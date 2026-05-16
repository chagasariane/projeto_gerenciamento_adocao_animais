@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="mb-5">

            <h1 class="section-title mb-3">

                Solicitar Adoção

            </h1>

            <p class="section-description m-0">

                Envie uma solicitação demonstrando
                seu interesse em adotar este animal.

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

        <div class="row g-4">

            {{-- CARD ANIMAL --}}
            <div class="col-lg-5">

                <div class="request-animal-card">

                    {{-- FOTO --}}
                    @if($animal->fotoPrincipal)

                        <img src="{{ asset('storage/' . $animal->fotoPrincipal->caminho) }}"
                             class="request-animal-image"
                             alt="{{ $animal->nome }}">

                    @else

                        <img src="{{ asset('imagem/sem-foto.png') }}"
                             class="request-animal-image"
                             alt="Sem foto">

                    @endif

                    <div class="request-animal-body">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h2 class="request-animal-name">

                                {{ $animal->nome }}

                            </h2>

                            <span class="animal-tag">

                                {{ $animal->especie->nome }}

                            </span>

                        </div>

                        <div class="request-info-grid">

                            <div class="request-info-item">

                                <span class="request-info-label">

                                    Raça

                                </span>

                                <span class="request-info-value">

                                    {{ $animal->raca->nome }}

                                </span>

                            </div>

                            <div class="request-info-item">

                                <span class="request-info-label">

                                    Porte

                                </span>

                                <span class="request-info-value">

                                    {{ ucfirst(strtolower($animal->porte)) }}

                                </span>

                            </div>

                            <div class="request-info-item">

                                <span class="request-info-label">

                                    Localização

                                </span>

                                <span class="request-info-value">

                                    {{ $animal->cidade }} - {{ $animal->estado }}

                                </span>

                            </div>

                        </div>

                        <div class="request-description-box">

                            <span class="request-info-label d-block mb-2">

                                Sobre o animal

                            </span>

                            <p class="mb-0">

                                {{ $animal->descricao }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- FORM --}}
            <div class="col-lg-7">

                <div class="request-form-card">

                    <div class="request-form-body">

                        <h3 class="request-form-title">

                            Sua mensagem ao protetor

                        </h3>

                        <p class="request-form-description">

                            Explique seu interesse na adoção,
                            experiência com animais e como pretende
                            cuidar deste pet.

                        </p>

                        <form action="{{ route('adocoes.store') }}"
                              method="POST">

                            @csrf

                            <input type="hidden"
                                   name="animal_id"
                                   value="{{ $animal->id }}">

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Mensagem

                                </label>

                                <textarea name="mensagem"
                                          rows="8"
                                          class="form-control custom-textarea"
                                          placeholder="Descreva por que você deseja adotar este animal...">{{ old('mensagem') }}</textarea>

                            </div>

                            <div class="d-flex gap-3 flex-wrap">

                                <a href="{{ route('animais.show', $animal->id) }}"
                                   class="btn back-btn">

                                    Voltar

                                </a>

                                <button type="submit"
                                        class="btn adopt-btn">

                                    Enviar Solicitação

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection