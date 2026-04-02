@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Nova Espécie</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('especies.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control"></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('especies.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

        </form>
    </div>
</div>

@endsection