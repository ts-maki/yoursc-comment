<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }

    public function create($user_id)
    {
        return view('post.create')->with('user_id', $user_id);
    }

    public function store(Request $request, $user_id)
    {
        dd($request);
        $post = Post::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'comment' => $request->comment
        ]);
        
        return back()->with('message', '投稿を保存しました');
    }
}
