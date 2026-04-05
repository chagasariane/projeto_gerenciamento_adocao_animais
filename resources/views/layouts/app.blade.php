<!DOCTYPE html>
<html>
<head>
    <title>MiauDot - Sistema de Adoção</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            MiauDot
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                       href="{{ route('users.index') }}">
                        Usuários
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('especies.*') ? 'active' : '' }}"
                       href="{{ route('especies.index') }}">
                        Espécies
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('racas.*') ? 'active' : '' }}"
                       href="{{ route('racas.index') }}">
                        Raças
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('animais.*') ? 'active' : '' }}"
                       href="{{ route('animais.index') }}">
                        Animais
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('adocoes.*') ? 'active' : '' }}"
                       href="{{ route('adocoes.index') }}">
                        Adoções
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>

<div class="container">
    @yield('content')
</div>

@yield('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>