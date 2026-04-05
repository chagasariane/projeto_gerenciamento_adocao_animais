@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Cadastrar Animal</h1>

    <a href="{{ route('animais.index') }}" class="btn btn-secondary mb-3">
        Voltar
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('animais.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}">
        </div>

        <div class="mb-3">
            <label>Sexo</label>
            <select name="sexo" class="form-control" required>
                <option value="">Selecione</option>
                <option value="MACHO" {{ old('sexo') == 'MACHO' ? 'selected' : '' }}>Macho</option>
                <option value="FEMEA" {{ old('sexo') == 'FEMEA' ? 'selected' : '' }}>Fêmea</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Porte</label>
            <select name="porte" class="form-control">
                <option value="">Selecione</option>
                <option value="PEQUENO" {{ old('porte') == 'PEQUENO' ? 'selected' : '' }}>Pequeno</option>
                <option value="MEDIO" {{ old('porte') == 'MEDIO' ? 'selected' : '' }}>Médio</option>
                <option value="GRANDE" {{ old('porte') == 'GRANDE' ? 'selected' : '' }}>Grande</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="DISPONIVEL" {{ old('status') == 'DISPONIVEL' ? 'selected' : '' }}>Disponível</option>
                <option value="EM_PROCESSO" {{ old('status') == 'EM_PROCESSO' ? 'selected' : '' }}>Em processo</option>
                <option value="ADOTADO" {{ old('status') == 'ADOTADO' ? 'selected' : '' }}>Adotado</option>
            </select>
        </div>

        {{-- PROTETOR --}}
        <div class="mb-3">
            <label class="form-label">Protetor</label>
            <select name="user_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($protetores as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- ESPÉCIE --}}
        <div class="mb-3">
            <label>Espécie</label>
            <select id="especie" name="especie_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($especies as $especie)
                    <option value="{{ $especie->id }}" {{ old('especie_id') == $especie->id ? 'selected' : '' }}>
                        {{ $especie->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- RAÇA --}}
        <div class="mb-3">
            <label>Raça</label>
            <select id="raca" name="raca_id" class="form-control" required disabled>
                <option value="">Selecione a espécie primeiro</option>
                @foreach($racas as $raca)
                    <option value="{{ $raca->id }}" data-especie="{{ $raca->especie_id }}">
                        {{ $raca->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control">{{ old('descricao') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success" id="btnSalvar">
            Salvar
        </button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    const especieSelect = document.getElementById('especie');
    const racaSelect = document.getElementById('raca');
    const form = document.querySelector('form');
    const btn = document.getElementById('btnSalvar');

    especieSelect.addEventListener('change', function () {
        const especieId = this.value;

        racaSelect.value = "";
        racaSelect.disabled = true;

        Array.from(racaSelect.options).forEach(option => {
            if (!option.value) return;

            const pertence = option.getAttribute('data-especie') === especieId;
            option.hidden = !pertence;
        });

        if (especieId) {
            racaSelect.disabled = false;
        }
    });

    // Evita duplo submit
    form.addEventListener('submit', function () {
        btn.disabled = true;
        btn.innerText = 'Salvando...';
    });
</script>
@endsection