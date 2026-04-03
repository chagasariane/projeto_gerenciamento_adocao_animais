@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Editar Raça</h1>

    <a href="{{ route('racas.index') }}" class="btn btn-secondary mb-3">
        Voltar
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('racas.update', $raca->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control"
                   value="{{ $raca->nome }}" required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control">
                {{ $raca->descricao }}
            </textarea>
        </div>

        <div class="mb-3">
            <label>Espécie</label>
            <select name="especie_id" class="form-control" required>
                @foreach($especies as $especie)
                    <option value="{{ $especie->id }}"
                        {{ $raca->especie_id == $especie->id ? 'selected' : '' }}>
                        {{ $especie->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>
    </form>
</div>

@endsection