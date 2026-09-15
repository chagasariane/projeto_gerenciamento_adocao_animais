@extends('layouts.app')

@section('content')

<section class="auth-page">
    <div class="container">
        <div class="auth-wrapper">

            <div class="auth-form-side w-100">
                <div class="auth-form-wrapper">

                    <div class="mb-5">
                        <h2 class="auth-form-title">
                            Recuperar senha
                        </h2>

                        <p class="auth-form-subtitle">
                            Informe seu e-mail para receber o link de recuperação.
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert custom-alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label auth-label">
                                E-mail
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control auth-input"
                                placeholder="Digite seu e-mail"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                        </div>

                        <button type="submit"
                                class="btn auth-submit-btn w-100">
                            Enviar link de recuperação
                        </button>
                    </form>

                    <div class="auth-footer-text">
                        <a href="{{ route('login') }}">
                            Voltar para o login
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection