<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected function visitorsCount()
    {
        $visitorsCount = DB::table('visitors_count')->count();
        $visitorIp = Request::ip();
        $allVisitors = DB::table('visitors_count')->where('ip_address', $visitorIp)->count();

        if ($allVisitors < 1) {
            DB::table('visitors_count')->insert(['ip_address' => $visitorIp]);
        }

        return $visitorsCount;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('community')->withCount(['postVotes' => function($query) {
            $query->where('post_votes.created_at', '>', now()->subDays(7))
                ->where('vote', 1);
        }])->orderBy('post_votes_count', 'desc')->take(10)->get();

        $visitorsCount = $this->visitorsCount();

        return view('home', compact('posts', 'visitorsCount'));
    }
}
