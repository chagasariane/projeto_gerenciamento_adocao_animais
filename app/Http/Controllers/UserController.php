<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Endereco;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        /*
        |--------------------------------------------------------------------------
        | REGRA DE NEGÓCIO
        |--------------------------------------------------------------------------
        | Usuário deve possuir CPF ou CNPJ
        */

        if (
            empty($request->cpf) &&
            empty($request->cnpj)
        ) {
            return back()
                ->withErrors([
                    'cpf' => 'Informe CPF ou CNPJ.'
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | CRIAÇÃO DO USUÁRIO
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'cpf' => $request->cpf ?: null,
            'cnpj' => $request->cnpj ?: null,
            'telefone' => $request->telefone,
            'celular' => $request->celular,
            'is_admin' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ENDEREÇO
        |--------------------------------------------------------------------------
        */

        Endereco::create([
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'cep' => $request->cep,
            'user_id' => $user->id
        ]);

        return redirect()
            ->route('login.form')
            ->with('success', 'Conta criada com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | REGRA DE NEGÓCIO
        |--------------------------------------------------------------------------
        */

        if (
            empty($request->cpf) &&
            empty($request->cnpj)
        ) {
            return back()
                ->withErrors([
                    'cpf' => 'Informe CPF ou CNPJ.'
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | ATUALIZAÇÃO
        |--------------------------------------------------------------------------
        */

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf ?: null,
            'cnpj' => $request->cnpj ?: null,
            'telefone' => $request->telefone,
            'celular' => $request->celular,
        ];

        /*
        |--------------------------------------------------------------------------
        | SENHA OPCIONAL
        |--------------------------------------------------------------------------
        */

        if (!empty($request->password)) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        /*
        |--------------------------------------------------------------------------
        | ENDEREÇO
        |--------------------------------------------------------------------------
        */

        if ($user->endereco) {

            $user->endereco->update([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'cep' => $request->cep,
            ]);

        } else {

            Endereco::create([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'cep' => $request->cep,
                'user_id' => $user->id
            ]);

        }

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }
}