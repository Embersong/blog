@extends('layouts.app')

@section('title', 'Категории')

@section('menu')
    @include('parts.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @forelse ($categories as $category)

                    <a href="{{ route('posts.categories.show', $category) }}">{{ $category->name }}</a><br>
                @empty
                    <p>Нет категорий</p>
                @endforelse


            </div>
        </div>
    </div>
@endsection



