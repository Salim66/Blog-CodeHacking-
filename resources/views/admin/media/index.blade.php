@extends('admin.layouts.admin')


@section('content')

    <h1>Medias</h1>
    @if(Session::has('success'))
    <p class="shadow" style="background: rgb(214, 209, 209); color: #000; padding: 10px 15px; border-left: 3px solid green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('media.delete') }}" method="POST" class="form-inline">
        @csrf
        @method('DELETE')
        <div class="form-group">
            <select name="checkBoxArray" id="" class="form-control">
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary">
        </div>



        <table class="table table-striped table-hover border-bottom">
            <thead>
                <tr>
                    <th><input type="checkbox" id="option"></th>
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
                            <td><input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="{{ $photo->id }}"></td>
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

    </form>


@stop

@section('scripts')

    <script>
        // multiple file delete checkbox check
        $(document).ready(function(){

            $("#option").click(function(){

                if(this.checked){

                    $(".checkBoxes").each(function() {
                        this.checked = true;
                    });

                }else {

                    $(".checkBoxes").each(function() {
                        this.checked = false;
                    });

                }

            });

        });
    </script>

@endsection
