<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function commentstuden(Student $id)
    {
        $user = Auth::user();
        // foreach ($id->comments() as $comment) {
        //     echo $comment->body . '<br>';
        // }
        // dd($id->comments()->user->name);
        return view('school.students.comments.index', ['student' => $id, 'user' => $user]);
    }
    public function sendcomment(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'user_id' => 'required',
            'body' => 'required',
        ]);

        $models = new Comments();
        $models->student_id = $request->student_id;
        $models->user_id = $request->user_id;
        $models->body = $request->body;
        $models->save();
        return redirect()->back()->with('text', 'Malumot qo`shildi');
    }
}
