@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-warning text-dark">
        <h4>Editar Espécie</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('especies.update', $especie->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $especie->nome }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control">{{ $especie->descricao }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('especies.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-warning">Atualizar</button>
            </div>

        </form>
    </div>
</div>

@endsection