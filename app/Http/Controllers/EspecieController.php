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
        $request->merge([
            'nome' => trim($request->nome)
        ]);

        $request->validate([

            'nome' => 'required|max:255|unique:especies,nome',

            'descricao' => 'nullable'

        ], [

            'nome.unique' =>
                'Esta espécie já está cadastrada.',

        ]);

        Especie::create([
            'nome' => ucfirst(strtolower($request->nome)),
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
        $request->merge([
            'nome' => trim($request->nome)
        ]);

        $request->validate([

            'nome' => 'required|max:255|unique:especies,nome,' . $id,

            'descricao' => 'nullable'

        ], [

            'nome.unique' =>
                'Esta espécie já está cadastrada.',

        ]);

        $especie = Especie::findOrFail($id);

        $especie->update([
            'nome' => ucfirst(strtolower($request->nome)),
            'descricao' => $request->descricao
        ]);

        return redirect()
            ->route('especies.index')
            ->with('success', 'Espécie atualizada com sucesso!');
    }

    // EXCLUIR
    public function destroy($id)
    {
    $especie = Especie::with('racas')->findOrFail($id);

    // Verifica se existem raças vinculadas à espécie.
    if ($especie->racas()->exists()) {

    $nomesRacas = $especie->racas()
        ->orderBy('nome')
        ->pluck('nome')
        ->implode(', ');

    return redirect()
        ->route('especies.index')
        ->with(
            'error',
            "Não é possível excluir a espécie '{$especie->nome}', pois ela possui raças cadastradas: {$nomesRacas}."
        );

    }

    // Verifica se existem animais vinculados diretamente à espécie.
    if ($especie->animais()->exists()) {

    $nomesAnimais = $especie->animais()
        ->orderBy('nome')
        ->pluck('nome')
        ->implode(', ');

    return redirect()
        ->route('especies.index')
        ->with(
            'error',
            "Não é possível excluir a espécie '{$especie->nome}', pois existem animais cadastrados que utilizam essa espécie: {$nomesAnimais}."
        );

    }

    $especie->delete();

    return redirect()
    ->route('especies.index')
    ->with('success', 'Espécie excluída com sucesso!');
    }
}