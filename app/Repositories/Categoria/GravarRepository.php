<?php

namespace App\Repositories\Categoria;

use Exception;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class GravarRepository
{
    private $dados;
    private $categoriaId;

    public function criaOuAtualiza(array $dados, int $id = null): bool
    {
        $this->dados = $dados;
        $this->categoriaId = $id;
        try {
            DB::beginTransaction();
            $this->gravaCategoria();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }

        return true;
    }

    private function gravaCategoria(): void
    {
        $categoria = Categoria::findOrNew($this->categoriaId);
        $categoria->fill($this->dados);
        $categoria->saveOrFail();
    }

    public function excluir(int $id): bool
    {
        try {
            DB::beginTransaction();
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }

        return true;
    }
}
