<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Event as EventModel;
use App\Events\StudentStaffEvent;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\Staff as StaffResource;

class EventsController extends BaseController
{
    public $model;

    /**
     * @OA\Get(
     *     path="/api/event/{type}/{id}/{time}",
     *     operationId="attandanceEvent",
     *     description="student and staff attandance",
     *     summary="student and staff attandance",
     *     tags={"Attandances"},
     *     @OA\Parameter(
     *          name="type",
     *          in="path",
     *          required=true,
     *          description="type should be 'staff' or 'student' ",
     *          example="student"
     *     ),
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="attandance person ID",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="time",
     *          in="path",
     *          required=true,
     *          description="attandance time",
     *          example="09:00"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Student or Staff not found "
     *     )
     * )
     *
     */
    public function event($type, $id, $time)
    {

        $model=$type=='staff' ? Staff::class : Student::class;
        $obj=$model::find($id);
        if(is_null($obj)){
            return response()->json('object not found')->setStatusCode(404);
        }

//        if($type=='student'){
//            $obj->test_status=1;
//            $obj->save();
//        }

        $lastEventStatus=$obj->getLastEventStatus();

        $status=$lastEventStatus==1 ? 0 : 1;
        $newRecord=[
            'person_id'=>$id,
            'type'=>$type,
            'name'=>$obj->name,
            'status'=>$status,
            'time'=>$time,
            'school_id'=>$obj->school_id,
            'organization_id'=>$obj->organization_id ?? null,
        ];

        EventModel::create($newRecord);
        $resource=$type=='staff' ? new StaffResource($obj) : new StudentResource($obj);

        $response = [
            'success' => true,
            'status'=>$status,
            'data'    => $resource,
        ];
        return response()->json($response);
    }
}
