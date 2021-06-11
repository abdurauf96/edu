<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       
        $payments = Payment::latest()->get();
    
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $students=\App\Models\Student::all();
        $courses=\App\Models\Course::all();
        $groups=\App\Models\Group::all();
        return view('admin.payments.create', compact('courses', 'students', 'groups'));
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
			'student_id' => 'required',
			'course_id' => 'required',
			'group_id' => 'required',
			'month' => 'required',
			'amount' => 'required',
			'type' => 'required',
			'description' => 'required'
		]);
        $requestData = $request->all();
        
        Payment::create($requestData);

        return redirect('admin/payments')->with('flash_message', 'To`lov qo`shildi!');
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
        $payment = Payment::findOrFail($id);

        return view('admin.payments.show', compact('payment'));
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
        $payment = Payment::findOrFail($id);
        $students=\App\Models\Student::all();
        $courses=\App\Models\Course::all();
        $groups=\App\Models\Group::all();
        return view('admin.payments.edit', compact('payment', 'students', 'courses', 'groups'));
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
			'student_id' => 'required',
			'course_id' => 'required',
			'group_id' => 'required',
			'month' => 'required',
			'amount' => 'required',
			'type' => 'required',
			'description' => 'required'
		]);
        $requestData = $request->all();
        
        $payment = Payment::findOrFail($id);
        $payment->update($requestData);

        return redirect('admin/payments')->with('flash_message', 'To`lov yangilandi!');
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
        Payment::destroy($id);

        return redirect('admin/payments')->with('flash_message', 'To`lov o`chirib yuborildi!');
    }

    public function getGroups()
    {
        $course_id=$_POST['course_id'];
        $groups=\App\Models\Group::where('course_id', $course_id)->get();
        $res=view('admin.payments.ajax', compact('groups'));
        return $res;
    }
}
