<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">

                @php
                    $categories = \App\Models\Category::latest()->get();
                @endphp

                @if(count($categories) > 0 )
                    @foreach($categories as $category)
                        <li><a href="#">{{ $category->name }}</a></li>
                    @endforeach
                @endif



            </ul>
        </div>

    </div>
    <!-- /.row -->
</div>
