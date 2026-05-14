@extends('layouts.app')

@section('content')

<div class="container">

    <div class="mb-4">

        <h1>
            Solicitar Adoção
        </h1>

        <p class="text-muted">
            Envie uma solicitação para adoção deste animal.
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

    {{-- CARD ANIMAL --}}
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <h3 class="mb-3">

                {{ $animal->nome }}

            </h3>

            <p class="mb-1">

                <strong>
                    Espécie:
                </strong>

                {{ $animal->especie->nome }}

            </p>

            <p class="mb-1">

                <strong>
                    Raça:
                </strong>

                {{ $animal->raca->nome }}

            </p>

            <p class="mb-1">

                <strong>
                    Porte:
                </strong>

                {{ $animal->porte }}

            </p>

            <p class="mb-1">

                <strong>
                    Localização:
                </strong>

                {{ $animal->cidade }} - {{ $animal->estado }}

            </p>

            <hr>

            <p class="mb-0">

                {{ $animal->descricao }}

            </p>

        </div>

    </div>

    {{-- FORM --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('adocoes.store') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="animal_id"
                       value="{{ $animal->id }}">

                <div class="mb-4">

                    <label class="form-label">

                        Mensagem para o protetor

                    </label>

                    <textarea name="mensagem"
                              rows="5"
                              class="form-control"
                              placeholder="Descreva seu interesse na adoção...">{{ old('mensagem') }}</textarea>

                </div>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('animais.index') }}"
                       class="btn btn-secondary">

                        Voltar

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        Enviar Solicitação

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection