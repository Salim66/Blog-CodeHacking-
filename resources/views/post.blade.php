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



    <div id="disqus_thread"></div>
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
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


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
