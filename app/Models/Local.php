<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cep',
        'cidade',
        'estado',
        'bairro',
        'rua',
        'numero',
        'complemento',
        'latitude',
        'longitude',
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'local_id');
    }
}
