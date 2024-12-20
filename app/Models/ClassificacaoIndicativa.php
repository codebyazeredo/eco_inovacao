<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificacaoIndicativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'classificacao'
    ];

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_classificacao', 'classificacao_indicativa_id', 'evento_id');
    }
}
