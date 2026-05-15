@extends('layouts.app')

@section('content')

<section class="institutional-page">

    <div class="container">

        {{-- HERO --}}
        <div class="institutional-hero text-center">

            <h1 class="institutional-title mb-4">

                Como Funciona a Plataforma

            </h1>

            <p class="institutional-description">

                A MiauDot conecta pessoas interessadas em adotar
                com protetores, ONGs e responsáveis por animais,
                tornando o processo de adoção mais seguro,
                organizado e responsável.

            </p>

            <p class="section-description">

                A plataforma foi desenvolvida para tornar
                o processo de adoção mais organizado,
                transparente e seguro para todos.

            </p>

        </div>

        {{-- ETAPAS --}}
        <div class="how-it-works-section">

            <div class="row g-4">

                {{-- ETAPA 1 --}}
                <div class="col-lg-3 col-md-6">

                    <div class="step-card">

                        <div class="step-number">

                            01

                        </div>

                        <div class="step-icon">

                            📝

                        </div>

                        <h3 class="step-title">

                            Crie sua conta

                        </h3>

                        <p class="step-description">

                            Cadastre-se na plataforma para acessar
                            os recursos de adoção responsável.

                        </p>

                    </div>

                </div>

                {{-- ETAPA 2 --}}
                <div class="col-lg-3 col-md-6">

                    <div class="step-card">

                        <div class="step-number">

                            02

                        </div>

                        <div class="step-icon">

                            🔎

                        </div>

                        <h3 class="step-title">

                            Busque animais

                        </h3>

                        <p class="step-description">

                            Utilize filtros inteligentes para encontrar
                            animais compatíveis com seu perfil.

                        </p>

                    </div>

                </div>

                {{-- ETAPA 3 --}}
                <div class="col-lg-3 col-md-6">

                    <div class="step-card">

                        <div class="step-number">

                            03

                        </div>

                        <div class="step-icon">

                            💬

                        </div>

                        <h3 class="step-title">

                            Demonstre interesse

                        </h3>

                        <p class="step-description">

                            Entre em contato com o responsável
                            e acompanhe o processo de adoção.

                        </p>

                    </div>

                </div>

                {{-- ETAPA 4 --}}
                <div class="col-lg-3 col-md-6">

                    <div class="step-card">

                        <div class="step-number">

                            04

                        </div>

                        <div class="step-icon">

                            🐾

                        </div>

                        <h3 class="step-title">

                            Finalize a adoção

                        </h3>

                        <p class="step-description">

                            Após aprovação, finalize a adoção
                            de forma responsável e segura.

                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- DIFERENCIAIS --}}
        <div class="benefits-section">

            <div class="text-center mb-5">

                <h2 class="section-title mb-3">

                    Por que utilizar a MiauDot?

                </h2>

                <p class="section-description">

                    A plataforma foi pensada para oferecer
                    uma experiência moderna, intuitiva
                    e segura durante todo o processo de adoção.

                </p>

            </div>

            <div class="row g-4">

                {{-- BENEFÍCIO 1 --}}
                <div class="col-lg-4">

                    <div class="benefit-card">

                        <div class="benefit-icon">

                            🛡️

                        </div>

                        <h3 class="benefit-title">

                            Processo mais seguro

                        </h3>

                        <p class="benefit-description">

                            A plataforma organiza informações,
                            histórico e comunicação entre usuários,
                            aumentando a transparência da adoção.

                        </p>

                    </div>

                </div>

                {{-- BENEFÍCIO 2 --}}
                <div class="col-lg-4">

                    <div class="benefit-card">

                        <div class="benefit-icon">

                            ⚡

                        </div>

                        <h3 class="benefit-title">

                            Busca inteligente

                        </h3>

                        <p class="benefit-description">

                            Utilize filtros por espécie,
                            porte, localização e características
                            dos animais disponíveis.

                        </p>

                    </div>

                </div>

                {{-- BENEFÍCIO 3 --}}
                <div class="col-lg-4">

                    <div class="benefit-card">

                        <div class="benefit-icon">

                            ❤️

                        </div>

                        <h3 class="benefit-title">

                            Adoção responsável

                        </h3>

                        <p class="benefit-description">

                            O sistema incentiva adoções conscientes,
                            promovendo maior compatibilidade
                            entre adotantes e animais.

                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- CTA --}}
        <div class="institutional-cta">

            <div class="cta-card text-center">

                <h2 class="cta-title mb-4">

                    Transforme uma adoção em um novo começo

                </h2>

                <p class="cta-description mb-5">

                    Cadastre-se na plataforma e ajude a conectar
                    animais a novos lares de forma responsável,
                    segura e organizada.

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