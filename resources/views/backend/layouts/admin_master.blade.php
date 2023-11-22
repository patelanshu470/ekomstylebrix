<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="{{ getenv('WEBSITE_NAME') }}">
    <link rel="icon" href="{{ asset(getenv("FAVICON_ICON")) }}">
    <link rel="shortcut icon" href="{{ asset(getenv("FAVICON_ICON")) }}" type="image/x-icon">
    <title>{{ getenv('WEBSITE_NAME') }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/resources/assets/css/linearicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/ratio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vector-map.css') }}">
    <link rel="stylesheet" href="{{ asset('public/resources/assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/resources/assets/css/vendors/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('public/resources/assets/toastr/toatr.css') }}">
    <style>
        .custom-active {
            background-color: #ffffff3b !important;
        }
        .error {
            color: red;
            margin: 0px !important;
        }
        /* Customize DataTable pagination styles */
        .dataTables_paginate {
            text-align: center;
            margin-top: 10px;
        }
        .dataTables_paginate .paginate_button {
            display: inline-block;
            padding: 6px 12px;
            margin: 3px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
        }
        .dataTables_paginate .paginate_button.current {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .dataTables_paginate .paginate_button:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('backend.layouts.panels.navbar')
        <div class="page-body-wrapper">

            @include('backend.layouts.panels.sidebar')
            <div class="page-body">
                @yield('content')
                @include('backend.layouts.panels.footer')
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/40ab2e945c.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/resources/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/config.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/chart/apex-chart/chart-custom1.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/custom-slick.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/customizer.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/ratio.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/sidebareffect.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/script.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/custom-data-table.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/js/select2-custom.js') }}"></script>
    <script src="{{ asset('public/resources/assets/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/sweetalert/sweetalerts.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('public/resources/assets/toastr/toastr.js') }}"></script>
    {{-- <script src="{{ asset('resources/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('resources/assets/js/ckeditor-custom.js') }}"></script> --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('status'))
            toastr.success("{{ Session::get('status') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
<audio id="audio" src="{{ asset('public/audio/notification.mp3') }}" preload="auto"></audio>
<script>
    $(document).ready(function() {
        function playAudio() {
            var audio = $('#audio')[0];
            audio.play();
        }
        function showNotification() {
            Swal.fire({
                title: "You have a new order, please check.",
                icon: "warning", // Use the appropriate icon value
                showCancelButton: false,
                confirmButtonColor: "#1b00ff",
                confirmButtonText: "Ok, let me check",
               
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('pending.orders') }}";
                }
            });
        }
        function getData() {
            $.ajax({
                url: "{{ route('check.new.order') }}",
                type: "GET",
                success: function(data) {
                    if (data) {
                        playAudio();
                        showNotification();
                    }
                }
            });
        }
        setInterval(getData, 5000); // Check for new orders every 5 seconds
    });
</script>

</body>

</html>
