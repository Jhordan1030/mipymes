<?php

namespace App\Policies;

use App\Models\TipoNota;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipoNotaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user-> can('ver TipoNota');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TipoNota $tipoNota): bool
    {
        return $user-> can('ver TipoNota');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user-> can('crear TipoNota');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TipoNota $tipoNota): bool
    {
        return $user-> can('editar TipoNota');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TipoNota $tipoNota): bool
    {
        return $user-> can('eliminar TipoNota');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TipoNota $tipoNota): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TipoNota $tipoNota): bool
    {
        return false;
    }
}
