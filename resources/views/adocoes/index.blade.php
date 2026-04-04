@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Adoções</h2>
    <a href="{{ route('adocoes.create') }}" class="btn btn-primary">Nova Adoção</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Animal</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($adocoes as $adocao)
        <tr>
            <td>{{ $adocao->id }}</td>
            <td>{{ $adocao->user->name ?? '' }}</td>
            <td>{{ $adocao->animal->nome ?? '' }}</td>
            <td>{{ $adocao->status }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('adocoes.edit', $adocao->id) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('adocoes.destroy', $adocao->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection 