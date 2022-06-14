<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest; /* バリデーション */
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class PostController extends Controller
{
    /* ------------------------------------ 
        ▽ 記事一覧 ▽
    ------------------------------------ */
    public function home()
    {
        $posts = Post::latest()->paginate(10);
        $posts->load('category', 'user');
        return view('home', [
            'posts' => $posts
        ]);
    }
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        $posts->load('category', 'user');
        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    /* ------------------------------------ 
        ▽ カテゴリー一覧 ▽
    ------------------------------------ */
    public function category($id)
    {
        $posts = Post::latest()->where('category_id', $id)->paginate(10);
        $category = Category::where('id', $id)->get();
        $posts->load('category', 'user');
        return view('posts.index', [
            'posts' => $posts,
            'categoryName' => $category[0]['category_name']
        ]);
    }
    /* ------------------------------------ 
        ▽ ユーザー一覧 ▽
    ------------------------------------ */
    public function user($id)
    {
        $posts = Post::latest()->where('user_id', $id)->paginate(10);
        $user = User::where('id', $id)->get();
        $posts->load('category', 'user');
        return view('posts.index', [
            'posts' => $posts,
            'userName' => $user[0]['name']
        ]);
    }
    /* ------------------------------------ 
        ▽ 新規投稿 ▽
    ------------------------------------ */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', [
            'categories' => $categories
        ]);
    }
    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->user_id = \Auth::user()->id;
        /* ▽ 画像が正常にアップされてる際の処理 ▽ */
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filename = $request->file('image')->store('public/image');
            $post->image = basename($filename);
            // php artisan storage:link でファイル格納場所を作っておく
        } else {
            $post->image = false;
        }
        $post->save();
        return redirect('/posts/' . $post->id);
    }
    /* ------------------------------------ 
        ▽ 記事詳細 ▽
    ------------------------------------ */
    public function detail($id)
    {
        $post = Post::findOrFail($id);
        $post->load('category', 'user', 'likes', 'answer');
        $comments = Comment::latest()->where('post_id', $id)->paginate(10);
        $comments->load('user', 'reply');
        $defaultCount = count($post->likes);
        $userAuth = \Auth::user();
        if (isset($userAuth)) {
            $defaultLiked = $post->likes->where('user_id', $userAuth->id)->first();
        } else {
            $defaultLiked = false;
        }

        $now = new Carbon();
        $created =  new Carbon($post->created_at);
        $limit =  $created->addMinutes(5);
        $timeG = $now->gte($limit);

        return view('posts.detail', [
            'post' => $post,
            'comments' => $comments,
            'defaultCount' => $defaultCount,
            'defaultLiked' => $defaultLiked,
            'userAuth' => $userAuth,
            'now' => $now,
            'limit' => $limit,
            'timeG' => $timeG,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
