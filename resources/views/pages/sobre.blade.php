@extends('layouts.app')

@section('content')

<section class="institutional-page">

    <div class="container">

        {{-- HERO --}}
        <div class="institutional-hero text-center">

            <h1 class="institutional-title mb-4">

                Sobre a MiauDot

            </h1>

            <p class="institutional-description">

                A MiauDot é uma plataforma web desenvolvida
                para facilitar a adoção responsável de animais,
                conectando adotantes e responsáveis
                de forma organizada, segura e acessível.

            </p>

        </div>

        {{-- MISSÃO --}}
        <div class="about-section-custom">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <div class="about-content-card">

                        <h2 class="section-title mb-4">

                            Incentivar adoções responsáveis

                        </h2>

                        <p class="section-description about-text">

                            A plataforma busca facilitar
                            o encontro entre animais
                            disponíveis para adoção
                            e pessoas interessadas
                            em oferecer um novo lar.

                        </p>

                        <p class="section-description about-text">

                            O objetivo é tornar o processo
                            mais transparente, organizado
                            e seguro para todos os envolvidos.

                        </p>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="about-image-card">

                        <img src="{{ asset('imagem/sobre.png') }}"
                            alt="Adoção responsável"
                            class="about-image">

                    </div>

                </div>

            </div>

        </div>

        {{-- IMPACTO SOCIAL --}}
        <div class="impact-section">

            <div class="text-center mb-5">

                <h2 class="section-title mb-3">

                    Impacto Social

                </h2>

                <p class="section-description">

                    O abandono e a superpopulação
                    de animais são problemas recorrentes.
                    A tecnologia pode contribuir para tornar
                    o processo de adoção mais eficiente
                    e acessível.

                </p>

            </div>

            <div class="row g-4">

                <div class="col-lg-4">

                    <div class="impact-card">

                        <div class="impact-icon">

                            🏠

                        </div>

                        <h3 class="impact-title">

                            Novos lares

                        </h3>

                        <p class="impact-description">

                            Aumentar as chances de adoções
                            responsáveis por meio
                            de uma plataforma centralizada.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="impact-card">

                        <div class="impact-icon">

                            ❤️

                        </div>

                        <h3 class="impact-title">

                            Bem-estar animal

                        </h3>

                        <p class="impact-description">

                            Incentivar cuidados responsáveis
                            e promover maior conscientização
                            sobre adoção.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="impact-card">

                        <div class="impact-icon">

                            🤝

                        </div>

                        <h3 class="impact-title">

                            Conexão segura

                        </h3>

                        <p class="impact-description">

                            Aproximar adotantes e responsáveis
                            por animais de maneira organizada
                            e transparente.

                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- PROJETO ACADÊMICO --}}
        <div class="academic-section">

            <div class="academic-card">

                <div class="text-center">

                    <span class="page-badge mb-4">

                        Projeto Acadêmico

                    </span>

                    <h2 class="section-title mb-4">

                        Desenvolvimento acadêmico e tecnológico

                    </h2>

                    <p class="section-description academic-description">

                        A MiauDot foi desenvolvida como projeto acadêmico
                        do curso de Análise e Desenvolvimento de Sistemas,
                        aplicando conceitos de engenharia de software,
                        desenvolvimento web, modelagem de banco de dados
                        e arquitetura MVC com Laravel.

                    </p>

                </div>

                <div class="row g-4 mt-4">

                    <div class="col-lg-4">

                        <div class="academic-info-card">

                            <h4 class="academic-info-title">

                                Backend

                            </h4>

                            <p class="academic-info-description">

                                Laravel e PHP para estruturação
                                da aplicação utilizando MVC.

                            </p>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="academic-info-card">

                            <h4 class="academic-info-title">

                                Frontend

                            </h4>

                            <p class="academic-info-description">

                                Interface responsiva utilizando
                                HTML, CSS, Bootstrap e Blade.

                            </p>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="academic-info-card">

                            <h4 class="academic-info-title">

                                Banco de Dados

                            </h4>

                            <p class="academic-info-description">

                                Estrutura relacional desenvolvida
                                com MariaDB e migrations Laravel.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- CTA --}}
        <div class="institutional-cta">

            <div class="cta-card text-center">

                <h2 class="cta-title mb-4">

                    Faça parte dessa iniciativa

                </h2>

                <p class="cta-description mb-5">

                    Ajude a transformar a adoção responsável
                    em um processo mais acessível,
                    organizado e seguro para todos.

                </p>

                <div class="d-flex justify-content-center flex-wrap gap-3">

                    @guest

                        <a href="{{ route('register') }}"
                           class="btn hero-btn">

                            Criar Conta

                        </a>

                    @endguest

                    <a href="{{ url('/') }}"
                       class="btn back-btn">

                        Ver Animais

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection