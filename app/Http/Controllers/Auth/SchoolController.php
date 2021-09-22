<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
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
        $data['password']=\Hash::make($request->password);
        $school=School::create($data);
        return redirect('/')->with('msg', 'Murojatingiz qoldirildi! Iltimos tasdiqlanishini kuting...');
        
    }

    public function login(LoginRequest $request)
    {

        $request->userAuthenticate();

        $request->session()->regenerate();

        return redirect(RouteServiceProvider::SCHOOL_HOME);
    }

    public function destroy(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
