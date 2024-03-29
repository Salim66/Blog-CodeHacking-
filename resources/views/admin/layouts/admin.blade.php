<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin/assets/css/libs/blog-post.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/libs/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/libs/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/libs/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/libs/metisMenu.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/libs/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/libs/styles.css')}}" rel="stylesheet">

    @yield('styles')

</head>

<body id="admin-page" style="padding-top: 0;">

<div id="wrapper">

    <!-- Navigation -->
    @include('admin.layouts.includes.admin_nav')







</div>






<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>

                @yield('content')
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{asset('admin/assets/js/libs/jquery.js')}}"></script>
<script src="{{asset('admin/assets/js/libs/bootstrap.js')}}"></script>
<script src="{{asset('admin/assets/js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/assets/js/libs/metisMenu.js')}}"></script>
<script src="{{asset('admin/assets/js/libs/sb-admin-2.js')}}"></script>
<script src="{{asset('admin/assets/js/libs/scripts.js')}}"></script>

@yield('scripts')

@yield('footer')





</body>

</html>
