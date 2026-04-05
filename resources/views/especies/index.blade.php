@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Espécies</h1>
        <a href="{{ route('especies.create') }}" class="btn btn-primary">
            Nova Espécie
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th width="170">Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($especies as $especie)
                <tr>
                    <td>{{ $especie->id }}</td>

                    <td>{{ $especie->nome }}</td>

                    <td>{{ $especie->descricao }}</td>

                    <td>
                        <a href="{{ route('especies.edit', $especie->id) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('especies.destroy', $especie->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Nenhuma espécie cadastrada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection