<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', function () {
    return view('welcome');
});

//投稿一覧
Route::get('index', [PostController::class, 'index'])->name('post.index');
//新規投稿
Route::get('/post/create/{user_id}', [PostController::class, 'create'])->name('post.create');
Route::post('/post/{user_id}', [PostController::class, 'store'])->name('post.store');
//投稿詳細e
Route::get('/post/{post_id}', [PostController::class, 'show'])->name('post.show');
//投稿編集
Route::get('/post/edit/{post_id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/edit/{post_id}', [PostController::class, 'update'])->name('post.update');
//投稿削除
Route::delete('/post/delete/{post_id}', [PostController::class, 'destroy'])->name('post.delete');
//返信作成
Route::get('/post/comment/{post_id}', [CommentController::class, 'create'])->name('post.comment');
//返信投稿
Route::post('/post/comment/{post_id}', [CommentController::class, 'store'])->name('comment.store');
//返信編集
Route::get('/comment/edit/{comment_id}', [CommentController::class, 'edit'])->name('comment.edit');
Route::put('/comment/edit/{comment_id}', [CommentController::class, 'update'])->name('comment.update');
//返信削除
Route::delete('/comment/edit/{comment_id}', [CommentController::class, 'destroy'])->name('comment.delete');
//いいね登録
Route::post('/post/like/{post_id}', [LikeController::class, 'store'])->name('like.store');

Route::get('/bootstrap', function () {
    return view('bootstrap');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
