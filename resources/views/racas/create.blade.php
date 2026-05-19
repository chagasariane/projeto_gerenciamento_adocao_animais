@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        <div class="form-page-wrapper">

            {{-- HEADER --}}
            <div class="form-page-header text-center d-flex flex-column align-items-center mb-5">

                <div class="d-flex flex-column align-items-center">

                    <h1 class="section-title mb-3">

                        Cadastrar Raça

                    </h1>

                    <p class="section-description form-page-description">

                        Cadastre uma nova raça para organizar os animais
                        corretamente na plataforma de adoção responsável.

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

            {{-- FORMULÁRIO --}}
            <div class="form-section-card">

                <form action="{{ route('racas.store') }}"
                      method="POST">

                    @csrf

                    {{-- NOME --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Nome da Raça
                            <span class="required-field">*</span>

                        </label>

                        <input
                            type="text"
                            name="nome"
                            class="form-control custom-input"
                            value="{{ old('nome') }}"
                            placeholder="Ex: Labrador, Siamês, Persa"
                            required>

                    </div>

                    {{-- DESCRIÇÃO --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Descrição

                        </label>

                        <textarea
                            name="descricao"
                            class="form-control custom-textarea"
                            rows="5"
                            placeholder="Descreva características da raça...">{{ old('descricao') }}</textarea>

                    </div>

                    {{-- ESPÉCIE --}}
                    <div class="mb-0">

                        <label class="form-label fw-semibold">

                            Espécie
                            <span class="required-field">*</span>

                        </label>

                        <select name="especie_id"
                                class="form-select custom-select"
                                required>

                            <option value="">

                                Selecione uma espécie

                            </option>

                            @foreach($especies as $especie)

                                <option
                                    value="{{ $especie->id }}"
                                    {{ old('especie_id') == $especie->id ? 'selected' : '' }}>

                                    {{ ucfirst(strtolower($especie->nome)) }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- BOTÕES --}}
                    <div class="d-flex justify-content-between flex-wrap gap-3 mt-5">

                        <a href="{{ route('racas.index') }}"
                           class="btn back-btn">

                            Voltar

                        </a>

                        <button type="submit"
                                class="btn save-btn">

                            Salvar Raça

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection