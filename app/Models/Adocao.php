<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Animal;

class Adocao extends Model
{
    protected $table = 'adocoes';

    protected $fillable = [
        'data_adocao',
        'data_requisicao',
        'descricao',
        'status',
        'user_id',
        'animal_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}