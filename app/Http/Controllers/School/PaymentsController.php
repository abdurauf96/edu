<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    private $paymentRepo;
    private $studentRepo;
    
    public function __construct(PaymentRepositoryInterface $paymentRepo, StudentRepositoryInterface $studentRepo)
    {
        $this->paymentRepo=$paymentRepo;
        $this->studentRepo=$studentRepo;
    }

    public function index(Request $request)
    {
       
        $payments = $this->paymentRepo->getAll();
        return view('school.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $students=$this->studentRepo->getAll();
        $courses=\App\Models\Course::all();
        $groups=\App\Models\Group::all();
        $months=\App\Models\Month::all();
        return view('school.payments.create', compact('courses', 'students', 'groups', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PaymentRequest $request)
    {
        
        $this->paymentRepo->create($request);
        
        return redirect('school/payments')->with('flash_message', 'To`lov qo`shildi!');
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

        return view('school.payments.show', compact('payment'));
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
        $payment = $this->paymentRepo->findOne($id);
        $students=$this->studentRepo->getAll();
        $courses=\App\Models\Course::all();
        $groups=\App\Models\Group::all();
        $months=\App\Models\Month::all();
        return view('school.payments.edit', compact('payment', 'students', 'courses', 'groups', 'months'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PaymentRequest $request, $id)
    {
        $this->paymentRepo->update($request, $id);
        return redirect('school/payments')->with('flash_message', 'To`lov yangilandi!');
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

        return redirect('school/payments')->with('flash_message', 'To`lov o`chirib yuborildi!');
    }

    public function getGroups()
    {
        $course_id=$_POST['course_id'];
        $groups=\App\Models\Group::where('course_id', $course_id)->get();
        $res=view('school.payments.ajax', compact('groups'));
        return $res;
    }
}
