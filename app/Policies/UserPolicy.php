<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->id === Auth::user()->id;
    }

}
