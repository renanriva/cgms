<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CoursePolicy
 *
 * @package App\Policies
 */
class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user){

        if ($user->role == 'admin'){

            return true;
        }

        return false;
    }

    public function update(User $user){

        if ($user->role == 'admin'){

            return true;
        }

        return false;
    }



    /**
     * @param User $user
     * @return bool
     */
    public function upcoming(User $user){

        if ($user->role == 'teacher'){

            return true;
        }

        return false;
    }

}
