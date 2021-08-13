<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Student;

class StudentLoginController extends BaseController
{
    public function login(Request $request)
    {
        
        $request->validate([
            'username'=>'required',
            'password'=>'required' 
        ]);
      
        if (Auth::guard('student')->attempt(['username' => $request->username, 'password' => $request->password])) {
            $success['username']=auth()->guard('student')->user()->name;
            $success['token']=auth()->guard('student')->user()->createToken('Laravel')->accessToken;
            return response()->json($success);
        }else{
            return $this->sendError('username or password wrong');
        }
    }
}
