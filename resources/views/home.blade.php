@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="hero-section">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="hero-title">

                    Encontre um amigo,
                    mude uma vida.

                </h1>

                <p class="hero-description">

                    Nossa plataforma conecta adotantes responsáveis
                    com animais que precisam de um novo lar seguro,
                    acolhedor e cheio de carinho.

                </p>

                <a href="#animais-disponiveis"
                   class="btn hero-btn">

                    Ver animais disponíveis

                </a>

            </div>

            <div class="col-lg-6 text-center">

                <img src="{{ asset('imagem/home2.png') }}"
                     class="img-fluid hero-image"
                     alt="Animal">

            </div>

        </div>

    </div>

</section>

{{-- FILTROS --}}
<section class="filter-section">

    <div class="container">

        <div class="filter-box">

            <form method="GET"
                  action="{{ url('/') }}">

                <div class="row g-3 align-items-end">

                    {{-- ESPÉCIE --}}
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">

                            Espécie

                        </label>

                        <select name="especie_id"
                                class="form-select custom-select">

                            <option value="">

                                Todas as espécies

                            </option>

                            @foreach($especies as $especie)

                                <option value="{{ $especie->id }}"
                                    {{ request('especie_id') == $especie->id ? 'selected' : '' }}>

                                    {{ $especie->nome }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- SEXO --}}
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">

                            Sexo

                        </label>

                        <select name="sexo"
                                class="form-select custom-select">

                            <option value="">

                                Qualquer sexo

                            </option>

                            <option value="MACHO"
                                {{ request('sexo') == 'MACHO' ? 'selected' : '' }}>

                                Macho

                            </option>

                            <option value="FEMEA"
                                {{ request('sexo') == 'FEMEA' ? 'selected' : '' }}>

                                Fêmea

                            </option>

                        </select>

                    </div>

                    {{-- RAÇA --}}
<div class="col-lg-3">

    <label class="form-label fw-semibold mb-2">
        Raça
    </label>

    <input type="text"
           name="raca"
           class="form-control custom-input"
           value="{{ request('raca') }}"
           placeholder="Digite a raça">

</div>

{{-- CIDADE --}}
<div class="col-lg-3">

    <label class="form-label fw-semibold mb-2">
        Cidade
    </label>

    <input type="text"
           name="cidade"
           class="form-control custom-input"
           value="{{ request('cidade') }}"
           placeholder="Digite a cidade">

</div>

                    {{-- BOTÕES --}}
                    <div class="col-12">

                        <div class="d-flex gap-3 mt-2">

                            <button type="submit"
                                    class="btn filter-btn">

                                Filtrar

                            </button>

                            <a href="{{ url('/') }}"
                                class="btn clear-btn">

                                Limpar filtros

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</section>

{{-- ANIMAIS --}}
<section class="animals-section"
         id="animais-disponiveis">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="section-title mb-0">

                Animais disponíveis

            </h2>

            <span class="animals-count">

                {{ $animais->total() }} animais encontrados

            </span>

        </div>

        @if($animais->count())

            <div class="row">

                @foreach($animais as $animal)

                    <div class="col-lg-3 col-md-6 mb-4">

                        <div class="animal-card">

                            {{-- IMAGEM --}}
                                @if($animal->fotoPrincipal)

                                    <img src="{{ $animal->fotoPrincipal->caminho }}"
                                        class="animal-image"
                                        alt="{{ $animal->nome }}">

                                @else

                                    <img src="{{ asset('imagem/sem-foto.png') }}"
                                        class="animal-image"
                                        alt="{{ $animal->nome }}">

                                @endif

                            <div class="animal-body">

                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <h4 class="animal-name">

                                        {{ $animal->nome }}

                                    </h4>

                                    <span class="animal-tag">

                                        {{ $animal->especie->nome }}

                                    </span>

                                </div>

                                {{-- LOCALIZAÇÃO / IDADE --}}
                                <p class="animal-location">

                                    📍 {{ $animal->cidade }} - {{ $animal->estado }}

                                    <br>

                                    🐾 {{ $animal->idade_formatada }}

                                </p>

                                {{-- RAÇA / PORTE --}}
                                <p class="animal-breed">

                                    {{ $animal->raca->nome }}
                                    ·
                                    {{ ucfirst(strtolower($animal->porte)) }}

                                </p>

                                {{-- DESCRIÇÃO --}}
                                <p class="animal-description">

                                    {{ \Illuminate\Support\Str::limit($animal->descricao, 90) }}

                                </p>

                                {{-- BOTÃO --}}
                                <a href="{{ route('animais.show', $animal->id) }}"
                                class="btn animal-btn">

                                    Ver detalhes

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $animais->links() }}
            </div>

        @else

            <div class="alert alert-info">

                Nenhum animal disponível no momento.

            </div>

        @endif

    </div>

</section>

{{-- SOBRE --}}
<section class="about-section">

    <div class="container text-center">

        <h2 class="section-title">

            A adoção responsável começa
            com a conexão certa

        </h2>

        <p class="section-description">

            Adotar um animal é um compromisso de longo prazo.
            Nossa plataforma ajuda adotantes e protetores
            a criarem conexões mais seguras e transparentes.

        </p>

        <div class="row mt-5">

            <div class="col-md-4 mb-4">

                <div class="info-card">

                    <div class="info-icon">

                        <img src="{{ asset('imagem/protecao.png') }}"
                            alt="Proteção"
                            style="width: 38px; height: 38px; object-fit: contain;">

                    </div>

                    <h4>
                        Perfis Verificados
                    </h4>

                    <p>
                        Informações mais seguras para aumentar
                        a confiança no processo de adoção.
                    </p>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="info-card">

                    <div class="info-icon">
                        ❤️
                    </div>

                    <h4>
                        Adoção Responsável
                    </h4>

                    <p>
                        Incentivamos adoções conscientes e
                        alinhadas ao perfil do adotante.
                    </p>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="info-card">

                    <div class="info-icon">
                        👥
                    </div>

                    <h4>
                        Apoio da Comunidade
                    </h4>

                    <p>
                        Aproximamos ONGs, protetores
                        independentes e adotantes.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection