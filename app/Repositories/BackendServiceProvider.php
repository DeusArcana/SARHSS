<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function boot() {}

    public function register()
    {
        $this->app->when(\App\Http\Controllers\UnidadesController::class)
            ->needs(\App\Repositories\BaseRepositoryInterface::class)
            ->give(\App\Repositories\UnidadesRepository::class);

        $this->app->when(\App\Http\Controllers\EmpleadosController::class)
            ->needs(\App\Repositories\BaseRepositoryInterface::class)
            ->give(\App\Repositories\EmpleadosRepository::class);

        $this->app->when(\App\Http\Controllers\API\UnidadesController::class)
            ->needs(\App\Repositories\BaseRepositoryInterface::class)
            ->give(\App\Repositories\UnidadesRepository::class);

        $this->app->when(\App\Http\Controllers\EstudiosController::class)
            ->needs(\App\Repositories\BaseRepositoryInterface::class)
            ->give(\App\Repositories\EstudiosRepository::class);

        $this->app->when(\App\Http\Controllers\DomiciliosController::class)
            ->needs(\App\Repositories\BaseRepositoryInterface::class)
            ->give(\App\Repositories\DomiciliosRepository::class);

        $this->app->when(\App\Http\Controllers\CursosController::class)
            ->needs(\App\Repositories\BaseRepositoryInterface::class)
            ->give(\App\Repositories\CursosRepository::class);

        $this->app->when(\App\Http\Controllers\EspecialidadesMedicasController::class)
            ->needs(\App\Repositories\BaseRepositoryInterface::class)
            ->give(\App\Repositories\EspecialidadesMedicasRepository::class);
    }
}
