<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CoursePlans;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentFullInfo;
use App\Http\Resources\StudentPaymentHistory;
use App\Http\Requests\UpdateStudentRequest;
use Hash;
class StudentController extends BaseController
{
    /**
     *
     * @OA\Get(
     *     path="/api/student/fullinfo",
     *     operationId="getStudentFullInfo",
     *     summary="get all information about student",
     *     description="get data about student with bearer token",
     *     tags={"Student"},
     *     security={ {"bearer_token":{} }},
     *
     *     @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="data", type="object", ref="#/components/schemas/Student"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *     )
     * )
     *
     */

    public function studentFullInfo(Request $request)
    {
        return $this->sendResponse(new StudentFullInfo($request->user()));
    }

    /**
     *
     * @OA\Get(
     *     path="/api/student/payments",
     *     operationId="getStudentPayments",
     *     summary="get student payments for courses",
     *     description="get student payments with bearer token",
     *     tags={"Student"},
     *     security={ {"bearer_token":{} }},
     *
     *     @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="data", type="object", @OA\Property(property="payment_history", type="array", collectionFormat="multi", @OA\Items(type="object", ref="#/components/schemas/StudentPaymentHistory") )),
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *     )
     * )
     *
     */

    public function getStudentPayments(Request $request)
    {
        $student=$request->user();
        $histories=[];
        foreach ($student->payments as $payment) {
            $history=new StudentPaymentHistory($payment);
            array_push($histories, $history);
        }

        $data=[
            'payment_history'=>$histories
        ];

        return $this->sendResponse($data);
    }

    /**
     *
     *  @OA\Get(
     *      path="/api/student/{id}",
     *      operationId="getStudent",
     *      description="get student",
     *      summary="get student info",
     *      tags={"Student"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="student id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Student not found"
     *     ),
     * )
     */
    public function getStudent($id)
    {
        $student=Student::with('group')->findOrFail($id);
        return $this->sendResponse(new StudentResource($student));
    }

    /**
     *
     * @OA\Get(
     *     path="/api/student/events",
     *     operationId="getStudentEvents",
     *     summary="get student attandances",
     *     description="student attandances",
     *     tags={"Student"},
     *     security={ {"bearer_token":{} }},
     *
     *     @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="data", type="object"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *     )
     * )
     *
     */
    public function getStudentEvents()
    {
        $student=request()->user();
        $events=[];
        foreach ($student->events as $event) {
            $data=[
                'event'=>$event->status==1 ? 'Kirib kelgan' : 'Chiqib ketgan',
                'time'=>$event->time,
                'date'=>$event->created_at->format('d-m-Y')
            ];
            array_push($events, $data);
        }
        return $this->sendResponse($events);
    }


    /**
     * @OA\Post(
     *     path="/api/student/update-info",
     *     operationId="updateStudentInfo",
     *     summary="update student information",
     *     description="update student information",
     *     tags={"Student"},
     *     security={ {"bearer_token":{} }},
     *     @OA\RequestBody(
     *          required=true,
     *          description="fill in the required fields",
     *          @OA\JsonContent(
     *              required={"name", "phone"},
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="year", type="date"),
     *              @OA\Property(property="address", type="string"),
     *              @OA\Property(property="passport", type="string"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="data", type="string"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *     )
     * )
     */
    public function updateInfo(UpdateStudentRequest $request)
    {
        $student=request()->user();
        $requestData=$request->all();
        $student->update($requestData);
        return $this->sendResponse('updated successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/student/update-image",
     *     operationId="updateStudentImage",
     *     summary="update student image",
     *     description="update student image",
     *     tags={"Student"},
     *     security={ {"bearer_token":{} }},
     *     @OA\RequestBody(
     *          required=true,
     *          description="upload image",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(property="image", description="upload image", type="file"),
     *              ),
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="data", type="string"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *     )
     * )
     */
    public function updateImage(Request $request)
    {
        $student=request()->user();

        $request->validate(['image'=>'required|file']);

        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/students';
            $file->move($path, $image);
            $student->update(['image'=>$image]);
            return $this->sendResponse('successfully updated');
        }

    }


    /**
     * @OA\Post(
     *     path="/api/student/update-password",
     *     operationId="updateStudentPassword",
     *     summary="update student password",
     *     description="update student password",
     *     tags={"Student"},
     *     security={ {"bearer_token":{} }},
     *     @OA\RequestBody(
     *          required=true,
     *          description="fill in the required fields",
     *          @OA\JsonContent(
     *              required={"name", "phone"},
     *              @OA\Property(property="old_password", type="string", format="password"),
     *              @OA\Property(property="password", type="string", format="password"),
     *              @OA\Property(property="password_confirmation", type="string", format="password"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="data", type="string"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *     )
     * )
     */
    public function updatePassword(Request $request)
    {
        $student=request()->user();
        $request->validate([
            'old_password'=>'required',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if(!Hash::check($request->old_password, $student->password)){
            return $this->sendError('something is wrong', [], 422);
        }

        $student->update(['password'=>Hash::make($request->password)]);
        return $this->sendResponse('password updated');
    }


    /**
     * @OA\Get(
     *     path="/api/student/{id}/plans",
     *     operationId="getCoursePlans",
     *     description="get student course plans",
     *     summary="get student course plans",
     *     tags={"Student"},
     *     @OA\Parameter(
     *         name="id",
     *         description="student id",
     *         required=true,
     *         in="path",
     *         example="1011",
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean"),
     *              @OA\Property(property="data", ref="#/components/schemas/CoursePlan"),
     *          ),
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Student not found",
     *     )
     * )
     *
     */
    public function coursePlans($id)
    {
        $student=Student::find($id);
        if(!$student){
            return $this->sendError('student not found');
        }
        return $this->sendResponse(CoursePlans::collection($student->course()->plans));
    }

}
