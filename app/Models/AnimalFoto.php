<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalFoto extends Model
{
    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'animal_id',
        'caminho',
        'principal'
    ];

    /**
     * Conversão automática de tipos.
     */
    protected $casts = [
        'principal' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    /**
     * Animal proprietário da foto.
     */
    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}