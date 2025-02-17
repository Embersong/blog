@extends('layouts.app')

@section('title', 'Посты')

@section('menu')
    @include('parts.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('parts.messages')

                @forelse ($posts as $post)

                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }} : {{ $post->likes }}</a><br>
                @empty
                    <p>Нет постов</p>
                @endforelse

                {{ $posts->links() }}

            </div>
        </div>
    </div>
@endsection



