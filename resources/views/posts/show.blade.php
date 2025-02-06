@extends('layouts.app')

@section('title', 'Пост')

@section('menu')
    @include('parts.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('parts.messages')

                <div class="card">

                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">
                        @if ($post->image)
                            <img class="w-25 me-2 float-start" src="{{ asset('storage/' . $post->image) }}" alt="img">
                        @endif
                        {{ $post->text }}
                    </div>

                    <button data-id="{{ $post->id }}" class="btn btn-primary w-25 likeButton ms-3 mb-2">
                        Likes: <span id="likeCount">{{ $post->likes }}</span>
                    </button>


                </div>
            </div>
        </div>
    </div>
@endsection

