<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Auth;
class StudentController extends Controller
{
    public function showLoginForm(){
        return view('auth.student.login');
    }

    public function login(Request $request){
        
        $student=Student::where('username', $request->username)->first();
        Auth::guard('student')->login($student);
       
        return redirect(RouteServiceProvider::STUDENT_HOME);

    }

    public function destroy(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
