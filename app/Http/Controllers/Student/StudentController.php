<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function redirectToPaymentSystem(Request $request)
    {
        $paysys=$request->paysys;
        $amount=$request->amount;
        $key=auth()->user()->id;
       
        return redirect('/pay/'.$paysys.'/'.$key.'/'.$amount);
    }
}
