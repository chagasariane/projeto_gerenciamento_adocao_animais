<?php

namespace App\Notifications;

use App\Models\Conversa;
use App\Models\Mensagem;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NovaMensagemNotification extends Notification
{
    use Queueable;

    protected Mensagem $mensagem;
    protected Conversa $conversa;

    public function __construct(
        Mensagem $mensagem,
        Conversa $conversa
    ) {
        $this->mensagem = $mensagem;
        $this->conversa = $conversa;
    }

    /**
     * Define onde a notificação será armazenada.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Dados que serão armazenados na tabela notifications.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'tipo' => 'nova_mensagem',

            'titulo' => 'Nova mensagem',

            'mensagem' =>
                $this->mensagem->usuario->name .
                ' enviou uma nova mensagem.',

            'conversa_id' => $this->conversa->id,

            'remetente_id' => $this->mensagem->usuario_id,

            'remetente_nome' =>
                $this->mensagem->usuario->name,
        ];
    }

    /**
     * Representação da notificação como array.
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}