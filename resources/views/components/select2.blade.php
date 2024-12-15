@props([
    'primaryKey' => null,
    'textKey' => null,
    'textKeyFn' => null,
    'route' => null,
    'value' => null,
    'data' => [],
    'filter' => null,
    'fixedFilter' => null,
    'closeOnSelect' => true,
    'defaultAttributes' => [
        'class' => 'form-control',
        'style' => 'width: ' . $width,
        'id' => $id,
    ],
    'processResults' => null,
    'formControl' => [],
    'retrieveValue' => true,
])

@php
    $multiple = isset($multiple) && $multiple !== false;

    if ($retrieveValue && $value === null) {
        $value = request()->input($nome);
    }

    if ($value !== null && !is_array($value)) {
        $value = [$value];
    }

    if ($multiple && !str_ends_with($nome, '[]')) {
        $nome .= '[]';
    }

    $attributes = array_merge($defaultAttributes, $formControl);

    if (!$closeOnSelect) {
        $attributes['data-close-on-select'] = 'false';
    }

    if (empty($id) && !empty($nome)) {
        $id = str_replace(['[', ']'], ['', ''], $nome) . '-select2' . rand(1000, 9999);
        $attributes['id'] = $id;
    }

    if (empty($id) && empty($nome)) {
        $id = 'select2-' . rand(1000, 9999);
        $attributes['id'] = $id;
    }

    $selectIdJs = '$' . str_replace('-', '', $id) . 'Select2';
    $selectPlaceholderJs = $multiple ? 'querySelector("input.select2-search__field").placeholder' : 'querySelector("span.select2-selection__placeholder").innerText';

    $routeName = $route[0] ?? null;
    $routeParameters = $route[1] ?? [];
    $textKeysJs = $textKey ? 'item.' . implode(' || item.', $textKey) : "item.{$primaryKey}";

    $arrayValues = null;
    if (isset($routeParameters['tableOrModel']) && isset($primaryKey) && isset($value) && class_exists('\App\\' . $routeParameters['tableOrModel'])) {
        $model = '\App\\' . $routeParameters['tableOrModel'];
        $arrayValues = $model::select($routeParameters['selectable'] ?? '*')->whereIn($primaryKey, $value)->get();
    }

    if ($processResults == null) {
        $processResults = "data => {
            const items = [];
        ";

        if ($textKeyFn !== null) {
            $processResults .= "
                const textKeyFn = {$textKeyFn};
            ";
        }

        $processResults .= "
            data.items.forEach(function (item) {
                items.push({
                    id: item.{$primaryKey},
                    text:
        ";

        if ($textKeyFn !== null) {
            $processResults .= "textKeyFn(item)";
        } else {
            $processResults .= $textKeysJs;
        }

        $processResults .= ",";
        $processResults .= "
                });
            });

            return {
                results: items,
                pagination: {
                    more: data.page < data.total_pages
                }
            };
        }";
    }
@endphp

{{ Form::select($nome, $data, '', $attributes) }}

<script type="text/javascript">
    $(document).ready(function() {
        const {{ $selectIdJs }} = $('#' + '{{ $id }}');
        {{ $selectIdJs }}.each(function() {
            $(this).select2({
                ajax: {
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    url: function(params) {
                        @if ($routeName !== null)
                            return '{!! route($routeName, $routeParameters) !!}';
                        @elseif ($filter !== null)
                            return '{!! $url !!}';
                        @endif
                    },
                    data: function(params) {
                        @php
                            $filter = (array) $filter;
                            if (is_string(array_key_first($filter))) {
                                $filter = [$filter];
                            }
                        @endphp

                        let filters = [
                                @foreach ($filter as $filterKey => $filterValue)
                                @php
                                    $filterField = null;
                                    $filterOperator = null;
                                    $filterSearchValue = null;

                                    if (is_array($filterValue)) {
                                        $filterField = $filterValue['field'];
                                        $filterOperator = $filterValue['operator'] ?? null;
                                        $filterSearchValue = $filterValue['value'] ?? null;
                                    } else {
                                        if (is_string($filterKey)) {
                                            $filterField = $filterKey;
                                            $filterSearchValue = $filterValue;
                                        } else{
                                            $filterField = $filterValue;
                                        }
                                    }
                                @endphp

                            {
                                "field": "{{ $filterField }}",
                                @if ($filterOperator !== null)
                                "operator": "{{ $filterOperator }}",
                                @endif
                                "value":
                                    @if ($filterSearchValue !== null)
                                        "{{ $filterSearchValue }}"
                                @else
                                params.term.trimEnd()
                                @endif
                            },
                            @endforeach
                        ];
                        let fixedFilters = [
                                @foreach ($fixedFilter ?? [] as $filterKey => $filterValue)
                                @php
                                    $filterField = null;
                                    $filterOperator = null;
                                    $filterSearchValue = null;

                                    if (is_array($filterValue)) {
                                        $filterField = $filterValue['field'];
                                        $filterOperator = $filterValue['operator'] ?? null;
                                        $filterSearchValue = $filterValue['value'] ?? null;
                                    } else {
                                        if (is_string($filterKey)) {
                                            $filterField = $filterKey;
                                            $filterSearchValue = $filterValue;
                                        } else{
                                            $filterField = $filterValue;
                                        }
                                    }
                                @endphp

                            {
                                "field": "{{ $filterField }}",
                                @if ($filterOperator !== null)
                                "operator": "{{ $filterOperator }}",
                                @endif
                                "value": "{{ $filterSearchValue }}"
                            },
                            @endforeach
                        ];

                        filters = filters.filter(filter => filter.value !== '');

                        return {
                            page: params.page,
                            filter: filters,
                            fixedFilter: fixedFilters
                        };
                    },
                    processResults: {!! $processResults !!},
                    cache: true
                },
                multiple: {{ $multiple ? 'true' : 'false' }},
                allowClear: true,
                minimumInputLength: 1,
                placeholder: "{{ $placeholder }}",
                dropdownParent: $(this).parent()
            });
        });

        {{ $selectIdJs }}[0].dataset.placeholder = {{ $selectIdJs }}[0].closest('div').{!! $selectPlaceholderJs !!};

        @if ($textKeyFn !== null)
        const textKeyFn = {!! $textKeyFn !!};
        @endif

        @if (is_null($arrayValues) && is_array($value) && count($value) > 0 && !is_null($routeName) && !is_null($primaryKey))
        const data = [];
        const values = [];
        const getFilters = {
            filter: [
                {
                    field: '{{ $primaryKey }}',
                    operator: 'IN',
                    value: [ {!! "'" . implode("', '", $value) . "'" !!} ]
                }
            ]
        };

        {{ $selectIdJs }}.prop('disabled', true);
        {{ $selectIdJs }}[0].closest('div').{!! $selectPlaceholderJs !!} = 'Carregando...';

        $.get('{!! route($routeName, $routeParameters) !!}', getFilters)
            .done(response => {
                const data = [];
                response.items.forEach(item => {
                    data.push({
                        id: item.{{ $primaryKey }},
                        text:
                            @if ($textKeyFn !== null)
                            textKeyFn(item)
                        @else
                            {!! $textKeysJs !!}
                            @endif
                        ,
                    });

                    values.push(item.{{ $primaryKey }});
                });

                if (data.length > 0) {
                    data.forEach(item => {
                        {{ $selectIdJs }}
                            .append(new Option(item.text, item.id, true, true))
                    });
                }

                if (values.length > 0) {
                    {{ $selectIdJs }}
                        .val(values);
                }

                {{ $selectIdJs }}.trigger('change');
            })
            .always(() => {
                @if ($multiple)
                    {{ $selectIdJs }}[0].closest('div').{!! $selectPlaceholderJs !!} = {{ $selectIdJs }}[0].dataset.placeholder;
                @endif

                    {{ $selectIdJs }}.prop('disabled', false);
            });
        @endif

        @if (!is_null($arrayValues))
        const objectValues = JSON.parse('{!! json_encode($arrayValues) !!}');

        objectValues.forEach(item => {
            const option = new Option(
                @if ($textKeyFn !== null)
                textKeyFn(item)
            @else
                {{ $textKeysJs }}
                @endif
                , item.{{ $primaryKey }}, true, true);

            {{ $selectIdJs }}.append(option);
        });

        {{ $selectIdJs }}.trigger('change');
        @endif
    });
</script>
