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
        $user->name=$event->school->name;
        $user->password=$event->school->password;
        $user->email=$event->school->email;
        $user->school_id=$event->school->id;
        $user->save();
        RoleUser::create(['user_id'=>$user->id, 'role_id'=>1]);
    }
}
