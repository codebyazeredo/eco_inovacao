document.addEventListener('DOMContentLoaded', function () {
    function inicializarSelect2(selectId) {
        $(`#${selectId}`).select2();
    }

    function inicializarMapa(mapId, latInputId, lngInputId) {
        const initialLocation = [-28.6775, -49.3697];
        const map = L.map(mapId).setView(initialLocation, 13);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '© OpenStreetMap contributors',
        }).addTo(map);

        const marker = L.marker(initialLocation, { draggable: true }).addTo(map);

        marker.on("dragend", function (e) {
            const { lat, lng } = e.target.getLatLng();
            document.getElementById(latInputId).value = lat.toFixed(6);
            document.getElementById(lngInputId).value = lng.toFixed(6);
            atualizarCep(lat, lng);
        });

        return { map, marker, initialLocation };
    }

    function configurarAutocomplete(inputId, suggestionsListId, map, marker, latInputId, lngInputId) {
        const input = document.getElementById(inputId);
        const suggestionsList = document.getElementById(suggestionsListId);
        let timeout = null;

        input.addEventListener("input", function () {
            const query = input.value.trim();

            if (!query) {
                suggestionsList.innerHTML = "";
                return;
            }

            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&format=json&addressdetails=1`)
                    .then((response) => response.json())
                    .then((data) => {
                        suggestionsList.innerHTML = "";

                        data.forEach((item) => {
                            const option = document.createElement("option");
                            option.value = item.display_name;
                            suggestionsList.appendChild(option);
                        });

                        if (data.length === 0) {
                            const option = document.createElement("option");
                            option.value = "Nenhum resultado encontrado";
                            suggestionsList.appendChild(option);
                        }
                    })
                    .catch((error) => console.error("Erro no autocomplete:", error));
            }, 300);
        });

        input.addEventListener("change", function () {
            const selectedAddress = input.value;

            if (!selectedAddress) return;

            fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(selectedAddress)}&format=json&addressdetails=1`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.length === 0) return;

                    const { lat, lon, address } = data[0];
                    const newLocation = [parseFloat(lat), parseFloat(lon)];

                    map.setView(newLocation, 13);
                    marker.setLatLng(newLocation);

                    document.getElementById(latInputId).value = lat;
                    document.getElementById(lngInputId).value = lon;

                    if (address) {
                        if (address.road) document.getElementById("rua").value = address.road || '';
                        if (address.suburb) document.getElementById("bairro").value = address.suburb || '';
                        if (address.city) document.getElementById("cidade").value = address.city || '';
                        if (address.state) document.getElementById("estado").value = address.state || '';
                        if (address.postcode) document.getElementById("cep").value = address.postcode || '';
                        if (address.country) {
                            document.getElementById("estado").value = address.state || address.country;
                        }
                    }

                    atualizarCep(lat, lon);
                })
                .catch((error) => console.error("Erro ao atualizar o mapa:", error));
        });
    }

    function atualizarCep(latitude, longitude) {
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json&addressdetails=1`)
            .then((response) => response.json())
            .then((data) => {
                if (data && data.address) {
                    const address = data.address;
                    if (address.postcode) {
                        document.getElementById("cep").value = address.postcode || '';
                    } else {
                        document.getElementById("cep").value = ''; // Se não encontrar o CEP
                    }
                }
            })
            .catch((error) => console.error("Erro ao buscar o CEP:", error));
    }

    $(document).ready(function () {
        inicializarSelect2('estado');

        const { map, marker, initialLocation } = inicializarMapa('map', 'latitude', 'longitude');

        configurarAutocomplete('local_evento', 'suggestions', map, marker, 'latitude', 'longitude');

        atualizarCep(initialLocation[0], initialLocation[1]);
        document.getElementById("latitude").value = initialLocation[0];
        document.getElementById("longitude").value = initialLocation[1];
    });

});
