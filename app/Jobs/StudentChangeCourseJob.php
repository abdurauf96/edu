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
    protected $student,$new_group;
    public function __construct($student, $new_group)
    {
        $this->new_group=$new_group;
        $this->student=$student;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $description=<<<TEXT
        {$this->student->name}  {$this->student->group->course->name} kursi {$this->student->group->name} guruhidan {$this->new_group->course->name} kursi {$this->new_group->name} guruhiga o'tdi
TEXT;
        \App\Models\StudentActivity::create(['student_id'=>$this->student->id, 'description'=>$description ]);
    }
}
