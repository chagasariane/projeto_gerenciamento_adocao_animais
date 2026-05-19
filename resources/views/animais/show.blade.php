@extends('layouts.app')

@section('content')

<section class="animal-details-page">
    <div class="container">

        {{-- HERO --}}
        <div class="animal-hero">
            <h1 class="animal-details-title">{{ $animal->nome }}</h1>
            <p class="animal-details-location">
                <i class="bi bi-geo-alt"></i>
                {{ $animal->cidade }} - {{ $animal->estado }}
            </p>
        </div>

        {{-- LAYOUT PRINCIPAL --}}
        <div class="animal-main-layout">

            {{-- COLUNA ESQUERDA: GALERIA --}}
            <div class="animal-gallery-col">

                <div class="animal-gallery-main">
                    @if($animal->fotos->count())
                        <img
                            id="gallery-featured"
                            src="{{ asset('storage/' . $animal->fotos->first()->caminho) }}"
                            class="animal-featured-image"
                            alt="{{ $animal->nome }}">
                    @else
                        <img
                            id="gallery-featured"
                            src="https://placedog.net/900/700?id={{ $animal->id }}"
                            class="animal-featured-image"
                            alt="{{ $animal->nome }}">
                    @endif
                </div>

                @if($animal->fotos->count() > 1)
                    <div class="animal-thumbs-row">
                        @foreach($animal->fotos as $index => $foto)
                            <div class="animal-thumb {{ $index === 0 ? 'active-thumb' : '' }}"
                                 data-img="{{ asset('storage/' . $foto->caminho) }}">
                                <img src="{{ asset('storage/' . $foto->caminho) }}" alt="Foto {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            {{-- COLUNA DIREITA: INFORMAÇÕES --}}
            <div class="animal-info-col">

                {{-- GRID DE DADOS --}}
                <div class="animal-data-grid">
                    <div class="animal-data-card">
                        <span class="animal-data-label">Espécie</span>
                        <span class="animal-data-value">
                            {{ ucfirst(strtolower($animal->especie->nome)) }}
                        </span>
                    </div>
                    <div class="animal-data-card">
                        <span class="animal-data-label">Raça</span>
                        <span class="animal-data-value">{{ $animal->raca->nome }}</span>
                    </div>
                    <div class="animal-data-card">
                        <span class="animal-data-label">Sexo</span>
                        <span class="animal-data-value">{{ ucfirst(strtolower($animal->sexo)) }}</span>
                    </div>
                    <div class="animal-data-card">
                        <span class="animal-data-label">Idade</span>
                        <span class="animal-data-value">{{ $animal->idade_formatada }}</span>
                    </div>
                    <div class="animal-data-card">
                        <span class="animal-data-label">Porte</span>
                        <span class="animal-data-value">{{ ucfirst(strtolower($animal->porte)) }}</span>
                    </div>
                    <div class="animal-data-card">
                        <span class="animal-data-label">Castrado</span>
                        <span class="animal-data-value">{{ $animal->castrado ? 'Sim' : 'Não' }}</span>
                    </div>
                    <div class="animal-data-card">
                        <span class="animal-data-label">Vacinado</span>
                        <span class="animal-data-value">{{ $animal->vacinado ? 'Sim' : 'Não' }}</span>
                    </div>
                    <div class="animal-data-card">
                        <span class="animal-data-label">Status</span>
                        <span class="animal-data-value">
                            {{ ucfirst(strtolower($animal->status)) }}
                        </span>
                    </div>
                </div>

                {{-- SOBRE --}}
                <div class="modern-section-card">
                    <h3 class="modern-section-title">Sobre {{ $animal->nome }}</h3>
                    <p class="modern-section-text">{{ $animal->descricao }}</p>
                </div>

                {{-- NECESSIDADES --}}
                @if($animal->necessidades_especiais)
                    <div class="modern-section-card modern-section-warning">
                        <h3 class="modern-section-title">⚠ Necessidades especiais</h3>
                        <p class="modern-section-text">{{ $animal->necessidades_especiais }}</p>
                    </div>
                @endif

                {{-- RESPONSÁVEL + BOTÃO ADOTAR --}}
                <div class="modern-section-card">
                    <h3 class="modern-section-title">Responsável</h3>
                    <div class="responsavel-box">
                        <div class="responsavel-avatar">
                            {{ strtoupper(substr($animal->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <h5 class="responsavel-nome">{{ $animal->user->name }}</h5>
                            @if($animal->user->telefone)
                                <p class="responsavel-contato">
                                    <i class="bi bi-telephone"></i>
                                    {{ $animal->user->telefone }}
                                </p>
                            @endif
                        </div>
                    </div>

                    @auth
                        @if(auth()->id() != $animal->user_id && $animal->status == 'DISPONIVEL')

                            <a href="{{ route('adocoes.create', ['animal_id' => $animal->id]) }}"
                            class="modern-adopt-btn w-100 d-block text-center mt-3">

                                Quero Adotar

                            </a>

                        @endif
                    @else

                        <a href="{{ route('login') }}"
                        class="modern-adopt-btn w-100 d-block text-center mt-3">

                            Faça login para adotar

                        </a>

                    @endauth
                </div>

            </div>
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const featured = document.getElementById('gallery-featured');
    const thumbs   = document.querySelectorAll('.animal-thumb');
    let imagens      = [];
    let nomes        = [];
    let imagemAtual  = 0;
    const nomeAnimal = document.querySelector('.animal-details-title')?.textContent.trim() || '';

    thumbs.forEach((thumb, index) => {
        imagens.push(thumb.dataset.img);
        thumb.addEventListener('click', function () {
            imagemAtual = index;
            featured.src = imagens[index];
            thumbs.forEach(t => t.classList.remove('active-thumb'));
            thumb.classList.add('active-thumb');
        });
    });

    if (!thumbs.length && featured) {
        imagens.push(featured.src);
    }

    /*
    |------------------------------------------------------------------
    | LIGHTBOX
    |------------------------------------------------------------------
    */

    const lightbox = document.createElement('div');
    lightbox.className = 'lightbox-overlay';
    lightbox.setAttribute('role', 'dialog');
    lightbox.setAttribute('aria-modal', 'true');

    lightbox.innerHTML = `
        <div class="lightbox-shell">
            <div class="lightbox-topbar" style="position:relative;">
                <span class="lightbox-title">${nomeAnimal}</span>
                <span class="lightbox-counter"></span>
                <button class="lightbox-close" aria-label="Fechar">✕</button>
            </div>
            <div class="lightbox-main">
                <button class="lightbox-prev" aria-label="Anterior">&#10094;</button>
                <div class="lightbox-img-wrap">
                    <img class="lightbox-image" src="" alt="Foto do animal">
                </div>
                <button class="lightbox-next" aria-label="Próxima">&#10095;</button>
            </div>
            <div class="lightbox-thumbs"></div>
        </div>
    `;

    document.body.appendChild(lightbox);

    const lbImage   = lightbox.querySelector('.lightbox-image');
    const lbCounter = lightbox.querySelector('.lightbox-counter');
    const lbThumbs  = lightbox.querySelector('.lightbox-thumbs');
    const btnClose  = lightbox.querySelector('.lightbox-close');
    const btnPrev   = lightbox.querySelector('.lightbox-prev');
    const btnNext   = lightbox.querySelector('.lightbox-next');

    /* Monta thumbnails dentro do lightbox */
    function buildLbThumbs() {
        lbThumbs.innerHTML = '';
        if (imagens.length <= 1) return;
        imagens.forEach((src, i) => {
            const t = document.createElement('div');
            t.className = 'lightbox-lb-thumb' + (i === imagemAtual ? ' active-lb-thumb' : '');
            t.innerHTML = `<img src="${src}" alt="Foto ${i + 1}">`;
            t.addEventListener('click', () => { imagemAtual = i; atualizarLb(); });
            lbThumbs.appendChild(t);
        });
    }

    function atualizarLb() {
        lbImage.src = imagens[imagemAtual];
        lbCounter.textContent = imagens.length > 1 ? `${imagemAtual + 1} / ${imagens.length}` : '';
        lbThumbs.querySelectorAll('.lightbox-lb-thumb').forEach((t, i) => {
            t.classList.toggle('active-lb-thumb', i === imagemAtual);
        });
        /* Sincroniza thumb da galeria */
        thumbs.forEach((t, i) => t.classList.toggle('active-thumb', i === imagemAtual));
    }

    function abrirLightbox() {
        buildLbThumbs();
        atualizarLb();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function fecharLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    /* Abre ao clicar na imagem principal */
    if (featured) {
        featured.addEventListener('click', () => abrirLightbox());
    }

    btnClose.addEventListener('click', fecharLightbox);
    lightbox.addEventListener('click', e => { if (e.target === lightbox) fecharLightbox(); });

    btnNext.addEventListener('click', () => {
        imagemAtual = (imagemAtual + 1) % imagens.length;
        atualizarLb();
    });

    btnPrev.addEventListener('click', () => {
        imagemAtual = (imagemAtual - 1 + imagens.length) % imagens.length;
        atualizarLb();
    });

    document.addEventListener('keydown', e => {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape')     fecharLightbox();
        if (e.key === 'ArrowRight') btnNext.click();
        if (e.key === 'ArrowLeft')  btnPrev.click();
    });
});
</script>
@endsection