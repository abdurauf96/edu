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
        $students = $this->statService->getAllStudentsStatistics();
        $groups_qty=count(Group::all());

        $schools=$this->statService->getSchoolStatistics();

        $districts=District::withCount('schools')->get();
        return view('admin.dashboard', compact( 'students','schools','districts','groups_qty'));
    }
}
