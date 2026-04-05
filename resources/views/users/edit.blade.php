@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
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
                <select name="role" id="role" class="form-control">
                    <option value="ADOTANTE" {{ $user->role == 'ADOTANTE' ? 'selected' : '' }}>Adotante</option>
                    <option value="PROTETOR" {{ $user->role == 'PROTETOR' ? 'selected' : '' }}>Protetor</option>
                </select>
            </div>

            <div class="mb-3" id="campo-cpf">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-control" value="{{ $user->cpf }}">
            </div>

            <div class="mb-3" id="campo-cnpj">
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

            <hr>
            <h5>Endereço</h5>

            <div class="mb-3">
                <label class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control" value="{{ $user->endereco->cep ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Logradouro</label>
                <input type="text" name="logradouro" class="form-control" value="{{ $user->endereco->logradouro ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Número</label>
                <input type="text" name="numero" class="form-control" value="{{ $user->endereco->numero ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Complemento</label>
                <input type="text" name="complemento" class="form-control" value="{{ $user->endereco->complemento ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <input type="text" name="cidade" class="form-control" value="{{ $user->endereco->cidade ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <input type="text" name="estado" class="form-control" value="{{ $user->endereco->estado ?? '' }}">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Atualizar</button>
            </div>

        </form>
    </div>
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

        ajustarCampos(); // ESSENCIAL

        roleSelect.addEventListener('change', ajustarCampos);
    });
</script>
@endsection