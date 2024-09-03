<tr id="{{ 'row-' . $key }}">
    <th scope="row">#</th>
    <td>
        <input class="form-control" value="" placeholder="নাম..." name="warish[{{ $key }}][name]"
            type="text">


    </td>
    <td>
        <select name="warish[{{$key}}][relation]" class="form-control" id="warish[{{$key}}][relation]">
            <option value=""></option>
            @foreach (lv_warishtype() as $lv_key => $item)
                <option value="{{ $lv_key }}">{{ $item }}</option>
            @endforeach
        </select>

    </td>
    <td>
        <input class="form-control date-pick" value="" placeholder="জন্মদিন"
            name="warish[{{ $key }}][birthday]" type="text">
    </td>

    <td>
        <input class="form-control" placeholder="পরিচয়পত্র" value="" name="warish[{{ $key }}][nid]"
            type="text">

    </td>
    <td>
        <button class="btn btn-danger btn-sm removeRow" style="margin-top: 7px;" type="button"
            data-id="{{ $key }}">
            <i class="fa fa-minus" aria-hidden="true"></i>
        </button>
    </td>
</tr>
