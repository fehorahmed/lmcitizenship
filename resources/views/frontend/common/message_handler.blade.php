@if(!empty(Session::get('success')))
    <div class="alert alert-success">
        <ul class="list-unstyled">
            {{ Session::get('success') }}
        </ul>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(!empty(Session::get('failed')))
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            {{ Session::get('failed') }}
        </ul>
    </div>
@endif

@if(!empty(Session::get('message')))
    <div class="alert alert-success">
        <ul class="list-unstyled">
            {{ Session::get('message') }}
        </ul>
    </div>
@endif