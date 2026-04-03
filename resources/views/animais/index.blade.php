@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Lista de Animais</h1>

    <a href="{{ route('animais.create') }}" class="btn btn-primary mb-3">
        Novo Animal
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('animais.index') }}" class="mb-4">

        <div class="row">

            <div class="col-md-3">
                <label>Espécie</label>
                <select name="especie_id" id="especie" class="form-control">
                    <option value="">Todas</option>
                    @foreach($especies as $especie)
                        <option value="{{ $especie->id }}"
                            {{ request('especie_id') == $especie->id ? 'selected' : '' }}>
                            {{ $especie->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Raça</label>
                <select name="raca_id" id="raca" class="form-control">
                    <option value="">Todas</option>
                    @foreach($racas as $raca)
                        <option value="{{ $raca->id }}"
                            data-especie="{{ $raca->especie_id }}"
                            {{ request('raca_id') == $raca->id ? 'selected' : '' }}>
                            {{ $raca->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="DISPONIVEL" {{ request('status') == 'DISPONIVEL' ? 'selected' : '' }}>Disponível</option>
                    <option value="EM_PROCESSO" {{ request('status') == 'EM_PROCESSO' ? 'selected' : '' }}>Em processo</option>
                    <option value="ADOTADO" {{ request('status') == 'ADOTADO' ? 'selected' : '' }}>Adotado</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                <a href="{{ route('animais.index') }}" class="btn btn-secondary">Limpar</a>
            </div>

        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Porte</th>
                <th>Status</th>
                <th>Protetor</th>
                <th>Raça</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($animais as $animal)
                <tr>
                    <td>{{ $animal->id }}</td>
                    <td>{{ $animal->nome }}</td>
                    <td>{{ $animal->sexo }}</td>
                    <td>{{ $animal->porte }}</td>
                    <td>{{ $animal->status }}</td>
                    <td>{{ $animal->user->name ?? '—' }}</td>
                    <td>{{ $animal->raca->nome ?? '—' }}</td>
                    <td>
                        <a href="{{ route('animais.edit', $animal->id) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('animais.destroy', $animal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
    const especieSelect = document.getElementById('especie');
    const racaSelect = document.getElementById('raca');

    function filtrarRacas() {
        const especieId = especieSelect.value;

        Array.from(racaSelect.options).forEach(option => {
            if (!option.value) return;

            const pertence = option.getAttribute('data-especie') === especieId;

            option.style.display = (!especieId || pertence) ? 'block' : 'none';
        });

        // desabilita se não tiver espécie
        racaSelect.disabled = !especieId;
    }

    especieSelect.addEventListener('change', function () {
        racaSelect.value = "";
        filtrarRacas();
    });

    window.addEventListener('load', filtrarRacas);
</script>
@endsection