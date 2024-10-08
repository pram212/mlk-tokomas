<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class SettingPolicy
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

    public function parentView(User $user) {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('master-setting');
    }

    public function backUpDatabase(User $user) {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('backup_database');
    }

    public function mailSetting(User $user) {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('mail_setting');
    }

    public function smsSetting(User $user) {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('sms_setting');
    }

    public function createSms(User $user) {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('create_sms');
    }

    public function posSetting(User $user) {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('pos_setting');
    }

    public function sendNotification(User $user) {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('send_notification');
    }

    public function emptyDatabase(User $user) {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('empty_database');
    }

}
