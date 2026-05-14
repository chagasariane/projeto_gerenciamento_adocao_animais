<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Especie extends Model
{
    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'nome',
        'descricao'
    ];

    /**
     * Raças pertencentes à espécie.
     */
    public function racas(): HasMany
    {
        return $this->hasMany(Raca::class);
    }

    /**
     * Animais pertencentes à espécie.
     */
    public function animais(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}