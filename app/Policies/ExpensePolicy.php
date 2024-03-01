<?php

namespace App\Policies;

use App\Expense;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class ExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any expenses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('expenses-index');
    }

    /**
     * Determine whether the user can view the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function view(User $user, Expense $expense)
    {
        //
    }

    /**
     * Determine whether the user can create expenses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('expenses-add');
    }

    /**
     * Determine whether the user can update the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function update(User $user, Expense $expense)
    {
        //
    }

    /**
     * Determine whether the user can delete the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function delete(User $user, Expense $expense)
    {
        //
    }

    /**
     * Determine whether the user can restore the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function restore(User $user, Expense $expense)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function forceDelete(User $user, Expense $expense)
    {
        //
    }
}
