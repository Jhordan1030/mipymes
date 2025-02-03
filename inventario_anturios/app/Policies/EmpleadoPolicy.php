<?php

namespace App\Policies;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Auth\Access\Response;


//Maneja la autorización de los usuarios
class EmpleadoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    //Toma como parámatro el usuario autenticado
    public function viewAny(User $user): bool
    {
        return $user-> can('ver empleado');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Empleado $empleado): bool
    {
        return $user-> can('ver Empleado');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user-> can('crear Empleado');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Empleado $empleado): bool
    {
        return $user-> can('editar Empleado');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Empleado $empleado): bool
    {
        return $user-> can('eliminar Empleado');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Empleado $empleado): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Empleado $empleado): bool
    {
        return false;
    }
}
