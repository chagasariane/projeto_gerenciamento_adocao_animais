<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['data_adocao', 'data_requisicao', 'descricao', 'status', 'user_id', 'animal_id'])]
class Adocao extends Model
{
    protected $table = 'adocoes';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

}