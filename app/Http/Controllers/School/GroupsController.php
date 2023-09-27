<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\GroupRequest;
use App\Jobs\StudentRemoveDebtJob;
use App\Models\Group;
use App\Models\Room;
use App\Models\User;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Jobs\StudentFinishedCourseJob;

class GroupsController extends Controller
{
    public function index(Request $request): View
    {
        return view('school.groups.index');
    }

    public function create(): View
    {
        $courses = Course::school()->get();
        $teachers = Teacher::school()->whereStatus(1)->get();
        $rooms = Room::latest()->get();

        return view('school.groups.create', compact('courses', 'teachers','rooms'));
    }

    public function store(GroupRequest $request): RedirectResponse
    {
        $requestData = $request->all();
        Group::create($requestData);
        return redirect('school/groups')->with('flash_message', 'Guruh qo`shildi!');
    }

    public function show($id): View
    {
        $group = Group::withCourseName()->withTeacherName()->withRoomNumber()->findOrFail($id);

        return view('school.groups.show', compact('group'));
    }

    public function edit($id): View
    {
        $group = Group::findOrFail($id);
        $courses = Course::school()->get();
        $teachers = Teacher::school()->whereStatus(1)->get();
        $rooms = Room::latest()->get();

        return view('school.groups.edit', compact('group', 'courses', 'teachers', 'rooms'));
    }

    public function update(GroupRequest $request, $id): RedirectResponse
    {
        $group = Group::findOrFail($id);
        if($request->last_month_debt){
            dispatch(new StudentRemoveDebtJob($group, $request->last_month_debt));
        }
        if($request->status==Group::GRADUATED){
            dispatch(new StudentFinishedCourseJob($group, $request->end_date));
        }
        $requestData = $request->all();
        $group->update($requestData);
        return redirect('school/groups')->with('flash_message', 'Guruh yangilandi!');
    }

    public function destroy($id): RedirectResponse
    {
        Group::destroy($id);

        return redirect('school/groups')->with('flash_message', 'Guruh o`chirib yuborildi!');
    }

    public function selectManagers(Request $request): RedirectResponse|View
    {
        if($request->isMethod('post')){
            Group::findOrFail($request->group_id)->update(['user_id'=>auth()->guard('user')->id()]);
            return back()->with('flash_message', 'Guruh '.auth()->guard('user')->user()->name.'ga biriktirildi !');
        }

        $groups=Group::school()->with('course')->type('active')->whereNull('user_id')->get();

        $managers = User::role('manager')
            ->withCount(['groups', 'students'])
            ->get();

        return view('school.groups.select-managers', compact('groups', 'managers'));

    }
}
