<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
//    public function register(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//            'email' => 'required|email',
//            'password' => 'required|confirmed',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError('Validation Error.', $validator->errors());
//        }
//
//        $data=$request->all();
//        $data['password']=bcrypt($data['password']);
//        $user=User::create($data);
//        $success['token']=$user->createToken('Laravel')->accessToken;
//        $success['name']=$user->name;
//        return $this->sendResponse($success);
//    }
//
//    public function login(Request $request)
//    {
//        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
//            $success['token']=auth()->user()->createToken('Laravel')->accessToken;
//            $success['name']=auth()->user()->name;
//            return $this->sendResponse($success);
//        }else{
//            return $this->sendError('Unauthorised', ['error'=>'Unauthorised']);
//        }
//    }
}
