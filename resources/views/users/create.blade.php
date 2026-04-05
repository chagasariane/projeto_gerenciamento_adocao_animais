@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Novo Usuário</h4>
    </div>

    <div class="card-body">

        {{-- Exibir erros --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="role" id="role" class="form-control">
                    <option value="ADOTANTE" {{ old('role') == 'ADOTANTE' ? 'selected' : '' }}>Adotante</option>
                    <option value="PROTETOR" {{ old('role') == 'PROTETOR' ? 'selected' : '' }}>Protetor</option>
                </select>
            </div>

            <div class="mb-3" id="campo-cpf">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}">
            </div>

            <div class="mb-3" id="campo-cnpj">
                <label class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" value="{{ old('cnpj') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ old('celular') }}">
            </div>

            <hr>
            <h5>Endereço</h5>

            <div class="mb-3">
                <label class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control" value="{{ old('cep') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Logradouro</label>
                <input type="text" name="logradouro" class="form-control" value="{{ old('logradouro') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Número</label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Complemento</label>
                <input type="text" name="complemento" class="form-control" value="{{ old('complemento') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <input type="text" name="cidade" class="form-control" value="{{ old('cidade') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <input type="text" name="estado" class="form-control" value="{{ old('estado') }}">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success" id="btnSalvar">Salvar</button>
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
        const form = document.querySelector('form');
        const btn = document.getElementById('btnSalvar');

        ajustarCampos();

        roleSelect.addEventListener('change', ajustarCampos);

        // 🔴 Bloqueio de múltiplos envios
        form.addEventListener('submit', function () {
            btn.disabled = true;
            btn.innerText = 'Salvando...';
        });
    });
</script>
@endsection