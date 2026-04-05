@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HERO SECTION --}}
    <div class="row align-items-center mb-5">

        <div class="col-md-6">
            <h1 class="fw-bold mb-3">
                Encontre um novo amigo e transforme vidas 
            </h1>

            <p class="text-muted mb-4">
                O MiauDot conecta você a animais que precisam de um lar.
                Adote com responsabilidade e transforme uma vida, inclusive a sua.
            </p>

            <a href="{{ route('animais.index') }}" class="btn btn-primary">
                Ver animais disponíveis
            </a>
        </div>

        <div class="col-md-6 text-center">
            <img src="{{ asset('imagem/home2.png') }}"
                 class="img-fluid rounded shadow"
                 style="max-height: 350px;">
        </div>

    </div>

    {{-- FILTRO SIMPLES (visual apenas) --}}
    <div class="card mb-5">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-3">
                    <select class="form-control">
                        <option>Espécie</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-control">
                        <option>Porte</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-control">
                        <option>Idade</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Buscar...">
                </div>

            </div>
        </div>
    </div>

    {{-- LISTA DE ANIMAIS (ESTÁTICA POR ENQUANTO) --}}
    <h4 class="mb-4">Animais disponíveis</h4>

    <div class="row">

        @for ($i = 0; $i < 6; $i++)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">

                <img src="https://placedog.net/400/300"
                     class="card-img-top"
                     alt="Animal">

                <div class="card-body">

                    <h5 class="card-title">Nome do Animal</h5>

                    <p class="text-muted mb-2">
                        Raça • 2 anos
                    </p>

                    <p class="small">
                        Animal dócil, saudável e pronto para adoção.
                    </p>

                </div>

                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        Ver detalhes
                    </a>
                </div>

            </div>
        </div>
        @endfor

    </div>

</div>

@endsection