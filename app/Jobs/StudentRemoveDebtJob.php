<?php

namespace App\Jobs;

use App\Models\StudentActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentRemoveDebtJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $group;
    protected $summa;
    public function __construct($group, $summa)
    {
        $this->group=$group;
        $this->summa=$summa;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->group->students as $student){
            $student->debt-=$this->summa;
            $student->save();
            StudentActivity::create(['student_id'=>$student->id, 'description'=>'Kursni bitirgani uchun '.$this->summa.' so`m qarzidan ayrildi !']);
        }
    }
}
