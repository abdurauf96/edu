<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentFinishedCourseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $group;
    protected $end_date;
    public function __construct($group, $end_date)
    {
        $this->group=$group;
        $this->end_date=$end_date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $numberAllDays=(int)date('t'); //number all days for that month
        $numberStudyDay=(int)date('d', strtotime($this->end_date)); //number study days for that month
        $remainDays = $numberAllDays - $numberStudyDay;
        $priceCourse=(int)$this->group->course->price;
        $summa=round($priceCourse/$numberAllDays*$remainDays);
       
        foreach($this->group->students as $student){
            $student->debt-=$summa;
            $student->finished_date=$this->end_date;
            $student->status=0;
            $student->save();
        }
        //\Log::info("qarz-  {$summa} ; qolgan kuni - {$remainDays} ; ");
    }
}
