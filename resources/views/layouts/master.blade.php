<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="#" type="image/png" />
    <!--plugins-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('admin/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('admin/assets/css/others.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/sweetalert-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/custom.css') }}" rel="stylesheet">
    <title>Project Management System</title>
    <meta name="app-url" content="/">
    <meta name="file-base-url" content="/">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .svg-clock {
            max-width: 200px !important;
        }
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--navigation-->
        @include('layouts.sidebar')
        <!--end navigation-->
        <!--start header -->
        @include('layouts.topbar')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('layouts.footer')
    </div>
    <!--end wrapper-->
    <!--plugins-->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/assets/js/others.js') }}"></script>
    <script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sweetalert-2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: ({
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            })
        });
    </script>

    {!! Toastr::message() !!}
    @yield('script')
    @stack('scripts')
</body>

</html>