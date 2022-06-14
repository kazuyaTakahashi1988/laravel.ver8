<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function create(Request $request)
    {
        $post_id = $request->post_id;
        $comment_id = $request->comment_id;
        $comment = $request->comment;
        $user = $request->user;

        return view('answers.create', [
            'post_id' => $post_id,
            'comment_id' => $comment_id,
            'comment' => $comment,
            'user' => $user
        ]);
    }
    public function store(Request $request)
    {
        $answer = new Answer;

        $answer->comment_id = $request->comment_id;
        $answer->post_id = $request->post_id;
        
        $answer->save();

        return redirect('/posts/'.$answer->post_id);
    }
}
