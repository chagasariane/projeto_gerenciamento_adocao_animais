@extends('layouts.app')

@section('content')

<section class="form-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="page-header mb-5">

            <div>

                <h1 class="page-title">
                    Cadastrar Animal
                </h1>

                <p class="page-description">
                    Preencha as informações do animal disponível para adoção.
                </p>

            </div>

        </div>

        {{-- ERROS --}}
        @if ($errors->any())

            <div class="custom-alert error-alert">

                <strong>
                    Foram encontrados erros:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $erro)

                        <li>{{ $erro }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- FORM CARD --}}
        <div class="form-card">

            <form action="{{ route('animais.store') }}"
                  method="POST">

                @csrf

                {{-- DADOS BÁSICOS --}}
                <div class="form-section">

                    <h3 class="form-section-title">

                        Informações Básicas

                    </h3>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="custom-label">
                                Nome
                            </label>

                            <input type="text"
                                   name="nome"
                                   class="form-control custom-input"
                                   value="{{ old('nome') }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="custom-label">
                                Data de Nascimento
                            </label>

                            <input type="date"
                                   name="data_nascimento"
                                   class="form-control custom-input"
                                   value="{{ old('data_nascimento') }}">

                        </div>

                    </div>

                </div>

                {{-- CARACTERÍSTICAS --}}
                <div class="form-section">

                    <h3 class="form-section-title">

                        Características

                    </h3>

                    <div class="row">

                        <div class="col-md-4 mb-4">

                            <label class="custom-label">
                                Sexo
                            </label>

                            <select name="sexo"
                                    class="form-select custom-select"
                                    required>

                                <option value="">
                                    Selecione
                                </option>

                                <option value="MACHO"
                                    {{ old('sexo') == 'MACHO' ? 'selected' : '' }}>

                                    Macho

                                </option>

                                <option value="FEMEA"
                                    {{ old('sexo') == 'FEMEA' ? 'selected' : '' }}>

                                    Fêmea

                                </option>

                            </select>

                        </div>

                        <div class="col-md-4 mb-4">

                            <label class="custom-label">
                                Porte
                            </label>

                            <select name="porte"
                                    class="form-select custom-select">

                                <option value="">
                                    Selecione
                                </option>

                                <option value="PEQUENO"
                                    {{ old('porte') == 'PEQUENO' ? 'selected' : '' }}>

                                    Pequeno

                                </option>

                                <option value="MEDIO"
                                    {{ old('porte') == 'MEDIO' ? 'selected' : '' }}>

                                    Médio

                                </option>

                                <option value="GRANDE"
                                    {{ old('porte') == 'GRANDE' ? 'selected' : '' }}>

                                    Grande

                                </option>

                            </select>

                        </div>

                        <div class="col-md-4 mb-4">

                            <label class="custom-label">
                                Status
                            </label>

                            <select name="status"
                                    class="form-select custom-select">

                                <option value="DISPONIVEL"
                                    {{ old('status') == 'DISPONIVEL' ? 'selected' : '' }}>

                                    Disponível

                                </option>

                                <option value="EM_PROCESSO"
                                    {{ old('status') == 'EM_PROCESSO' ? 'selected' : '' }}>

                                    Em processo

                                </option>

                                <option value="ADOTADO"
                                    {{ old('status') == 'ADOTADO' ? 'selected' : '' }}>

                                    Adotado

                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- RELACIONAMENTOS --}}
                <div class="form-section">

                    <h3 class="form-section-title">

                        Relacionamentos

                    </h3>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="custom-label">
                                Protetor
                            </label>

                            <select name="user_id"
                                    class="form-select custom-select"
                                    required>

                                <option value="">
                                    Selecione
                                </option>

                                @foreach($protetores as $user)

                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>

                                        {{ $user->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="custom-label">
                                Espécie
                            </label>

                            <select id="especie"
                                    name="especie_id"
                                    class="form-select custom-select"
                                    required>

                                <option value="">
                                    Selecione
                                </option>

                                @foreach($especies as $especie)

                                    <option value="{{ $especie->id }}"
                                        {{ old('especie_id') == $especie->id ? 'selected' : '' }}>

                                        {{ $especie->nome }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 mb-4">

                            <label class="custom-label">
                                Raça
                            </label>

                            <select id="raca"
                                    name="raca_id"
                                    class="form-select custom-select"
                                    required
                                    disabled>

                                <option value="">
                                    Selecione a espécie primeiro
                                </option>

                                @foreach($racas as $raca)

                                    <option value="{{ $raca->id }}"
                                            data-especie="{{ $raca->especie_id }}"
                                        {{ old('raca_id') == $raca->id ? 'selected' : '' }}>

                                        {{ $raca->nome }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

                {{-- DESCRIÇÃO --}}
                <div class="form-section">

                    <h3 class="form-section-title">

                        Descrição

                    </h3>

                    <div class="mb-4">

                        <textarea name="descricao"
                                  rows="5"
                                  class="form-control custom-textarea"
                                  placeholder="Descreva comportamento, histórico, temperamento e observações importantes...">{{ old('descricao') }}</textarea>

                    </div>

                </div>

                {{-- ACTIONS --}}
                <div class="form-actions">

                    <a href="{{ route('animais.index') }}"
                       class="btn back-btn">

                        Voltar

                    </a>

                    <button type="submit"
                            class="btn save-btn"
                            id="btnSalvar">

                        Salvar Animal

                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection

@section('scripts')

<script>

    const especieSelect = document.getElementById('especie');
    const racaSelect = document.getElementById('raca');
    const form = document.querySelector('form');
    const btn = document.getElementById('btnSalvar');

    if (especieSelect && racaSelect) {

        function filtrarRacas() {

            const especieId = especieSelect.value;

            racaSelect.value = "";

            Array.from(racaSelect.options).forEach(option => {

                if (!option.value) return;

                const pertence =
                    option.getAttribute('data-especie') === especieId;

                option.hidden = !pertence;

            });

            racaSelect.disabled = !especieId;
        }

        especieSelect.addEventListener('change', filtrarRacas);

        window.addEventListener('load', filtrarRacas);
    }

    if (form && btn) {

        form.addEventListener('submit', function () {

            btn.disabled = true;
            btn.innerText = 'Salvando...';

        });

    }

</script>

@endsection