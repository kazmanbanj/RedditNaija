<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $post->load('community');

        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment_text' => $request->comment_text
        ]);

        return redirect()->route('communities.posts.show', [$post, $post->community]);
    }
}
