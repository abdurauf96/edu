<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\GroupRequest;
use App\Jobs\StudentRemoveDebtJob;
use App\Models\Group;
use App\Models\User;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Jobs\StudentFinishedCourseJob;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */


    public function index(Request $request)
    {
        return view('school.groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courses = Course::school()->get();
        $teachers = Teacher::school()->whereStatus(1)->get();
        return view('school.groups.create', compact('courses', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(GroupRequest $request)
    {
        $requestData = $request->all();
        Group::create($requestData);
        return redirect('school/groups')->with('flash_message', 'Guruh qo`shildi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $group = Group::withCourseName()->withTeacherName()->findOrFail($id);
        return view('school.groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $courses = Course::school()->get();
        $teachers = Teacher::school()->whereStatus(1)->get();
        return view('school.groups.edit', compact('group', 'courses', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(GroupRequest $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Group::destroy($id);

        return redirect('school/groups')->with('flash_message', 'Guruh o`chirib yuborildi!');
    }

    public function selectManagers(Request $request)
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
