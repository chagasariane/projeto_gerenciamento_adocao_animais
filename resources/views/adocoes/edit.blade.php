@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="mb-5">

            <h1 class="section-title mb-3">

                Gerenciar Solicitação

            </h1>

            <p class="section-description m-0">

                Avalie a solicitação de adoção recebida
                e defina o andamento do processo.

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

        {{-- CARD --}}
        <div class="adoption-manage-card">

            {{-- TOPO --}}
            <div class="adoption-manage-top">

                {{-- FOTO --}}
                <div class="manage-photo-wrapper">

                    @if($adocao->animal->fotoPrincipal)

                        <img src="{{ asset('storage/' . $adocao->animal->fotoPrincipal->caminho) }}"
                             class="manage-photo"
                             alt="{{ $adocao->animal->nome }}">

                    @else

                        <img src="{{ asset('imagem/sem-foto.png') }}"
                             class="manage-photo"
                             alt="Sem foto">

                    @endif

                </div>

                {{-- INFO --}}
                <div class="flex-grow-1">

                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                        <div>

                            <h2 class="manage-animal-name">

                                {{ $adocao->animal->nome }}

                            </h2>

                            <p class="manage-animal-meta mb-0">

                                {{ $adocao->animal->especie->nome ?? '-' }}
                                ·
                                {{ ucfirst(strtolower($adocao->animal->porte ?? '-')) }}

                            </p>

                        </div>

                        {{-- STATUS --}}
                        @if($adocao->status == 'PENDENTE')

                            <span class="status-badge pending-badge">

                                Pendente

                            </span>

                        @elseif($adocao->status == 'APROVADA')

                            <span class="status-badge approved-badge">

                                Aprovada

                            </span>

                        @elseif($adocao->status == 'RECUSADA')

                            <span class="status-badge refused-badge">

                                Recusada

                            </span>

                        @else

                            <span class="status-badge canceled-badge">

                                Cancelada

                            </span>

                        @endif

                    </div>

                    <div class="manage-meta-grid mt-4">

                        <div class="manage-meta-item">

                            <span class="manage-meta-label">

                                Solicitante

                            </span>

                            <span class="manage-meta-value">

                                {{ $adocao->user->name }}

                            </span>

                        </div>

                        <div class="manage-meta-item">

                            <span class="manage-meta-label">

                                E-mail

                            </span>

                            <span class="manage-meta-value">

                                {{ $adocao->user->email }}

                            </span>

                        </div>

                        <div class="manage-meta-item">

                            <span class="manage-meta-label">

                                Data da Solicitação

                            </span>

                            <span class="manage-meta-value">

                                {{ $adocao->created_at->format('d/m/Y \à\s H:i') }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

            {{-- MENSAGEM --}}
            @if($adocao->mensagem)

                <div class="manage-message-box">

                    <span class="message-label">

                        Mensagem enviada pelo solicitante

                    </span>

                    <p class="message-content mb-0">

                        {{ $adocao->mensagem }}

                    </p>

                </div>

            @endif

            {{-- FORM --}}
            @if($adocao->status == 'PENDENTE')

                <div class="manage-form-wrapper">

                    <form action="{{ route('adocoes.update', $adocao->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Decisão da solicitação

                            </label>

                            <select name="status"
                                    class="form-select custom-select"
                                    required>

                                <option value="">

                                    Selecione uma opção

                                </option>

                                <option value="APROVADA">

                                    Aprovar Solicitação

                                </option>

                                <option value="RECUSADA">

                                    Recusar Solicitação

                                </option>

                            </select>

                        </div>

                        <div class="d-flex gap-3 flex-wrap">

                            <a href="{{ route('adocoes.index') }}"
                               class="btn back-btn">

                                Voltar

                            </a>

                            <button type="submit"
                                    class="btn save-btn"
                                    onclick="return confirm('Confirma esta decisão? Essa ação não poderá ser revertida.')">

                                Confirmar Decisão

                            </button>

                        </div>

                    </form>

                </div>

            @else

                <div class="manage-form-wrapper">

                    <a href="{{ route('adocoes.index') }}"
                       class="btn back-btn">

                        Voltar

                    </a>

                </div>

            @endif

        </div>

    </div>

</section>

@endsection