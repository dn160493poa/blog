<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke()
    {
        //$posts = Post::paginate(6); dd($posts);
        $posts = DB::table('posts as p')
            ->select("p.id", "p.title", "p.main_image", "c.title as category_title", DB::raw('1 as liked_users_count'))
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->paginate(6);


        //$random_posts = Post::get()->random(4);
        $random_posts = DB::table('posts as p')
            ->select("p.id", "p.title", "p.main_image", "c.title as category_title", DB::raw('1 as liked_users_count'))
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->inRandomOrder()
            ->limit(4)
            ->get();


        //$liked_posts = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(4);
        $liked_posts = DB::table('posts as p')
            ->select("p.id", "p.title", "p.main_image", "c.title as category_title", DB::raw('1 as liked_users_count'))
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->get()
            ->random(4);


        return view('post.index', compact('posts', 'random_posts', 'liked_posts'));
    }

}
