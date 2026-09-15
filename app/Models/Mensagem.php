<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mensagem extends Model
{
    protected $table = 'mensagens';

    protected $fillable = [
        'conversa_id',
        'usuario_id',
        'mensagem',
        'lida',
    ];

    protected $casts = [
        'lida' => 'boolean',
    ];

    public function conversa(): BelongsTo
    {
        return $this->belongsTo(Conversa::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}