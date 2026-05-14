<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Animal extends Model
{
    use SoftDeletes;

    /**
     * Nome da tabela.
     */
    protected $table = 'animais';

    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'user_id',
        'especie_id',
        'raca_id',
        'nome',
        'descricao',
        'data_nascimento',
        'sexo',
        'porte',
        'status',
        'cidade',
        'estado',
        'castrado',
        'vacinado',
        'necessidades_especiais',
    ];

    /**
     * Conversão automática de tipos.
     */
    protected $casts = [
        'data_nascimento' => 'date',
        'castrado' => 'boolean',
        'vacinado' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    /**
     * Usuário responsável pelo animal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Espécie do animal.
     */
    public function especie(): BelongsTo
    {
        return $this->belongsTo(Especie::class);
    }

    /**
     * Raça do animal.
     */
    public function raca(): BelongsTo
    {
        return $this->belongsTo(Raca::class);
    }

    /**
     * Solicitações de adoção do animal.
     */
    public function adocoes(): HasMany
    {
        return $this->hasMany(Adocao::class);
    }

    /*
    |--------------------------------------------------------------------------
    | FOTOS
    |--------------------------------------------------------------------------
    */

    /**
     * Fotos do animal.
     */
    public function fotos(): HasMany
    {
        return $this->hasMany(AnimalFoto::class);
    }

    /**
     * Foto principal do animal.
     */
    public function fotoPrincipal(): HasOne
    {
        return $this->hasOne(AnimalFoto::class)
                    ->where('principal', true);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /**
     * Retorna idade formatada do animal.
     */
    public function getIdadeFormatadaAttribute(): string
    {
        if (!$this->data_nascimento) {

            return 'Idade não informada';
        }

        $agora = Carbon::now();

        $anos = (int) $this->data_nascimento
            ->diffInYears($agora);

        if ($anos >= 1) {

            return $anos . ' ' .
                ($anos === 1 ? 'ano' : 'anos');
        }

        $meses = (int) $this->data_nascimento
            ->diffInMonths($agora);

        if ($meses >= 1) {

            return $meses . ' ' .
                ($meses === 1 ? 'mês' : 'meses');
        }

        return 'Recém-nascido';
    }
}