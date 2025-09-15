<?php

namespace Illuminate\Auth\Events;

use Illuminate\Queue\SerializesModels;

class Registered
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user  The authenticated user.
     */
    public function __construct(        public $user,    ) {



        $user = \App\Models\User::find($user->id);
        $user->assignRole('customer');
    }
}
