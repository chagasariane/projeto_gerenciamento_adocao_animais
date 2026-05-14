<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'cnpj',
        'telefone',
        'celular',
        'is_admin'
    ];

    /**
     * Campos ocultos em serializações.
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Conversão automática de tipos.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Endereço do usuário.
     */
    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }

    /**
     * Animais cadastrados pelo usuário.
     */
    public function animais(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    /**
     * Solicitações de adoção realizadas pelo usuário.
     */
    public function adocoes(): HasMany
    {
        return $this->hasMany(Adocao::class);
    }
}