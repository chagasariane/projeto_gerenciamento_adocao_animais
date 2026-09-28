@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="mb-4">
        <h2>Questionário de adoção</h2>

        <p>
            Você está solicitando a adoção de
            <strong>{{ $animal->nome }}</strong>.
        </p>

        <p class="text-muted">
            Responda às perguntas abaixo para que o responsável
            pelo animal possa avaliar sua solicitação.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('adocoes.questionario.store', $animal) }}"
    >

        @csrf

        @foreach ($perguntas as $pergunta)

            <div class="mb-4">

                <label class="form-label fw-bold">

                    {{ $loop->iteration }}.
                    {{ $pergunta->pergunta }}

                    @if ($pergunta->obrigatoria)
                        <span class="text-danger">*</span>
                    @endif

                </label>

                @if ($pergunta->tipo === 'textarea')

                    <textarea
                        name="respostas[{{ $pergunta->id }}]"
                        class="form-control"
                        rows="4"
                    >{{ old('respostas.' . $pergunta->id) }}</textarea>

                @elseif ($pergunta->tipo === 'boolean')

                    <select
                        name="respostas[{{ $pergunta->id }}]"
                        class="form-select"
                    >
                        <option value="">
                            Selecione
                        </option>

                        <option
                            value="Sim"
                            @selected(
                                old('respostas.' . $pergunta->id)
                                === 'Sim'
                            )
                        >
                            Sim
                        </option>

                        <option
                            value="Não"
                            @selected(
                                old('respostas.' . $pergunta->id)
                                === 'Não'
                            )
                        >
                            Não
                        </option>
                    </select>

                @elseif ($pergunta->tipo === 'select')

                    <select
                        name="respostas[{{ $pergunta->id }}]"
                        class="form-select"
                    >

                        <option value="">
                            Selecione
                        </option>

                        @foreach ($pergunta->opcoes ?? [] as $opcao)

                            <option
                                value="{{ $opcao }}"
                                @selected(
                                    old(
                                        'respostas.' . $pergunta->id
                                    ) === $opcao
                                )
                            >
                                {{ $opcao }}
                            </option>

                        @endforeach

                    </select>

                @else

                    <input
                        type="text"
                        name="respostas[{{ $pergunta->id }}]"
                        class="form-control"
                        value="{{
                            old(
                                'respostas.' . $pergunta->id
                            )
                        }}"
                    >

                @endif

            </div>

        @endforeach

        <div class="d-flex gap-2">

            <a
                href="{{ route('animais.show', $animal) }}"
                class="btn btn-outline-secondary"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn btn-success"
            >
                Enviar solicitação de adoção
            </button>

        </div>

    </form>

</div>

@endsection