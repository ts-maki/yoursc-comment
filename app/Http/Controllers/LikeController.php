<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function checkFavorite($post_id)
    {
        $is_favorite = Auth::user()->isFavorite($post_id);
        return response()->json([
            'is_favorite' => $is_favorite
        ]);
    }
    public function store($post_id)
    {
        Auth::user()->likes()->syncWithoutDetaching($post_id);
    }

    public function destroy($post_id)
    {
        Auth::user()->likes()->detach($post_id);
    }
}
