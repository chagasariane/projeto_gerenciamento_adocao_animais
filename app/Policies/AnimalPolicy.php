<?php

namespace App\Policies;

use App\Models\Animal;
use App\Models\User;

class AnimalPolicy
{
    /**
     * Listagem de animais do usuário.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Visualização de animal.
     */
    public function view(
        User $user,
        Animal $animal
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
        | DONO
        |--------------------------------------------------------------------------
        */

        return $animal->user_id === $user->id;
    }

    /**
     * Criação de animal.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Atualização do animal.
     */
    public function update(
        User $user,
        Animal $animal
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
        | DONO
        |--------------------------------------------------------------------------
        */

        return $animal->user_id === $user->id;
    }

    /**
     * Remoção do animal.
     */
    public function delete(
        User $user,
        Animal $animal
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
        | DONO
        |--------------------------------------------------------------------------
        */

        return $animal->user_id === $user->id;
    }

    /**
     * Restaurar animal.
     */
    public function restore(
        User $user,
        Animal $animal
    ): bool {

        return $user->is_admin;
    }

    /**
     * Exclusão permanente.
     */
    public function forceDelete(
        User $user,
        Animal $animal
    ): bool {

        return $user->is_admin;
    }
}