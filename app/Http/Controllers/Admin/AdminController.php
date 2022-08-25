<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $number_schools=School::all()->count();
        $number_students=Student::all()->count();

        return view('admin.dashboard', compact('number_schools', 'number_students'));

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
            $student->sertificat_date=request()->sertificate_date;
            $student->save();
            return redirect()->route('admin.students');
        }
    }
}
