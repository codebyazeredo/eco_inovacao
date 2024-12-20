<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem_capa',
        'privado',
        'descricao',
        'data_inicio',
        'hora_inicio',
        'data_fim',
        'hora_fim',
        'local_id',
        'user_id',
        'termos_aceitos',
    ];

    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'evento_categoria', 'evento_id', 'categoria_id');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'evento_assunto', 'evento_id', 'assunto_id');
    }

    public function classificacoesIndicativas()
    {
        return $this->belongsToMany(ClassificacaoIndicativa::class, 'evento_classificacao', 'evento_id', 'classificacao_indicativa_id');
    }
}
