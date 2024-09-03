@foreach($fdata as $k => $odata)
@php
$key = $k +1;
@endphp

<tr id="{{ 'row-'.$key }}">
    <th scope="row">#</th>
    <td>
        <input class="form-control" value="{{ $odata['name'] }}" placeholder="নাম..." name="warish[{{$key }}][name]"
            type="text">


    </td>
    <td>

        {{ Form::select('warish['.$key.'][relation]',  lv_warishtype(),  (( $odata['relation']) ? $odata['relation']: NULL),
                                ['class' => 'form-control', 'placeholder' => ' সম্পর্ক']) }}

    </td>
    <td>
        <input class="form-control date-pick" value="{{ date('d-m-Y', strtotime($odata['birthday'])) }}"
            placeholder="জন্মদিন" name="warish[{{$key }}][birthday]" type="text">

    </td>

    <td>
        <input class="form-control" placeholder="পরিচয়পত্র" value="{{ $odata['nid'] }}" name="warish[{{$key }}][nid]"
            type="text">

    </td>
    <td>
        <button class="btn btn-danger btn-sm removeRow" style="margin-top: 7px;" type="button" data-id="{{ $key }}">
            <i class="fa fa-minus" aria-hidden="true"></i>
        </button>
    </td>
</tr>

@endforeach