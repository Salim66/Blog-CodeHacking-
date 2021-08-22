@extends('admin.layouts.admin')


@section('content')
    <table class="table table-striped border-bottom">
        <thead>
            <tr>
                <th>Id</th>
                <th>Role</th>
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
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
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><?php if($user->is_active){ ?><span class='badge badge-success'>Active</span><?php }else{ ?><span class='badge badge-danger'>Inactive</span><?php } ?></td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@stop
