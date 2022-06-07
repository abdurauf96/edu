<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Group;
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
        $year=$request->year;
        $type=$request->type;
        
        $groups = Group::school()
        ->type($request->type)
        ->orderBy('status')
        ->latest()
        ->when($year, function($query) use ($year){
            $query->where('year', $year);
        })
        ->get();
        return view('school.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courses = Course::school()->get();
        $teachers = Teacher::school()->get();
        return view('school.groups.create', compact('courses', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'teacher_id' => 'required',
			'course_id' => 'required',
			'duration' => 'required'
		]);
        $requestData = $request->all();

        Group::create($requestData);

        return redirect('school/groups?year='.date('Y'))->with('flash_message', 'Guruh qo`shildi!');
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
        $group = Group::findOrFail($id);

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
        $teachers = Teacher::school()->get();
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required',
			'teacher_id' => 'required',
			'course_id' => 'required',
			'duration' => 'required'
		]);
        $group = Group::findOrFail($id);
        if($request->status==2 && $group->status!=$request->status){  
            dispatch(new StudentFinishedCourseJob($group,$request->end_date)); //if group finished course calculate debt students
        }
        $requestData = $request->all();
        $group->update($requestData);
        return redirect('school/groups?year='.date('Y'))->with('flash_message', 'Guruh yangilandi!');
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

        return redirect('school/groups?year='.date('Y'))->with('flash_message', 'Guruh o`chirib yuborildi!');
    }
}
