<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Especie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HOME / CATÁLOGO
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | QUERY BASE
        |--------------------------------------------------------------------------
        */

        $query = Animal::with([

            'user',

            'raca',

            'especie',

            'fotoPrincipal'

        ])
        ->where('status', 'DISPONIVEL');

        /*
        |--------------------------------------------------------------------------
        | FILTRO POR ESPÉCIE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('especie_id')) {

            $query->where(
                'especie_id',
                $request->especie_id
            );

        }

        /*
        |--------------------------------------------------------------------------
        | FILTRO POR PORTE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('porte')) {

            $query->where(
                'porte',
                $request->porte
            );

        }

        /*
        |--------------------------------------------------------------------------
        | FILTRO POR CIDADE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('cidade')) {

            $query->where(
                'cidade',
                'like',
                '%' . $request->cidade . '%'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | BUSCA POR NOME
        |--------------------------------------------------------------------------
        */

        if ($request->filled('busca')) {

            $query->where(
                'nome',
                'like',
                '%' . $request->busca . '%'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | RESULTADOS
        |--------------------------------------------------------------------------
        */

        $animais = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | ESPÉCIES
        |--------------------------------------------------------------------------
        */

        $especies = Especie::orderBy('nome')->get();

        return view('home', compact(

            'animais',

            'especies'

        ));
    }
}