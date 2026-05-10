<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        App\User::class => App\Policies\UserPolicy::class,
        'App\Models\Unidad' => 'App\Policies\UnidadPolicy',
        'App\Models\Empleado' => 'App\Policies\EmpleadoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // El SuperUsuario puede realizar todas las acciones
        Gate::before(function ($user, $ability) {
            return $user->isSuperUser() ? true : null;
        });
    }
}
