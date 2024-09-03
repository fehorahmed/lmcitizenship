<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- {!! metas(webseting(), $options = array(
    'url' => config('app.url', 'default'),
    'img_url' => NULL,
    'title' => NULL,
    'description' => NULL,
    'keywords' => NULL
    )) !!} --}}
    <script type="text/javascript">
        var baseurl = "<?php echo url('/'); ?>";
    </script>
    @include('frontend.layouts.css')
    @include('frontend.layouts.js_head')

</head>


<body style="background:#DFF0F9 !important;">
    @include('frontend.layouts.header')

    <div class="frontend_content">
        <div class="extra_pad">
            @yield('content')
        </div>
    </div>

    @include('frontend.layouts.footer')
    @include('frontend.layouts.js')
    <script type="text/javascript">
        $(function() {
            $(".g-date-pick").datepicker({
                format: 'yyyy-mm-dd'
            }).val();
        });
    </script>
    @yield('cusjs')



</body>

</html>
