@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4 mb-5">

            <div>

                <h1 class="section-title mb-2">

                    Solicitações de Adoção

                </h1>

                <p class="crud-description m-0">

                    Gerencie solicitações enviadas e acompanhe
                    o andamento dos pedidos de adoção.

                </p>

            </div>

        </div>

        {{-- ALERTAS --}}
        @if(session('success'))

            <div class="alert custom-alert-success mb-4">

                {{ session('success') }}

            </div>

        @endif

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

        {{-- LISTAGEM --}}
        @if($adocoes->count())

            <div class="row">

                @foreach($adocoes as $adocao)

                    @php

                        $souDonoAnimal =
                            $adocao->animal &&
                            $adocao->animal->user_id == auth()->id();

                    @endphp

                    <div class="col-lg-6 mb-4">

                        <div class="adoption-card h-100">

                            {{-- TOPO --}}
                            <div class="adoption-top">

                                {{-- FOTO --}}
                                <div class="adoption-photo-wrapper">

                                    @if($adocao->animal && $adocao->animal->fotoPrincipal)

                                        <img src="{{ asset('storage/' . $adocao->animal->fotoPrincipal->caminho) }}"
                                            class="adoption-photo"
                                            alt="{{ $adocao->animal->nome }}">

                                    @else

                                        <img src="{{ asset('imagem/sem-foto.png') }}"
                                            class="adoption-photo"
                                            alt="Sem foto">

                                    @endif

                                </div>

                                {{-- INFO --}}
                                <div class="flex-grow-1">

                                    <div class="d-flex justify-content-between align-items-start mb-2">

                                        <div>

                                            <h3 class="adoption-animal-name">

                                                {{ $adocao->animal->nome ?? 'Animal removido' }}

                                            </h3>

                                            <span class="adoption-role">

                                                @if($souDonoAnimal)

                                                    Você recebeu esta solicitação

                                                @else

                                                    Você enviou esta solicitação

                                                @endif

                                            </span>

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

                                    {{-- META --}}
                                    <div class="adoption-meta">

                                        <div class="adoption-meta-item">

                                            👤

                                            <strong>
                                                {{ $adocao->user->name ?? 'Usuário removido' }}
                                            </strong>
                                            <div>
                                                📞 {{ $adocao->user->celular ?? 'Não informado' }}
                                            </div>

                                        </div>

                                        <div class="adoption-meta-item">

                                            📅

                                            {{ $adocao->created_at->format('d/m/Y \à\s H:i') }}

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- MENSAGEM --}}
                            @if($adocao->mensagem)

                                <div class="px-4 pb-4">

                                    <div class="adoption-message-box">

                                        <span class="message-label">

                                            Mensagem enviada

                                        </span>

                                        <p class="message-content mb-0">

                                            {{ $adocao->mensagem }}

                                        </p>

                                    </div>

                                </div>

                            @endif

                            {{-- AÇÕES --}}
                            <div class="adoption-card-footer">

                                @if(
                                    $souDonoAnimal &&
                                    $adocao->status == 'PENDENTE'
                                )

                                    <a href="{{ route('adocoes.edit', $adocao->id) }}"
                                    class="btn animal-btn w-100">

                                        Gerenciar Solicitação

                                    </a>

                                @elseif(
                                    $adocao->user_id == auth()->id() &&
                                    $adocao->status == 'PENDENTE'
                                )

                                    <form action="{{ route('adocoes.destroy', $adocao->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn delete-btn w-100"
                                                onclick="return confirm('Deseja cancelar esta solicitação?')">

                                            Cancelar Solicitação

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-state-box">

                <h4 class="mb-3">

                    Nenhuma solicitação encontrada

                </h4>

                <p class="mb-0">

                    Quando houver solicitações de adoção,
                    elas aparecerão aqui.

                </p>

            </div>

        @endif

    </div>

</section>

@endsection