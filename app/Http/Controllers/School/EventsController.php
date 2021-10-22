<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function events()
    {
        //$events=\App\Models\Event::school()->latest()->get();
        return view('school.events.events');
    }
    public function filter(Request $request){
        dd($request->all());
    }
}
