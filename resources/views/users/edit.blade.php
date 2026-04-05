@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-4">Editar Usuário</h1>

    {{-- Erros --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Senha (deixe em branco para não alterar)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tipo</label>
                <select name="role" id="role" class="form-control">
                    <option value="ADOTANTE" {{ old('role', $user->role) == 'ADOTANTE' ? 'selected' : '' }}>Adotante</option>
                    <option value="PROTETOR" {{ old('role', $user->role) == 'PROTETOR' ? 'selected' : '' }}>Protetor</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3" id="campo-cpf">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $user->cpf) }}">
            </div>

            <div class="col-md-6 mb-3" id="campo-cnpj">
                <label class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" value="{{ old('cnpj', $user->cnpj) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $user->telefone) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ old('celular', $user->celular) }}">
            </div>
        </div>

        <hr>
        <h5 class="mb-3">Endereço</h5>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control" value="{{ old('cep', $user->endereco->cep ?? '') }}">
            </div>

            <div class="col-md-8 mb-3">
                <label class="form-label">Logradouro</label>
                <input type="text" name="logradouro" class="form-control" value="{{ old('logradouro', $user->endereco->logradouro ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Número</label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero', $user->endereco->numero ?? '') }}">
            </div>

            <div class="col-md-5 mb-3">
                <label class="form-label">Complemento</label>
                <input type="text" name="complemento" class="form-control" value="{{ old('complemento', $user->endereco->complemento ?? '') }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Cidade</label>
                <input type="text" name="cidade" class="form-control" value="{{ old('cidade', $user->endereco->cidade ?? '') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{ old('estado', $user->endereco->estado ?? '') }}">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                Voltar
            </a>

            <button type="submit" class="btn btn-primary">
                Atualizar
            </button>
        </div>

    </form>
</div>

@endsection

@section('scripts')
<script>
    function ajustarCampos() {
        const role = document.getElementById('role').value;
        const campoCpf = document.getElementById('campo-cpf');
        const campoCnpj = document.getElementById('campo-cnpj');

        if (role === 'ADOTANTE') {
            campoCpf.style.display = 'block';
            campoCnpj.style.display = 'none';
        } else {
            campoCpf.style.display = 'block';
            campoCnpj.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');

        ajustarCampos();
        roleSelect.addEventListener('change', ajustarCampos);
    });
</script>
@endsection