<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiauDot</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container">

            <a class="navbar-brand logo-text" href="{{ url('/') }}">
                MiauDot
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('animais.index') }}">
                            Animais
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Como Funciona
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Sobre
                        </a>
                    </li>

                </ul>

                <div class="d-flex align-items-center gap-3">

                    @guest
                        <a href="{{ route('login.form') }}"
                           class="login-link">
                            Entrar
                        </a>

                        <a href="{{ route('register.form') }}"
                           class="btn btn-signup">
                            Cadastrar
                        </a>
                    @endguest

                    @auth
                        <span class="me-2">
                            {{ auth()->user()->name }}
                        </span>

                        <form method="POST"
                              action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-danger">
                                Sair
                            </button>
                        </form>
                    @endauth

                </div>

            </div>

        </div>
    </nav>

    {{-- CONTEÚDO --}}
    <main class="flex-grow-1 mt-5 pt-5">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer-custom">

        <div class="container">

            <div class="row gy-5">

                <div class="col-lg-4 col-md-6">
                    <h3 class="footer-logo">MiauDot</h3>

                    <p class="footer-description">
                        Plataforma web desenvolvida para facilitar
                        a adoção responsável de animais.
                    </p>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Navegação</h5>

                    <a href="{{ url('/') }}" class="footer-link">Home</a>
                    <a href="{{ route('animais.index') }}" class="footer-link">Animais</a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Recursos</h5>

                    <span class="footer-text-item">Cadastro de animais</span>
                    <span class="footer-text-item">Busca avançada</span>
                    <span class="footer-text-item">Solicitações de adoção</span>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Projeto Acadêmico</h5>

                    <p class="footer-description-small">
                        Sistema acadêmico de adoção responsável.
                    </p>
                </div>

            </div>

            <hr class="footer-divider">

            <div class="footer-bottom">
                <span>
                    © {{ date('Y') }} MiauDot
                </span>
            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>
</html>