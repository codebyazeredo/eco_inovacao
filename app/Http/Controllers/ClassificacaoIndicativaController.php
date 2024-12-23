<?php

namespace App\Http\Controllers;

use App\Models\ClassificacaoIndicativa;
use App\Repositories\ClassificacaoIndicativa\GravarRepository;
use App\Http\Requests\ClassificacaoIndicativaRequest;
use App\Repositories\ClassificacaoIndicativa\ListarRepository;
use Illuminate\Http\JsonResponse;

class ClassificacaoIndicativaController extends Controller
{
    public function index(ListarRepository $repository): JsonResponse
    {
        $classificacoes = $repository->listar();
        return response()->json(['classificacoes' => $classificacoes]);
    }

    public function show($id): JsonResponse
    {
        $classificacao = ClassificacaoIndicativa::findOrFail($id);
        return response()->json(['classificacao' => $classificacao]);
    }

    public function store(ClassificacaoIndicativaRequest $request, GravarRepository $repository): JsonResponse
    {
        $dados = $request->validated();

        if (!$repository->criaOuAtualiza($dados)) {
            return response()->json(['message' => 'Erro ao salvar a classificação indicativa'], 422);
        }

        return response()->json(['message' => 'Classificação Indicativa salva com sucesso']);
    }

    public function update(ClassificacaoIndicativaRequest $request, $id, GravarRepository $repository): JsonResponse
    {
        $dados = $request->validated();

        $classificacao = ClassificacaoIndicativa::find($id);
        if (!$classificacao) {
            return response()->json(['message' => 'Classificação Indicativa não encontrada'], 404);
        }

        if (!$repository->criaOuAtualiza($dados, $id)) {
            return response()->json(['message' => 'Erro ao atualizar a classificação indicativa'], 422);
        }

        return response()->json(['message' => 'Classificação Indicativa atualizada com sucesso']);
    }

    public function destroy(int $id, GravarRepository $repository): JsonResponse
    {
        if (!$repository->excluir($id)) {
            return response()->json(['message' => 'Erro ao excluir a classificação indicativa'], 422);
        }

        return response()->json(['message' => 'Classificação Indicativa excluída com sucesso']);
    }
}
