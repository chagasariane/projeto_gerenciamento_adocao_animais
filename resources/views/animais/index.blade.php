@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Animais</h1>
        <a href="{{ route('animais.create') }}" class="btn btn-primary">
            Novo Animal
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('animais.index') }}" class="mb-4">

        <div class="row g-3">

            <div class="col-md-3">
                <label class="form-label">Espécie</label>
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
                <label class="form-label">Raça</label>
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
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="DISPONIVEL" {{ request('status') == 'DISPONIVEL' ? 'selected' : '' }}>Disponível</option>
                    <option value="EM_PROCESSO" {{ request('status') == 'EM_PROCESSO' ? 'selected' : '' }}>Em processo</option>
                    <option value="ADOTADO" {{ request('status') == 'ADOTADO' ? 'selected' : '' }}>Adotado</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    Filtrar
                </button>

                <a href="{{ route('animais.index') }}" class="btn btn-secondary w-100">
                    Limpar
                </a>
            </div>

        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Porte</th>
                <th>Status</th>
                <th>Protetor</th>
                <th>Raça</th>
                <th width="180">Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($animais as $animal)
                <tr>
                    <td>{{ $animal->id }}</td>
                    <td>{{ $animal->nome }}</td>
                    <td>{{ $animal->sexo }}</td>
                    <td>{{ $animal->porte }}</td>

                    <td>
                        @if($animal->status == 'DISPONIVEL')
                            <span class="badge bg-success">Disponível</span>
                        @elseif($animal->status == 'EM_PROCESSO')
                            <span class="badge bg-warning text-dark">Em processo</span>
                        @else
                            <span class="badge bg-secondary">Adotado</span>
                        @endif
                    </td>

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
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Nenhum animal cadastrado
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

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
                if (!option.value) return;

                const pertence = option.getAttribute('data-especie') === especieId;

                option.style.display = (!especieId || pertence) ? 'block' : 'none';
            });

            racaSelect.disabled = !especieId;
        }

        especieSelect.addEventListener('change', function () {
            racaSelect.value = "";
            filtrarRacas();
        });

        window.addEventListener('load', filtrarRacas);
    }
</script>
@endsection