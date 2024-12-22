<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Repositories\Assunto\GravarRepository;
use App\Http\Requests\AssuntoRequest;
use App\Repositories\Assunto\ListarRepository;
use Illuminate\Http\JsonResponse;

class AssuntoController extends Controller
{
    public function index(ListarRepository $repository): JsonResponse
    {
        $assuntos = $repository->listar();
        return response()->json(['assuntos' => $assuntos]);
    }

    public function show($id): JsonResponse
    {
        $assunto = Assunto::findOrFail($id);
        return response()->json(['assunto' => $assunto]);
    }

    public function store(AssuntoRequest $request, GravarRepository $repository): JsonResponse
    {
        $dados = $request->validated();

        if (!$repository->criaOuAtualiza($dados)) {
            return response()->json(['message' => 'Erro ao salvar o assunto'], 422);
        }

        return response()->json(['message' => 'Assunto salvo com sucesso']);
    }

    public function update(AssuntoRequest $request, $id, GravarRepository $repository): JsonResponse
    {
        $dados = $request->validated();

        $assunto = Assunto::find($id);
        if (!$assunto) {
            return response()->json(['message' => 'Assunto não encontrado'], 404);
        }

        if (!$repository->criaOuAtualiza($dados, $id)) {
            return response()->json(['message' => 'Erro ao atualizar o assunto'], 422);
        }

        return response()->json(['message' => 'Assunto atualizado com sucesso']);
    }

    public function destroy(int $id, GravarRepository $repository): JsonResponse
    {
        if (!$repository->excluir($id)) {
            return response()->json(['message' => 'Erro ao excluir o assunto'], 422);
        }

        return response()->json(['message' => 'Assunto excluído com sucesso']);
    }
}
