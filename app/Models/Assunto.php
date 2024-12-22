<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'assuntos';
    protected $fillable = [
        'tipo',
        'descricao'
    ];

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_assunto', 'assunto_id', 'evento_id');
    }
}
