<div class="row">
    <div class="col-md-4">
        <a class="btn btn-danger" href="{{ url('/my_account') }}" role="button">Back</a>
    </div>

    <div class="col-md-8 text-right">
        <div class="btn-group" role="group">
            <a href="{{route('user.warish')}}" class="btn btn-info">
                হোম পেজ
            </a>
            <a href="{{route('user.warish.form')}}" class="btn btn-info">
                নতুন আবেদন
            </a>
            <a href="{{route('user.warish')}}" class="btn btn-info">
                সকল আবেদন
            </a>
        </div>
    </div>
</div>
