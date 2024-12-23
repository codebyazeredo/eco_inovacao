<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Repositories\Categoria\GravarRepository;
use App\Http\Requests\CategoriaRequest;
use App\Repositories\Categoria\ListarRepository;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    public function index(ListarRepository $repository): JsonResponse
    {
        $categorias = $repository->listar();
        return response()->json(['categorias' => $categorias]);
    }

    public function show($id): JsonResponse
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json(['categoria' => $categoria]);
    }

    public function store(CategoriaRequest $request, GravarRepository $repository): JsonResponse
    {
        $dados = $request->validated();

        if (!$repository->criaOuAtualiza($dados)) {
            return response()->json(['message' => 'Erro ao salvar a categoria'], 422);
        }

        return response()->json(['message' => 'Categoria salva com sucesso']);
    }

    public function update(CategoriaRequest $request, $id, GravarRepository $repository): JsonResponse
    {
        $dados = $request->validated();

        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        if (!$repository->criaOuAtualiza($dados, $id)) {
            return response()->json(['message' => 'Erro ao atualizar a categoria'], 422);
        }

        return response()->json(['message' => 'Categoria atualizada com sucesso']);
    }

    public function destroy(int $id, GravarRepository $repository): JsonResponse
    {
        if (!$repository->excluir($id)) {
            return response()->json(['message' => 'Erro ao excluir a categoria'], 422);
        }

        return response()->json(['message' => 'Categoria excluída com sucesso']);
    }
}
