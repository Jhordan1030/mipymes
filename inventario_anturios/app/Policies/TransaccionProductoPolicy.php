<?php

namespace App\Policies;

use App\Models\TransaccionProducto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransaccionProductoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user-> can('ver TransaccionProducto');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TransaccionProducto $transaccionProducto): bool
    {
        return $user-> can('ver TransaccionProducto');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user-> can('crear TransaccionProducto');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TransaccionProducto $TransaccionProducto): bool
    {
        return $user-> can('editar TransaccionProducto');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TransaccionProducto $TransaccionProducto): bool
    {
        return $user-> can('eliminar TransaccionProducto');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TransaccionProducto $TransaccionProducto): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TransaccionProducto $TransaccionProducto): bool
    {
        return false;
    }
}
