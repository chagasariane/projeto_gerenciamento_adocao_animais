@extends('layouts.app')

@section('content')

<section class="crud-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="crud-header mb-5">

            <div class="crud-header-content">

                <h1 class="crud-title">

                    Usuários

                </h1>

                <p class="crud-description">

                    Gerencie os usuários cadastrados na plataforma
                    de adoção responsável.

                </p>

            </div>

            <a href="{{ route('users.create') }}"
               class="btn create-btn">

                Novo Usuário

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
                  action="{{ route('users.index') }}">

                <div class="row g-4 align-items-end">

                    {{-- NOME --}}
                    <div class="col-lg-5">

                        <label class="form-label fw-semibold mb-2">

                            Buscar usuário

                        </label>

                        <input type="text"
                               name="name"
                               class="form-control custom-input"
                               placeholder="Digite o nome do usuário..."
                               value="{{ request('name') }}">

                    </div>

                    {{-- EMAIL --}}
                    <div class="col-lg-4">

                        <label class="form-label fw-semibold mb-2">

                            E-mail

                        </label>

                        <input type="text"
                               name="email"
                               class="form-control custom-input"
                               placeholder="Digite o e-mail..."
                               value="{{ request('email') }}">

                    </div>

                    {{-- BOTÕES --}}
                    <div class="col-lg-3">

                        <div class="d-flex gap-3">

                            <button type="submit"
                                    class="btn filter-btn w-100">

                                Filtrar

                            </button>

                            <a href="{{ route('users.index') }}"
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

                {{ $users->count() }} usuário(s) encontrado(s)

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

                                E-mail

                            </th>

                            <th>

                                Tipo de Usuário

                            </th>

                            <th width="220">

                                Ações

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr>

                                {{-- NOME --}}
                                <td>

                                    <div class="crud-table-title">

                                        {{ $user->name }}

                                    </div>

                                </td>

                                {{-- EMAIL --}}
                                <td>

                                    <span class="crud-table-description">

                                        {{ $user->email }}

                                    </span>

                                </td>

                                {{-- TIPO --}}
                                <td>

                                    @if($user->is_admin)

                                        <span class="status-badge approved-badge">

                                            Administrador

                                        </span>

                                    @else

                                        <span class="status-badge pending-badge">

                                            Usuário Comum

                                        </span>

                                    @endif

                                </td>

                                {{-- AÇÕES --}}
                                <td>

                                    <div class="crud-actions">

                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="btn edit-btn">

                                            Editar

                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn delete-btn"
                                                    onclick="return confirm('Deseja realmente excluir este usuário?')">

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

                                            👤

                                        </div>

                                        <h4 class="mb-2">

                                            Nenhum usuário encontrado

                                        </h4>

                                        <p class="mb-0">

                                            Cadastre um novo usuário para começar.

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