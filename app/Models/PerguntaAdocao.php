<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerguntaAdocao extends Model
{
    protected $table = 'perguntas_adocao';

    protected $fillable = [
        'pergunta',
        'tipo',
        'opcoes',
        'obrigatoria',
        'ordem',
        'ativo',
    ];

    protected $casts = [
        'opcoes' => 'array',
        'obrigatoria' => 'boolean',
        'ativo' => 'boolean',
    ];

    public function respostas(): HasMany
    {
        return $this->hasMany(
            RespostaAdocao::class,
            'pergunta_id'
        );
    }
}