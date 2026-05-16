<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adocao extends Model
{
    use SoftDeletes;

    /**
     * Nome da tabela.
     */
    protected $table = 'adocoes';

    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'user_id',
        'animal_id',
        'status',
        'mensagem',
        'data_aprovacao',
    ];

    /**
     * Conversão automática de tipos.
     */
    protected $casts = [
        'data_aprovacao' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    /**
     * Usuário solicitante da adoção.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Animal relacionado à adoção.
     */
    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}