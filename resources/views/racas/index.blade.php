@extends('layouts.app')

@section('content')

<section class="crud-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="crud-header mb-5">

            <div class="crud-header-content">

                <h1 class="crud-title">

                    Raças

                </h1>

                <p class="crud-description">

                    Gerencie as raças cadastradas na plataforma
                    de adoção responsável.

                </p>

            </div>

            <a href="{{ route('racas.create') }}"
               class="btn create-btn">

                Nova Raça

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
                action="{{ route('racas.index') }}">

                <div class="row g-4 align-items-end">

                    {{-- BUSCA --}}
                    <div class="col-lg-6">

                        <label class="form-label fw-semibold mb-2">

                            Buscar raça

                        </label>

                        <input type="text"
                            name="nome"
                            class="form-control custom-input"
                            placeholder="Digite o nome da raça..."
                            value="{{ request('nome') }}">

                    </div>

                    {{-- ESPÉCIE --}}
                    <div class="col-lg-3">

                        <label class="form-label fw-semibold mb-2">

                            Espécie

                        </label>

                        <select name="especie_id"
                                class="form-select custom-select">

                            <option value="">

                                Todas as espécies

                            </option>

                            @foreach($especies as $especie)

                                <option value="{{ $especie->id }}"
                                    {{ request('especie_id') == $especie->id ? 'selected' : '' }}>

                                    {{ ucfirst(strtolower($especie->nome)) }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- BOTÕES --}}
                    <div class="col-lg-3">

                        <div class="d-flex gap-3">

                            <button type="submit"
                                    class="btn filter-btn w-100">

                                Filtrar

                            </button>

                            <a href="{{ route('racas.index') }}"
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

                {{ $racas->count() }} raça(s) encontrada(s)

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

                                Espécie

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

                        @forelse($racas as $raca)

                            <tr>

                                <td>

                                    <div class="crud-table-title">

                                        {{ ucfirst(strtolower($raca->nome)) }}

                                    </div>

                                </td>

                                <td>

                                    <span class="crud-table-description">

                                        {{ ucfirst(strtolower($raca->especie->nome ?? 'Espécie não vinculada')) }}

                                    </span>

                                </td>

                                <td>

                                    <span class="crud-table-description">

                                        {{ $raca->descricao ?? 'Sem descrição cadastrada.' }}

                                    </span>

                                </td>

                                <td>

                                    <div class="crud-actions">

                                        <a href="{{ route('racas.edit', $raca->id) }}"
                                           class="btn edit-btn">

                                            Editar

                                        </a>

                                        <form action="{{ route('racas.destroy', $raca->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn delete-btn"
                                                    onclick="return confirm('Deseja realmente excluir esta raça?')">

                                                Excluir

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4">

                                    <div class="empty-table-state">

                                        <div class="empty-table-icon">

                                            🐾

                                        </div>

                                        <h4 class="mb-2">

                                            Nenhuma raça encontrada

                                        </h4>

                                        <p class="mb-0">

                                            Cadastre uma nova raça para começar.

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