@php
    /** @var \App\Eloquent\Post $post */
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-8 offset-2">
            <section class="card">
                <div class="card-body">
                    <h1>
                        {{ $post->title }}
                        @can('update', $post)
                            <a class="btn btn-success btn-sm" href="{{ route('posts.edit', $post) }}">編集</a>
                        @endcan
                        @can('destroy', $post)
                            <button class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#delete-post-modal">削除</button>
                        @endcan
                    </h1>
                    <p class="text-muted text-right">
                        Written by <a href="{{ route('users.show', $post->author) }}">{{ $post->author->screen_name }}</a>
                        <br>
                        Last updated at {{ $post->updated_at->diffForHumans() }}
                    </p>
                    <hr>
                    <div>
                        {!! nl2br(e($post->body)) !!}
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="delete-post-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    本当に削除しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">キャンセル</button>
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
