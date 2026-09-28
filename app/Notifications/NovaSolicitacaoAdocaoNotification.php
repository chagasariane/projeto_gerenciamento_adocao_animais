<?php

namespace App\Notifications;

use App\Models\Adocao;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NovaSolicitacaoAdocaoNotification extends Notification
{
    use Queueable;

    protected Adocao $adocao;

    public function __construct(Adocao $adocao)
    {
        $this->adocao = $adocao;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'tipo' => 'nova_solicitacao_adocao',

            'titulo' => 'Novo interesse em adoção',

            'mensagem' =>
                $this->adocao->user->name .
                ' demonstrou interesse em adotar ' .
                $this->adocao->animal->nome . '.',

            'adocao_id' => $this->adocao->id,

            'animal_id' => $this->adocao->animal->id,

            'animal_nome' => $this->adocao->animal->nome,

            'solicitante_id' => $this->adocao->user->id,

            'solicitante_nome' => $this->adocao->user->name,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}