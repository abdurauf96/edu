<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\WaitingStudent;
use App\Models\District;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WaitingStudentsController extends Controller
{
    public function index(Request $request): View
    {
        $courses=Course::school()->withCount('waitingStudents')->get();
        $all=WaitingStudent::school()->get()->count();

        return view('school.waiting-students.index', compact('courses', 'all'));
    }

    public function create(): View
    {
        $courses=Course::school()->get();
        $districts=District::all();

        return view('school.waiting-students.create', compact('courses', 'districts'));
    }

    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->all();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time() . $file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image'] = $image;
        }
        WaitingStudent::create($requestData);

        return redirect('school/waiting-students')->with('flash_message', 'O`quvchi qo`shildi!');
    }

    public function show($id): View
    {
        $waitingstudent = WaitingStudent::with('course')->findOrFail($id);

        return view('school.waiting-students.show', compact('waitingstudent'));
    }

    public function edit($id): View
    {
        $waitingstudent = WaitingStudent::findOrFail($id);
        $courses=Course::school()->get();
        $districts=District::all();

        return view('school.waiting-students.edit', compact('waitingstudent', 'courses', 'districts'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $requestData = $request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;
        }
        $waitingstudent = WaitingStudent::findOrFail($id);
        $waitingstudent->update($requestData);

        return redirect('school/waiting-students')->with('flash_message', 'O`quvchi yangilandi!');
    }

    public function destroy($id): RedirectResponse
    {
        WaitingStudent::destroy($id);

        return redirect('school/waiting-students')->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

    public function archive(): View
    {
        return view('school.waiting-students.archive');
    }
}
