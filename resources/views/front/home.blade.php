@extends('layouts.blog-home')

@section('content')

    @if(count($posts) > 0)

    @foreach($posts as $post)
        <h2>
            <a href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a>
        </h2>
        <p class="lead">
            by <a href="index.php">{{ $post->user->name }}</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{ date('F d, Y', strtotime($post->created_at)) }} at {{ date('h:i A', strtotime($post->created_at)) }}</p>
        <hr>
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
        <hr>
        <p>{!! Str::limit(htmlspecialchars_decode($post->body), 100, '...') !!}</p>
        <a class="btn btn-primary" href="{{ route('blog.post', $post->slug) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
    @endforeach

    @endif

@endsection
