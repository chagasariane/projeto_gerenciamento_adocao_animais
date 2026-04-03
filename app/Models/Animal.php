<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Raca;

class Animal extends Model
{
    protected $table = 'animais';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'sexo',
        'porte',
        'descricao',
        'status',
        'user_id',
        'raca_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function raca()
    {
        return $this->belongsTo(Raca::class);
    }
}