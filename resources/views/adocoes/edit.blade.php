@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">

        <h1>
            Gerenciar Solicitação
        </h1>

        <p class="text-muted mb-0">
            Avalie a solicitação de adoção recebida.
        </p>

    </div>

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

    {{-- CARD --}}
    <div class="card shadow-sm">

        <div class="card-body">

            {{-- ANIMAL --}}
            <h3 class="mb-4">

                {{ $adocao->animal->nome }}

            </h3>

            {{-- SOLICITANTE --}}
            <div class="mb-4">

                <h5>
                    Solicitante
                </h5>

                <p class="mb-1">

                    <strong>
                        Nome:
                    </strong>

                    {{ $adocao->user->name }}

                </p>

                <p class="mb-0">

                    <strong>
                        Email:
                    </strong>

                    {{ $adocao->user->email }}

                </p>

            </div>

            {{-- STATUS --}}
            <div class="mb-4">

                <h5>
                    Status Atual
                </h5>

                <p class="mb-0">

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

            </div>

            {{-- MENSAGEM --}}
            @if($adocao->mensagem)

                <div class="mb-4">

                    <h5>
                        Mensagem do Solicitante
                    </h5>

                    <div class="border rounded p-3 bg-light">

                        {{ $adocao->mensagem }}

                    </div>

                </div>

            @endif

            {{-- FORM --}}
            @if($adocao->status == 'PENDENTE')

                <form action="{{ route('adocoes.update', $adocao->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="form-label">

                            Decisão

                        </label>

                        <select name="status"
                                class="form-select"
                                required>

                            <option value="">
                                Selecione
                            </option>

                            <option value="APROVADA">

                                Aprovar Solicitação

                            </option>

                            <option value="RECUSADA">

                                Recusar Solicitação

                            </option>

                        </select>

                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('adocoes.index') }}"
                           class="btn btn-secondary">

                            Voltar

                        </a>

                        <button type="submit"
                                class="btn btn-primary"
                                onclick="return confirm('Confirma esta decisão? Essa ação não poderá ser revertida.')">

                            Confirmar Decisão

                        </button>

                    </div>

                </form>

            @else

                <div class="d-flex justify-content-between">

                    <a href="{{ route('adocoes.index') }}"
                       class="btn btn-secondary">

                        Voltar

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection