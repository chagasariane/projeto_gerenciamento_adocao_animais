@extends('layouts.app')

@section('content')

<section class="crud-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="crud-header mb-5">

            <div class="crud-header-content">

                <h1 class="crud-title">

                    Espécies

                </h1>

                <p class="crud-description">

                    Gerencie as espécies cadastradas na plataforma
                    de adoção responsável.

                </p>

            </div>

            <a href="{{ route('especies.create') }}"
               class="btn create-btn">

                Nova Espécie

            </a>

        </div>

        {{-- ALERT --}}
        @if(session('success'))

            <div class="custom-alert-success mb-4">

                {{ session('success') }}

            </div>

        @endif

        {{-- FILTRO --}}
        <div class="filter-box mb-4">

            <form method="GET"
                  action="{{ route('especies.index') }}">

                <div class="row g-4 align-items-end">

                    <div class="col-lg-9">

                        <label class="form-label fw-semibold mb-2">

                            Buscar espécie

                        </label>

                        <input type="text"
                               name="nome"
                               class="form-control custom-input"
                               placeholder="Digite o nome da espécie..."
                               value="{{ request('nome') }}">

                    </div>

                    <div class="col-lg-3">

                        <div class="d-flex gap-3">

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
        <div class="crud-results-info mb-4">

            <span>

                {{ $especies->count() }} espécie(s) encontrada(s)

            </span>

        </div>

        {{-- TABLE --}}
        <div class="crud-table-card">

            <div class="table-responsive">

                <table class="table crud-table align-middle mb-0">

                    <thead>

                        <tr>

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

                                    <div class="crud-table-title">

                                        {{ ucfirst(strtolower($especie->nome)) }}

                                    </div>

                                </td>

                                <td>

                                    <span class="crud-table-description">

                                        {{ $especie->descricao ?? 'Sem descrição cadastrada.' }}

                                    </span>

                                </td>

                                <td>

                                    <div class="crud-actions">

                                        <a href="{{ route('especies.edit', $especie->id) }}"
                                           class="btn edit-btn">

                                            Editar

                                        </a>

                                        <form action="{{ route('especies.destroy', $especie->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn delete-btn"
                                                    onclick="return confirm('Deseja realmente excluir esta espécie?')">

                                                Excluir

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3">

                                    <div class="empty-table-state">

                                        <div class="empty-table-icon">

                                            🐾

                                        </div>

                                        <h4 class="mb-2">

                                            Nenhuma espécie encontrada

                                        </h4>

                                        <p class="mb-0">

                                            Cadastre uma nova espécie para começar.

                                        </p>

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