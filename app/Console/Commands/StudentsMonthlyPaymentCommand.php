<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;

class StudentsMonthlyPaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Students monthly payment command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$groups=\App\Models\Group::whereDate('end_date', '>', date('Y-m-d'))->get();
        $students=Student::active()->get();

            foreach ($students as $student) {
                if($student->group->course_id==16){ // 16 - comp savodxonligi
                    continue;
                }
                $student->debt+= $student->getPriceMonth();
                $student->save();
            }

        \Log::info("oquvchilarga oylik tolov yozildi");
        return Command::SUCCESS;
    }
}
