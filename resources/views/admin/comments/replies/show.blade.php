@extends('admin.layouts.admin')


@section('content')

    @if(count($replies) > 0)

        @if(Session::has('success'))
        <p class="shadow" style="background: rgb(214, 209, 209); color: #000; padding: 10px 15px; border-left: 3px solid green;">{{ session('success') }}</p>
        @endif
        <h1>Single Comment Reply</h1>
        <table class="table table-striped border-bottom table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @if($replies)
                    @foreach ($replies as $reply)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $reply->author }}</td>
                        <td>{{ $reply->email }}</td>
                        <td>{{ $reply->body }}</td>
                        <td><a href="{{ route('blog.post', $reply->comment->post_id) }}">View Post</a></td>
                        <td>
                            @if($reply->is_active == 1)

                                {!! Form::open(['method' => 'PATCH', 'action' => ['App\Http\Controllers\CommentReplyController@update', $reply->id]]) !!}
                                    <input type="hidden" name="is_active" value="0">
                                    <div class="form-group">
                                        {!! Form::submit('Un-approved', ['class' => 'btn btn-info']) !!}
                                    </div>
                                {!! Form::close() !!}

                            @else

                                {!! Form::open(['method' => 'PATCH', 'action' => ['App\Http\Controllers\CommentReplyController@update', $reply->id]]) !!}
                                    <input type="hidden" name="is_active" value="1">
                                    <div class="form-group">
                                        {!! Form::submit('Approved', ['class' => 'btn btn-success']) !!}
                                    </div>
                                {!! Form::close() !!}

                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\CommentReplyController@destroy', $reply->id]]) !!}
                                <div class="form-group">
                                    {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
                                </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    @else
        <h1 class="text-center">No Comment Replies</h1>
    @endif

@stop
