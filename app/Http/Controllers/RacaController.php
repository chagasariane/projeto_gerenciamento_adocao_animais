<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Raca;
use App\Models\Especie;

class RacaController extends Controller
{
    public function index(Request $request)
    {
        $query = Raca::with('especie');

        /*
        |--------------------------------------------------------------------------
        | FILTRO POR NOME
        |--------------------------------------------------------------------------
        */

        if ($request->filled('nome')) {

            $query->where(
                'nome',
                'like',
                '%' . $request->nome . '%'
            );

        }

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

        $racas = $query
            ->orderBy('nome')
            ->get();

        $especies = Especie::orderBy('nome')->get();

        return view(
            'racas.index',
            compact('racas', 'especies')
        );
    }

    public function create()
    {
        $especies = Especie::all();
        return view('racas.create', compact('especies'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'nome' => trim($request->nome)
        ]);

        $request->validate([

            'nome' => [
                'required',
                'max:255',
                \Illuminate\Validation\Rule::unique('racas')
                    ->where(function ($query) use ($request) {

                        return $query->where(
                            'especie_id',
                            $request->especie_id
                        );

                    }),
            ],

            'especie_id' =>
                'required|exists:especies,id',

        ], [

            'nome.unique' =>
                'Esta raça já está cadastrada para esta espécie.',

        ]);

        Raca::create([
        'nome' => mb_convert_case(
            $request->nome,
            MB_CASE_TITLE,
            'UTF-8'
        ),

            'descricao' => $request->descricao,

            'especie_id' => $request->especie_id,
        ]);

        return redirect()
            ->route('racas.index')
            ->with('success', 'Raça cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $raca = Raca::findOrFail($id);
        $especies = Especie::all();

        return view('racas.edit', compact('raca', 'especies'));
    }

    public function update(Request $request, $id)
    {
        $request->merge([

            'nome' => trim($request->nome)

        ]);

        $raca = Raca::findOrFail($id);

        $request->validate([

            'nome' => [
                'required',
                'max:255',

                \Illuminate\Validation\Rule::unique('racas')
                    ->where(function ($query) use ($request) {

                        return $query->where(
                            'especie_id',
                            $request->especie_id
                        );

                    })
                    ->ignore($id),
            ],

            'especie_id' =>
                'required|exists:especies,id',

        ], [

            'nome.unique' =>
                'Esta raça já está cadastrada para esta espécie.',

        ]);

        $raca->update([

            'nome' => mb_convert_case(
                $request->nome,
                MB_CASE_TITLE,
                'UTF-8'
            ),

            'descricao' => $request->descricao,

            'especie_id' => $request->especie_id,

        ]);

        return redirect()
            ->route('racas.index')
            ->with('success', 'Raça atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $raca = Raca::findOrFail($id);
        $raca->delete();

        return redirect()
            ->route('racas.index')
            ->with('success', 'Raça excluída com sucesso!');
    }
}