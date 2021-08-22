@extends('admin.layouts.admin')

@section('content')

    <h1>User Create</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\AdminUserController@store', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('role', 'Role:') !!}
            {!! Form::select('role_id', ['' => 'Choose Options'] + $roles, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('is_active', [1 => 'Active', 0 => 'Inactive'], 0, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add User', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    @include('admin.layouts.includes.form_error')

@stop
