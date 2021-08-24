@extends('admin.layouts.admin')


@section('content')
    @if(Session::has('success'))
        <p class="shadow" style="background: rgb(214, 209, 209); color: #000; padding: 10px 15px; border-left: 3px solid green;">{{ session('success') }}</p>
    @endif
    <h1>Posts</h1>
    <table class="table table-striped border-bottom table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Category</th>
                <th>Photo</th>
                <th>title</th>
                <th>body</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @if($posts)
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ @$post->user->name }}</td>
                    <td>{{ @$post->category ? $post->category->name : 'Unathorize' }}</td>
                    <td><img style="width: 35px; height: 35px; border-radius: 50%;" src="{{ @$post->photo ? URL::to($post->photo->file) : 'http://placehold.it/400x400' }}" alt="" class="shadow"></td>
                    <td><a href="{{ route('posts.edit', $post->id) }}">{{ Str::limit($post->title, 25, '...') }}</a></td>
                    <td>{{ Str::limit($post->body, 20, '...') }}</td>
                    <td><a href="{{ route('blog.post', $post->id) }}">View Post</a></td>
                    <td><a href="{{ route('comments.show', $post->id) }}">View Comments</a></td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@stop
