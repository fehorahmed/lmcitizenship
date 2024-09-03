<div class="row">
    <div class="sidebar-area">
        <div class="col-md-12">
            <div class="dc-photo-area">
                @php
                $w1 = dynamic_widget($widgets, ['id' => 1, 'heading' => true]);
                @endphp
                {{-- {!! $w1 !!} --}}
                {!! substr($w1, 0, 1500) !!}
            </div>
            <div class="dc-photo-area">
                @php
                $w2 = dynamic_widget($widgets, ['id' => 3, 'heading' => true]);
                @endphp
                {!! $w2 !!}
            </div>
            <div class="dc-photo-area">
                <div class="sidebar-title section-title">
                    <h2>Facebook Like Box</h2>
                </div>
                <div class="facebook-page">
                    @php
                    $w3 = dynamic_widget($widgets, ['id' => 4, 'heading' => null]);
                    @endphp
                    {!! $w3 !!}
                </div>
            </div>
            <div class="sidebar-wap">
                <div class="sidebar-title section-title">
                    <h2>আভ্যন্তরীণ ই-সেবা</h2>
                </div>
                <div class="sidebar-list">
                    @php
                    $w5 = dynamic_widget($widgets, ['id' => 5, 'heading' => null]);
                    @endphp
                    {!! $w5 !!}
                </div>
            </div>
            <div class="sidebar-wap">
                <div class="sidebar-title section-title">
                    <h2>কেন্দ্রীয় ই-সেবা </h2>
                </div>
                <div class="sidebar-list">
                    @php
                    $w6 = dynamic_widget($widgets, ['id' => 6, 'heading' => null]);
                    @endphp
                    {!! $w6 !!}
                </div>
            </div>
            <!--sidebar-wap end-->

            <!-- sidebar-wap start  -->
            <div class="sidebar-wap">
                <div class="sidebar-title section-title">
                    <h2>গুরুত্বপূর্ণ লিংক </h2>
                </div>
                <div class="sidebar-list">
                    @php
                    $w7 = dynamic_widget($widgets, ['id' => 7, 'heading' => null]);
                    @endphp
                    {!! $w7 !!}
                </div>
            </div>
            {{--            <div class="sidebar-wap">--}}
            {{--                <div class="sidebar-title section-title">--}}
            {{--                    <h2> ভিজিটর পরিসংখ্যান </h2>--}}
            {{--                </div>--}}
            {{--                @php--}}
            {{--                    $today = \App\Visitor::whereRaw('DATE(created_at) = CURDATE()')->get();--}}
            {{--                    $yesterday = \App\Visitor::whereRaw('DATE(created_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)')->get();--}}
            {{--                    $last_7day = \App\Visitor::whereRaw('DATE(created_at) = DATE_SUB(CURDATE(), INTERVAL 7 DAY)')->get();--}}
            {{--                    $last_30day = \App\Visitor::whereRaw('DATE(created_at) = DATE_SUB(CURDATE(), INTERVAL 30 DAY)')->get();--}}
            {{--                @endphp--}}

            {{--                <table class="table table-bordered">--}}
            {{--                    <tr>--}}
            {{--                        <th style="width: 50%;">Today</th>--}}
            {{--                        <td>{{ count($today) }}</td>--}}
            {{--                    </tr>--}}
            {{--                    <tr>--}}
            {{--                        <th style="width: 50%;">This Yesterday</th>--}}
            {{--                        <td>{{ count($yesterday) }}</td>--}}
            {{--                    </tr>--}}
            {{--                    <tr>--}}
            {{--                        <th style="width: 50%;">This Week</th>--}}
            {{--                        <td>{{ count($last_7day) }}</td>--}}
            {{--                    </tr>--}}
            {{--                    <tr>--}}
            {{--                        <th style="width: 50%;">This Month</th>--}}
            {{--                        <td>{{ count($last_30day) }}</td>--}}
            {{--                    </tr>--}}
            {{--                </table>--}}
            {{--            </div>--}}
        </div>
    </div>
</div>