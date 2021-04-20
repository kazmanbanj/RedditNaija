@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $community->name }}</div>

                <div class="card-body">
                    <a href="{{ route('communities.posts.create', $community) }}" class="btn btn-primary">Add Post</a>
                    <br><br>
                    @forelse ($posts as $post)
                    <div class="row">
                        <div class="col-1 text-center">
                            <div>
                                <a wire:click.prevent="vote(1)" href="{{ route('post.vote', [$post->id, 1]) }}"><i class="fa fa-2x fa-sort-asc" aria-hidden="true"></i></a>
                            </div>
                            <b style="font-size: 24px; font-weight: bold">{{ $post->votes }}</b>
                            <div>
                                <a wire:click.prevent="vote(-1)" href="{{ route('post.vote', [$post->id, -1]) }}"><i class="fa fa-2x fa-sort-desc" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-11">
                            <a href="{{ route('communities.posts.show', [$community, $post]) }}">
                                <h3>{{ $post->title }}</h3>
                            </a>
                            <p>{{ \Illuminate\Support\Str::words($post->post_text, 10) }}</p>
                        </div>
                    </div>
                    <hr>
                    @empty
                        No posts found
                    @endforelse

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection