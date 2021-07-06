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
        }else{
            $student=Student::findOrFail($id);
            $name=$student->name;
        }
        EventModel::create([
            'person_id'=>$id,
            'type'=>$type,
            'name'=>$name,
            'status'=>$status=='in'? 1 : 0,
            'time'=>$time,
        ]);
        $data=['type'=>$type, 'id'=>$id];
        event(new StudentStaffEvent($data));
        if($type=='staff'){
            return $this->sendResponse(new StaffResource($staff));
        }else{
            return $this->sendResponse(new StudentResource($student));
        }
        
    }
}
