@extends('admin.layouts.admin')


@section('content')

    <h1>Create Post</h1>

    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\AdminPostController@store', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', ['' => 'Options'], null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Description:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Add Post', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}


@stop
