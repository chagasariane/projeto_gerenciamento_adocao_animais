@extends('layouts.app')

@section('content')

<section class="crud-page">

    <div class="container">

        <div class="form-page-wrapper">

            {{-- HEADER --}}
            <div class="form-page-header text-center d-flex flex-column align-items-center mb-5">

                <h1 class="crud-title mb-3">

                    Editar Espécie

                </h1>

                <p class="crud-description form-page-description">

                    Atualize as informações da espécie cadastrada
                    na plataforma de adoção responsável.

                </p>

            </div>

            {{-- ERROS --}}
            @if ($errors->any())

                <div class="custom-alert-danger mb-4">

                    <strong class="d-block mb-2">

                        Foram encontrados erros no formulário:

                    </strong>

                    <ul class="mb-0 ps-3">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- FORM --}}
            <div class="form-section-card">

                <form action="{{ route('especies.update', $especie->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    {{-- NOME --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold mb-2">

                            Nome da Espécie
                            <span class="required-field">*</span>

                        </label>

                        <input
                            type="text"
                            name="nome"
                            class="form-control custom-input"
                            value="{{ old('nome', $especie->nome) }}"
                            placeholder="Ex: Cachorro, Gato, Coelho"
                            required>

                    </div>

                    {{-- DESCRIÇÃO --}}
                    <div class="mb-0">

                        <label class="form-label fw-semibold mb-2">

                            Descrição

                        </label>

                        <textarea
                            name="descricao"
                            class="form-control custom-textarea"
                            rows="6"
                            placeholder="Descreva características gerais da espécie...">{{ old('descricao', $especie->descricao) }}</textarea>

                    </div>

                    {{-- BOTÕES --}}
                    <div class="d-flex justify-content-between flex-wrap gap-3 mt-5">

                        <a href="{{ route('especies.index') }}"
                           class="btn back-btn">

                            Cancelar

                        </a>

                        <button type="submit"
                                class="btn save-btn">

                            Atualizar Espécie

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection