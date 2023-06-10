<?php

namespace App\Policies;

use App\Models\RegisterCode;
use App\Models\User;

class RegisterCodePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function get(User $user, RegisterCode $registerCode = null){
        return true;
    }
}
