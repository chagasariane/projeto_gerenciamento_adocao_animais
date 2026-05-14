<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Raca extends Model
{
    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'nome',
        'descricao',
        'especie_id'
    ];

    /**
     * Espécie à qual a raça pertence.
     */
    public function especie(): BelongsTo
    {
        return $this->belongsTo(Especie::class);
    }

    /**
     * Animais pertencentes à raça.
     */
    public function animais(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}