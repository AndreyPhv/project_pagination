<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($page)
    {
//  проверка на выход за пределы допустимых страниц
        $page_count = ceil(Post::count() / env('PAGINATION_ITEMS_PER_PAGE'));
        if ($page < 1 || $page > $page_count)
        {
            return redirect()->action([PostController::class, 'index'], ['page' => 1]);
        };


//  посты выводимые на страницу
        $first_post = (($page - 1) * env('PAGINATION_ITEMS_PER_PAGE'))+ 1;
        $last_post = $first_post + env('PAGINATION_ITEMS_PER_PAGE') - 1;
        $posts = Post::whereBetween('id', [$first_post, $last_post])->get();;


//  выводимые в пагинацию номера страниц
        $first_page = $page - floor(env('PAGINATION_DISPLAYED_PAGES_NUM')/2);
        $first_page = $first_page > 0 ? $first_page : 1;
        $last_page = $first_page + env('PAGINATION_DISPLAYED_PAGES_NUM') - 1;

        if ($last_page > $page_count)
        {
            $last_page = $page_count;
            $first_page = $last_page - env('PAGINATION_DISPLAYED_PAGES_NUM') + 1;
            $first_page = $first_page > 0 ? $first_page : 1;
        }

        $pagination_pages = range($first_page, $last_page);


        return view('posts', [
            'posts'=>$posts,
            'current_page'=>$page,
            'page_count'=>$page_count,
            'pagination_pages'=>$pagination_pages,
        ]);
    }
}
