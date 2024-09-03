@foreach($olds as $key => $odata)
<tr id="{{ 'row-'.$key }}">
    <th scope="row">#</th>
    <td class="{{($errors->has('warish.'.$key.'.name'))?'has-error ':'' }}">
        <input class="form-control" value="{{ $odata['name'] }}" placeholder="নাম..." name="warish[{{$key }}][name]"
            type="text">

        @if($errors->has('warish.'.$key.'.name'))
        <span class="help-block">
            {{ $errors->first('warish.'.$key.'.name') }}
        </span>
        @endif
    </td>
    <td class="{{($errors->has('warish.'.$key.'.relation'))?'has-error ':'' }}">
        <select class="form-control" value="{{ $odata['relation'] }}" name="warish[{{$key }}][relation]">
            <option value="Son">পুত্র</option>
            <option value="Daughter">কন্যা</option>
        </select>

        @if($errors->has('warish.'.$key.'.relation'))
        <span class="help-block">
            {{ $errors->first('warish.'.$key.'.relation') }}
        </span>
        @endif
    </td>
    <td class="{{($errors->has('warish.'.$key.'.birthday'))?'has-error ':'' }}">
        <input class="form-control date-pick" value="{{ $odata['birthday'] }}" placeholder="জন্মদিন"
            name="warish[{{$key }}][birthday]" type="text">
        @if($errors->has('warish.'.$key.'.birthday'))
        <span class="help-block">
            {{ $errors->first('warish.'.$key.'.birthday') }}
        </span>
        @endif
    </td>

    <td class="{{($errors->has('warish.'.$key.'.relation'))?'has-error ':'' }}">
        <input class="form-control" placeholder="পরিচয়পত্র" value="{{ $odata['nid'] }}" name="warish[{{$key }}][nid]"
            type="text">
        @if($errors->has('warish.'.$key.'.nid'))
        <span class="help-block">
            {{ $errors->first('warish.'.$key.'.nid') }}
        </span>
        @endif
    </td>
    <td>
        <button class="btn btn-danger btn-sm removeRow" style="margin-top: 7px;" type="button" data-id="{{ $key }}">
            <i class="fa fa-minus" aria-hidden="true"></i>
        </button>
    </td>
</tr>

@endforeach