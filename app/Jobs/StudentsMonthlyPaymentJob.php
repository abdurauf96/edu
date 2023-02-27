<?php

namespace App\Jobs;

use App\Models\StudentActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;


class StudentsMonthlyPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $students;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($students)
    {
        $this->students=$students;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            foreach($this->students as $student){
                $student->debt += $student->getPriceMonth();
                $student->save();
                StudentActivity::create(['student_id'=>$student->id, 'description'=>$student->getPriceMonth().' so`m oylik to`lov yozildi !']);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
