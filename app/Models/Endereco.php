<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
    'logradouro',
    'numero',
    'complemento',
    'cidade',
    'estado',
    'cep',
    'user_id'
];
}
