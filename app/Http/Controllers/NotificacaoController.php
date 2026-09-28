<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacaoController extends Controller
{
    public function show(Request $request, string $notification)
    {
        $notificacao = $request->user()
            ->notifications()
            ->where('id', $notification)
            ->firstOrFail();

        // Marca como lida
        if (is_null($notificacao->read_at)) {
            $notificacao->markAsRead();
        }

        // Nova mensagem
        if (
            ($notificacao->data['tipo'] ?? null) === 'nova_mensagem'
            && isset($notificacao->data['conversa_id'])
        ) {
            return redirect()->route(
                'chat.show',
                $notificacao->data['conversa_id']
            );
        }

        // Futuramente outros tipos cairão aqui.

        return redirect('/');
    }
}