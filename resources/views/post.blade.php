@extends('layouts.blog-post')


@section('content')

<div class="col-lg-8">

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{ $post->user->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{ date('F d, Y, h:i a', strtotime($post->created_at)) }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ $post->photo ? URL::to($post->photo->file) : 'http://placehold.it/400x400' }}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{ $post->body }}</p>

    <hr>

    <!-- Blog Comments -->
    @if(Auth::check())

        @if(Session::has('success'))
            <p class="shadow" style="background: rgb(214, 209, 209); color: #000; padding: 10px 15px; border-left: 3px solid green;">{{ session('success') }}</p>
        @endif
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>

            {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\PostCommentController@store']) !!}

                <input type="hidden" name="post_id" value={{ $post->id }}>

                <div class="form-group">
                    {!! Form::label('body', 'Body:') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '3']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Comment', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

        </div>

    @endif

    <hr>

    <!-- Posted Comments -->
    @if(count($comments) > 0)
        <!-- Comment -->
        @foreach($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="60" class="media-object" src="{{ $comment->photo ? URL::to($comment->photo) : 'http://placehold.it/60x60' }}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->author }}
                        <small>{{ date('F d, Y, h:i a') }}</small>
                    </h4>
                   {{ $comment->body }}

                    @if(count($comment->commentReplies) > 0)

                        @foreach($comment->commentReplies as $reply)
                        <!-- Nested Comment -->
                            <div class="media" style="margin-top: 60px">
                                <a class="pull-left" href="#">
                                    <img height="60" class="media-object" src="{{ $reply->photo ? URL::to($reply->photo) : 'http://placehold.it/64x64' }}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $reply->author }}
                                        <small>{{ date('F d, Y, h:i a', strtotime($reply->created_at)) }}</small>
                                    </h4>
                                    {{ $reply->body }}
                                </div>

                                {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\CommentReplyController@createReplay']) !!}

                                    <input type="hidden" name="comment_id" value={{ $comment->id }}>

                                    <div class="form-group" style="margin-top: 30px">
                                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '1']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::submit('Reply', ['class' => 'btn btn-primary']) !!}
                                    </div>

                                {!! Form::close() !!}

                            </div>
                            <!-- End Nested Comment -->
                        @endforeach

                    @endif

                </div>
            </div>
        @endforeach
    @endif



</div>

@stop
