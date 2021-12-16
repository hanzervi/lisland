<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <link href="{{ asset('public/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">

    <style>
        .btn-wide {
            width: 100%;
            height: 200px;
            font-size: 50px;
        }

        #counter {
            color: rgb(77, 189, 77);
        }
    </style>

</head>

<body>


    <main id="main">
        <section class="container mt-5 mb-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            {{ date('M d, Y') }}
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <span id="time">
                                {{ date('H:i:s A') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-success btn-wide" id="btnIn">IN</button>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-danger btn-wide" id="btnOut" disabled>OUT</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-5">
                            <h1 id="counter">{{ $number }}</h1>
                            <small># of Guest/s</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
        });
        var counter = $('#counter').html();
        
        $(document).ready(function() {
            setInterval(function(){ 
                $('#time').load(' #time');
            }, 1000);

            if (counter > 0)
                $('#btnOut').attr('disabled', false);
        });

        $('#btnIn').on('click', function() {
            counter++;
            $('#counter').html(counter);

            if (counter > 0)
                $('#btnOut').attr('disabled', false);
            else
                $('#btnOut').attr('disabled', true);

            $.ajax({
                url: "{{ url('/in-out/update/') }}/"+counter,
                method: 'post',
                processData: false,
                contentType: false,
                success: function(result){
                    console.log(result);
                }
            });
        });

        $('#btnOut').on('click', function() {
            counter--;
            $('#counter').html(counter);

            if (counter > 0)
                $('#btnOut').attr('disabled', false);
            else
                $('#btnOut').attr('disabled', true);

            $.ajax({
                url: "{{ url('/in-out/update/') }}/"+counter,
                method: 'post',
                processData: false,
                contentType: false,
                success: function(result){
                    console.log(result);
                }
            });
        });
    </script>

</body>

</html>
