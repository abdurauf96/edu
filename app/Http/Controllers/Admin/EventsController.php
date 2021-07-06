<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function events()
    {
        $events=\App\Models\Event::latest()->get();
        return view('admin.events.events', compact('events'));
    }
}
