<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Mensagem;

class Conversa extends Model
{
    protected $fillable = [
        'usuario_1_id',
        'usuario_2_id',
    ];

    public function usuario1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_1_id');
    }

    public function usuario2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_2_id');
    }

    public function mensagens(): HasMany
    {
        return $this->hasMany(Mensagem::class);
    }
}