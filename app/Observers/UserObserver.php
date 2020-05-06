<?php

namespace App\Observers;

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
    }


    /**
     * Handle the offer "retrieved" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function retrieved(User $user) {
        //$user->phone_number = '(' . __('prefixes.' . json_decode($user->phone_number)['prefix'] . '.prefix') . ')'. json_decode($user->phone_number)['number'];
    }
}
