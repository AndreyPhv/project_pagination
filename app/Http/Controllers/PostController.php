<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(env('PAGINATION_ITEMS_PER_PAGE'));

        return view('posts', ['posts'=>$posts]);
    }
}
