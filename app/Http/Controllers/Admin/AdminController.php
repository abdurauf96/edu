<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Group;
use App\Services\DashboardService;

class AdminController extends Controller
{
    public function __construct(public DashboardService $statService) {}

    public function dashboard()
    {
        $students = $this->statService->getAllStudentsStatistics();
        $groups_qty=count(Group::all());

        $schools=$this->statService->getSchoolStatistics();

        $districts=District::withCount('schools')->get();
        return view('admin.dashboard', compact( 'students','schools','districts','groups_qty'));
    }
}
