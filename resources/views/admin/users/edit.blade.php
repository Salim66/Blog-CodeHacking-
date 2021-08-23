@extends('admin.layouts.admin')

@section('content')

    <h1>User Edit</h1>

    <div class="row">
        <div class="col-sm-3">
            <img class="img-responsive img-rounded" src="{{ @$user->photo ? URL::to($user->photo->file) : 'http://placehold.it/400x400' }}" alt="">
        </div>

        <div class="col-sm-9">
            {!! Form::model($user, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\AdminUserController@update', $user->id], 'files' => true]) !!}
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
                    {!! Form::select('is_active', [1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('photo_id', 'Photo:') !!}
                    {!! Form::file('photo_id', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group" style="display: inline-block; float: left;">
                    {!! Form::submit('Add User', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

            {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\AdminUserController@destroy', $user->id], 'style' => 'display:inline-block; float: right;']) !!}
                {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>

    </div>
    <div class="row">
        @include('admin.layouts.includes.form_error')
    </div>

@stop
