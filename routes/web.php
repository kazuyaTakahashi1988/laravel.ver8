<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ▽ ▽ ▽ Web Routes ▽ ▽ ▽
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\AnswerController;
/* ----------------------------------------
    ▽ ▽ ルートページ Routes ▽ ▽
----------------------------------------- */

Route::get('/', [PostController::class, 'home'])->name('home');

/* ----------------------------------------
    ▽ ▽ 記事 Routes ▽ ▽
----------------------------------------- */
Route::prefix('/posts')->group(function () {
    /* ▽ 記事一覧 ▽ */
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    /* ▽ カテゴリー一覧 ▽ */
    Route::get('/category/{id}', [PostController::class, 'category'])->name('posts.category');
    /* ▽ ユーザー一覧 ▽ */
    Route::get('/user/{id}', [PostController::class, 'user'])->name('posts.user');
    /* ▽ 新規投稿 ▽ */
    Route::get('/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
    /* ▽ 記事詳細 ▽ */
    Route::get('/{id}', [PostController::class, 'detail'])->name('posts.detail');
    /* ▽ ckeditor img UP ▽ */
    Route::post('ckeditor/upload', [PostController::class, 'ckeditor'])->name('ckeditor.upload');
    // Route::get('/update/{content_id}', [PostController::class, 'update'])->name('contents.update');
    // Route::get('/delete/{content_id}', [PostController::class, 'delete'])->name('contents.delete');
});
/* ----------------------------------------
    ▽ ▽ コメント投稿 Routes ▽ ▽
----------------------------------------- */
Route::prefix('/comments')->group(function () {
    Route::get('/create/{id}', [CommentController::class, 'create'])->name('comments.create')->middleware('auth');
    Route::post('/store', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
});
/* ----------------------------------------
    ▽ ▽ コメントリプライ投稿 Routes ▽ ▽
----------------------------------------- */
Route::prefix('/replies')->group(function () {
    Route::get('/create/{id}', [ReplyController::class, 'create'])->name('replies.create')->middleware('auth');
    Route::post('/store', [ReplyController::class, 'store'])->name('replies.store')->middleware('auth');
});
/* ----------------------------------------
    ▽ ▽ ベストアンサー選出 Routes ▽ ▽
----------------------------------------- */
Route::prefix('/answers')->group(function () {
    Route::get('/create', [AnswerController::class, 'create'])->name('answers.create')->middleware('auth');
    Route::post('/store', [AnswerController::class, 'store'])->name('answers.store')->middleware('auth');
});

/* ----------------------------------------
    ▽ ▽ auth:sanctum Routes ▽ ▽
----------------------------------------- */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
|  ▽ ▽ ▽ API Routes ▽ ▽ ▽
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\LikeController;
/* ----------------------------------------
    ▽ ▽ お気に入り Routes ▽ ▽
----------------------------------------- */

Route::get('/posts/like/{id}/', [LikeController::class, 'like']);
Route::get('/posts/unlike/{id}', [LikeController::class, 'unlike']);
Route::get('/likes', [LikeController::class, 'index'])->name('likes.index')->middleware('auth');
