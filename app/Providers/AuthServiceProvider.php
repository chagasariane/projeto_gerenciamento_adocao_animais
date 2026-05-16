<?php

namespace App\Providers;

use App\Models\Animal;
use App\Policies\AnimalPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeamento de Policies.
     */
    protected $policies = [

        Animal::class => AnimalPolicy::class,
    ];

    /**
     * Registro de serviços de autenticação/autorização.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}