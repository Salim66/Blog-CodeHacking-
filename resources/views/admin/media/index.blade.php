@extends('admin.layouts.admin')


@section('content')

    <h1>Medias</h1>
    @if(Session::has('success'))
    <p class="shadow" style="background: rgb(214, 209, 209); color: #000; padding: 10px 15px; border-left: 3px solid green;">{{ session('success') }}</p>
    @endif
    <table class="table table-striped table-hover border-bottom">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($photos)
                @foreach($photos as $photo)
                    <tr>
                        <td>{{ $loop->index + 1; }}</td>
                        <td><img style="height: 100px; width: 100px;" src="{{ $photo->file ? URL::to($photo->file) : 'http://placehold.it/400x400' }}" alt=""></td>
                        <td>{{ $photo->created_at->diffForHumans() }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\AdminMediaContorller@destroy', $photo->id]]) !!}
                                {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@stop
