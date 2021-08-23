@extends('admin.layouts.admin')


@section('content')
    <table class="table table-striped border-bottom table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Role</th>
                <th>Name</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @if($users)
                @foreach ($users as $user)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ @$user->role->name }}</td>
                    <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td><img style="width: 35px; height: 35px; border-radius: 50%;" src="{{ @$user->photo ? URL::to($user->photo->file) : 'http://placehold.it/400x400' }}" alt="" class="shadow"></td>
                    <td><?php if($user->is_active){ ?><span class='badge badge-success'>Active</span><?php }else{ ?><span class='badge badge-danger'>Inactive</span><?php } ?></td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@stop
