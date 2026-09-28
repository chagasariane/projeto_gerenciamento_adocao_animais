<?php

namespace App\Notifications;

use App\Models\Adocao;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusAdocaoNotification extends Notification
{
    use Queueable;

    protected Adocao $adocao;

    public function __construct(Adocao $adocao)
    {
        $this->adocao = $adocao;
    }

    /**
     * Canal utilizado para enviar a notificação.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Dados salvos na tabela notifications.
     */
    public function toDatabase(object $notifiable): array
    {
        $animal = $this->adocao->animal;

        if ($this->adocao->status === 'APROVADA') {

            $titulo = 'Solicitação aprovada';

            $mensagem =
                'Sua solicitação de adoção de ' .
                $animal->nome .
                ' foi aprovada!';

        } elseif ($this->adocao->status === 'RECUSADA') {

            $titulo = 'Solicitação recusada';

            $mensagem =
                'Sua solicitação de adoção de ' .
                $animal->nome .
                ' foi recusada.';

        } else {

            $titulo = 'Atualização na adoção';

            $mensagem =
                'O status da sua solicitação de adoção de ' .
                $animal->nome .
                ' foi atualizado.';
        }

        return [
            'tipo' => 'status_adocao',
            'titulo' => $titulo,
            'mensagem' => $mensagem,

            'adocao_id' => $this->adocao->id,

            'animal_id' => $animal->id,
            'animal_nome' => $animal->nome,

            'status' => $this->adocao->status,
        ];
    }

    /**
     * Representação em array.
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}