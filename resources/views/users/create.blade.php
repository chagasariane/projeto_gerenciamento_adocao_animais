@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        <div class="auth-register-wrapper">

            {{-- HEADER --}}
            <div class="register-header text-center mb-5">

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
                                <span class="required-field">*</span>

                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control custom-input"
                                   value="{{ old('name') }}"
                                   placeholder="Digite seu nome"
                                   required>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                E-mail
                                <span class="required-field">*</span>

                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control custom-input"
                                   value="{{ old('email') }}"
                                   placeholder="Digite seu e-mail"
                                   required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Senha
                                <span class="required-field">*</span>

                            </label>

                            <input type="password"
                                name="password"
                                class="form-control custom-input"
                                placeholder="Digite sua senha"
                                required>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Confirmar Senha
                                <span class="required-field">*</span>

                            </label>

                            <input type="password"
                                name="password_confirmation"
                                class="form-control custom-input"
                                placeholder="Confirme sua senha"
                                required>

                        </div>

                    </div>

                    <div class="row">

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

                        <div class="col-md-6 mb-0">

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
                                   placeholder="Digite seu telefone (opcional)">

                        </div>

                        <div class="col-md-6 mb-0">

                            <label class="form-label fw-semibold">

                                Celular
                                <span class="required-field">*</span>

                            </label>

                            <input type="text"
                                   name="celular"
                                   class="form-control custom-input"
                                   value="{{ old('celular') }}"
                                   placeholder="Digite seu celular"
                                   required>

                        </div>

                    </div>

                </div>

                {{-- ENDEREÇO --}}
                <div class="form-section-card mb-5">

                    <h3 class="form-section-title">

                        Endereço
                        <span class="required-field">*</span>

                    </h3>

                    <div class="row">

                        <div class="col-md-4 mb-4">

                            <label class="form-label fw-semibold">

                                CEP
                                <span class="required-field">*</span>

                            </label>

                            <input type="text"
                                   name="cep"
                                   class="form-control custom-input"
                                   value="{{ old('cep') }}"
                                   placeholder="Digite o CEP"
                                   required>

                        </div>

                        <div class="col-md-8 mb-4">

                            <label class="form-label fw-semibold">

                                Logradouro
                                <span class="required-field">*</span>

                            </label>

                            <input type="text"
                                   name="logradouro"
                                   class="form-control custom-input"
                                   value="{{ old('logradouro') }}"
                                   placeholder="Digite o logradouro"
                                   required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-4">

                            <label class="form-label fw-semibold">

                                Número
                                <span class="required-field">*</span>

                            </label>

                            <input type="text"
                                   name="numero"
                                   class="form-control custom-input"
                                   value="{{ old('numero') }}"
                                   placeholder="Número"
                                   required>

                        </div>

                        <div class="col-md-5 mb-4">

                            <label class="form-label fw-semibold">

                                Complemento

                            </label>

                            <input type="text"
                                   name="complemento"
                                   class="form-control custom-input"
                                   value="{{ old('complemento') }}"
                                   placeholder="Complemento (opcional)">

                        </div>

                        <div class="col-md-4 mb-4">

                            <label class="form-label fw-semibold">

                                Cidade
                                <span class="required-field">*</span>

                            </label>

                            <input type="text"
                                   name="cidade"
                                   class="form-control custom-input"
                                   value="{{ old('cidade') }}"
                                   placeholder="Cidade"
                                   required>

                        </div>

                    </div>

                    <div class="mb-0">

                        <label class="form-label fw-semibold">

                            Estado
                            <span class="required-field">*</span>

                        </label>

                        <select name="estado"
                                class="form-select custom-input"
                                required>

                            <option value="">

                                Selecione o estado

                            </option>

                            @php
                                $ufs = [
                                    'AC','AL','AP','AM','BA','CE','DF','ES',
                                    'GO','MA','MT','MS','MG','PA','PB','PR',
                                    'PE','PI','RJ','RN','RS','RO','RR','SC',
                                    'SP','SE','TO'
                                ];
                            @endphp

                            @foreach($ufs as $uf)

                                <option value="{{ $uf }}"
                                    {{ old('estado') == $uf ? 'selected' : '' }}>

                                    {{ $uf }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                {{-- BOTÕES --}}
                <div class="d-flex justify-content-between flex-wrap gap-3">

                    @if(auth()->check() && auth()->user()->is_admin)

                        <a href="{{ route('users.index') }}"
                        class="btn back-btn">

                            Voltar

                        </a>

                    @else

                        <a href="{{ url('/') }}"
                        class="btn back-btn">

                            Voltar

                        </a>

                    @endif

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

@section('scripts')

<script>

    $(document).ready(function(){

        $('input[name="cpf"]').mask('000.000.000-00');

        $('input[name="cnpj"]').mask('00.000.000/0000-00');

        $('input[name="cep"]').mask('00000-000');

        $('input[name="telefone"]').mask('(00) 0000-0000');

        $('input[name="celular"]').mask('(00) 00000-0000');

    });

</script>

@endsection