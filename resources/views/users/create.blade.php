@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Novo Usuário</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="role" class="form-control">
                    <option value="ADOTANTE">Adotante</option>
                    <option value="PROTETOR">Protetor</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Celular</label>
                <input type="text" name="celular" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>

        </form>
    </div>
</div>

@endsection