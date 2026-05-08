@extends('layouts.app')

@section('content')

<section class="animals-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="page-header">

            <div>

                <h1 class="page-title">
                    Animais Disponíveis
                </h1>

                <p class="page-description">
                    Encontre animais disponíveis para adoção responsável.
                </p>

            </div>

            <a href="{{ route('animais.create') }}"
               class="btn create-btn">

                + Novo Animal

            </a>

        </div>

        {{-- ALERT --}}
        @if(session('success'))

            <div class="custom-alert success-alert">

                {{ session('success') }}

            </div>

        @endif

        {{-- FILTROS --}}
        <div class="filter-box mb-5">

            <form method="GET"
                  action="{{ route('animais.index') }}">

                <div class="row g-3">

                    <div class="col-lg-3">

                        <label class="form-label custom-label">
                            Espécie
                        </label>

                        <select name="especie_id"
                                id="especie"
                                class="form-select custom-select">

                            <option value="">
                                Todas
                            </option>

                            @foreach($especies as $especie)

                                <option value="{{ $especie->id }}"
                                    {{ request('especie_id') == $especie->id ? 'selected' : '' }}>

                                    {{ $especie->nome }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-lg-3">

                        <label class="form-label custom-label">
                            Raça
                        </label>

                        <select name="raca_id"
                                id="raca"
                                class="form-select custom-select">

                            <option value="">
                                Todas
                            </option>

                            @foreach($racas as $raca)

                                <option value="{{ $raca->id }}"
                                        data-especie="{{ $raca->especie_id }}"
                                    {{ request('raca_id') == $raca->id ? 'selected' : '' }}>

                                    {{ $raca->nome }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-lg-3">

                        <label class="form-label custom-label">
                            Status
                        </label>

                        <select name="status"
                                class="form-select custom-select">

                            <option value="">
                                Todos
                            </option>

                            <option value="DISPONIVEL"
                                {{ request('status') == 'DISPONIVEL' ? 'selected' : '' }}>

                                Disponível

                            </option>

                            <option value="EM_PROCESSO"
                                {{ request('status') == 'EM_PROCESSO' ? 'selected' : '' }}>

                                Em processo

                            </option>

                            <option value="ADOTADO"
                                {{ request('status') == 'ADOTADO' ? 'selected' : '' }}>

                                Adotado

                            </option>

                        </select>

                    </div>

                    <div class="col-lg-3 d-flex align-items-end gap-2">

                        <button type="submit"
                                class="btn filter-btn w-100">

                            Filtrar

                        </button>

                        <a href="{{ route('animais.index') }}"
                           class="btn clear-btn w-100">

                            Limpar

                        </a>

                    </div>

                </div>

            </form>

        </div>

        {{-- QUANTIDADE --}}
        <div class="animals-info">

            <span>

                {{ $animais->count() }} animal(is) encontrado(s)

            </span>

        </div>

        {{-- GRID --}}
        <div class="row">

            @forelse($animais as $animal)

                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

                    <div class="animal-card">

                        <img src="https://placedog.net/500/400"
                             class="animal-image"
                             alt="Animal">

                        <div class="animal-body">

                            <div class="d-flex justify-content-between align-items-start mb-2">

                                <h4 class="animal-name">

                                    {{ $animal->nome }}

                                </h4>

                                @if($animal->status == 'DISPONIVEL')

                                    <span class="status-badge success">

                                        Disponível

                                    </span>

                                @elseif($animal->status == 'EM_PROCESSO')

                                    <span class="status-badge warning">

                                        Em processo

                                    </span>

                                @else

                                    <span class="status-badge secondary">

                                        Adotado

                                    </span>

                                @endif

                            </div>

                            <p class="animal-info">

                                {{ $animal->raca->nome ?? 'Sem raça' }}

                            </p>

                            <p class="animal-info">

                                {{ $animal->porte }}

                            </p>

                            <p class="animal-info">

                                {{ $animal->sexo }}

                            </p>

                            <p class="animal-owner">

                                Responsável:
                                {{ $animal->user->name ?? 'Não informado' }}

                            </p>

                            <div class="animal-actions">

                                <a href="{{ route('animais.edit', $animal->id) }}"
                                   class="btn edit-btn">

                                    Editar

                                </a>

                                <form action="{{ route('animais.destroy', $animal->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn delete-btn">

                                        Excluir

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-box">

                        Nenhum animal encontrado.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

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

                const pertence =
                    option.getAttribute('data-especie') === especieId;

                option.style.display =
                    (!especieId || pertence) ? 'block' : 'none';
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