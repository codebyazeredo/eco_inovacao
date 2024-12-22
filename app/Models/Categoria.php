<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_categoria', 'categoria_id', 'evento_id');
    }
}
