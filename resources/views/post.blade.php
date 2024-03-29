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
    <p class="lead">{!! htmlspecialchars_decode($post->body) !!}</p>

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
                    {{-- <img height="60" class="media-object" src="{{ $comment->photo ? URL::to($comment->photo) : 'http://placehold.it/60x60' }}" alt=""> --}}
                    <img height="60" class="media-object" src="{{ Auth::user()->gravatar }}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->author }}
                        <small>{{ date('F d, Y, h:i a') }}</small>
                    </h4>
                   {{ $comment->body }}

                    <div class="main-comment-reply-container">
                        <button class="main-toggle-reply btn btn-primary pull-right"  tootle_id="{{ $comment->id }}">Reply</button>
                        <div class="main-comment-reply-{{ $comment->id }} col-sm-10" style="display: none;">
                            {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\CommentReplyController@createReplay']) !!}

                                <input type="hidden" name="comment_id" value={{ $comment->id }}>

                                <div class="form-group" style="margin-top: 30px">
                                    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '1']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                                </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

                    @if(count($comment->commentReplies) > 0)

                        @foreach($comment->commentReplies as $reply)
                        <!-- Nested Comment -->
                            <div class="media" style="margin-top: 60px; margin-bottom: 60px; width: 100%;">
                                <a class="pull-left" href="#">
                                    <img height="60" class="media-object" src="{{ $reply->photo ? URL::to($reply->photo) : 'http://placehold.it/64x64' }}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $reply->author }}
                                        <small>{{ date('F d, Y, h:i a', strtotime($reply->created_at)) }}</small>
                                    </h4>
                                    {{ $reply->body }}
                                </div>

                                <div class="comment-reply-container">
                                    <button class="toggle-reply btn btn-primary pull-right"  tootle_id="{{ $reply->id }}">Reply</button>
                                    <div class="comment-reply-{{ $reply->id }} col-sm-8" style="display: none;">
                                        {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\CommentReplyController@createReplay']) !!}

                                            <input type="hidden" name="comment_id" value={{ $comment->id }}>

                                            <div class="form-group" style="margin-top: 30px">
                                                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '1']) !!}
                                            </div>

                                            <div class="form-group">
                                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                                            </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>



                            </div>
                            <!-- End Nested Comment -->
                        @endforeach

                    @endif

                </div>
            </div>
        @endforeach
    @endif


    {{-- <div id="disqus_thread"></div>
    <script>
        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://blog-codehacking.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript> --}}


</div>

@stop

@section('scripts')

    <script>
        $(document).ready(function(){

            //main comment reply
            $('.main-comment-reply-container .main-toggle-reply').click(function(){
                let id = $(this).attr('tootle_id');
                $('.main-comment-reply-'+id).slideToggle('slow');
            });

            // child comment reply
            $('.comment-reply-container .toggle-reply').click(function(){
                let id = $(this).attr('tootle_id');
                $('.comment-reply-'+id).slideToggle('slow');
            });


        });
    </script>

@stop
