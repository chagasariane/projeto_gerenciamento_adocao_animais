@extends('layouts.app')

@section('content')

<section class="animal-show-page">

    <div class="container">

        <div class="row g-5">

            {{-- GALERIA --}}
            <div class="col-lg-7">

                {{-- FOTO PRINCIPAL --}}
                <div class="mb-4">

                    @if($animal->fotoPrincipal)

                        <img id="imagem-principal"
                            src="{{ asset('storage/' . $animal->fotoPrincipal->caminho) }}"
                            class="w-100 rounded shadow-sm"
                            style="height: 500px; object-fit: cover;"
                            alt="{{ $animal->nome }}">

                    @else

                        <img id="imagem-principal"
                             src="https://placedog.net/900/700?id={{ $animal->id }}"
                             class="w-100 rounded shadow-sm"
                             style="height: 500px; object-fit: cover;"
                             alt="{{ $animal->nome }}">

                    @endif

                </div>

                {{-- OUTRAS FOTOS --}}
                @if($animal->fotos->count())

                    <div class="row">

                        @foreach($animal->fotos as $foto)

                            <div class="col-md-3 mb-3">

                                <img src="{{ asset('storage/' . $foto->caminho) }}"
                                    class="w-100 rounded shadow-sm miniatura-animal"
                                    style="height: 120px; object-fit: cover; cursor: pointer;"
                                    data-img="{{ asset('storage/' . $foto->caminho) }}">

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

            {{-- DETALHES --}}
            <div class="col-lg-5">

                {{-- HEADER --}}
                <div class="mb-4">

                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div>

                            <h1 class="fw-bold mb-2">

                                {{ $animal->nome }}

                            </h1>

                            <span class="badge bg-primary fs-6">

                                {{ $animal->especie->nome }}

                            </span>

                        </div>

                        <span class="badge bg-success fs-6">

                            {{ $animal->status }}

                        </span>

                    </div>

                    <p class="text-muted fs-5">

                        📍 {{ $animal->cidade }} - {{ $animal->estado }}

                    </p>

                </div>

                {{-- INFORMAÇÕES --}}
                <div class="card shadow-sm border-0 mb-4 animal-info-card">

                    <div class="card-body p-4">

                        <h4 class="animal-section-title">

                            Informações do Animal

                        </h4>

                        <div class="animal-info-grid">

                            <div class="animal-info-item">

                                <span class="animal-info-label">
                                    Raça
                                </span>

                                <span class="animal-info-value">
                                    {{ $animal->raca->nome }}
                                </span>

                            </div>

                            <div class="animal-info-item">

                                <span class="animal-info-label">
                                    Sexo
                                </span>

                                <span class="animal-info-value">
                                    {{ ucfirst(strtolower($animal->sexo)) }}
                                </span>

                            </div>

                            <div class="animal-info-item">

                                <span class="animal-info-label">
                                    Idade
                                </span>

                                <span class="animal-info-value">
                                    {{ $animal->idade_formatada }}
                                </span>

                            </div>

                            <div class="animal-info-item">

                                <span class="animal-info-label">
                                    Porte
                                </span>

                                <span class="animal-info-value">
                                    {{ ucfirst(strtolower($animal->porte)) }}
                                </span>

                            </div>

                            <div class="animal-info-item">

                                <span class="animal-info-label">
                                    Castrado
                                </span>

                                <span class="animal-info-value">
                                    {{ $animal->castrado ? 'Sim' : 'Não' }}
                                </span>

                            </div>

                            <div class="animal-info-item">

                                <span class="animal-info-label">
                                    Vacinado
                                </span>

                                <span class="animal-info-value">
                                    {{ $animal->vacinado ? 'Sim' : 'Não' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- DESCRIÇÃO --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-body">

                        <h4 class="mb-3">

                            Sobre {{ $animal->nome }}

                        </h4>

                        <p class="mb-0">

                            {{ $animal->descricao }}

                        </p>

                    </div>

                </div>

                {{-- NECESSIDADES --}}
                @if($animal->necessidades_especiais)

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-body">

                            <h4 class="mb-3">

                                Necessidades Especiais

                            </h4>

                            <p class="mb-0">

                                {{ $animal->necessidades_especiais }}

                            </p>

                        </div>

                    </div>

                @endif

                {{-- PROTETOR --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-body">

                        <h4 class="mb-3">

                            Responsável

                        </h4>

                        <p class="mb-2">

                            <strong>
                                {{ $animal->user->name }}
                            </strong>

                        </p>

                        @if($animal->user->telefone)

                            <p class="mb-0">

                                📞 {{ $animal->user->telefone }}

                            </p>

                        @endif

                    </div>

                </div>

                {{-- ADOÇÃO --}}
                @auth

                    @if(
                        auth()->id() != $animal->user_id &&
                        $animal->status == 'DISPONIVEL'
                    )

                        <form action="{{ route('adocoes.store') }}"
                              method="POST">

                            @csrf

                            <input type="hidden"
                                   name="animal_id"
                                   value="{{ $animal->id }}">

                            <button type="submit"
                                    class="btn adopt-btn w-100">

                                Quero Adotar

                            </button>

                        </form>

                    @endif

                @else

                    <a href="{{ route('login.form') }}"
                       class="btn btn-primary btn-lg w-100">

                        Faça login para adotar

                    </a>

                @endauth

            </div>

        </div>

    </div>

</section>

@endsection

@section('scripts')

<script>

    const miniaturas = document.querySelectorAll('.miniatura-animal');

    const imagemPrincipal =
        document.getElementById('imagem-principal');

    miniaturas.forEach(miniatura => {

        miniatura.addEventListener('click', function () {

            imagemPrincipal.src =
                this.dataset.img;

        });

    });

</script>

@endsection