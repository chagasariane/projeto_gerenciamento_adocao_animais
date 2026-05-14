@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">

        <h1>
            Solicitações de Adoção
        </h1>

        <p class="text-muted mb-0">
            Gerencie suas solicitações e os pedidos recebidos.
        </p>

    </div>

    {{-- ALERTAS --}}
    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    {{-- ERROS --}}
    @if ($errors->any())

        <div class="alert alert-danger">

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

                    <div class="card shadow-sm h-100">

                        <div class="card-body">

                            {{-- ANIMAL --}}
                            <h4 class="mb-3">

                                {{ $adocao->animal->nome ?? 'Animal removido' }}

                            </h4>

                            {{-- ADOTANTE --}}
                            <p class="mb-1">

                                <strong>
                                    Solicitante:
                                </strong>

                                {{ $adocao->user->name ?? 'Usuário removido' }}

                            </p>

                            {{-- STATUS --}}
                            <p class="mb-3">

                                <strong>
                                    Status:
                                </strong>

                                @if($adocao->status == 'PENDENTE')

                                    <span class="badge bg-warning text-dark">

                                        Pendente

                                    </span>

                                @elseif($adocao->status == 'APROVADA')

                                    <span class="badge bg-success">

                                        Aprovada

                                    </span>

                                @elseif($adocao->status == 'RECUSADA')

                                    <span class="badge bg-danger">

                                        Recusada

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Cancelada

                                    </span>

                                @endif

                            </p>

                            {{-- MENSAGEM --}}
                            @if($adocao->mensagem)

                                <div class="border rounded p-3 bg-light">

                                    <strong>
                                        Mensagem:
                                    </strong>

                                    <p class="mb-0 mt-2">

                                        {{ $adocao->mensagem }}

                                    </p>

                                </div>

                            @endif

                        </div>

                        {{-- AÇÕES --}}
                        <div class="card-footer bg-white border-0">

                            {{-- DONO DO ANIMAL --}}
                            @if(
                                $souDonoAnimal &&
                                $adocao->status == 'PENDENTE'
                            )

                                <div class="d-flex gap-2">

                                    <a href="{{ route('adocoes.edit', $adocao->id) }}"
                                       class="btn btn-primary w-100">

                                        Gerenciar Solicitação

                                    </a>

                                </div>

                            {{-- SOLICITANTE --}}
                            @elseif(
                                $adocao->user_id == auth()->id() &&
                                $adocao->status == 'PENDENTE'
                            )

                                <form action="{{ route('adocoes.destroy', $adocao->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger w-100"
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

        <div class="alert alert-info">

            Nenhuma solicitação encontrada.

        </div>

    @endif

</div>

@endsection