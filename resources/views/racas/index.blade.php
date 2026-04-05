@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Raças</h1>
        <a href="{{ route('racas.create') }}" class="btn btn-primary">
            Nova Raça
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
                <th>Espécie</th>
                <th width="170">Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($racas as $raca)
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
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Nenhuma raça cadastrada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection