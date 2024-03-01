<?php

namespace App\Policies;

use App\Payroll;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class PayrollPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any payrolls.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('payroll');
    }

    /**
     * Determine whether the user can view the payroll.
     *
     * @param  \App\User  $user
     * @param  \App\Payroll  $payroll
     * @return mixed
     */
    public function view(User $user, Payroll $payroll)
    {
        //
    }

    /**
     * Determine whether the user can create payrolls.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the payroll.
     *
     * @param  \App\User  $user
     * @param  \App\Payroll  $payroll
     * @return mixed
     */
    public function update(User $user, Payroll $payroll)
    {
        //
    }

    /**
     * Determine whether the user can delete the payroll.
     *
     * @param  \App\User  $user
     * @param  \App\Payroll  $payroll
     * @return mixed
     */
    public function delete(User $user, Payroll $payroll)
    {
        //
    }

    /**
     * Determine whether the user can restore the payroll.
     *
     * @param  \App\User  $user
     * @param  \App\Payroll  $payroll
     * @return mixed
     */
    public function restore(User $user, Payroll $payroll)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the payroll.
     *
     * @param  \App\User  $user
     * @param  \App\Payroll  $payroll
     * @return mixed
     */
    public function forceDelete(User $user, Payroll $payroll)
    {
        //
    }
}
