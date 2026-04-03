@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Cadastrar Raça</h1>

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

    <form action="{{ route('racas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Espécie</label>
            <select name="especie_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($especies as $especie)
                    <option value="{{ $especie->id }}">
                        {{ $especie->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Salvar
        </button>
    </form>
</div>

@endsection