<?php

namespace App\Repositories\ClassificacaoIndicativa;

use App\Models\ClassificacaoIndicativa;

class ListarRepository
{
    public function listar()
    {
        return ClassificacaoIndicativa::all();
    }
}
