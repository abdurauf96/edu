<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
    public function events()
    {
        return view('school.events.events');
    }


    public function userEvents($type, $id){

        $events=Event::where('type', $type)->select('time', 'created_at', 'status','name')->where('person_id', $id)->get();
        $res['events']=[];

        foreach($events as $e){
            if($e->status==0){
                $data=['start'=> $e->created_at->format('Y-m-d'), 'end'=>$e->created_at->format('Y-m-d'), 'title'=>"Ketgan vaqti: ".$e->time, 'backgroundColor'=>'#f00'];
            }else{
                $data=['start'=> $e->created_at->format('Y-m-d'), 'end'=>$e->created_at->format('Y-m-d'), 'title'=>"Kelgan vaqti: ".$e->time, 'backgroundColor'=>'#00f'];
            }
            array_push($res['events'], $data);
        }

        $res['name']=$events[0]['name'] ?? null;

        return view('school.events.userEvents', compact('res'));
    }
}
