<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Raca;
use App\Models\Especie;
use App\Models\User;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::with(['raca', 'user']);

        // Filtro por espécie
        if ($request->filled('especie_id')) {
            $query->whereHas('raca', function ($q) use ($request) {
                $q->where('especie_id', $request->especie_id);
            });
        }

        // Filtro por raça
        if ($request->filled('raca_id')) {
            $query->where('raca_id', $request->raca_id);
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $animais = $query->latest()->get();

        $especies = Especie::all();
        $racas = Raca::all();

        return view('animais.index', compact('animais', 'especies', 'racas'));
    }

    public function create()
    {
        $especies = Especie::all();
        $racas = Raca::all();
        $protetores = User::where('role', 'PROTETOR')->get();

        return view('animais.create', compact('especies', 'racas', 'protetores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'sexo' => 'required',
            'raca_id' => 'required|exists:racas,id',
            'user_id' => 'required|exists:users,id'
        ]);

        Animal::create([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'sexo' => $request->sexo,
            'porte' => $request->porte,
            'descricao' => $request->descricao,
            'status' => $request->status ?? 'disponivel',
            'user_id' => $request->user_id,
            'raca_id' => $request->raca_id
        ]);

        return redirect()
            ->route('animais.index')
            ->with('success', 'Animal cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        $especies = Especie::all();
        $racas = Raca::all();
        $protetores = User::where('role', 'PROTETOR')->get();

        return view('animais.edit', compact('animal', 'especies', 'racas', 'protetores'));
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $request->validate([
            'nome' => 'required|max:255',
            'sexo' => 'required',
            'raca_id' => 'required|exists:racas,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $animal->update([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'sexo' => $request->sexo,
            'porte' => $request->porte,
            'descricao' => $request->descricao,
            'status' => $request->status ?? 'disponivel',
            'user_id' => $request->user_id,
            'raca_id' => $request->raca_id
        ]);

        return redirect()
            ->route('animais.index')
            ->with('success', 'Animal atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return redirect()
            ->route('animais.index')
            ->with('success', 'Animal excluído com sucesso!');
    }
}