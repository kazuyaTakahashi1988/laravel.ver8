<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReplyRequest; /* バリデーション */
use App\Models\Reply;
use App\Models\Post;
use Carbon\Carbon;

class ReplyController extends Controller
{

    /* ------------------------------------ 
        ▽ コメントリプライ投稿 ▽
    ------------------------------------ */
    public function create($id, Request $request)
    {
        return view('replies.create', [
            'comment_id' => $id,
            'post_id' => $request->post_id
        ]);
    }
    public function store(ReplyRequest $request)
    {

        $reply = new Reply;
        $reply->reply = $request->reply;
        $reply->comment_id = $request->comment_id;
        $reply->user_id = \Auth::user()->id;
        $reply->save();
        return redirect('/posts/' . $request->post_id);

        // $post = Post::findOrFail($request->post_id);
        // $now = new Carbon();
        // $created =  new Carbon($post->created_at);
        // $limit =  $created->addMinutes(5);
        // $timeG = $now->gte($limit);
        // if (!$timeG) {
        // } else {
        //     return redirect('/posts/');
        // }
    }
}
