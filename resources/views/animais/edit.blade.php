@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Editar Animal</h1>

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

    <form action="{{ route('animais.update', $animal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control"
                   value="{{ $animal->nome }}" required>
        </div>

        <div class="mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control"
                   value="{{ $animal->data_nascimento }}">
        </div>

        <div class="mb-3">
            <label>Sexo</label>
            <select name="sexo" class="form-control" required>
                <option value="MACHO" {{ $animal->sexo == 'MACHO' ? 'selected' : '' }}>Macho</option>
                <option value="FEMEA" {{ $animal->sexo == 'FEMEA' ? 'selected' : '' }}>Fêmea</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Porte</label>
            <select name="porte" class="form-control">
                <option value="">Selecione</option>
                <option value="PEQUENO" {{ $animal->porte == 'PEQUENO' ? 'selected' : '' }}>Pequeno</option>
                <option value="MEDIO" {{ $animal->porte == 'MEDIO' ? 'selected' : '' }}>Médio</option>
                <option value="GRANDE" {{ $animal->porte == 'GRANDE' ? 'selected' : '' }}>Grande</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="DISPONIVEL" {{ $animal->status == 'DISPONIVEL' ? 'selected' : '' }}>Disponível</option>
                <option value="EM_PROCESSO" {{ $animal->status == 'EM_PROCESSO' ? 'selected' : '' }}>Em processo</option>
                <option value="ADOTADO" {{ $animal->status == 'ADOTADO' ? 'selected' : '' }}>Adotado</option>
            </select>
        </div>

        <!-- ESPÉCIE -->
        <div class="mb-3">
            <label>Espécie</label>
            <select id="especie" class="form-control">
                <option value="">Selecione</option>
                @foreach($especies as $especie)
                    <option value="{{ $especie->id }}"
                        {{ $animal->raca->especie_id == $especie->id ? 'selected' : '' }}>
                        {{ $especie->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- RAÇA -->
        <div class="mb-3">
            <label>Raça</label>
            <select id="raca" name="raca_id" class="form-control" required>
                @foreach($racas as $raca)
                    <option value="{{ $raca->id }}"
                        data-especie="{{ $raca->especie_id }}"
                        {{ $animal->raca_id == $raca->id ? 'selected' : '' }}>
                        {{ $raca->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control">{{ $animal->descricao }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    const especieSelect = document.getElementById('especie');
    const racaSelect = document.getElementById('raca');

    function filtrarRacas() {
        const especieId = especieSelect.value;

        Array.from(racaSelect.options).forEach(option => {
            const pertence = option.getAttribute('data-especie') === especieId;
            option.style.display = pertence ? 'block' : 'none';
        });
    }

    especieSelect.addEventListener('change', function () {
        racaSelect.value = "";
        filtrarRacas();
    });

    // Executa ao carregar a página
    window.addEventListener('load', function () {
        filtrarRacas();
    });
</script>
@endsection