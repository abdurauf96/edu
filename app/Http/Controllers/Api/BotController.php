<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Http\Resources\BotStudent as BotStudentResource;
use App\Models\Course;
use App\Models\BotStudent;
use Illuminate\Http\Request;

class BotController extends Controller
{
    /**
     *
     *
     * @OA\Get(
     *     path="/api/courses",
     *     summary="Get all courses",
     *     description="test description",
     *     tags={"Courses"},
     *     @OA\Response (
     *       response=404,
     *       description="not found"
     *      )
     * )
     */


    public function getCourses(){
        $course_name=request()->get('course_name');

        if($course_name){
            $course=Course::where('name', $course_name)->first();
            if($course){
                return response()->json(new CourseResource($course));
            }else{
                return response()->json("course not found");
            }
        }else{
            $courses=Course::where([
                'school_id'=> 1,
                'is_for_bot'=>true,
                'status'=>true
            ])->get();
            return response()->json(new CourseCollection($courses));
        }

    }

    public function getOneStudent(){
        $chat_id=request()->get('chat_id');
        if($chat_id){
            $student=BotStudent::where('chat_id', $chat_id)->first();
            return response()->json(new BotStudentResource($student));
        }

    }

    public function saveBotStudent(Request $request){
        $res=BotStudent::where('chat_id', $request->chat_id)->first();
        if($res){
            $res->update($request->all());
        }else{
            BotStudent::create($request->all());
        }
        return true;
    }
}
