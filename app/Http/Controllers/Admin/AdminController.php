<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Group;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends Controller
{
    public $statService;

    public function __construct(DashboardService $statService)
    {
        $this->statService=$statService;
    }

    public function dashboard()
    {
        if(auth()->user()->hasRole('xtb')){

            $students=$this->statService->getSchoolStudentsStatistics();
            $groups_qty=$this->statService->getQuantityGroups();

        }else{
            $students = $this->statService->getAllStudentsStatistics();
            $groups_qty=count(Group::all());
        }

        $schools=$this->statService->getSchoolStatistics();

        $districts=District::withCount('schools')->get();
        return view('admin.dashboard', compact( 'students','schools','districts','groups_qty'));

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

            return redirect()->route('admin.sertificats');
        }
    }
}
