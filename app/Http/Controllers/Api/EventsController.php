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
    public function event($type, $id, $time)
    {
        // if($type=='staff'){
        //     $this->model=St
        // }
        $model=$type=='staff' ? Staff::class : Student::class;

       
            $obj=$model::findOrFail($id);
            
            $name=$obj->name;
            $school_id=$obj->school_id;
            $organization_id=$obj->organization_id ?? null;
            $lastEventStatus=$obj->getLastEventStatus();
            //return $obj->getLastEventStatus();
            $resource=$type=='staff' ? new StaffResource($obj) : new StudentResource($obj);
       //}else{
            //$student=Student::findOrFail($id);
            //$school_id=$student->school_id;
            //$name=$student->name;
            //$lastEventStatus=$student->getLastEventStatus();
            //$resource=new StudentResource($student);
        //}

        $status=$lastEventStatus==1 ? 0 : 1;
        $newRecord=[
            'person_id'=>$id,
            'type'=>$type,
            'name'=>$name,
            'status'=>$status,
            'time'=>$time,
            'school_id'=>$school_id,
            'organization_id'=>$organization_id,
        ];
        //$data=['type'=>$type, 'id'=>$id];
        //$event=EventModel::where(['type'=>$type, 'person_id'=>$id])->latest()->first();

        // if($event){
        //     if($event->status!=$status){

        //         EventModel::create($newRecord);
        //         event(new StudentStaffEvent($data));
        //         return $this->sendResponse($resource);
        //     }else{
        //         return response()->json(['success'=>false, 'data'=>$resource]);
        //     }
        // }else {

        EventModel::create($newRecord);
           //event(new StudentStaffEvent($data));
        return $this->sendResponse($resource,$status);
        //}

    }
}
