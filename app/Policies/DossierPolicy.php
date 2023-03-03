<?php

namespace App\Policies;

use App\Dossier;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DossierPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->is_admin || $user->hasPermissionTo('view_dossier');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->is_admin || $user->hasPermissionTo('view_dossier');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin || $user->hasPermissionTo('ajouter_dossier');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->is_admin || $user->hasPermissionTo('modifier_dossier');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->is_admin || $user->hasPermissionTo('supprimer_dossier');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function restore(User $user, Dossier $dossier)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function forceDelete(User $user, Dossier $dossier)
    {
        //
    }
}
