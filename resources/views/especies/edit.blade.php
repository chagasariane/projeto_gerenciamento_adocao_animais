@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-4">Editar Espécie</h1>

    {{-- Erros --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('especies.update', $especie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input 
                type="text" 
                name="nome" 
                class="form-control"
                value="{{ old('nome', $especie->nome) }}"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea 
                name="descricao" 
                class="form-control"
                rows="3"
            >{{ old('descricao', $especie->descricao) }}</textarea>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('especies.index') }}" class="btn btn-secondary">
                Voltar
            </a>

            <button type="submit" class="btn btn-primary">
                Atualizar
            </button>
        </div>

    </form>

</div>

@endsection