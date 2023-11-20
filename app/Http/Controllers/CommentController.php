<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create($post_id)
    {
        return view('comment.create')->with('post_id', $post_id);
    }

    public function store(Request $request, $post_id)
    {
        $user_id = Auth::id();
        $comment = Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => $request->comment
        ]);

        return to_route('post.index')->with('message', '返信を保存しました');
    }
}
