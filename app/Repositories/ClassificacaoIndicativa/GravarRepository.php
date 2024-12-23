<?php

namespace App\Repositories\ClassificacaoIndicativa;

use Exception;
use App\Models\ClassificacaoIndicativa;
use Illuminate\Support\Facades\DB;

class GravarRepository
{
    private $dados;
    private $classificacaoId;

    public function criaOuAtualiza(array $dados, int $id = null): bool
    {
        $this->dados = $dados;
        $this->classificacaoId = $id;
        try {
            DB::beginTransaction();
            $this->gravaClassificacaoIndicativa();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }

        return true;
    }

    private function gravaClassificacaoIndicativa(): void
    {
        $classificacao = ClassificacaoIndicativa::findOrNew($this->classificacaoId);
        $classificacao->fill($this->dados);
        $classificacao->saveOrFail();
    }

    public function excluir(int $id): bool
    {
        try {
            DB::beginTransaction();
            $classificacao = ClassificacaoIndicativa::findOrFail($id);
            $classificacao->delete();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }

        return true;
    }
}
