<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RespostaAdocao extends Model
{
    protected $table = 'respostas_adocao';

    protected $fillable = [
        'adocao_id',
        'pergunta_id',
        'pergunta',
        'resposta',
    ];

    public function adocao(): BelongsTo
    {
        return $this->belongsTo(Adocao::class);
    }

    public function pergunta(): BelongsTo
    {
        return $this->belongsTo(
            PerguntaAdocao::class,
            'pergunta_id'
        );
    }
}