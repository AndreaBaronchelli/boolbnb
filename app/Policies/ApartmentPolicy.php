<?php

namespace App\Policies;

use App\User;
use App\Apartment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApartmentPolicy
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

    public function view(User $user, Apartment $apartment) {
        return $user->id == $apartment->user_id;
    }

    public function update(User $user, Apartment $apartment) {
        return $user->id === $apartment->user_id;
    }
}
