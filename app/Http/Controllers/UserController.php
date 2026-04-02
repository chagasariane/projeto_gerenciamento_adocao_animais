<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // retorna todos os registros da tabela
        return view('users.index', compact('users')); // Retorna a view 'users.index' passando os usuários para a view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create'); // Retorna a view 'users.create' para exibir o formulário de criação de usuário    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $data = $request->all(); // Obtém todos os dados do formulário
        $data['password'] = bcrypt($data['password']); // Criptografa a senha antes de salvar
        User::create($data); // Cria um novo usuário com os dados fornecidos
        return redirect()->route('users.index'); // Redireciona para a lista de usuários    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id); // Encontra o usuário pelo ID
        return view('users.edit', compact('user')); // Retorna a view 'users.edit' passando o usuário para a view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($id); // Encontra o usuário pelo ID
        $data = $request->all(); // Obtém todos os dados do formulário
        if (isset($data['password']) && $data['password'] != '') {
            $data['password'] = bcrypt($data['password']); // Criptografa a senha se ela for fornecida
        } else {
            unset($data['password']); // Remove a senha do array de dados para não atualizar se não for fornecida
        }
        $user->update($data); // Atualiza o usuário com os novos dados
        return redirect()->route('users.index'); // Redireciona para a lista de usuários
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id); // Encontra o usuário pelo ID
        $user->delete(); // Exclui o usuário
        return redirect()->route('users.index'); // Redireciona para a lista de usuários
    }
}
