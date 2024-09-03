<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Training Project" name="description" />
    <meta content="Coderthemes" name="author" />
    {{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}
    <link href="{{ asset('assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/css/summernote-bs5.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/tabs.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .page-title {
            text-transform: uppercase;
        }

        /* body[data-leftbar-theme=dark] .leftside-menu {
            background: #000408;
        } */

        #topMenu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            border-radius: 10px;
        }

        #topMenu ul li {
            float: left;
        }

        #topMenu ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        #topMenu ul li a:hover:not(.menuActive) {
            color: #f7bc19;
        }

        #topMenu ul li a:hover {
            color: #fff2cc;
        }

        .menuActive {
            color: #f7bc19 !important;
            border-bottom: 5px solid #f7bc19;
        }

        ul.checkbox-list {
            list-style: none;
            padding: 10px;
            height: 200px;
            overflow-x: scroll;
            border: 1px solid #d2d6de;
        }
    </style>
    @stack('styles')
    @php
        $setting = \App\Models\Setting::first();
    @endphp
    @if ($setting)
        <title>@yield('title') - {{ $setting->name ?? '' }}</title>
    @else
        <title>@yield('title') - Application Name</title>
    @endif


</head>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid"
    data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.master.leftmenu')
        <!-- Left Sidebar End -->
        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('admin.master.topmenu')
                <!-- end Topbar -->
                @yield('content')
            </div>
            <!-- content -->
            <!-- Footer Start -->
            @include('admin.master.footer')
            <!-- end Footer -->
        </div>
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('admin.master.rightmenu')
    <div class="rightbar-overlay"></div>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote-bs5.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script> --}}

    <script>
        $('#summernote').summernote({
            placeholder: 'Description...',
            tabsize: 2,
            height: 100
        });
    </script>
    {{-- <script>$.NotificationApp.send("Title","Your awesome message text","Right","Background color","Icon")</script> --}}
    <script>
        @if (session()->has('success'))
            $.toast({
                heading: 'Success',
                text: '{{ session()->get('success') }}',
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'success'
            })
        @endif



        @if (session()->has('error'))
            $.toast({
                heading: 'Error',
                text: '{{ session()->get('error') }}',
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error'
            })
        @endif

        @if (@$errors->any())
            @foreach ($errors->all() as $error)
                $.toast({
                    heading: 'Error',
                    text: '{{ $error }}',
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'error'
                })
                {{-- toastr.error("{{ $error }}"); --}}
            @endforeach
        @endif
    </script>
    @stack('scripts')
</body>

</html>
