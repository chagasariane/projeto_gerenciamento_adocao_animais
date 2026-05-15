@extends('layouts.app')

@section('content')

<section class="auth-page">

    <div class="container">

        <div class="auth-wrapper">

            <div class="row g-0 align-items-stretch">

                {{-- LADO ESQUERDO --}}
                <div class="col-lg-6">

                    <div class="auth-brand-side">

                        <div class="auth-brand-content">

                            <span class="auth-badge">

                                Plataforma de Adoção Responsável

                            </span>

                            <h1 class="auth-title">

                                Encontre um novo melhor amigo.

                            </h1>

                            <p class="auth-description">

                                Conectamos adotantes responsáveis
                                com animais que precisam de um lar
                                seguro, acolhedor e cheio de carinho.

                            </p>

                            <div class="auth-features">

                                <div class="auth-feature-item">

                                    Adoção responsável

                                </div>

                                <div class="auth-feature-item">

                                    Perfis verificados

                                </div>

                                <div class="auth-feature-item">

                                    Processo seguro e transparente

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- LADO DIREITO --}}
                <div class="col-lg-6">

                    <div class="auth-form-side">

                        <div class="auth-form-wrapper">

                            <div class="mb-5">

                                <h2 class="auth-form-title">

                                    Entrar

                                </h2>

                                <p class="auth-form-subtitle">

                                    Acesse sua conta para continuar.

                                </p>

                            </div>

                            {{-- ERROS --}}
                            @if ($errors->any())

                                <div class="alert custom-alert-danger mb-4">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $erro)

                                            <li>{{ $erro }}</li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif

                            <form method="POST"
                                  action="{{ route('login') }}">

                                @csrf

                                {{-- EMAIL --}}
                                <div class="mb-4">

                                    <label class="form-label auth-label">

                                        E-mail

                                    </label>

                                    <input type="email"
                                           name="email"
                                           class="form-control auth-input"
                                           placeholder="Digite seu e-mail"
                                           value="{{ old('email') }}"
                                           required>

                                </div>

                                {{-- SENHA --}}
                                <div class="mb-4">

                                    <label class="form-label auth-label">

                                        Senha

                                    </label>

                                    <input type="password"
                                           name="password"
                                           class="form-control auth-input"
                                           placeholder="Digite sua senha"
                                           required>

                                </div>

                                {{-- BOTÃO --}}
                                <button type="submit"
                                        class="btn auth-submit-btn w-100">

                                    Entrar na plataforma

                                </button>

                            </form>

                            {{-- FOOTER --}}
                            <div class="auth-footer-text">

                                Ainda não possui conta?

                                <a href="{{ route('register') }}">

                                    Criar conta

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection