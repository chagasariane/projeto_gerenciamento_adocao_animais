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
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control">
        </div>

        <div class="mb-3">
            <label>Sexo</label>
            <select name="sexo" class="form-control" required>
                <option value="">Selecione</option>
                <option value="MACHO">Macho</option>
                <option value="FEMEA">Fêmea</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Porte</label>
            <select name="porte" class="form-control">
                <option value="">Selecione</option>
                <option value="PEQUENO">Pequeno</option>
                <option value="MEDIO">Médio</option>
                <option value="GRANDE">Grande</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="DISPONIVEL">Disponível</option>
                <option value="EM_PROCESSO">Em processo</option>
                <option value="ADOTADO">Adotado</option>
            </select>
        </div>

        <!-- ESPÉCIE -->
        <div class="mb-3">
            <label>Espécie</label>
            <select id="especie" class="form-control">
                <option value="">Selecione</option>
                @foreach($especies as $especie)
                    <option value="{{ $especie->id }}">
                        {{ $especie->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- RAÇA -->
        <div class="mb-3">
            <label>Raça</label>
            <select id="raca" name="raca_id" class="form-control" disabled required>
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
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Salvar
        </button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    const especieSelect = document.getElementById('especie');
    const racaSelect = document.getElementById('raca');

    especieSelect.addEventListener('change', function () {
        const especieId = this.value;

        // Reset
        racaSelect.value = "";
        racaSelect.disabled = true;

        // Filtrar opções
        Array.from(racaSelect.options).forEach(option => {
            if (!option.value) return;

            const pertence = option.getAttribute('data-especie') === especieId;

            option.style.display = pertence ? 'block' : 'none';
        });

        if (especieId) {
            racaSelect.disabled = false;
        }
    });
</script>
@endsection