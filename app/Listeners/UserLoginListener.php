<?php

namespace App\Listeners;

use Adrianorosa\GeoLocation\GeoLocation;
use App\Models\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLoginListener
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
    public function handle($event)
    {
        $details = GeoLocation::lookup($event->ip);
        Login::create([
            'user_id'=>auth()->guard('user')->id(),
            'ip'=>$event->ip,
            'login_at'=>date('Y-m-d H:i:s'),
            'latitude'=>$details->getLatitude(),
            'longitude'=>$details->getLongitude(),
            'city'=>$details->getCity(),
        ]);
    }
}
