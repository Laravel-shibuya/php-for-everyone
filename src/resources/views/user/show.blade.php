@php
    /** @var \App\Eloquent\User $user */
    /** @var \App\Eloquent\Post[]|\Illuminate\Pagination\LengthAwarePaginator $posts */
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <section class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="d-inline">{{ $user->screen_name }}</h3>
                    <span class="text-muted">( {{ $user->name }} )</span>
                    <p class="mt-2 mb-0 text-muted">{!! nl2br(e($user->profile)) !!}</p>
                </div>
            </div>
        </section>

        <section class="col-md-8">
            <h3>記事一覧</h3>
            <div class="card">
            <div class="card-body">
                @forelse($posts as $post)
                    <span>
                        <h5><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                        <p class="text-muted">Last updated at {{ $post->updated_at->diffForHumans() }}</p>
                    </span>
                @empty
                    <p>投稿がありません。</p>
                @endforelse
                {{ $posts->links() }}
            </div>
            </div>
        </section>
    </div>
</div>
@endsection

