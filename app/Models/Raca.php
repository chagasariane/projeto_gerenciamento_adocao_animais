<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Especie;

class Raca extends Model
{
    protected $table = 'racas';

    protected $fillable = [
        'nome',
        'descricao',
        'especie_id'
    ];

    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }
}