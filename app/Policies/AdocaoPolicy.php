<?php

namespace App\Policies;

use App\Models\Adocao;
use App\Models\User;

class AdocaoPolicy
{
    /**
     * Listagem de adoções.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Visualização de adoção.
     */
    public function view(
        User $user,
        Adocao $adocao
    ): bool {

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->is_admin) {

            return true;
        }

        /*
        |--------------------------------------------------------------------------
        | SOLICITANTE
        |--------------------------------------------------------------------------
        */

        if ($adocao->user_id === $user->id) {

            return true;
        }

        /*
        |--------------------------------------------------------------------------
        | DONO DO ANIMAL
        |--------------------------------------------------------------------------
        */

        return $adocao->animal->user_id === $user->id;
    }

    /**
     * Criar solicitação.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Gerenciar adoção.
     */
    public function update(
        User $user,
        Adocao $adocao
    ): bool {

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->is_admin) {

            return true;
        }

        /*
        |--------------------------------------------------------------------------
        | DONO DO ANIMAL
        |--------------------------------------------------------------------------
        */

        return $adocao->animal->user_id === $user->id;
    }

    /**
     * Cancelar solicitação.
     */
    public function delete(
        User $user,
        Adocao $adocao
    ): bool {

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->is_admin) {

            return true;
        }

        /*
        |--------------------------------------------------------------------------
        | SOLICITANTE
        |--------------------------------------------------------------------------
        */

        return $adocao->user_id === $user->id;
    }

    /**
     * Restaurar adoção.
     */
    public function restore(
        User $user,
        Adocao $adocao
    ): bool {

        return $user->is_admin;
    }

    /**
     * Exclusão permanente.
     */
    public function forceDelete(
        User $user,
        Adocao $adocao
    ): bool {

        return $user->is_admin;
    }
}