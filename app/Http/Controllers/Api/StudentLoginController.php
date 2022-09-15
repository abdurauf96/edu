<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Student;
use Validator;

class StudentLoginController extends BaseController
{
    /**
     *   @OA\Post(
     *   path="/api/student/login",
     *   summary="Login student",
     *   description="Login by id and password",
     *   operationId="studentLogin",
     *   tags={"Authentification"},
     *      @OA\RequestBody(
     *      required=true,
     *      description="pass student id and password",
     *         @OA\JsonContent(
     *             required={"id", "password"},
     *              @OA\Property(
     *                  property="id", type="integer", example=986
     *              ),
     *              @OA\Property( property="password", type="string", example="12345678" ),
     *          ) ,
     *      ),
     *      @OA\Response(
     *        response=404,
     *        description="Not found data",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Sorry, student not found"),
     *          )
     *      ),
     *     @OA\Response(
     *        response=422,
     *        description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sorry, wrong id or password. Please try again")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="data", type="object", collectionFormat="multi",
     *                  @OA\Property(property="username", type="string", example="John Doe"),
     *                  @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZTczMmI2NjJmMGUwM"),
     *              ),
     *          ),
     *      )
     *
     *   )
     */

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'=>'required|integer',
            'password'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }



        if (Auth::guard('student')->attempt(['id' => $request->id, 'password' => $request->password])) {
            $success['username']=auth()->guard('student')->user()->name;
            $success['token']=auth()->guard('student')->user()->createToken('Laravel')->accessToken;
            return $this->sendResponse($success);
        }else{
            return $this->sendError('Sorry, student not found', [], 404);
        }
    }
}
