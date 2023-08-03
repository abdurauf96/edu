<?php

namespace App\Console;

use App\Jobs\StudentsMonthlyPaymentJob;
use App\Models\User;
use App\Repositories\StudentRepository;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //Commands\StudentsMonthlyPaymentCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->job(new StudentsMonthlyPaymentJob(new StudentRepository()))->everyMinute();
        $schedule->call(function () {
            $activeSessions=\App\Models\Login::whereNull('logout_at')->get();
            foreach ($activeSessions as $session){
                if(!Cache::has('user-'.$session->user_id)){
                    $session->update(['logout_at'=>now()]);
                    $startDate = Carbon::parse($session->login_at);
                    $diff = $startDate->diffInMinutes(Carbon::now());
                    $session->update(['session_time'=>$diff]);
                    User::find($session->user_id)->update(['is_active'=>false]);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
