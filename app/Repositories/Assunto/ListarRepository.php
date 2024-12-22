<?php

namespace App\Repositories\Assunto;

use App\Models\Assunto;

class ListarRepository
{
    public function listar()
    {
        return Assunto::query()->get();
    }
}
