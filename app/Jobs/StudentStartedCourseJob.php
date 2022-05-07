<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentStartedCourseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $student;
    public function __construct($student)
    {
        $this->student=$student;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //'t' Number of days in the given month (28 through 31)
        //'j' Day of the month without leading zeros (1 to 31)
        //$timestamp = strtotime('2014-10-03');
        $numberAllDays=(int)date('t', strtotime($this->student->start_date));
        $numberStartDay=(int)date('j', strtotime($this->student->start_date));
        $remainDays = $numberAllDays - $numberStartDay+1;
        $priceCourse=(int)$this->student->group->course->price;
        $debt=round($priceCourse/$numberAllDays*$remainDays);
        $this->student->update(['debt'=>$debt]);

        \Log::info("qarz-  {$debt} ; qolgan kuni - {$remainDays} ; kurs narxi - {$priceCourse}");

    }
}
