@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        <div class="auth-register-wrapper">

            {{-- HEADER --}}
            <div class="register-header text-center">

                <span class="auth-badge mb-4">

                    Plataforma de Adoção Responsável

                </span>

                <h1 class="section-title mb-3">

                    Criar Conta

                </h1>

                <p class="section-description register-description">

                    Cadastre-se para encontrar animais disponíveis,
                    acompanhar solicitações e participar do processo
                    de adoção responsável.

                </p>

            </div>

            {{-- ERROS --}}
            @if ($errors->any())

                <div class="alert custom-alert-danger mb-4">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('users.store') }}"
                  method="POST">

                @csrf

                {{-- DADOS PRINCIPAIS --}}
                <div class="form-section-card mb-4">

                    <h3 class="form-section-title">
                        Informações da Conta
                    </h3>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Nome

                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control custom-input"
                                   value="{{ old('name') }}"
                                   placeholder="Digite seu nome">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                E-mail

                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control custom-input"
                                   value="{{ old('email') }}"
                                   placeholder="Digite seu e-mail">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Senha

                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control custom-input"
                                   placeholder="Digite sua senha">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                CPF

                            </label>

                            <input type="text"
                                   name="cpf"
                                   class="form-control custom-input"
                                   value="{{ old('cpf') }}"
                                   placeholder="Digite seu CPF">

                        </div>

                    </div>

                    <div class="mb-0">

                        <label class="form-label fw-semibold">

                            CNPJ

                        </label>

                        <input type="text"
                               name="cnpj"
                               class="form-control custom-input"
                               value="{{ old('cnpj') }}"
                               placeholder="Digite seu CNPJ (opcional)">

                    </div>

                </div>

                {{-- CONTATO --}}
                <div class="form-section-card mb-4">

                    <h3 class="form-section-title">

                        Contato

                    </h3>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Telefone

                            </label>

                            <input type="text"
                                   name="telefone"
                                   class="form-control custom-input"
                                   value="{{ old('telefone') }}"
                                   placeholder="Digite seu telefone">

                        </div>

                        <div class="col-md-6 mb-0">

                            <label class="form-label fw-semibold">

                                Celular

                            </label>

                            <input type="text"
                                   name="celular"
                                   class="form-control custom-input"
                                   value="{{ old('celular') }}"
                                   placeholder="Digite seu celular">

                        </div>

                    </div>

                </div>

                {{-- ENDEREÇO --}}
                <div class="form-section-card mb-5">

                    <h3 class="form-section-title">

                        Endereço

                    </h3>

                    <div class="row">

                        <div class="col-md-4 mb-4">

                            <label class="form-label fw-semibold">

                                CEP

                            </label>

                            <input type="text"
                                   name="cep"
                                   class="form-control custom-input"
                                   value="{{ old('cep') }}"
                                   placeholder="Digite o CEP">

                        </div>

                        <div class="col-md-8 mb-4">

                            <label class="form-label fw-semibold">

                                Logradouro

                            </label>

                            <input type="text"
                                   name="logradouro"
                                   class="form-control custom-input"
                                   value="{{ old('logradouro') }}"
                                   placeholder="Digite o logradouro">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-4">

                            <label class="form-label fw-semibold">

                                Número

                            </label>

                            <input type="text"
                                   name="numero"
                                   class="form-control custom-input"
                                   value="{{ old('numero') }}"
                                   placeholder="Número">

                        </div>

                        <div class="col-md-5 mb-4">

                            <label class="form-label fw-semibold">

                                Complemento

                            </label>

                            <input type="text"
                                   name="complemento"
                                   class="form-control custom-input"
                                   value="{{ old('complemento') }}"
                                   placeholder="Complemento">

                        </div>

                        <div class="col-md-4 mb-4">

                            <label class="form-label fw-semibold">

                                Cidade

                            </label>

                            <input type="text"
                                   name="cidade"
                                   class="form-control custom-input"
                                   value="{{ old('cidade') }}"
                                   placeholder="Cidade">

                        </div>

                    </div>

                    <div class="mb-0">

                        <label class="form-label fw-semibold">

                            Estado

                        </label>

                        <input type="text"
                               name="estado"
                               class="form-control custom-input"
                               value="{{ old('estado') }}"
                               placeholder="Estado">

                    </div>

                </div>

                {{-- BOTÕES --}}
                <div class="d-flex justify-content-between flex-wrap gap-3">

                    <a href="{{ url('/') }}"
                       class="btn back-btn">

                        Voltar

                    </a>

                    <button type="submit"
                            class="btn save-btn">

                        Criar Conta

                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection