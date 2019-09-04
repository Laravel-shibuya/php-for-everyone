@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-8 offset-2">
        <section>
            <h2>記事を投稿する</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title" class="col-form-label text-md-right">{{ __('Title') }}</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="body" class="col-form-label text-md-right">{{ __('Body') }}</label>
                            <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" cols="30" rows="10" required>{{ old('body') }}</textarea>
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">投稿する</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

