@extends('layouts.app')

@section('content')

<section class="crud-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="page-header">

            <div>

                <h1 class="page-title">
                    Espécies
                </h1>

                <p class="page-description">
                    Gerencie as espécies cadastradas no sistema.
                </p>

            </div>

            <a href="{{ route('especies.create') }}"
               class="btn create-btn">

                + Nova Espécie

            </a>

        </div>

        {{-- ALERT --}}
        @if(session('success'))

            <div class="custom-alert success-alert">

                {{ session('success') }}

            </div>

        @endif

        {{-- FILTRO --}}
        <div class="filter-box mb-4">

            <form method="GET"
                action="{{ route('especies.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-lg-10">

                        <label class="custom-label">

                            Buscar espécie

                        </label>

                        <input type="text"
                            name="nome"
                            class="form-control custom-input"
                            placeholder="Digite o nome da espécie..."
                            value="{{ request('nome') }}">

                    </div>

                    <div class="col-lg-2">

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn filter-btn w-100">

                                Filtrar

                            </button>

                            <a href="{{ route('especies.index') }}"
                            class="btn clear-btn w-100">

                                Limpar

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        {{-- INFO --}}
        <div class="animals-info mb-3">

            <span>

                {{ $especies->count() }} espécie(s) encontrada(s)

            </span>

        </div>

        {{-- TABLE CARD --}}
        <div class="table-card">

            <div class="table-responsive">

                <table class="table custom-table align-middle">

                    <thead>

                        <tr>

                            <th width="80">
                                ID
                            </th>

                            <th>
                                Nome
                            </th>

                            <th>
                                Descrição
                            </th>

                            <th width="220">
                                Ações
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($especies as $especie)

                            <tr>

                                <td>

                                    <span class="table-id">

                                        #{{ $especie->id }}

                                    </span>

                                </td>

                                <td>

                                    <div class="table-title">

                                        {{ $especie->nome }}

                                    </div>

                                </td>

                                <td>

                                    <span class="table-description">

                                        {{ $especie->descricao ?? 'Sem descrição cadastrada.' }}

                                    </span>

                                </td>

                                <td>

                                    <div class="table-actions">

                                        <a href="{{ route('especies.edit', $especie->id) }}"
                                           class="btn edit-btn">

                                            Editar

                                        </a>

                                        <form action="{{ route('especies.destroy', $especie->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn delete-btn">

                                                Excluir

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4">

                                    <div class="empty-table">

                                        Nenhuma espécie cadastrada.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection