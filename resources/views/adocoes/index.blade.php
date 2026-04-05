@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Adoções</h1>
        <a href="{{ route('adocoes.create') }}" class="btn btn-primary">
            Nova Adoção
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
                <th>Adotante</th>
                <th>Animal</th>
                <th>Status</th>
                <th width="180">Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($adocoes as $adocao)
                <tr>
                    <td>{{ $adocao->id }}</td>

                    <td>{{ $adocao->user->name ?? '—' }}</td>

                    <td>{{ $adocao->animal->nome ?? '—' }}</td>

                    <td>
                        @if($adocao->status == 'PENDENTE')
                            <span class="badge bg-warning text-dark">Pendente</span>
                        @elseif($adocao->status == 'APROVADO')
                            <span class="badge bg-success">Aprovado</span>
                        @elseif($adocao->status == 'RECUSADO')
                            <span class="badge bg-danger">Recusado</span>
                        @else
                            <span class="badge bg-secondary">Finalizado</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('adocoes.edit', $adocao->id) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('adocoes.destroy', $adocao->id) }}" method="POST" style="display:inline;">
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
                    <td colspan="5" class="text-center">
                        Nenhuma adoção cadastrada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection