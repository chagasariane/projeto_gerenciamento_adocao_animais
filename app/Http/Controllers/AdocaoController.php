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
        $adocoes = Adocao::with(['user', 'animal'])->get();
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
        $existe = Adocao::where('user_id', $request->user_id)
            ->where('animal_id', $request->animal_id)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Este usuário já solicitou adoção deste animal.');
        }

        $request->validate([
            'user_id' => 'required',
            'animal_id' => 'required',
            'status' => 'required',
            'descricao' => 'nullable|string'
        ]);

        Adocao::create([
            'user_id' => $request->user_id,
            'animal_id' => $request->animal_id,
            'status' => $request->status,
            'descricao' => $request->descricao,
            'data_requisicao' => now()
        ]);

        return redirect()->route('adocoes.index');
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

        $request->validate([
            'user_id' => 'required',
            'animal_id' => 'required',
            'status' => 'required',
            'descricao' => 'nullable|string'
        ]);

        $adocao->update([
            'user_id' => $request->user_id,
            'animal_id' => $request->animal_id,
            'status' => $request->status,
            'descricao' => $request->descricao
        ]);

        return redirect()->route('adocoes.index');
    }

    public function destroy($id)
    {
        $adocao = Adocao::findOrFail($id);
        $adocao->delete();

        return redirect()->route('adocoes.index');
    }
}