<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'comments')->orderBy('updated_at', 'DESC')->paginate(20);
        return view('post.index')->with('posts', $posts);
    }

    //投稿ページ
    public function create($user_id)
    {
        return view('post.create')->with('user_id', $user_id);
    }

    //投稿詳細ページ
    public function show($post_id)
    {

        $post = Post::findOrFail($post_id);
        return view('post.show')->with('post', $post);
    }


    //投稿保存
    public function store(Request $request, $user_id)
    {
        $post = Post::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'comment' => $request->comment
        ]);

        // $posts = Post::with('user')->get();
        // return view('post.index')
        //     ->with('message', '投稿を保存しました')
        //     ->with('posts', $posts);
        return to_route('post.index')->with('message', '投稿を保存しました');
    }

    //編集ページ遷移
    public function edit($post_id)
    {

        $post = Post::findOrFail($post_id);
        return view('post.edit')->with('post', $post);
    }

    //編集更新
    public function update(Request $request, $post_id)
    {

        $post = Post::findOrFail($post_id);
        $post->fill($request->all())->save();
        return to_route('post.index')->with('message', '更新が完了しました');
    }

    //投稿削除
    public function destroy($post_id)
    {

        $post = Post::findOrFail($post_id);
        $post->likes()->detach();
        $post->comments()->delete();
        $post->delete();
        return to_route('post.index')->with('message', '投稿を削除しました');
    }
}
