<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('public/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('public/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <link href="{{ asset('public/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">

    <style>
        .img-room {
            width: auto;
            height: 600px;
            object-fit: cover;
        }

    </style>

</head>

<body>

    <div class="click-closed"></div>

    <div class="box-collapse">
        <div class="title-box-d">
            <h3 class="title-d">Book Now</h3>
        </div>
        <span class="close-box-collapse right-boxed bi bi-x"
            onclick="$('#bookForm').trigger('reset'); $('#checkRoom').html(''); $('#btnCheck').prop('disabled', true);"></span>
        <div class="box-collapse-wrap form">
            <form class="form-a" method="post" action="javascript:void(0)" id="bookForm">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="form-group">
                            <label class="pb-2" for="room">Room Type <span class="text-danger">*</span></label>
                            <select class="form-control form-select form-control-a" name="room_id"
                                onchange="btnCheckChange()" required>
                                <option value="" selected disabled>Select Room</option>
                                @if (count($data['room']) > 0)
                                @foreach ($data['room'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group mt-3">
                            <label class="pb-2">Check In Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" placeholder="Check In Date" name="check_in"
                                onchange="btnCheckChange()" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group mt-3">
                            <label class="pb-2">Check Out Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" placeholder="Check Out Date" name="check_out"
                                onchange="btnCheckChange()" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group mt-3">
                            <label class="pb-2">Adults <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" min="1" value="0" step="1" name="adults"
                                onchange="btnCheckChange()" placeholder="Adults">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group mt-3">
                            <label class="pb-2">Children</label>
                            <input type="number" class="form-control" min="0" value="0" step="1" name="children"
                                onchange="btnCheckChange()" placeholder="Children">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group mt-3">
                            <label class="pb-2">Infants</label>
                            <input type="number" class="form-control" min="0" value="0" step="1" name="infants"
                                onchange="btnCheckChange()" placeholder="Infant">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-b" id="btnCheck" onclick="checkRoom()" disabled>Check
                            Availability</button>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div id="checkRoom">

                        </div>
                    </div>
                    {{--  --}}
                    <div class="col-lg-6">
                        <div class="form-group mt-3">
                            <label class="pb-2">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="firstname" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mt-3">
                            <label class="pb-2">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="lastname" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mt-3">
                            <label class="pb-2">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-3">
                            <label class="pb-2">Sex <span class="text-danger">*</span></label>
                            <select class="form-control form-select form-control-a" name="sex" required>
                                <option value="" selected disabled></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-3">
                            <label class="pb-2">Contact <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="contact_no" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-3">
                            <label class="pb-2">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-b">Book Now</button>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div id="bookStatus">
                          
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
        <div class="container">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false"
                aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a class="navbar-brand text-brand" href="{{ url('/') }}"><img
                    src="{{ asset('public/assets/img/logo.png') }}" width="145px"></a>

            <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="#about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="#rooms">Rooms</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="#amenities">Amenities</a>
                    </li>

                    {{-- <li class="nav-item">
            <a class="nav-link " href="#contact">Contact</a>
          </li> --}}

                </ul>
            </div>

            <button type="button" class="btn btn-b-n btn-book navbar-toggle-box navbar-toggle-box-collapse"
                data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
                Book Now
            </button>

        </div>
    </nav>

    <div class="intro swiper position-relative" id="home">

        <div class="swiper-wrapper">

            <div class="swiper-slide carousel-item-a intro-item bg-image"
                style="background-image: url({{ asset('public/assets/img/home-bg.jpg') }})">
                <div class="overlay overlay-a"></div>
                <div class="intro-content display-table">
                    <div class="table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="intro-body">
                                        <p class="intro-title-top">182 McArthur Highway
                                            <br> Urdaneta City
                                        </p>
                                        <h1 class="intro-title mb-4">
                                            <span class="color-b">Lisland</span>
                                            <br> Rainforest Resort
                                        </h1>
                                        <p class="intro-subtitle intro-price">
                                            <a href="#main"><span class="price-a">Get Started</span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main id="main">
        @yield('content')
    </main>

    <section class="section-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="widget-a">
                        <div class="w-header-a">
                            <h3 class="w-title-a text-brand">Lisland</h3>
                        </div>
                        <div class="w-body-a">
                            <p class="w-text-a color-text-a">
                                Rainforest Resort
                            </p>
                        </div>
                        <div class="w-footer-a">
                            <ul class="list-unstyled">
                                <li class="color-a">
                                    inquiries_lisland@yahoo.com
                                </li>
                                <li class="color-a">
                                    (+63) 915 750-1817
                                </li>
                                <li class="color-a">
                                    (075) 656-2379
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 section-md-t3">
                    <div class="widget-a">
                        <div class="w-body-a">
                            <div class="w-body-a">
                                <ul class="list-unstyled">
                                    <li class="item-list-a">
                                        <i class="bi bi-chevron-right"></i> <a href="#home">Home</a>
                                    </li>
                                    <li class="item-list-a">
                                        <i class="bi bi-chevron-right"></i> <a href="#about">About</a>
                                    </li>
                                    <li class="item-list-a">
                                        <i class="bi bi-chevron-right"></i> <a href="#rooms">Rooms</a>
                                    </li>
                                    <li class="item-list-a">
                                        <i class="bi bi-chevron-right"></i> <a href="#amenities">Amenities</a>
                                    </li>
                                    {{-- <li class="item-list-a">
                                        <i class="bi bi-chevron-right"></i> <a href="#contact">Contact</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 section-md-t3">
                    <div class="widget-a">
                        <div class="w-body-a">
                            <ul class="list-unstyled">
                                <li class="item-list-a">
                                    <i class="bi bi-chevron-right"></i> <a href="#">Terms and Condition</a>
                                </li>
                                <li class="item-list-a">
                                    <i class="bi bi-chevron-right"></i> <a href="#">Privacy Policy</a>
                                </li>
                                <li class="item-list-a">
                                    <i class="bi bi-chevron-right"></i> <a href="#">Cookie Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="socials-a">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="bi bi-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="bi bi-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="bi bi-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="copyright-footer">
                        <p class="copyright color-text-a">
                            &copy; Copyright
                            <span class="color-a">Lisland</span> All Rights Reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            if (today.getHours() >= 14) 
                today = yyyy + '-' + mm + '-' + (dd+1);
            else
                today = yyyy + '-' + mm + '-' + dd;

            $('input[type="date"]').attr('min', today);

        });

        $('[name=room_id]').on('change', function () {
            $('[name=adults]').val(0);
            $('[name=children]').val(0);
            $('[name=infants]').val(0);

            $.ajax({
                url: '{{ url("/admin/booking/onsite/check-room-capacity") }}',
                method: 'post',
                data: {
                    'room_id': $(this).val(),
                },
                success: function (result) {
                    $('[name=adults]').attr('max', result.adults == null ? 0 : result.adults);
                    $('[name=children]').attr('max', result.children == null ? 0 : result.children);
                    $('[name=infants]').attr('max', result.infants == null ? 0 : result.infants);
                }
            });

            $('#btnCheck').prop('disabled', true);
        });

        function btnCheckChange() {
            if ($('[name=room_id]').val() != '' && $('[name=adults]').val() != '' && $('[name=adults]').val() != 0 && $(
                    '[name=check_in]').val() != '' && $('[name=check_out]').val() != '') {
                $('#btnCheck').prop('disabled', false);
            } else {
                $('#btnCheck').prop('disabled', true);
            }
            $('#checkRoom').fadeOut();
        }

        function checkRoom() {
            $.ajax({
                url: '{{ url("/booking/online/check-room") }}',
                method: 'post',
                data: {
                    'room_id': $('[name=room_id]').val(),
                    'adults': $('[name=adults]').val(),
                    'children': $('[name=children]').val(),
                    'infants': $('[name=infants]').val(),
                    'check_in': $('[name=check_in]').val(),
                    'check_out': $('[name=check_out]').val(),
                },
                success: function (result) {
                    if (result.status == 'available') {
                        $('#checkRoom').hide();
                        $('#checkRoom').html(
                            '<div class="alert mt-1 alert-success" role="alert">' +
                            'Room available, you can now proceed.<br>' +
                            'Price Total: ' + (result.price).toLocaleString() +
                            '</div>'
                        );
                        $('#checkRoom').fadeIn();
                    } else if (result.status == 'unavailable') {
                        $('#checkRoom').hide();
                        $('#checkRoom').html(
                            '<div class="alert mt-1 alert-danger" role="alert">' +
                            'Room unavailable, choose other room or adjust the check in date.' +
                            '</div>'
                        );
                        $('#checkRoom').fadeIn();
                    }
                    console.log(result.status);
                }
            });
        }

        $('#bookForm').on('submit', function () {
            let uf = $('#bookForm');
            let fd = new FormData(uf[0]);

            $.ajax({
                url: '{{ url("/booking/online/add") }}',
                method: 'post',
                data: fd,
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result == 'success') {
                        $('#bookStatus').hide();
                        $('#bookStatus').html(
                            '<div class="alert mt-1 alert-success" role="alert">'+
                              'Success! Your book has now been pending. Please pay thru Gcash QR Code.<br><hr>'+
                              '<div class="text-center">'+
                                '<img src="{{ asset('public/assets/img/qr.png') }}" width="200px" height="auto" class="img">'+
                              '</div>'+
                            '</div>'
                        );
                        $('#bookStatus').fadeIn();

                        $('#bookForm').trigger('reset');
                        $('#btnCheck').prop('disabled', true);
                        $('#checkRoom').hide();
                    } else {
                        $('#bookStatus').hide();
                        $('#bookStatus').html(
                            '<div class="alert mt-1 alert-danger" role="alert">' +
                            'Failed! Your book has failed to add.' +
                            '</div>'
                        );
                        $('#bookStatus').fadeIn();

                        console.log(result);
                    }
                }
            });
        });

    </script>

</body>

</html>
