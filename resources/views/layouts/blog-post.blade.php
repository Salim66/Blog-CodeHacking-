@include('layouts.includes.front_header')

    <!-- Navigation -->
    @include('layouts.includes.front_nav')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            @yield('content')

            <!-- Blog Sidebar Widgets Column -->
            @include('layouts.includes.front_sidebar')

        </div>
        <!-- /.row -->

@include('layouts.includes.front_footer')

@yield('scripts')
