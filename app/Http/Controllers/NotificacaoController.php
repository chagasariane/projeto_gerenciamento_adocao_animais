<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacaoController extends Controller
{
    public function show(Request $request, string $notification)
    {
        // Busca somente notificações pertencentes ao usuário autenticado.
        $notificacao = $request->user()
            ->notifications()
            ->where('id', $notification)
            ->firstOrFail();

        // Marca a notificação como lida.
        if (is_null($notificacao->read_at)) {
            $notificacao->markAsRead();
        }

        $dados = $notificacao->data;
        $tipo = $dados['tipo'] ?? null;

        // Nova mensagem: abre a conversa correspondente.
        if (
            $tipo === 'nova_mensagem'
            && !empty($dados['conversa_id'])
        ) {
            return redirect()->route(
                'chat.show',
                $dados['conversa_id']
            );
        }

        // Novo interesse em adoção: abre a tela de adoções.
        if (
            $tipo === 'nova_solicitacao_adocao'
            && !empty($dados['adocao_id'])
        ) {
            return redirect()->route('adocoes.index');
        }

        // Atualização do status de uma adoção.
        if (
            $tipo === 'status_adocao'
            && !empty($dados['adocao_id'])
        ) {
            return redirect()->route('adocoes.index');
        }

        // Destino padrão para notificações sem rota específica.
        return redirect()->route('home')
            ->with('info', 'Notificação marcada como lida.');
    }
}