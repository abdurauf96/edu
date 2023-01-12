<?php

namespace App\Jobs;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentOutedCourseJob implements ShouldQueue
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
        $numberAllDays=(int)date('t', strtotime($this->student->outed_date)); //number all days for that month
        $numberStudyDay=(int)date('d', strtotime($this->student->outed_date)); //number study days for that month
        $remainDays = $numberAllDays - $numberStudyDay;
        $priceCourse=(int)$this->student->getPriceMonth();
        $summa=round($priceCourse/$numberAllDays*$remainDays);
        $this->student->debt-=$summa;
        $this->student->save();
        StudentActivity::create(['student_id'=>$this->student->id, 'description'=>'Kursdan chiqib ketgani uchun '.$summa.' so`m qarzidan ayrildi !']);
        \Log::info("qarz-  {$summa} ; qolgan kuni - {$remainDays} ; ");
    }
}
