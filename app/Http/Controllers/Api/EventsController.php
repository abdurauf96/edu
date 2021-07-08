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

        $status=$status=='in' ? 1 : 0;
        $newRecord=[
            'person_id'=>$id,
            'type'=>$type,
            'name'=>$name,
            'status'=>$status,
            'time'=>$time,
        ];
        $event=EventModel::where(['type'=>$type, 'person_id'=>$id])->latest()->first();
        if($event){
            if($event->status!=$status){
                EventModel::create($newRecord);
                $data=['type'=>$type, 'id'=>$id];
                event(new StudentStaffEvent($data));
            }else{
                return response()->json(['success'=>false]);
            }
        }else{
            EventModel::create($newRecord);
        }
        
        return response()->json(['success'=>true]);
        
    }
}
