@extends('admin.layouts.admin')


@section('content')

    <div class="row">
        <div class="col-sm-6">
            <h1>Add Category</h1>
            {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\AdminCategoriesController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Add Category', ['class' => 'btn btn-primary']) !!}
                    </div>
            {!! Form::close() !!}
        </div>
        <div class="col-sm-6">
            @if(Session::has('success'))
                <p class="shadow" style="background: rgb(214, 209, 209); color: #000; padding: 10px 15px; border-left: 3px solid green;">{{ session('success') }}</p>
            @endif
            <h1>Categories</h1>
            <table class="table table-striped border-bottom table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @if($categories)
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="{{ route('categories.edit', $category->id) }}">{{ @$category->name }}</a></td>
                            <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@stop
