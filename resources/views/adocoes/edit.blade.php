@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-4">Editar Adoção</h1>

    {{-- Erros --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('adocoes.update', $adocao->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Adotante</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Selecione</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ old('user_id', $adocao->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Animal</label>
                <select name="animal_id" class="form-control" required>
                    <option value="">Selecione</option>
                    @foreach($animais as $animal)
                        <option value="{{ $animal->id }}"
                            {{ old('animal_id', $adocao->animal_id) == $animal->id ? 'selected' : '' }}>
                            {{ $animal->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="PENDENTE" {{ old('status', $adocao->status) == 'PENDENTE' ? 'selected' : '' }}>Pendente</option>
                <option value="APROVADO" {{ old('status', $adocao->status) == 'APROVADO' ? 'selected' : '' }}>Aprovado</option>
                <option value="RECUSADO" {{ old('status', $adocao->status) == 'RECUSADO' ? 'selected' : '' }}>Recusado</option>
                <option value="FINALIZADO" {{ old('status', $adocao->status) == 'FINALIZADO' ? 'selected' : '' }}>Finalizado</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Observações</label>
            <textarea name="descricao" class="form-control" rows="3">{{ old('descricao', $adocao->descricao) }}</textarea>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('adocoes.index') }}" class="btn btn-secondary">
                Voltar
            </a>

            <button type="submit" class="btn btn-primary">
                Atualizar
            </button>
        </div>

    </form>

</div>

@endsection