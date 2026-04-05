@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-4">Cadastrar Raça</h1>

    {{-- Erros --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('racas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input 
                type="text" 
                name="nome" 
                class="form-control"
                value="{{ old('nome') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea 
                name="descricao" 
                class="form-control"
                rows="3"
            >{{ old('descricao') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Espécie</label>
            <select name="especie_id" class="form-control" required>
                <option value="">Selecione</option>

                @foreach($especies as $especie)
                    <option 
                        value="{{ $especie->id }}"
                        {{ old('especie_id') == $especie->id ? 'selected' : '' }}
                    >
                        {{ $especie->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('racas.index') }}" class="btn btn-secondary">
                Voltar
            </a>

            <button type="submit" class="btn btn-primary">
                Salvar
            </button>
        </div>

    </form>

</div>

@endsection