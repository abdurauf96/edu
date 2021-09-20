<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\School;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterSchoolRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class SchoolController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.school.register');
    }

    public function showLoginForm()
    {
        return view('auth.school.login');
    }

    public function register(RegisterSchoolRequest $request)
    {
        $data=$request->all();
        $data['password']=Hash::make($data['password']);
        $school=School::create($data);
        
        Auth::guard('school')->attempt(['email' => $request->email, 'password' => $request->password]);
        return redirect(RouteServiceProvider::SCHOOL_HOME);
        
    }

    public function login(LoginRequest $request)
    {

        // if(Auth::guard('school')->attempt(['email' => $request->email, 'password' => $request->password])){
        //     return redirect()->route('school.dashboard');
        // }else{
        //     abort(403);
        // }

        $request->schoolAuthenticate();

        $request->session()->regenerate();

        return redirect(RouteServiceProvider::SCHOOL_HOME);
    }

    public function destroy(Request $request)
    {
        Auth::guard('school')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
