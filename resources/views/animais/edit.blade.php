@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="content-card mb-5">

            <h1 class="section-title mb-3">
                Editar Animal
            </h1>

            <p class="section-description m-0">
                Atualize as informações e mantenha o perfil do animal sempre atualizado.
            </p>

        </div>

        {{-- ERROS --}}
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

        {{-- FORM CARD --}}
        <div class="filter-box">

            {{-- FORM PRINCIPAL --}}
            <form action="{{ route('animais.update', $animal->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- INFORMAÇÕES BÁSICAS --}}
                <div class="content-card mb-5">

                    <h3 class="animal-section-title">
                        Informações Básicas
                    </h3>

                    <p class="section-helper-text mb-5">
                        Dados principais de identificação do animal.
                    </p>

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
                                   value="{{ old('nome', $animal->nome) }}"
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
                                   value="{{ old('data_nascimento', optional($animal->data_nascimento)->format('Y-m-d')) }}">

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
                                      required>{{ old('descricao', $animal->descricao) }}</textarea>

                        </div>

                    </div>

                </div>

                {{-- CARACTERÍSTICAS --}}
                <div class="content-card mb-5">

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
                                    {{ old('sexo', $animal->sexo) == 'MACHO' ? 'selected' : '' }}>

                                    Macho

                                </option>

                                <option value="FEMEA"
                                    {{ old('sexo', $animal->sexo) == 'FEMEA' ? 'selected' : '' }}>

                                    Fêmea

                                </option>

                                <option value="NAO_IDENTIFICADO"
                                    {{ old('sexo', $animal->sexo) == 'NAO_IDENTIFICADO' ? 'selected' : '' }}>

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
                                    {{ old('porte', $animal->porte) == 'PEQUENO' ? 'selected' : '' }}>

                                    Pequeno

                                </option>

                                <option value="MEDIO"
                                    {{ old('porte', $animal->porte) == 'MEDIO' ? 'selected' : '' }}>

                                    Médio

                                </option>

                                <option value="GRANDE"
                                    {{ old('porte', $animal->porte) == 'GRANDE' ? 'selected' : '' }}>

                                    Grande

                                </option>

                            </select>

                        </div>

                        {{-- STATUS --}}
                        <div class="col-lg-3">

                            <label class="form-label fw-semibold mb-2">
                                Status
                            </label>

                            <select name="status"
                                    class="form-select custom-select">

                                <option value="DISPONIVEL"
                                    {{ old('status', $animal->status) == 'DISPONIVEL' ? 'selected' : '' }}>

                                    Disponível

                                </option>

                                <option value="ADOTADO"
                                    {{ old('status', $animal->status) == 'ADOTADO' ? 'selected' : '' }}>

                                    Adotado

                                </option>

                                <option value="INATIVO"
                                    {{ old('status', $animal->status) == 'INATIVO' ? 'selected' : '' }}>

                                    Inativo

                                </option>

                            </select>

                        </div>

                        {{-- ESPÉCIE --}}
                        <div class="col-lg-3">

                            <label class="form-label fw-semibold mb-2">
                                <span class="required-field">*</span>
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
                                        {{ old('especie_id', optional($animal->raca)->especie_id) == $especie->id ? 'selected' : '' }}>

                                        {{ ucfirst(strtolower($especie->nome)) }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- RAÇA --}}
                        <div class="col-lg-6">

                            <label class="form-label fw-semibold mb-2">
                                Raça
                                <span class="required-field">*</span>
                            </label>

                            <select id="raca"
                                    name="raca_id"
                                    class="form-select custom-select"
                                    required>

                                @foreach($racas as $raca)

                                    <option value="{{ $raca->id }}"
                                            data-especie="{{ $raca->especie_id }}"
                                        {{ old('raca_id', $animal->raca_id) == $raca->id ? 'selected' : '' }}>

                                        {{ ucfirst(strtolower($raca->nome)) }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- CIDADE --}}
                        <div class="col-lg-3">

                            <label class="form-label fw-semibold mb-2">
                                Cidade
                                <span class="required-field">*</span>
                            </label>

                            <input type="text"
                                   name="cidade"
                                   class="form-control custom-input"
                                   value="{{ old('cidade', $animal->cidade) }}"
                                   placeholder="Digite a cidade"
                                   required>

                        </div>

                        {{-- ESTADO --}}
                        <div class="col-lg-3">

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
                                        {{ old('estado', $animal->estado) == $uf ? 'selected' : '' }}>

                                        {{ $uf }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

                {{-- SAÚDE --}}
                <div class="content-card mb-5">

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
                                           {{ old('castrado', $animal->castrado) ? 'checked' : '' }}>

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
                                           {{ old('vacinado', $animal->vacinado) ? 'checked' : '' }}>

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
                                  placeholder="Informe medicações, cuidados especiais ou observações relevantes.">{{ old('necessidades_especiais', $animal->necessidades_especiais) }}</textarea>

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

                        Atualizar Animal

                    </button>

                </div>

            </form>

        </div>

        {{-- FOTOS ATUAIS --}}
        <div class="mb-5 mt-5">

            <div class="d-flex flex-column flex-lg-row
                        justify-content-between
                        align-items-lg-center
                        gap-3
                        mb-4">

                <div>

                    <h3 class="animal-section-title mb-2">
                        Fotos Atuais
                    </h3>

                </div>

            </div>

            @if($animal->fotos->count())

                <div class="d-flex flex-wrap gap-4"
                    id="fotos-atuais">

                    @foreach($animal->fotos as $foto)

                        <div class="animal-card preview-foto-card
                            {{ $foto->principal ? 'foto-principal-card' : '' }}"
                            data-foto-id="{{ $foto->id }}">

                            {{-- BADGE --}}
                            @if($foto->principal)

                            @endif

                            {{-- IMAGEM --}}
                            <img src="{{ asset('storage/' . $foto->caminho) }}"
                                class="animal-image"
                                alt="Foto do animal">

                            {{-- CORPO --}}
                            <div class="animal-body">

                                <form action="{{ route('animais.fotos.destroy', $foto->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="delete-btn w-100"
                                            onclick="return confirm('Deseja remover esta foto?')">

                                        Remover

                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="animal-info-item">

                    <p class="text-muted mb-0">
                        Nenhuma foto cadastrada.
                    </p>

                </div>

            @endif

        </div>

        {{-- ADICIONAR NOVAS FOTOS --}}
        <div class="filter-box mt-5">

            <form action="{{ route('animais.fotos.store', $animal->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-4">

                    <h3 class="animal-section-title">
                        Adicionar Novas Fotos
                    </h3>

                </div>

                <div class="animal-info-item">

                    <div class="d-flex flex-column flex-lg-row
                                justify-content-between
                                align-items-lg-center
                                gap-3
                                mb-4">

                        <div>

                            <span class="animal-info-label d-block mb-2">

                                Upload de imagens

                            </span>

                            <p class="text-muted mb-0">

                                Fotos bem iluminadas e naturais aumentam
                                as chances de adoção.

                            </p>

                        </div>

                        {{-- INPUT --}}
                        <input type="file"
                            id="edit-fotos"
                            name="fotos[]"
                            multiple
                            accept="image/*"
                            hidden>

                        {{-- BOTÃO --}}
                        <button type="button"
                                class="create-btn"
                                id="edit-btn-fotos">

                            Adicionar Fotos

                        </button>

                    </div>

                    {{-- PREVIEW --}}
                    <div id="edit-preview-fotos"
                        class="row g-3 mb-4">

                    </div>

                    {{-- ACTIONS --}}
                    <div class="d-flex justify-content-end">

                        <button type="submit"
                                class="save-btn">

                            Enviar Fotos

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | FILTRO DE RAÇAS
    |--------------------------------------------------------------------------
    */

    const especieSelect =
        document.getElementById('especie');

    const racaSelect =
        document.getElementById('raca');

    if (especieSelect && racaSelect) {

        function filtrarRacas() {

            const especieId =
                especieSelect.value;

            Array.from(racaSelect.options)
                .forEach(option => {

                    if (!option.value) return;

                    const pertence =
                        option.getAttribute('data-especie') === especieId;

                    option.style.display =
                        (!especieId || pertence)
                            ? 'block'
                            : 'none';
                });

            racaSelect.disabled =
                !especieId;
        }

        especieSelect.addEventListener(
            'change',
            function () {

                racaSelect.value = "";

                filtrarRacas();

            }
        );

        window.addEventListener(
            'load',
            filtrarRacas
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PREVIEW DE NOVAS FOTOS
    |--------------------------------------------------------------------------
    */

    const inputFotos =
        document.getElementById('edit-fotos');

    const btnFotos =
        document.getElementById('edit-btn-fotos');

    const previewFotos =
        document.getElementById('edit-preview-fotos');

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

                        ${index === 0
                            ? `
                              `
                            : ''
                        }

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

</script>

@endsection