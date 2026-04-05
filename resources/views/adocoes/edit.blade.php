@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-warning">
        Editar Adoção
    </div>

    <div class="card-body">
        <form action="{{ route('adocoes.update', $adocao->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Usuário</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $adocao->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Animal</label>
                <select name="animal_id" class="form-control">
                    @foreach($animais as $animal)
                        <option value="{{ $animal->id }}" {{ $animal->id == $adocao->animal_id ? 'selected' : '' }}>
                            {{ $animal->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="PENDENTE" {{ $adocao->status == 'PENDENTE' ? 'selected' : '' }}>Pendente</option>
                    <option value="APROVADA" {{ $adocao->status == 'APROVADA' ? 'selected' : '' }}>Aprovada</option>
                    <option value="RECUSADA" {{ $adocao->status == 'RECUSADA' ? 'selected' : '' }}>Recusada</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" rows="3">{{ $adocao->descricao }}</textarea>
            </div>

            <button class="btn btn-warning">Atualizar</button>
        </form>
    </div>
</div>

@endsection