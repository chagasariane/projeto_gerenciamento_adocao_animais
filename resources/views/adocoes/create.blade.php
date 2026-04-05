@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
        Nova Adoção
    </div>

    <div class="card-body">
        <form action="{{ route('adocoes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Usuário</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Animal</label>
                <select name="animal_id" class="form-control">
                    @foreach($animais as $animal)
                        <option value="{{ $animal->id }}">{{ $animal->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="PENDENTE">Pendente</option>
                    <option value="APROVADA">Aprovada</option>
                    <option value="RECUSADA">Recusada</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" rows="3">{{ old('descricao') }}</textarea>
            </div>

            <button class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>

@endsection