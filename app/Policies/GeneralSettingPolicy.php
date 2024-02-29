<?php

namespace App\Policies;

use App\GeneralSetting;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class GeneralSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any general settings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('general_setting');
    }

    /**
     * Determine whether the user can view the general setting.
     *
     * @param  \App\User  $user
     * @param  \App\GeneralSetting  $generalSetting
     * @return mixed
     */
    public function view(User $user, GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Determine whether the user can create general settings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the general setting.
     *
     * @param  \App\User  $user
     * @param  \App\GeneralSetting  $generalSetting
     * @return mixed
     */
    public function update(User $user, GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Determine whether the user can delete the general setting.
     *
     * @param  \App\User  $user
     * @param  \App\GeneralSetting  $generalSetting
     * @return mixed
     */
    public function delete(User $user, GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Determine whether the user can restore the general setting.
     *
     * @param  \App\User  $user
     * @param  \App\GeneralSetting  $generalSetting
     * @return mixed
     */
    public function restore(User $user, GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the general setting.
     *
     * @param  \App\User  $user
     * @param  \App\GeneralSetting  $generalSetting
     * @return mixed
     */
    public function forceDelete(User $user, GeneralSetting $generalSetting)
    {
        //
    }
}
