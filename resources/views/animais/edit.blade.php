@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-4">Editar Animal</h1>

    {{-- Erros --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('animais.update', $animal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control"
                       value="{{ old('nome', $animal->nome) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="form-control"
                       value="{{ old('data_nascimento', $animal->data_nascimento) }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-4 mb-3">
                <label class="form-label">Sexo</label>
                <select name="sexo" class="form-control" required>
                    <option value="">Selecione</option>
                    <option value="MACHO" {{ old('sexo', $animal->sexo) == 'MACHO' ? 'selected' : '' }}>Macho</option>
                    <option value="FEMEA" {{ old('sexo', $animal->sexo) == 'FEMEA' ? 'selected' : '' }}>Fêmea</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Porte</label>
                <select name="porte" class="form-control">
                    <option value="">Selecione</option>
                    <option value="PEQUENO" {{ old('porte', $animal->porte) == 'PEQUENO' ? 'selected' : '' }}>Pequeno</option>
                    <option value="MEDIO" {{ old('porte', $animal->porte) == 'MEDIO' ? 'selected' : '' }}>Médio</option>
                    <option value="GRANDE" {{ old('porte', $animal->porte) == 'GRANDE' ? 'selected' : '' }}>Grande</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="DISPONIVEL" {{ old('status', $animal->status) == 'DISPONIVEL' ? 'selected' : '' }}>Disponível</option>
                    <option value="EM_PROCESSO" {{ old('status', $animal->status) == 'EM_PROCESSO' ? 'selected' : '' }}>Em processo</option>
                    <option value="ADOTADO" {{ old('status', $animal->status) == 'ADOTADO' ? 'selected' : '' }}>Adotado</option>
                </select>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Espécie</label>
                <select id="especie" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($especies as $especie)
                        <option value="{{ $especie->id }}"
                            {{ old('especie_id', optional($animal->raca)->especie_id) == $especie->id ? 'selected' : '' }}>
                            {{ $especie->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Raça</label>
                <select id="raca" name="raca_id" class="form-control" required>
                    @foreach($racas as $raca)
                        <option value="{{ $raca->id }}"
                            data-especie="{{ $raca->especie_id }}"
                            {{ old('raca_id', $animal->raca_id) == $raca->id ? 'selected' : '' }}>
                            {{ $raca->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="3">{{ old('descricao', $animal->descricao) }}</textarea>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('animais.index') }}" class="btn btn-secondary">
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
    const especieSelect = document.getElementById('especie');
    const racaSelect = document.getElementById('raca');

    if (especieSelect && racaSelect) {

        function filtrarRacas() {
            const especieId = especieSelect.value;

            Array.from(racaSelect.options).forEach(option => {
                const pertence = option.getAttribute('data-especie') === especieId;
                option.style.display = (!especieId || pertence) ? 'block' : 'none';
            });
        }

        especieSelect.addEventListener('change', function () {
            racaSelect.value = "";
            filtrarRacas();
        });

        window.addEventListener('load', filtrarRacas);
    }
</script>
@endsection