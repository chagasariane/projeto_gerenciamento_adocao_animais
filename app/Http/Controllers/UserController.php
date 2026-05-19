<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::latest()->get();
        $query = User::latest();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $users = $query->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
  
    /*
    |--------------------------------------------------------------------------
    | NORMALIZAÇÃO
    |--------------------------------------------------------------------------
    */

    $request->merge([

        'cpf' => $request->cpf
            ? preg_replace('/\D/', '', $request->cpf)
            : null,

        'cnpj' => $request->cnpj
            ? preg_replace('/\D/', '', $request->cnpj)
            : null,

        'telefone' => $request->telefone
            ? preg_replace('/\D/', '', $request->telefone)
            : null,

        'celular' => $request->celular
            ? preg_replace('/\D/', '', $request->celular)
            : null,

        'cep' => $request->cep
            ? preg_replace('/\D/', '', $request->cep)
            : null,

    ]);

    /*
    |--------------------------------------------------------------------------
    | VALIDAÇÃO
    |--------------------------------------------------------------------------
    */

    $request->validate([

        'name' => 'required|max:255',

        'email' => 'required|email|unique:users,email',

        'password' => 'required|string|min:6|confirmed',

        'celular' => 'required',

        'cpf' => 'nullable|unique:users,cpf',

        'cnpj' => 'nullable|unique:users,cnpj',

        'cep' => 'required',

        'logradouro' => 'required|max:255',

        'numero' => 'required|max:20',

        'cidade' => 'required|max:255',

        'estado' => 'required|max:2',

        ], [

            'cpf.unique' =>
                'Este CPF já está cadastrado.',

            'cnpj.unique' =>
                'Este CNPJ já está cadastrado.',

            'email.unique' =>
                'Este e-mail já está cadastrado.',

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

        $cpf = $request->cpf
            ? preg_replace('/\D/', '', $request->cpf)
            : null;

        $cnpj = $request->cnpj
            ? preg_replace('/\D/', '', $request->cnpj)
            : null;

        $telefone = $request->telefone
            ? preg_replace('/\D/', '', $request->telefone)
            : null;

        $celular = $request->celular
            ? preg_replace('/\D/', '', $request->celular)
            : null;

        $cep = $request->cep
            ? preg_replace('/\D/', '', $request->cep)
            : null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf' => $cpf,
            'cnpj' => $cnpj,
            'telefone' => $telefone,
            'celular' => $celular,
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
            'cep' => $cep,
            'user_id' => $user->id
        ]);

        if (auth()->check() && auth()->user()->is_admin) {

            return redirect()
                ->route('users.index')
                ->with(
                    'success',
                    'Usuário criado com sucesso!'
                );

        }

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Conta criada com sucesso!'
            );
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

            'celular' => 'required',

            'cep' => 'required',

            'logradouro' => 'required|max:255',

            'numero' => 'required|max:20',

            'cidade' => 'required|max:255',

            'estado' => 'required|size:2',

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
        | NORMALIZAÇÃO
        |--------------------------------------------------------------------------
        */

        $cpf = $request->cpf
            ? preg_replace('/\D/', '', $request->cpf)
            : null;

        $cnpj = $request->cnpj
            ? preg_replace('/\D/', '', $request->cnpj)
            : null;

        $telefone = $request->telefone
            ? preg_replace('/\D/', '', $request->telefone)
            : null;

        $celular = $request->celular
            ? preg_replace('/\D/', '', $request->celular)
            : null;

        $cep = $request->cep
            ? preg_replace('/\D/', '', $request->cep)
            : null;

        /*
        |--------------------------------------------------------------------------
        | DADOS DO USUÁRIO
        |--------------------------------------------------------------------------
        */

        $data = [

            'name' => trim($request->name),

            'email' => trim($request->email),

            'cpf' => $cpf,

            'cnpj' => $cnpj,

            'telefone' => $telefone,

            'celular' => $celular,

            'is_admin' => $request->is_admin,

        ];

        /*
        |--------------------------------------------------------------------------
        | SENHA OPCIONAL
        |--------------------------------------------------------------------------
        */

        if (!empty($request->password)) {

            $data['password'] =
                Hash::make($request->password);

        }

        $user->update($data);

        /*
        |--------------------------------------------------------------------------
        | ENDEREÇO
        |--------------------------------------------------------------------------
        */

        $dadosEndereco = [

            'logradouro' => trim($request->logradouro),

            'numero' => trim($request->numero),

            'complemento' => $request->complemento
                ? trim($request->complemento)
                : null,

            'cidade' => trim($request->cidade),

            'estado' => strtoupper(trim($request->estado)),

            'cep' => $cep,

        ];

        if ($user->endereco) {

            $user->endereco->update(
                $dadosEndereco
            );

        } else {

            $dadosEndereco['user_id'] =
                $user->id;

            Endereco::create(
                $dadosEndereco
            );

        }

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Usuário atualizado com sucesso!'
            );
    }

    public function perfil()
    {
        $user = auth()->user();

        return view('users.perfil', compact('user'));
    }

    public function editarPerfil()
    {
        $user = auth()->user();

        return view('users.editar-perfil', compact('user'));
    }

    public function atualizarPerfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'celular' => 'required',

            'cep' => 'required',

            'logradouro' => 'required|max:255',

            'numero' => 'required|max:20',

            'cidade' => 'required|max:255',

            'estado' => 'required|size:2',

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
        | NORMALIZAÇÃO
        |--------------------------------------------------------------------------
        */

        $cpf = $request->cpf
            ? preg_replace('/\D/', '', $request->cpf)
            : null;

        $cnpj = $request->cnpj
            ? preg_replace('/\D/', '', $request->cnpj)
            : null;

        $telefone = $request->telefone
            ? preg_replace('/\D/', '', $request->telefone)
            : null;

        $celular = $request->celular
            ? preg_replace('/\D/', '', $request->celular)
            : null;

        $cep = $request->cep
            ? preg_replace('/\D/', '', $request->cep)
            : null;

        /*
        |--------------------------------------------------------------------------
        | DADOS DO USUÁRIO
        |--------------------------------------------------------------------------
        */

        $data = [

            'name' => trim($request->name),

            'email' => trim($request->email),

            'cpf' => $cpf,

            'cnpj' => $cnpj,

            'telefone' => $telefone,

            'celular' => $celular,

        ];

        /*
        |--------------------------------------------------------------------------
        | SENHA OPCIONAL
        |--------------------------------------------------------------------------
        */

        if (!empty($request->password)) {

            $data['password'] =
                Hash::make($request->password);

        }

        $user->update($data);

        /*
        |--------------------------------------------------------------------------
        | ENDEREÇO
        |--------------------------------------------------------------------------
        */

        $dadosEndereco = [

            'logradouro' => trim($request->logradouro),

            'numero' => trim($request->numero),

            'complemento' => $request->complemento
                ? trim($request->complemento)
                : null,

            'cidade' => trim($request->cidade),

            'estado' => strtoupper(trim($request->estado)),

            'cep' => $cep,

        ];

        if ($user->endereco) {

            $user->endereco->update(
                $dadosEndereco
            );

        } else {

            $dadosEndereco['user_id'] =
                $user->id;

            Endereco::create(
                $dadosEndereco
            );

        }

        return redirect()
            ->route('perfil')
            ->with(
                'success',
                'Perfil atualizado com sucesso!'
            );
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