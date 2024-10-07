<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class ReportPolicy
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

    public function parentView(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('report-parent');
    }

    public function viewProfitLoss(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('profit-loss');
    }

    public function viewBestSeller(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('best-seller');
    }

    public function viewDue(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('due-report');
    }

}
