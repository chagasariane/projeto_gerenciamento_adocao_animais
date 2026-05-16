<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'logradouro',
        'numero',
        'complemento',
        'cidade',
        'estado',
        'cep',
        'user_id'
    ];

    /**
     * Usuário proprietário do endereço.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}