@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Lista de Espécies</h2>
    <a href="{{ route('especies.create') }}" class="btn btn-primary">Nova Espécie</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($especies as $especie)
            <tr>
                <td>{{ $especie->id }}</td>
                <td>{{ $especie->nome }}</td>
                <td>{{ $especie->descricao }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('especies.edit', $especie->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('especies.destroy', $especie->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection