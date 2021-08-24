@extends('admin.layouts.admin')


@section('content')

    <h1>Medias</h1>

    <table class="table table-striped table-hover border-bottom">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @if($photos)
                @foreach($photos as $photo)
                    <tr>
                        <td>{{ $loop->index + 1; }}</td>
                        <td><img style="height: 100px; width: 100px;" src="{{ $photo->file ? URL::to($photo->file) : 'no file' }}" alt=""></td>
                        <td>{{ $photo->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@stop
