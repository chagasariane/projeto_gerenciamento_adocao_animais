@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="chat-page-header mb-4">
        <div>
            <h2 class="chat-title">
                <i class="bi bi-chat-dots"></i>
                Meus Chats
            </h2>

            <p class="chat-subtitle">
                Converse com outros usuários do MiauDot.
            </p>
        </div>
    </div>

    <div class="chat-list-container">

        @forelse($conversas as $conversa)

            @php
                $outroUsuario = $conversa->usuario_1_id === auth()->id()
                    ? $conversa->usuario2
                    : $conversa->usuario1;

                $ultimaMensagem = $conversa->mensagens()
                    ->latest()
                    ->first();
            @endphp

            <a
                href="{{ route('chat.show', $conversa) }}"
                class="chat-conversation"
            >

                <div class="chat-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="chat-conversation-content">

                    <div class="chat-conversation-top">

                        <strong>
                            {{ $outroUsuario->name }}
                        </strong>

                        @if($ultimaMensagem)
                            <small>
                                {{ $ultimaMensagem->created_at->format('d/m/Y H:i') }}
                            </small>
                        @endif

                    </div>

                    @if($ultimaMensagem)

                        <p>
                            {{ Str::limit($ultimaMensagem->mensagem, 90) }}
                        </p>

                    @else

                        <p class="chat-empty-message">
                            Nenhuma mensagem ainda.
                        </p>

                    @endif

                </div>

                <div class="chat-arrow">
                    <i class="bi bi-chevron-right"></i>
                </div>

            </a>

        @empty

            <div class="chat-no-conversations">

                <div class="chat-empty-icon">
                    <i class="bi bi-chat-square-text"></i>
                </div>

                <h4>Nenhuma conversa ainda</h4>

                <p>
                    Quando você entrar em contato com um protetor,
                    suas conversas aparecerão aqui.
                </p>

            </div>

        @endforelse

    </div>

</div>
@endsection