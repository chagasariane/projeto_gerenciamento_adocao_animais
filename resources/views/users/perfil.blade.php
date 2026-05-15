@extends('layouts.app')

@section('content')

<section class="crud-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5">

            <h1 class="section-title mb-3">

                Meu Perfil

            </h1>

            <p class="section-description">

                Visualize suas informações cadastradas
                na plataforma de adoção responsável.

            </p>

        </div>

        {{-- CARD --}}
        <div class="form-section-card">

            <div class="row g-4">

                {{-- NOME --}}
                <div class="col-md-6">

                    <span class="animal-info-label">

                        Nome

                    </span>

                    <div class="animal-info-value">

                        {{ $user->name }}

                    </div>

                </div>

                {{-- EMAIL --}}
                <div class="col-md-6">

                    <span class="animal-info-label">

                        E-mail

                    </span>

                    <div class="animal-info-value">

                        {{ $user->email }}

                    </div>

                </div>

                {{-- CPF --}}
                <div class="col-md-6">

                    <span class="animal-info-label">

                        CPF

                    </span>

                    <div class="animal-info-value">

                        {{ $user->cpf ?? 'Não informado' }}

                    </div>

                </div>

                {{-- CNPJ --}}
                <div class="col-md-6">

                    <span class="animal-info-label">

                        CNPJ

                    </span>

                    <div class="animal-info-value">

                        {{ $user->cnpj ?? 'Não informado' }}

                    </div>

                </div>

                {{-- TELEFONE --}}
                <div class="col-md-6">

                    <span class="animal-info-label">

                        Telefone

                    </span>

                    <div class="animal-info-value">

                        {{ $user->telefone ?? 'Não informado' }}

                    </div>

                </div>

                {{-- CELULAR --}}
                <div class="col-md-6">

                    <span class="animal-info-label">

                        Celular

                    </span>

                    <div class="animal-info-value">

                        {{ $user->celular ?? 'Não informado' }}

                    </div>

                </div>

                {{-- TIPO --}}
                <div class="col-md-6">

                    <span class="animal-info-label">

                        Tipo de Usuário

                    </span>

                    <div class="animal-info-value">

                        @if($user->is_admin)

                            Administrador

                        @else

                            Usuário Comum

                        @endif

                    </div>

                </div>

            </div>
            
            {{-- BOTÃO EDITAR PERFIL --}}
            <div class="d-flex justify-content-end mt-4">

                <a href="{{ route('perfil.editar') }}"
                class="btn save-btn">

                    Editar Perfil

                </a>

            </div>
        </div>

    </div>

</section>

@endsection