<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($post_id)
    {
        Auth::user()->likes()->syncWithoutDetaching($post_id);
        
        return to_route('post.index')->with('like_on_message', 'いいね登録しました');
    }

    public function destory($post_id)
    {
        Auth::user()->likes()->detach($post_id);

        return to_route('post.index')->with('like_off_message', 'いいね解除しました');
    }
}
