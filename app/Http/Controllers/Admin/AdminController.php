<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends Controller
{
    public function dashboard()
    {
        $students = Student::selectRaw('count(*) as total')
            ->selectRaw("count(case when status='".Student::ACTIVE."' then 1 end) as active")
            ->selectRaw("count(case when status='".Student::GRADUATED."' then 1 end) as graduated")
            ->selectRaw("count(case when status='".Student::OUT."' then 1 end) as outed")
            ->first();

        $schools=School::withCount(['students', 'students as active_students_count'=> function($query){
            $query->active();
        },'students as graduated_students_count'=> function($query){
            $query->graduated();
        },'students as outed_students_count'=> function($query){
                $query->out();
        }])->get();

        $districts=District::withCount('schools')->get();
        return view('admin.dashboard', compact( 'students','schools','districts'));

    }

    public function sertificat($id)
    {
        $student=Student::findOrFail($id);
        if(request()->isMethod('get')){
            return view('admin.students.sertificat', compact('student'));
        }else{

            if(request()->hasFile('sertificat_file')){
                $file=request()->file('sertificat_file');
                $filename=time().'-'.$file->getClientOriginalName();
                $file->move('admin/sertificats/', $filename);
                $student->sertificat_file=$filename;
            }
            $student->sertificat_status=1;
            $student->sertificat_id=request()->sertificat_id;
            $student->sertificat_date=request()->sertificat_date;
            $student->save();

            return redirect()->route('admin.students');
        }
    }
}
