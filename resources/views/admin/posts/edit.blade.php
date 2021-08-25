@extends('admin.layouts.admin')


@section('content')

@include('admin.layouts.includes.tinyeditor')

    <h1>Edit Post</h1>

    <div class="row">
        <div class="col-sm-3">
            <img class="img-responsive img-rounded" src="{{ @$post->photo ? URL::to($post->photo->file) : 'http://placehold.it/400x400' }}" alt="">
        </div>
        <div class="col-sm-9">
            {!! Form::model($post, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\AdminPostController@update', $post->id], 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category_id', 'Category:') !!}
                    {!! Form::select('category_id', ['' => 'Choose Category'] + $categories, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('photo_id', 'Photo:') !!}
                    {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('body', 'Description:') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'mytextarea']) !!}
                </div>
                <div class="form-group" style="display: inline-block; float:left;">
                    {!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}


            {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\AdminPostController@destroy', $post->id]]) !!}
                <div class="form-group" style="display: inline-block; float: right;">
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        @include('admin.layouts.includes.form_error')
    </div>




@stop
