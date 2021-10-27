<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function showLoginForm(){
        return view('auth.teacher.login');
    }

    public function login(LoginRequest $request){

        $request->teacherAuthenticate();

        $request->session()->regenerate();

        return redirect(RouteServiceProvider::TEACHER_HOME);

    }

    public function destroy(Request $request)
    {
        Auth::guard('teacher')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
