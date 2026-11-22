@extends('layouts.app')

@section('content')

<div class="container chat-page">

    <div class="chat-box">

        {{-- CABEÇALHO --}}
        <div class="chat-header">

            <a
                href="{{ request('origem') === 'animal' && request('animal_id')
                    ? route('animais.show', request('animal_id')) . '?veio_do_chat=1'
                    : route('chat.index') }}"
                class="chat-header-back"
                title="Voltar"
            >
                <i class="bi bi-arrow-left"></i>
            </a>

            <div class="chat-header-avatar">
                <i class="bi bi-person-fill"></i>
            </div>

            <div class="chat-header-info">
                <h3 class="chat-header-name">
                    {{ $outroUsuario->name }}
                </h3>

                <p class="chat-header-status">
                    Usuário do MiauDot
                </p>
            </div>

        </div>


        {{-- MENSAGENS --}}
        <div class="chat-messages">

            @forelse($mensagens as $mensagem)

                @if($mensagem->usuario_id === auth()->id())

                    <div class="chat-message-row sent">

                        <div class="chat-message sent">
                            
                        <div class="chat-message-text">
                            {{ $mensagem->mensagem }}
                        </div>

                            <span class="chat-message-time">
                                {{ $mensagem->created_at->format('d/m/Y H:i') }}
                            </span>

                        </div>

                    </div>

                @else

                    <div class="chat-message-row received">

                        <div class="chat-message received">

                            <div class="chat-message-text">
                                {{ $mensagem->mensagem }}
                            </div>

                            <span class="chat-message-time">
                                {{ $mensagem->created_at->format('d/m/Y H:i') }}
                            </span>

                        </div>

                    </div>

                @endif

            @empty

                <div class="chat-messages-empty">

                    <div>

                        <i class="bi bi-chat-square-text"></i>

                        <p>
                            Nenhuma mensagem ainda.
                        </p>

                        <small>
                            Envie uma mensagem para iniciar a conversa.
                        </small>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- CAMPO DE ENVIO --}}
        <div class="chat-input-area">

            <form
                action="{{ route('chat.mensagem.store', $conversa) }}"
                method="POST"
            >

                @csrf

                <input
                    type="hidden"
                    name="origem"
                    value="{{ request('origem') }}"
                >

                <input
                    type="hidden"
                    name="animal_id"
                    value="{{ request('animal_id') }}"
                >

                <div class="chat-input-wrapper">

                    <textarea
                        name="mensagem"
                        class="chat-input"
                        rows="1"
                        placeholder="Digite sua mensagem..."
                        required
                    ></textarea>

                    <button
                        type="submit"
                        class="chat-send-btn"
                        title="Enviar mensagem"
                    >
                        <i class="bi bi-send-fill"></i>
                    </button>

                </div>

                @error('mensagem')
                    <div class="text-danger small mt-2">
                        {{ $message }}
                    </div>
                @enderror

            </form>

        </div>

    </div>

</div>

@endsection