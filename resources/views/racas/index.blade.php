@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Lista de Raças</h1>

    <a href="{{ route('racas.create') }}" class="btn btn-primary mb-3">
        Nova Raça
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Espécie</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($racas as $raca)
                <tr>
                    <td>{{ $raca->id }}</td>
                    <td>{{ $raca->nome }}</td>
                    <td>{{ $raca->especie->nome ?? '—' }}</td>
                    <td>
                        <a href="{{ route('racas.edit', $raca->id) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('racas.destroy', $raca->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection