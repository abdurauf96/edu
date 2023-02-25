<?php

namespace App\Jobs;

use App\Models\Student;
use App\Models\StudentActivity;
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
        foreach($this->group->students as $student){
            $student->finished_date=$this->end_date;
            $student->status=Student::GRADUATED;
            $student->save();
        }
    }
}
