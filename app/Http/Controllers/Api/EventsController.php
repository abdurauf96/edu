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
    public function event($type, $id, $status, $time)
    {

        if($type=='staff'){
            $staff=Staff::findOrFail($id);
            $name=$staff->name;
            $school_id=$staff->school_id;
            $resource=new StaffResource($staff);
        }else{
            $student=Student::findOrFail($id);
            $name=$student->name;
            $school_id=$student->school_id;
            $resource=new StudentResource($student);
        }

        $status=$status=='in' ? 1 : 0;
        $newRecord=[
            'person_id'=>$id,
            'type'=>$type,
            'name'=>$name,
            'status'=>$status,
            'time'=>$time,
            'school_id'=>$school_id,
        ];
        $data=['type'=>$type, 'id'=>$id];
        $event=EventModel::where(['type'=>$type, 'person_id'=>$id])->latest()->first();

        if($event){
            if($event->status!=$status){

                EventModel::create($newRecord);
                event(new StudentStaffEvent($data));
                return $this->sendResponse($resource);
            }else{
                return response()->json(['success'=>false, 'data'=>$resource]);
            }
        }else {

            EventModel::create($newRecord);

            event(new StudentStaffEvent($data));
            return $this->sendResponse($resource);
        }

    }
}
