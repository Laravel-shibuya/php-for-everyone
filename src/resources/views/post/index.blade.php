@php
/** @var \App\Eloquent\Post[]|\Illuminate\Database\Eloquent\Collection $posts */
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <section class="col-md-8">
            <h1>記事一覧</h1>
            @forelse($posts as $post)
                <div class="card mt-4">
                    <div class="card-body">
                        <h4><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>
                        <p class="text-muted mb-0">Written by <a href="{{ route('users.show', $post->author) }}">{{ $post->author->screen_name }}</a> <br>Last updated at {{ $post->updated_at->diffForHumans() }} </p>
                    </div>
                </div>
            @empty
                <p>投稿がありません。</p>
            @endforelse
            <div class="mt-4 row justify-content-center">
                {{ $posts->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
