<?php

namespace App\Listeners;

use App\Models\RoleUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Events\SchoolUserCreated;
class UserCreateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SchoolUserCreated $event)
    {
        $user=new User;
        $user->name=$event->user['name'];
        $user->password=bcrypt($event->user['password']);
        $user->email=$event->user['email'];
        $user->school_id=$event->user['school_id'];
        $user->save();

        $user->assignRole('admin');
    }
}
