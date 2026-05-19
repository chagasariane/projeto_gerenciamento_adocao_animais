@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="mb-5 text-center d-flex flex-column align-items-center">

            <h1 class="section-title mb-3">
                Cadastrar Animal
            </h1>

            <p class="section-description m-0">
                Preencha as informações do animal disponível para adoção responsável.
            </p>

        </div>

        {{-- ALERTAS --}}
        @if ($errors->any())

            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-5">

                <strong class="d-block mb-2">
                    Foram encontrados erros no formulário:
                </strong>

                <ul class="mb-0 ps-3">

                    @foreach ($errors->all() as $erro)

                        <li>{{ $erro }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- FORMULÁRIO --}}
        <div class="filter-box">

            <form action="{{ route('animais.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                {{-- INFORMAÇÕES BÁSICAS --}}
                <div class="mb-5">

                    <h3 class="animal-section-title">
                        Informações Básicas
                    </h3>

                    <div class="row g-4">

                        {{-- NOME --}}
                        <div class="col-lg-6">

                            <label class="form-label fw-semibold mb-2">
                                Nome
                                <span class="required-field">*</span>
                            </label>

                            <input type="text"
                                   name="nome"
                                   class="form-control custom-input"
                                   value="{{ old('nome') }}"
                                   placeholder="Digite o nome do animal"
                                   required>

                        </div>

                        {{-- DATA --}}
                        <div class="col-lg-6">

                            <label class="form-label fw-semibold mb-2">
                                Data de Nascimento
                                <span class="required-field">*</span>
                            </label>

                            <input type="date"
                                   name="data_nascimento"
                                   class="form-control custom-input"
                                   value="{{ old('data_nascimento') }}"
                                   required>

                        </div>

                        {{-- DESCRIÇÃO --}}
                        <div class="col-12">

                            <label class="form-label fw-semibold mb-2">
                                Descrição
                                <span class="required-field">*</span>
                            </label>

                            <textarea name="descricao"
                                      rows="5"
                                      class="form-control custom-input"
                                      placeholder="Descreva comportamento, personalidade e informações importantes do animal."
                                      required>{{ old('descricao') }}</textarea>

                        </div>

                    </div>

                </div>

                {{-- CARACTERÍSTICAS --}}
                <div class="mb-5">

                    <h3 class="animal-section-title">
                        Características
                    </h3>

                    <div class="row g-4">

                        {{-- SEXO --}}
                        <div class="col-lg-3">

                            <label class="form-label fw-semibold mb-2">
                                Sexo
                                <span class="required-field">*</span>
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

                                <option value="NAO_IDENTIFICADO"
                                    {{ old('sexo') == 'NAO_IDENTIFICADO' ? 'selected' : '' }}>

                                    Não Identificado

                                </option>

                            </select>

                        </div>

                        {{-- PORTE --}}
                        <div class="col-lg-3">

                            <label class="form-label fw-semibold mb-2">
                                Porte
                                <span class="required-field">*</span>
                            </label>

                            <select name="porte"
                                    class="form-select custom-select"
                                    required>

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

                        {{-- ESPÉCIE --}}
                        <div class="col-lg-3">

                            <label class="form-label fw-semibold mb-2">
                                Espécie
                                <span class="required-field">*</span>
                            </label>

                            <select name="especie_id"
                                id="especie_id"
                                class="form-select custom-select"
                                required>

                            <option value="">
                                Selecione
                            </option>

                            @foreach ($especies as $especie)

                                <option value="{{ $especie->id }}"
                                    {{ old('especie_id') == $especie->id ? 'selected' : '' }}>

                                    {{ ucfirst(strtolower($especie->nome)) }}

                                </option>

                            @endforeach

                        </select>

                        </div>

                        {{-- RAÇA --}}
                        <div class="col-lg-3">

                            <label class="form-label fw-semibold mb-2">
                                Raça
                                <span class="required-field">*</span>
                            </label>

                            <select name="raca_id"
                                    id="raca_id"
                                    class="form-select custom-select"
                                    required>

                                <option value="">
                                    Primeiro selecione uma espécie
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- LOCALIZAÇÃO --}}
                <div class="mb-5">

                    <h3 class="animal-section-title">
                        Localização
                    </h3>

                    <div class="row g-4">

                        {{-- CIDADE --}}
                        <div class="col-lg-6">

                            <label class="form-label fw-semibold mb-2">
                                Cidade
                                <span class="required-field">*</span>
                            </label>

                            <input type="text"
                                   name="cidade"
                                   class="form-control custom-input"
                                   value="{{ old('cidade') }}"
                                   placeholder="Digite a cidade"
                                   required>

                        </div>

                        {{-- ESTADO --}}
                        <div class="col-lg-6">

                            <label class="form-label fw-semibold mb-2">
                                Estado
                                <span class="required-field">*</span>
                            </label>

                            <select name="estado"
                                    class="form-select custom-select"
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

                </div>

                {{-- SAÚDE --}}
                <div class="mb-5">

                    <h3 class="animal-section-title">
                        Saúde e Cuidados
                    </h3>

                    <div class="row g-4 mb-4">

                        {{-- CASTRADO --}}
                        <div class="col-lg-6">

                            <div class="animal-info-item h-100 justify-content-center">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="castrado"
                                           class="form-check-input"
                                           {{ old('castrado') ? 'checked' : '' }}>

                                    <label class="form-check-label fw-semibold">

                                        Animal castrado

                                    </label>

                                </div>

                            </div>

                        </div>

                        {{-- VACINADO --}}
                        <div class="col-lg-6">

                            <div class="animal-info-item h-100 justify-content-center">

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="vacinado"
                                           class="form-check-input"
                                           {{ old('vacinado') ? 'checked' : '' }}>

                                    <label class="form-check-label fw-semibold">

                                        Animal vacinado

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- NECESSIDADES --}}
                    <div>

                        <label class="form-label fw-semibold mb-2">
                            Necessidades Especiais
                        </label>

                        <textarea name="necessidades_especiais"
                                  rows="5"
                                  class="form-control custom-input"
                                  placeholder="Informe medicações, cuidados especiais ou observações relevantes.">{{ old('necessidades_especiais') }}</textarea>

                    </div>

                </div>

                {{-- FOTOS --}}
                <div class="mb-5">

                    <h3 class="animal-section-title">
                        Fotos do Animal
                    </h3>

                    <div class="animal-info-item">

                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">

                            <div>

                                <span class="animal-info-label d-block mb-2">
                                    Upload de imagens
                                </span>

                                <p class="text-muted mb-0">

                                    Você pode enviar até 10 fotos.
                                    A primeira imagem será definida automaticamente
                                    como foto principal.

                                </p>

                            </div>

                            {{-- INPUT --}}
                            <input type="file"
                                id="fotos"
                                name="fotos[]"
                                multiple
                                accept="image/*"
                                hidden>

                            {{-- BOTÃO --}}
                            <button type="button"
                                    class="create-btn"
                                    id="btn-fotos">

                                Adicionar Fotos

                            </button>

                        </div>

                        {{-- PREVIEW --}}
                        <div id="preview-fotos"
                            class="row g-3">

                        </div>

                    </div>

                </div>

                {{-- BOTÕES --}}
                <div class="d-flex flex-column flex-md-row justify-content-end gap-3">

                    <a href="{{ route('animais.index') }}"
                       class="back-btn text-decoration-none text-center">

                        Cancelar

                    </a>

                    <button type="submit"
                            class="save-btn">

                        Cadastrar Animal

                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>

    const inputFotos =
        document.getElementById('fotos');

    const btnFotos =
        document.getElementById('btn-fotos');

    const previewFotos =
        document.getElementById('preview-fotos');

    /*
    |--------------------------------------------------------------------------
    | ARRAY DE IMAGENS
    |--------------------------------------------------------------------------
    */

    let arquivos = [];

    /*
    |--------------------------------------------------------------------------
    | ABRIR INPUT
    |--------------------------------------------------------------------------
    */

    btnFotos.addEventListener('click', () => {

        inputFotos.click();

    });

    /*
    |--------------------------------------------------------------------------
    | ADICIONAR IMAGENS
    |--------------------------------------------------------------------------
    */

    inputFotos.addEventListener('change', (event) => {

        Array.from(event.target.files)
            .forEach(file => {

                arquivos.push({

                    file: file,

                    preview: URL.createObjectURL(file)

                });

            });

        atualizarInputFiles();

        renderizarPreview();

    });

    /*
    |--------------------------------------------------------------------------
    | ATUALIZA INPUT FILES
    |--------------------------------------------------------------------------
    */

    function atualizarInputFiles() {

        const dataTransfer =
            new DataTransfer();

        arquivos.forEach(item => {

            dataTransfer.items.add(item.file);

        });

        inputFotos.files =
            dataTransfer.files;

    }

    /*
    |--------------------------------------------------------------------------
    | RENDERIZA PREVIEW
    |--------------------------------------------------------------------------
    */

    function renderizarPreview() {

        previewFotos.innerHTML = '';

        arquivos.forEach((item, index) => {

            const coluna =
                document.createElement('div');

            coluna.className =
                'col-auto preview-item';

            coluna.innerHTML = `

                <div class="animal-card preview-foto-card ${index === 0 ? 'foto-principal-card' : ''}">

                    <img src="${item.preview}"
                         class="animal-image"
                         alt="Preview">

                    <div class="animal-body">

                        <button type="button"
                                class="delete-btn w-100"
                                onclick="removerFoto(${index})">

                            Remover

                        </button>

                    </div>

                </div>

            `;

            previewFotos.appendChild(coluna);

        });

    }

    /*
    |--------------------------------------------------------------------------
    | REMOVER FOTO
    |--------------------------------------------------------------------------
    */

    function removerFoto(index) {

        arquivos.splice(index, 1);

        atualizarInputFiles();

        renderizarPreview();

    }

    /*
    |--------------------------------------------------------------------------
    | SORTABLE
    |--------------------------------------------------------------------------
    */

    new Sortable(previewFotos, {

        animation: 200,

        ghostClass: 'sortable-ghost',

        onEnd: function (event) {

            const itemMovido =
                arquivos.splice(event.oldIndex, 1)[0];

            arquivos.splice(
                event.newIndex,
                0,
                itemMovido
            );

            atualizarInputFiles();

            renderizarPreview();

        }

    });

    /*
    |--------------------------------------------------------------------------
    | FILTRO DINÂMICO DE RAÇAS
    |--------------------------------------------------------------------------
    */

    const selectEspecie =
        document.getElementById('especie_id');

    const selectRaca =
        document.getElementById('raca_id');

    /*
    |--------------------------------------------------------------------------
    | CARREGA RAÇAS
    |--------------------------------------------------------------------------
    */

    async function carregarRacas(especieId, racaSelecionada = null) {

        selectRaca.innerHTML = `
            <option value="">
                Carregando...
            </option>
        `;

        try {

            const response = await fetch(
                `/especies/${especieId}/racas`
            );

            const racas = await response.json();

            selectRaca.innerHTML = `
                <option value="">
                    Selecione
                </option>
            `;

            racas.forEach(raca => {

                const option =
                    document.createElement('option');

                option.value = raca.id;

                option.textContent =
                    raca.nome.charAt(0).toUpperCase() +
                    raca.nome.slice(1).toLowerCase();

                /*
                |--------------------------------------------------------------------------
                | MANTÉM OLD()
                |--------------------------------------------------------------------------
                */

                if (racaSelecionada == raca.id) {

                    option.selected = true;

                }

                selectRaca.appendChild(option);

            });

        } catch (error) {

            selectRaca.innerHTML = `
                <option value="">
                    Erro ao carregar raças
                </option>
            `;

        }

    }

    /*
    |--------------------------------------------------------------------------
    | ALTERAÇÃO DE ESPÉCIE
    |--------------------------------------------------------------------------
    */

    selectEspecie.addEventListener('change', () => {

        const especieId =
            selectEspecie.value;

        selectRaca.innerHTML = `
            <option value="">
                Selecione
            </option>
        `;

        if (!especieId) return;

        carregarRacas(especieId);

    });

    /*
    |--------------------------------------------------------------------------
    | OLD INPUT
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', () => {

        const especieOld =
            "{{ old('especie_id') }}";

        const racaOld =
            "{{ old('raca_id') }}";

        if (especieOld) {

            carregarRacas(
                especieOld,
                racaOld
            );

        }

    });

</script>

@endsection