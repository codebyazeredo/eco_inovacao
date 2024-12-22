<?php

namespace App\Repositories\Assunto;

use Exception;
use App\Models\Assunto;
use Illuminate\Support\Facades\DB;

class GravarRepository
{
    private $dados;
    private $assuntoId;

    public function criaOuAtualiza(array $dados, int $id = null): bool
    {
        $this->dados = $dados;
        $this->assuntoId = $id;
        try {
            DB::beginTransaction();
            $this->gravaAssunto();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }

        return true;
    }

    private function gravaAssunto(): void
    {
        $assunto = Assunto::findOrNew($this->assuntoId);
        $assunto->fill($this->dados);
        $assunto->saveOrFail();
    }

    public function excluir(int $id): bool
    {
        try {
            DB::beginTransaction();
            $assunto = Assunto::findOrFail($id);
            $assunto->delete();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }

        return true;
    }
}
