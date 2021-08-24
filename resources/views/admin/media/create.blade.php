@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
@stop

@section('content')

    @if(Session::has('success'))
    <p class="shadow" style="background: rgb(214, 209, 209); color: #000; padding: 10px 15px; border-left: 3px solid green;">{{ session('success') }}</p>
    @endif
    <h1>Upload Media</h1>

    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\AdminMediaContorller@store', 'class' => 'dropzone']) !!}


    {!! Form::close() !!}


@stop


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
@stop
