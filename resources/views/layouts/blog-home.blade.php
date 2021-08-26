@include('layouts.includes.front_header')
<!-- Navigation -->
    @include('layouts.includes.front_nav')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- First Blog Post -->

               @yield('content')

               <div class="text-center">
                {{ $posts->links('pagination::bootstrap-4') }}
               </div>

                <!-- Pager -->
                {{-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> --}}

            </div>

            <!-- Blog Sidebar Widgets Column -->

            @include('layouts.includes.front_sidebar')


        </div>
        <!-- /.row -->

@include('layouts.includes.front_footer')
