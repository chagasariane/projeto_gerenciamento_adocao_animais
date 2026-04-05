<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Endereco;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // 1. Validação básica
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:ADOTANTE,PROTETOR',
        ]);

        $data = $request->all();

        // 2. Normalizar CPF e CNPJ
        $data['cpf'] = $request->cpf ?: null;
        $data['cnpj'] = $request->cnpj ?: null;

        // 3. Regra de negócio
        if ($data['role'] === 'ADOTANTE') {
            if (empty($data['cpf'])) {
                return back()
                    ->withErrors(['cpf' => 'CPF é obrigatório para adotantes'])
                    ->withInput();
            }
            $data['cnpj'] = null;
        }

        if ($data['role'] === 'PROTETOR') {
            if (empty($data['cpf']) && empty($data['cnpj'])) {
                return back()
                    ->withErrors(['cpf' => 'Informe CPF ou CNPJ para protetor'])
                    ->withInput();
            }
        }

        // 4. Criptografar senha
        $data['password'] = bcrypt($data['password']);

        // 5. Criar usuário (CORRIGIDO - apenas uma vez)
        $user = User::create($data);

        // 6. Criar endereço
        Endereco::create([
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'cep' => $request->cep,
            'user_id' => $user->id
        ]);

        return redirect()->route('users.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        // 1. Validação básica
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:ADOTANTE,PROTETOR',
        ]);

        $data = $request->all();

        // 2. Normalizar CPF e CNPJ
        $data['cpf'] = $request->cpf ?: null;
        $data['cnpj'] = $request->cnpj ?: null;

        // 3. Regra de negócio
        if ($data['role'] === 'ADOTANTE') {
            if (empty($data['cpf'])) {
                return back()
                    ->withErrors(['cpf' => 'CPF é obrigatório para adotantes'])
                    ->withInput();
            }
            $data['cnpj'] = null;
        }

        if ($data['role'] === 'PROTETOR') {
            if (empty($data['cpf']) && empty($data['cnpj'])) {
                return back()
                    ->withErrors(['cpf' => 'Informe CPF ou CNPJ para protetor'])
                    ->withInput();
            }
        }

        // 4. Atualizar senha (se preenchida)
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // 5. Atualizar usuário
        $user->update($data);

        // 6. Atualizar ou criar endereço
        $endereco = $user->endereco;

        if ($endereco) {
            $endereco->update([
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

        return redirect()->route('users.index');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }
}