@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4 mb-5">

            <div>

                <h1 class="section-title mb-2">

                    Solicitar Adoção

                </h1>

                <p class="crud-description m-0">

                    Envie uma solicitação demonstrando
                    seu interesse em adotar este animal.

                </p>

            </div>

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

                <div class="form-section-card h-100">

                    {{-- FOTO --}}
                    @if($animal->fotoPrincipal)

                        <img
                            src="{{ asset('storage/' . $animal->fotoPrincipal->caminho) }}"
                            class="request-animal-image w-100 mb-4"
                            alt="{{ $animal->nome }}"
                            style="
                                height: 320px;
                                object-fit: cover;
                                border-radius: 24px;
                            "
                        >

                    @else

                        <img
                            src="{{ asset('imagem/sem-foto.png') }}"
                            class="request-animal-image w-100 mb-4"
                            alt="Sem foto"
                            style="
                                height: 320px;
                                object-fit: cover;
                                border-radius: 24px;
                            "
                        >

                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h2 class="manage-animal-name mb-0">

                            {{ $animal->nome }}

                        </h2>

                        <span class="animal-tag">

                            {{ $animal->especie->nome }}

                        </span>

                    </div>

                    <div class="manage-meta-grid mb-4">

                        <div class="manage-meta-item">

                            <span class="manage-meta-label">

                                Raça

                            </span>

                            <span class="manage-meta-value">

                                {{ $animal->raca->nome }}

                            </span>

                        </div>

                        <div class="manage-meta-item">

                            <span class="manage-meta-label">

                                Porte

                            </span>

                            <span class="manage-meta-value">

                                {{ ucfirst(strtolower($animal->porte)) }}

                            </span>

                        </div>

                        <div class="manage-meta-item">

                            <span class="manage-meta-label">

                                Localização

                            </span>

                            <span class="manage-meta-value">

                                {{ $animal->cidade }} - {{ $animal->estado }}

                            </span>

                        </div>

                    </div>

                    <div class="adoption-message-box">

                        <span class="message-label">

                            Sobre o animal

                        </span>

                        <p class="message-content mb-0">

                            {{ $animal->descricao }}

                        </p>

                    </div>

                </div>

            </div>

            {{-- FORM --}}
            <div class="col-lg-7">

                <div class="form-section-card h-100">

                    <h3 class="form-section-title mb-3">

                        Sua mensagem ao protetor

                    </h3>

                    <p class="crud-description mb-4">

                        Explique seu interesse na adoção,
                        experiência com animais e como pretende
                        cuidar deste pet.

                    </p>

                    <form action="{{ route('adocoes.store') }}"
                          method="POST">

                        @csrf

                        <input
                            type="hidden"
                            name="animal_id"
                            value="{{ $animal->id }}"
                        >

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Mensagem

                            </label>

                            <textarea
                                name="mensagem"
                                rows="8"
                                required
                                class="form-control custom-textarea"
                                placeholder="Descreva por que você deseja adotar este animal..."
                            >{{ old('mensagem') }}</textarea>

                        </div>

                        <div class="d-flex gap-3 flex-wrap">

                            <a
                                href="{{ route('animais.show', $animal->id) }}"
                                class="btn back-btn"
                            >

                                Voltar

                            </a>

                            <button
                                type="submit"
                                class="btn save-btn"
                            >

                                Enviar Solicitação

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection