@extends('admin.layouts.admin')

@section('content')

    <h1>User Create</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\AdminUserController@store']) !!}
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add User', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

@stop
