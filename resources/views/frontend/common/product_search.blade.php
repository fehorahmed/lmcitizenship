{{ Form::open(array('url' => 'search', 'method' => 'get', 'value' => 'PATCH', 'role' => 'search_product', 'id' => 'search_product')) }}


<div class="input-group add-on">
    <input
            type="text"
            id="srch-term"
            name="q"
            class="form-control"
            value="{{ app('request')->input('q') }}"
            placeholder="Search here">
    <div class="input-group-btn">
        <button type="submit" class="btn btn-default">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>


{{ Form::close() }}