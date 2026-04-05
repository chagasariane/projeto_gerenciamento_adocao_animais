<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adocao;
use App\Models\User;
use App\Models\Animal;

class AdocaoController extends Controller
{
    public function index()
    {
        $adocoes = Adocao::with(['user', 'animal'])->latest()->get();

        return view('adocoes.index', compact('adocoes'));
    }

    public function create()
    {
        $users = User::all();
        $animais = Animal::all();

        return view('adocoes.create', compact('users', 'animais'));
    }

    public function store(Request $request)
    {
        // Regra de duplicidade
        $existe = Adocao::where('user_id', $request->user_id)
            ->where('animal_id', $request->animal_id)
            ->exists();

        if ($existe) {
            return back()
                ->withErrors(['user_id' => 'Este usuário já solicitou adoção deste animal.'])
                ->withInput();
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'animal_id' => 'required|exists:animais,id',
            'status' => 'required|in:PENDENTE,APROVADO,RECUSADO,FINALIZADO',
            'descricao' => 'nullable|string'
        ]);

        Adocao::create([
            'user_id' => $request->user_id,
            'animal_id' => $request->animal_id,
            'status' => $request->status,
            'descricao' => $request->descricao,
            'data_requisicao' => now()
        ]);

        return redirect()
            ->route('adocoes.index')
            ->with('success', 'Adoção cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $adocao = Adocao::findOrFail($id);
        $users = User::all();
        $animais = Animal::all();

        return view('adocoes.edit', compact('adocao', 'users', 'animais'));
    }

    public function update(Request $request, $id)
    {
        $adocao = Adocao::findOrFail($id);

        // Regra de duplicidade (exceto o próprio registro)
        $existe = Adocao::where('user_id', $request->user_id)
            ->where('animal_id', $request->animal_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return back()
                ->withErrors(['user_id' => 'Este usuário já solicitou adoção deste animal.'])
                ->withInput();
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'animal_id' => 'required|exists:animais,id',
            'status' => 'required|in:PENDENTE,APROVADO,RECUSADO,FINALIZADO',
            'descricao' => 'nullable|string'
        ]);

        $adocao->update([
            'user_id' => $request->user_id,
            'animal_id' => $request->animal_id,
            'status' => $request->status,
            'descricao' => $request->descricao
        ]);

        return redirect()
            ->route('adocoes.index')
            ->with('success', 'Adoção atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $adocao = Adocao::findOrFail($id);
        $adocao->delete();

        return redirect()
            ->route('adocoes.index')
            ->with('success', 'Adoção excluída com sucesso!');
    }
}