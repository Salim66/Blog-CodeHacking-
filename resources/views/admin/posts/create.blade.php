@extends('admin.layouts.admin')


@section('content')

    @include('admin.layouts.includes.tinyeditor')

    <h1>Create Post</h1>

    <div class="row">
        {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\AdminPostController@store', 'files' => true]) !!}
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
            <div class="form-group">
                {!! Form::submit('Add Post', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>

    <div class="row">
        @include('admin.layouts.includes.form_error')
    </div>




@stop
