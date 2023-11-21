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

    //コメント新規作成
    public function store(Request $request, $post_id)
    {
        $user_id = Auth::id();
        $comment = Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => $request->comment
        ]);

        return to_route('post.index')->with('comment_message', '返信を保存しました');
    }

    //コメント編集ページ遷移
    public function edit($comment_id)
    {

        $comment = Comment::findOrFail($comment_id);
        return view('comment.edit')->with('comment', $comment);
    }

    //コメント更新
    public function update(Request $request, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->fill($request->all())->save();
        return to_route('post.index')->with('comment_message', 'コメント更新が完了しました');
    }

    //コメント削除
    public function destroy($comment_id)
    {

        $comment = Comment::findOrFail($comment_id);
        $comment->delete();
        return to_route('post.index')->with('comment_message', '投稿を削除しました');
    }
    
}
