<?php

namespace App\Jobs;

use App\Models\StudentActivity;
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
    protected $debt;
    public function __construct($student,$debt)
    {
        $this->student=$student;
        $this->debt=$debt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->student->update(['debt'=>$this->debt]);
        StudentActivity::create(['student_id'=>$this->student->id, 'description'=>'O\'qishni boshlagani uchun '.$this->debt.' so`m qarz yozildi !']);
    }
}
