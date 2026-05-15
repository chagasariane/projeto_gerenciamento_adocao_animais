@extends('layouts.app')

@section('content')

<div class="container animal-show-page">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4 mb-5">

        <div>

            <h1 class="section-title mb-2">
                Meus Animais
            </h1>

            <p class="section-description m-0">
                Gerencie os animais cadastrados na plataforma de adoção responsável.
            </p>

        </div>

        <a href="{{ route('animais.create') }}"
           class="create-btn text-decoration-none">

            Cadastrar Animal

        </a>

    </div>

    {{-- ALERTAS --}}
    @if(session('success'))

        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">

            {{ session('success') }}

        </div>

    @endif

    {{-- FILTROS --}}
    <section class="filter-section mb-5">

        <div class="filter-box">

            <form method="GET"
                  action="{{ route('animais.index') }}">

                <div class="row g-4">

                    {{-- ESPÉCIE --}}
                    <div class="col-lg-4">

                        <label class="form-label fw-semibold mb-2">
                            Espécie
                        </label>

                        <select name="especie_id"
                                class="form-select custom-select">

                            <option value="">
                                Todas
                            </option>

                            @foreach($especies as $especie)

                                <option value="{{ $especie->id }}"
                                    {{ request('especie_id') == $especie->id ? 'selected' : '' }}>

                                    {{ ucfirst(strtolower($especie->nome)) }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- RAÇA --}}
                    <div class="col-lg-4">

                        <label class="form-label fw-semibold mb-2">
                            Raça
                        </label>

                        <select name="raca_id"
                                class="form-select custom-select">

                            <option value="">
                                Todas
                            </option>

                            @foreach($racas as $raca)

                                <option value="{{ $raca->id }}"
                                    {{ request('raca_id') == $raca->id ? 'selected' : '' }}>

                                    {{ ucfirst(strtolower($raca->nome)) }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- STATUS --}}
                    <div class="col-lg-4">

                        <label class="form-label fw-semibold mb-2">
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

                            <option value="ADOTADO"
                                {{ request('status') == 'ADOTADO' ? 'selected' : '' }}>

                                Adotado

                            </option>

                            <option value="INATIVO"
                                {{ request('status') == 'INATIVO' ? 'selected' : '' }}>

                                Inativo

                            </option>

                        </select>

                    </div>

                </div>

                {{-- BOTÕES --}}
                <div class="d-flex flex-column flex-md-row justify-content-end gap-3 mt-4">

                    <a href="{{ route('animais.index') }}"
                       class="clear-btn text-decoration-none">

                        Limpar Filtros

                    </a>

                    <button type="submit"
                            class="filter-btn">

                        Filtrar Animais

                    </button>

                </div>

            </form>

        </div>

    </section>

    {{-- LISTAGEM --}}
    @if($animais->count())

        <div class="d-flex justify-content-between align-items-center mb-4">

            <span class="animals-count">

                {{ $animais->count() }}
                {{ $animais->count() > 1 ? 'animais encontrados' : 'animal encontrado' }}

            </span>

        </div>

        <div class="row g-4">

            @foreach($animais as $animal)

                <div class="col-xl-4 col-md-6">

                    <div class="animal-card">

                        {{-- IMAGEM --}}
                        @if($animal->fotoPrincipal)

                            <img src="{{ asset('storage/' . $animal->fotoPrincipal->caminho) }}"
                                class="animal-image"
                                alt="{{ $animal->nome }}">

                        @else

                            <img src="https://placehold.co/600x400?text=MiauDot"
                                class="animal-image"
                                alt="{{ $animal->nome }}">

                        @endif

                        {{-- CONTEÚDO --}}
                        <div class="animal-body">

                            <div class="d-flex justify-content-between align-items-start mb-3">

                                <h3 class="animal-name mb-0">

                                    {{ ucfirst($animal->nome) }}

                                </h3>

                                <span class="animal-tag">

                                    {{ ucfirst(strtolower($animal->status)) }}

                                </span>

                            </div>

                            <p class="animal-breed mb-2">

                                {{ ucfirst(strtolower($animal->especie->nome)) }}
                                •
                                {{ ucfirst(strtolower($animal->raca->nome)) }}

                            </p>

                            <p class="animal-location mb-3">

                                {{ ucfirst(strtolower($animal->cidade)) }}
                                -
                                {{ strtoupper($animal->estado) }}

                            </p>

                            {{-- INFO GRID --}}
                            <div class="animal-info-grid mb-4">

                                <div class="animal-info-item">

                                    <span class="animal-info-label">
                                        Porte
                                    </span>

                                    <span class="animal-info-value">
                                        {{ ucfirst(strtolower($animal->porte)) }}
                                    </span>

                                </div>

                                <div class="animal-info-item">

                                    <span class="animal-info-label">
                                        Sexo
                                    </span>

                                    <span class="animal-info-value">
                                        {{ ucfirst(strtolower($animal->sexo)) }}
                                    </span>

                                </div>

                            </div>

                            {{-- DESCRIÇÃO --}}
                            <p class="text-muted mb-4"
                               style="line-height: 1.8;">

                                {{ \Illuminate\Support\Str::limit($animal->descricao, 120) }}

                            </p>

                            {{-- BOTÕES --}}
                            <div class="d-flex gap-2">

                                <a href="{{ route('animais.show', $animal->id) }}"
                                   class="animal-btn text-decoration-none text-center">

                                    Visualizar

                                </a>

                                <a href="{{ route('animais.edit', $animal->id) }}"
                                   class="edit-btn text-decoration-none text-center w-100">

                                    Editar

                                </a>

                            </div>

                            <form action="{{ route('animais.destroy', $animal->id) }}"
                                  method="POST"
                                  class="mt-2">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="delete-btn w-100"
                                        onclick="return confirm('Deseja remover este animal?')">

                                    Remover

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="filter-box text-center py-5">

            <h3 class="mb-3 fw-bold">
                Nenhum animal cadastrado
            </h3>

            <p class="text-muted mb-4">

                Você ainda não cadastrou animais na plataforma.

            </p>

            <a href="{{ route('animais.create') }}"
               class="create-btn text-decoration-none">

                Cadastrar Primeiro Animal

            </a>

        </div>

    @endif

</div>

@endsection