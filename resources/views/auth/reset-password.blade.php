@extends('layouts.app')

@section('content')

<section class="auth-page">
    <div class="container">
        <div class="auth-wrapper">

            <div class="auth-form-side w-100">
                <div class="auth-form-wrapper">

                    <div class="mb-5">
                        <h2 class="auth-form-title">
                            Nova senha
                        </h2>

                        <p class="auth-form-subtitle">
                            Cadastre uma nova senha para sua conta.
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="alert custom-alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input
                            type="hidden"
                            name="token"
                            value="{{ $token }}"
                        >

                        <div class="mb-4">
                            <label class="form-label auth-label">
                                E-mail
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control auth-input"
                                value="{{ old('email', $email) }}"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label auth-label">
                                Nova senha
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control auth-input"
                                placeholder="Digite sua nova senha"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label auth-label">
                                Confirmar nova senha
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control auth-input"
                                placeholder="Digite novamente sua nova senha"
                                required
                            >
                        </div>

                        <button type="submit"
                                class="btn auth-submit-btn w-100">
                            Alterar senha
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection