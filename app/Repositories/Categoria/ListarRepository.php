<?php

namespace App\Repositories\Categoria;

use App\Models\Categoria;

class ListarRepository
{
    public function listar()
    {
        return Categoria::all();
    }
}
