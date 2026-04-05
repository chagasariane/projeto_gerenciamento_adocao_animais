<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raca;
use App\Models\Especie;

class RacaController extends Controller
{
    public function index()
    {
        // 🔹 Eager Loading para evitar N+1
        $racas = Raca::with('especie')->get();

        return view('racas.index', compact('racas'));
    }

    public function create()
    {
        $especies = Especie::all();
        return view('racas.create', compact('especies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'especie_id' => 'required|exists:especies,id'
        ]);

        Raca::create($request->only([
            'nome',
            'descricao',
            'especie_id'
        ]));

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
        $raca = Raca::findOrFail($id);

        $request->validate([
            'nome' => 'required|max:255',
            'especie_id' => 'required|exists:especies,id'
        ]);

        $raca->update($request->only([
            'nome',
            'descricao',
            'especie_id'
        ]));

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