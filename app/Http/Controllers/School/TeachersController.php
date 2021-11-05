<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TeacherRepositoryInterface;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public $teacherRepo;

    public function __construct(TeacherRepositoryInterface $teacherRepo)
    {
        $this->teacherRepo=$teacherRepo;
    }

    public function index(Request $request)
    {
        $teachers=Teacher::school()->get();

        return view('school.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courses = Course::school()->latest()->get();
        return view('school.teachers.create', compact('courses'));
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
			'course_id' => 'required',
			'phone' => 'required',
            'passport'=>'required',
            'birthday'=>'required',
		]);

        $this->teacherRepo->store($request->all());

        return redirect('school/teachers')->with('flash_message', 'O`qituvchi qo`shildi!');
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
        $teacher = Teacher::findOrFail($id);

        return view('school.teachers.show', compact('teacher'));
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
        $teacher = Teacher::findOrFail($id);
        $course_ids=$teacher->courses->pluck('id')->toArray();
        $courses = Course::school()->latest()->get();
        return view('school.teachers.edit', compact('teacher', 'courses', 'course_ids'));
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
            'course_id' => 'required',
            'phone' => 'required',
            'passport'=>'required',
            'birthday'=>'required',
        ]);
        $this->teacherRepo->update($id, $request->all());


        return redirect('school/teachers')->with('flash_message', 'O`qituvchi yangilandi!');
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
        Teacher::destroy($id);

        return redirect('school/teachers')->with('flash_message', 'O`qituvchi o`chirib yuborildi!');
    }
}
