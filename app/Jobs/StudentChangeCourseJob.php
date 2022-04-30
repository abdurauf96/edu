<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentChangeCourseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $student,$start_date,$priceNewCourse;
    public function __construct($student, $start_date, $priceNewCourse)
    {
        $this->start_date=$start_date;
        $this->student=$student;
        $this->priceNewCourse=$priceNewCourse;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        $numberAllDays=(int)date('t', strtotime($this->start_date)); //number all days for that month
        $numberStudyDay=(int)date('d', strtotime($this->start_date)); //number study days for that month
        $remainDays = $numberAllDays - $numberStudyDay;
        $priceOldCourse=(int)$this->student->group->course->price;
        $priceNewCourse=$this->priceNewCourse;
        $this->student->debt=$this->student->debt + $priceNewCourse/$numberAllDays*$remainDays - $priceOldCourse/$numberAllDays*$remainDays;
        $this->student->save();
        //\Log::info(['yangi kurs narxi - '.$priceNewCourse." ; eski kurs narxi - {$priceOldCourse}  ; qolgan kun - {$remainDays} ; qarz - {$this->student->debt}"]);
    }
}
