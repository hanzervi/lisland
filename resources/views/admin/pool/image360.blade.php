<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    
    <link rel="stylesheet" href="{{ asset('plugins/panorama-viewer/panorama_viewer.css') }}">
    
    <style>
        .panorama {
            width: auto;
            height: 600px;
            margin: 50px 0 50px 0;
        }
    </style>

</head>

<body class="control-sidebar-slide-open sidebar-collapse">
    <div class="wrapper">

        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="panorama">
                            <img src="" id="image360">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} Lisland.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        @include('admin.users.profile')

    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="{{ asset('plugins/panorama-viewer/jquery.panorama_viewer.js') }}"></script>

    <script>
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".panorama").panorama_viewer({
                repeat: false,
                direction: "horizontal",
                animationTime: 700,
                easing: "ease-out",
                overlay: true
            });

            $.ajax({
                url: "{{ url('/admin/pool/get') }}/4",
                type: "GET",
                success: function(items) {
                    $.each(items, function (i, item) {
                        $('#image360').prop('src', '{{ asset('storage/pool') }}/'+item.image360+'');
                    });
                }
            });
        });


    </script>
    
</body>

</html>
