<?php

namespace App\Traits;

trait GetError
{
    protected $error = "";

    public function validateData(array $dados, array $validacoes) : bool
    {
        foreach ($validacoes as $campo => $descricao) {
            if (empty($dados[$campo])) {
                $this->error = "Necessário informar $descricao.";
                return false;
            }
        }

        return true;
    }

    public function getError()
    {
        return $this->error;
    }
}
