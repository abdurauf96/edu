<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        $messages=Message::latest()->paginate(15);

        return view('school.messages.index', compact('messages'));
    }
}
