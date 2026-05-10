<?php

namespace App\Policies;

use App\Models\Empleado;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpleadoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any empleados.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the empleado.
     *
     * @return mixed
     */
    public function view(User $user, Empleado $empleado)
    {
        // Si es administrador
        if ($user->hasRoles(['admin'])) {
            return true;
        }
        // Si tanto la unidad como el usuario pertenecen a la misma jurisdicción
        if ($user->hasRoles(['juris'])) {
            return (int) $user->Jurisdiccion === (int) $empleado->Jurisdiccion->ID_Jurisdiccion;
        }
        // Si el usuario se encuentra adscrito a la unidad
        if ($user->hasRoles(['local'])) {
            return (int) $user->Unidad === (int) $empleado->Unidad->ID_Unidad;
        }

        return false;
    }

    /**
     * Determine whether the user can create empleados.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the empleado.
     *
     * @return mixed
     */
    public function update(User $user, Empleado $empleado)
    {
        // Si es administrador
        if ($user->hasRoles(['admin'])) {
            return true;
        }
        // Si tanto la unidad como el usuario pertenecen a la misma jurisdicción
        if ($user->hasRoles(['juris'])) {
            return (int) $user->Jurisdiccion === (int) $empleado->Jurisdiccion->ID_Jurisdiccion;
        }
        // Si el usuario se encuentra adscrito a la unidad
        if ($user->hasRoles(['local'])) {
            return (int) $user->Unidad === (int) $empleado->Unidad->ID_Unidad;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the empleado.
     *
     * @return mixed
     */
    public function delete(User $user, Empleado $empleado)
    {
        // Si es administrador
        if ($user->hasRoles(['admin'])) {
            return true;
        }
        // Si tanto la unidad como el usuario pertenecen a la misma jurisdicción
        if ($user->hasRoles(['juris'])) {
            return (int) $user->Jurisdiccion === (int) $empleado->Jurisdiccion->ID_Jurisdiccion;
        }
        // Si el usuario se encuentra adscrito a la unidad
        if ($user->hasRoles(['local'])) {
            return (int) $user->Unidad === (int) $empleado->Unidad->ID_Unidad;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the empleado.
     *
     * @return mixed
     */
    public function restore(User $user, Empleado $empleado)
    {
        // Si es administrador
        if ($user->hasRoles(['admin'])) {
            return true;
        }
        // Si tanto la unidad como el usuario pertenecen a la misma jurisdicción
        if ($user->hasRoles(['juris'])) {
            return (int) $user->Jurisdiccion === (int) $empleado->Jurisdiccion->ID_Jurisdiccion;
        }
        // Si el usuario se encuentra adscrito a la unidad
        if ($user->hasRoles(['local'])) {
            return (int) $user->Unidad === (int) $empleado->Unidad->ID_Unidad;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the empleado.
     *
     * @return mixed
     */
    public function forceDelete(User $user, Empleado $empleado)
    {
        // Si es administrador
        if ($user->hasRoles(['admin'])) {
            return true;
        }
        // Si tanto la unidad como el usuario pertenecen a la misma jurisdicción
        if ($user->hasRoles(['juris'])) {
            return (int) $user->Jurisdiccion === (int) $empleado->Jurisdiccion->ID_Jurisdiccion;
        }
        // Si el usuario se encuentra adscrito a la unidad
        if ($user->hasRoles(['local'])) {
            return (int) $user->Unidad === (int) $empleado->Unidad->ID_Unidad;
        }

        return false;
    }
}
