@extends('admin.layouts.admin')


@section('content')

    <div class="row">
        <div class="col-sm-6">
            <h1>Edit Category</h1>
            {!! Form::model($category, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\AdminCategoriesController@update', $category->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group" style="display: inline-block; float: left">
                        {!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}
                    </div>
            {!! Form::close() !!}

            {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\AdminCategoriesController@destroy', $category->id]]) !!}
                    <div class="form-group" style="display: inline-block; float: right;">
                        {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
                    </div>
            {!! Form::close() !!}
        </div>

@stop
