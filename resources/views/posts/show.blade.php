@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ $post->title }}</div>

    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-info">{{ session('message') }}</div>
        @endif

        @if ($post->post_url != '')
        <a href="{{ $post->post_url }}" target="_blank" class="mb-2">{{ $post->post_url }}</a>
        <br /><br />
        @endif

        @if ($post->post_image != '')
        <img src="{{ asset('storage/posts/' . $post->id . '/thumbnails_' . $post->post_image) }}"/>
        <br /><br />
        @endif
        <br>
        {{ $post->post_text }}

        @auth()
            <!-- Comments -->
            <hr />
            <h3><u>Comments:</u></h3>
            @forelse ($post->comments as $comment)
            <div class="border p-3" style="border-radius: 10px;">
                <b>by: {{ $comment->user->name }}</b>
                <br />
                <i class="fa fa-clock-o" aria-hidden="true"></i> - {{ $comment->created_at->diffForHumans() }}
                <p class="mt-2">{{ $comment->comment_text }}</p>
            </div>
            @empty
            No comments yet.
            @endforelse
            <hr />
            <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                @csrf
                Add a comment:
                <br />
                <textarea class="form-control" name="comment_text" rows="5" required></textarea>
                <br />
                <button type="submit" class="btn btn-sm btn-primary">Add Comment</button>
            </form>
            <!-- Comments end -->
            <hr />
            @can ('edit-post', $post)
                <a href="{{ route('communities.posts.edit', [$post->community, $post]) }}" class="btn btn-sm btn-primary">Edit post</a>
            @endcan
            @can('delete-post', $post)

                <form action="{{ route('communities.posts.destroy', [$post->community, $post]) }}" method="POST"
                    style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete Post
                    </button>
                </form>
                @else
                <form action="{{ route('post.report', $post->id) }}" method="POST"
                    style="display: inline-block">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Report post as inappropriate
                    </button>
                </form>
            @endcan
        @endauth
    </div>
</div>
@endsection
