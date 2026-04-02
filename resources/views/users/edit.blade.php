@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-warning text-dark">
        <h4>Editar Usuário</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Senha (deixe em branco para não alterar)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="role" class="form-control">
                    <option value="ADOTANTE" {{ $user->role == 'ADOTANTE' ? 'selected' : '' }}>Adotante</option>
                    <option value="PROTETOR" {{ $user->role == 'PROTETOR' ? 'selected' : '' }}>Protetor</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-control" value="{{ $user->cpf }}">
            </div>

            <div class="mb-3">
                <label class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" value="{{ $user->cnpj }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{ $user->telefone }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ $user->celular }}">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-warning">Atualizar</button>
            </div>

        </form>
    </div>
</div>

@endsection