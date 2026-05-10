<?php

namespace App\Policies;

use App\Models\Unidad;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnidadPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any unidads.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the unidad.
     *
     * @return mixed
     */
    public function view(User $user, Unidad $unidad)
    {
        // Si es administrador
        if ($user->hasRoles(['admin'])) {
            return true;
        }
        // Si tanto la unidad como el usuario pertenecen a la misma jurisdicción
        if ($user->hasRoles(['juris'])) {
            return (int) $user->Jurisdiccion === (int) $unidad->jurisdiccion->ID_Jurisdiccion;
        }
        // Si el usuario se encuentra adscrito a la unidad
        if ($user->hasRoles(['local'])) {
            return (int) $user->Unidad === (int) $unidad->ID_Unidad;
        }

        return false;
    }

    /**
     * Determine whether the user can create unidads.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the unidad.
     *
     * @return mixed
     */
    public function update(User $user, Unidad $unidad)
    {
        //
    }

    /**
     * Determine whether the user can delete the unidad.
     *
     * @return mixed
     */
    public function delete(User $user, Unidad $unidad)
    {
        //
    }

    /**
     * Determine whether the user can restore the unidad.
     *
     * @return mixed
     */
    public function restore(User $user, Unidad $unidad)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the unidad.
     *
     * @return mixed
     */
    public function forceDelete(User $user, Unidad $unidad)
    {
        //
    }
}
