<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest; /* バリデーション */
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

class CommentController extends Controller
{

    /* ------------------------------------ 
        ▽ コメント投稿 ▽
    ------------------------------------ */
    public function create($id)
    {
        return view('comments.create', [
            'post_id' => $id
        ]);
    }
    public function store(CommentRequest $request)
    {

        $post = Post::findOrFail($request->post_id);
        $now = new Carbon();
        $created =  new Carbon($post->created_at);
        // $limit =  $created->addMinutes(5);
        $limit =  $created->addDays(7);
        $timeG = $now->gte($limit);
        if (!$timeG) {
            $comment = new Comment;
            $comment->comment = $request->comment;
            $comment->post_id = $request->post_id;
            $comment->user_id = \Auth::user()->id;
            $comment->save();
            return redirect('/posts/' . $comment->post_id);
        } else {
            return redirect('/posts/');
        }
    }
}
