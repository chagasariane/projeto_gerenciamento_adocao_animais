@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="hero-section">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="hero-title">

                    Encontre um companheiro,
                    mude uma vida.

                </h1>

                <p class="hero-description">

                    Nossa plataforma conecta adotantes responsáveis
                    com animais que precisam de um novo lar seguro,
                    acolhedor e cheio de carinho.

                </p>

                <a href="{{ route('animais.index') }}"
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

            <div class="row g-3">

                <div class="col-md-3">

                    <select class="form-select custom-select">

                        <option>Todas as espécies</option>

                    </select>

                </div>

                <div class="col-md-3">

                    <select class="form-select custom-select">

                        <option>Qualquer porte</option>

                    </select>

                </div>

                <div class="col-md-3">

                    <select class="form-select custom-select">

                        <option>Qualquer idade</option>

                    </select>

                </div>

                <div class="col-md-3">

                    <input type="text"
                           class="form-control custom-input"
                           placeholder="Buscar animal...">

                </div>

            </div>

        </div>

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
                        🛡️
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

{{-- ANIMAIS --}}
<section class="animals-section">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="section-title mb-0">

                Animais disponíveis

            </h2>

            <span class="animals-count">

                8 animais encontrados

            </span>

        </div>

        <div class="row">

            @for ($i = 0; $i < 4; $i++)

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="animal-card">

                    <img src="https://placedog.net/500/400"
                         class="animal-image"
                         alt="Animal">

                    <div class="animal-body">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <h4 class="animal-name">

                                Thor

                            </h4>

                            <span class="animal-tag">

                                Cachorro

                            </span>

                        </div>

                        <p class="animal-location">

                            📍 Presidente Prudente - SP · 2 anos

                        </p>

                        <p class="animal-breed">

                            Labrador · Grande

                        </p>

                        <a href="#"
                           class="btn animal-btn">

                            Ver detalhes

                        </a>

                    </div>

                </div>

            </div>

            @endfor

        </div>

    </div>

</section>

@endsection