<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function index()
    {
        $likes = Like::latest()->where('user_id', \Auth::user()->id)->paginate(10);
        $likes->load('post');

        return view('likes.index', [
            'likes' => $likes,
        ]);
    }
    public function like($id)
    {
        $user_id = \Auth::user()->id;
        Like::create(['post_id' => $id, 'user_id' => $user_id]);
        $likeCount = count(Like::where('post_id', $id)->get());
        return response()->json(['likeCount' => $likeCount]);
    }
    public function unlike($id)
    {
        $user_id = \Auth::user()->id;
        $like = Like::where('user_id', $user_id)->where('post_id', $id)->first();
        $like->delete();
        $likeCount = count(Like::where('post_id', $id)->get());
        return response()->json(['likeCount' => $likeCount]);
    }
}
