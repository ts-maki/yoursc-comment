<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($post_id)
    {
        Auth::user()->likes()->syncWithoutDetaching($post_id);

        return back()->with('like_message', 'いいね登録しました');
    }

    
}
