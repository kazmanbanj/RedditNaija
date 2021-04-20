<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('community')->withCount(['votes' => function($query) {
            $query->where('post_votes.created_at', '>', now()->subDays(7))
                ->where('vote', 1);
        }])->orderBy('votes_count', 'desc')->take(10)->get();

        return view('home', compact('posts'));
    }
}
