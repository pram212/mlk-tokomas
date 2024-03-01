<?php

namespace App\Policies;

use App\HrmSetting;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class HrmSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any hrm settings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('hrm_setting');
    }

    /**
     * Determine whether the user can view the hrm setting.
     *
     * @param  \App\User  $user
     * @param  \App\HrmSetting  $hrmSetting
     * @return mixed
     */
    public function view(User $user, HrmSetting $hrmSetting)
    {
        //
    }

    /**
     * Determine whether the user can create hrm settings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the hrm setting.
     *
     * @param  \App\User  $user
     * @param  \App\HrmSetting  $hrmSetting
     * @return mixed
     */
    public function update(User $user, HrmSetting $hrmSetting)
    {
        //
    }

    /**
     * Determine whether the user can delete the hrm setting.
     *
     * @param  \App\User  $user
     * @param  \App\HrmSetting  $hrmSetting
     * @return mixed
     */
    public function delete(User $user, HrmSetting $hrmSetting)
    {
        //
    }

    /**
     * Determine whether the user can restore the hrm setting.
     *
     * @param  \App\User  $user
     * @param  \App\HrmSetting  $hrmSetting
     * @return mixed
     */
    public function restore(User $user, HrmSetting $hrmSetting)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the hrm setting.
     *
     * @param  \App\User  $user
     * @param  \App\HrmSetting  $hrmSetting
     * @return mixed
     */
    public function forceDelete(User $user, HrmSetting $hrmSetting)
    {
        //
    }
}
