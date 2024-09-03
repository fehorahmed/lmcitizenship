<div class="paymentinfo">
    @if($payment)
    @php
    $tp_info = json_decode($payment, true);
    @endphp
    <small>
        @if(isset($tp_info['payment_method']))
        <p> <b title="মেথড">মেথডঃ </b>{{ e2b($tp_info['payment_method'])}}</p>
        @endif

        @if(isset($tp_info['total']))
        <p><b title="টাকার পরিমান  ">টাকার পরিমান # </b>{{ e2b($tp_info['total'])}} টাকা</p>
        @endif

        @if(isset($tp_info['payorder']))
        <p> <b title="ব্যাঙ্ক ড্রাফট নং">ব্যাঙ্ক ড্রাফট নং # </b>{{ $tp_info['payorder']}}</p>
        @endif
        @if(isset($tp_info['bank']))
        <p> <b title="ব্যাঙ্ক">ব্যাঙ্কঃ </b>{{ e2b($tp_info['bank'])}} </p>
        @endif
        @if(isset($tp_info['branch']))
        <p> <b title="ব্রাঞ্চ">ব্রাঞ্চঃ </b>{{ e2b($tp_info['branch'])}} </p>
        @endif
        @if(isset($tp_info['number']))
        <p>
            <b title="ইজারা মোবাইল">লেনদেনের মোবাইল নম্বরঃ </b>{{ e2b($tp_info['number'])}}
        </p>
        @endif
        @if(isset($tp_info['tid']))
        <p> <b title="ট্যাক্স আইডি ">ট্রানঃ আইডিঃ </b>{{e2b( $tp_info['tid'])}}</p>
        @endif
        @if(isset($tp_info['date']))
        <p><b title="তারিখ">তারিখঃ </b>{{ e2b(date('d-F-Y', strtotime($tp_info['date'])))}} </p>
        @endif
    </small>
    @endif
</div>