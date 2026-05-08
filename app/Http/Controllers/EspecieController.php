<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especie;

class EspecieController extends Controller
{
    // LISTAR
    public function index(Request $request)
    {
        $query = Especie::query();

        if ($request->filled('nome')) {

            $query->where('nome', 'like', '%' . $request->nome . '%');

        }

        $especies = $query
            ->orderBy('nome')
            ->get();

        return view('especies.index', compact('especies'));
    }

    // FORMULÁRIO DE CRIAÇÃO
    public function create()
    {
        return view('especies.create');
    }

    // SALVAR
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'nullable'
        ]);

        Especie::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        return redirect()
            ->route('especies.index')
            ->with('success', 'Espécie cadastrada com sucesso!');
    }

    // FORMULÁRIO DE EDIÇÃO
    public function edit($id)
    {
        $especie = Especie::findOrFail($id);
        return view('especies.edit', compact('especie'));
    }

    // ATUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'nullable'
        ]);

        $especie = Especie::findOrFail($id);

        $especie->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        return redirect()
            ->route('especies.index')
            ->with('success', 'Espécie atualizada com sucesso!');
    }

    // EXCLUIR
    public function destroy($id)
    {
        $especie = Especie::findOrFail($id);
        $especie->delete();

        return redirect()
            ->route('especies.index')
            ->with('success', 'Espécie excluída com sucesso!');
    }
}