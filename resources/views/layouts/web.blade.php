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
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link href="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/plugins/jquery-confirm/jquery-confirm.min.css') }}">

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
            @auth
                <form class="form-a" method="post" action="javascript:void(0)" id="bookForm">
                    <div class="row">
                        <div class="col-md-6 mb-2">
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
                            <label class="pb-2">Avaialble Rooms</label>
                            <input type="text" class="form-control" id="available" value="--" readonly>
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
            @endauth

            @guest
                <div class="row mt-5 text-center">
                    <div class="col-lg-12 mb-5">
                        <h4>You must sign in before booking</h4>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <a href="{{ url('login') }}" class="btn btn-b">Click here to sign in</a>
                    </div>
                    <div class="col-lg-12">
                        <small>Don't have an account yet?</small> 
                        <br>
                        <a href="{{ url('register') }}">Click here to sign up</a>
                    </div>
                </div>
            @endguest
            
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

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-person"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item " href="javascript:void(0)" onclick="$('#transactions').modal('show'); callDt();">Transactions</a>
                                <a class="dropdown-item " href="javascript:void(0)" onclick="update({{ Auth::user()->id }})">User</a>
                                <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth

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

    @include('transactions')
    @include('user')

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

    <script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('public/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/main.js') }}"></script>

    @auth
        <script>
            $(document).ready(function(){
                $.fn.dataTable.ext.errMode = 'none';
                callDt();
            });
        </script>

        <script>
            function update(id) {
                $('#user').modal('show');

                $('[name=update_password]').val('');
                $('[name=update_confirmPw]').val('');

                $.ajax({
                    url: "{{ url('/admin/users/get') }}/"+id,
                    type: "GET",
                    success: function(items) {
                        $.each(items, function (i, item) {
                            $('[name=update_id]').val(item.id);
                            $('[name=update_firstname]').val(item.first_name);
                            $('[name=update_lastname]').val(item.last_name);
                            $('[name=update_address]').val(item.address);
                            $('[name=update_sex]').val(item.sex);
                            $('[name=update_contact]').val(item.contact);
                            $('[name=update_email]').val(item.email);
                            $('[name=update_username]').val(item.username);
                        });
                    }
                });
            }

            $('#userForm').on('submit', function () {
                let pw = $('[name=update_password]').val();
                let conPw = $('[name=update_confirmPw]').val();

                let uf = $('#userForm');
                let fd = new FormData(uf[0]);

                $.confirm({
                    animation: 'none',
                    theme: 'dark',
                    title: 'Update',
                    content: 'User will be updated, continue?',
                    buttons: {
                        No: function () {
                            //
                        },
                        Yes: {
                            btnClass: 'btn-primary',
                            action: function () {
                                if (pw != conPw) {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Oops!',
                                        content: 'Your password is not matched.'
                                    });
                                } 
                                else {
                                    $.ajax({
                                        url: '{{ url("/admin/users/update") }}',
                                        method: 'post',
                                        data: fd,
                                        processData: false,
                                        contentType: false,
                                        success: function (result) {
                                            if (result == 'success') {
                                                $.alert({
                                                    animation: 'none',
                                                    theme: 'dark',
                                                    title: 'Success!',
                                                    content: 'User has been updated.',
                                                    buttons: {
                                                        OK: function () {
                                                            callDt();
                                                            $('#user').modal('hide');
                                                            $('#userForm').trigger('reset');
                                                        },
                                                    }
                                                });
                                            } 
                                            else if (result == 'password_error') {
                                                $.alert({
                                                    animation: 'none',
                                                    theme: 'dark',
                                                    title: 'Oops!',
                                                    content: 'Your password is not matched.'
                                                });
                                            } 
                                            else if (result == 'username_error') {
                                                $.alert({
                                                    animation: 'none',
                                                    theme: 'dark',
                                                    title: 'Oops!',
                                                    content: 'Username has already been taken.'
                                                });
                                            } 
                                            else {
                                                $.alert({
                                                    animation: 'none',
                                                    theme: 'dark',
                                                    title: 'Failed!',
                                                    content: 'User has failed to update.'
                                                });
                                                console.log(result);
                                            }
                                        }
                                    });
                                }
                            }
                        },
                    }
                });
            });
        </script>

    @endauth

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

        function callDt() {
            $("#tb").DataTable({
                bDestroy: true,
                ajax: {
                    url: "{{ url('/admin/booking/online/table') }}",
                    dataSrc: ""
                },
                columns: [
                    {
                        data: 'ref'
                    },
                    {
                        data: 'room'
                    },
                    {
                        data: 'pax'
                    },
                    {
                        data: 'check_in'
                    },
                    {
                        data: 'check_out'
                    },
                    {
                        data: 'priceTotal',
                        render: function (data, type, row) {
                            return data.toLocaleString();
                        }
                            
                    },
                    {
                        data: 'status',
                        render: function (data, type, row) {
                            if (data == 0)
                                return '<span class="text-warning">Pending</span>';
                            else if (data == 1) 
                                return '<span class="text-info">Reserved</span>';
                            else if (data == 2)
                                return '<span class="text-success">Checked In</span>';
                            else if (data == 3)
                                return '<span class="text-warning">Checked Out</span>';
                        }
                    },
                    {
                        data: 'remarks'
                    },
                    {
                        data: 'payment'
                    },
                    {
                        data: 'payment_ref'
                    },
                ]
            });
        }

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

            $.ajax({
                url: '{{ url("/admin/booking/onsite/check-booked") }}',
                method: 'post',
                data: {
                    'room_id': $(this).val(),
                },
                success: function (result) {
                    $('#available').val(result);
                }
            });
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
                                'Success! Your book has now been pending. Please pay in any payment options.<br><hr>'+
                                '<div class="row">'+
                                    '<div class="col-lg-4 mb-3">'+
                                        '<h5>Gcash</h5>'+
                                        '<img src="{{ asset('public/assets/img/qr.png') }}" class="img-fluid">'+
                                    '</div>'+
                                    '<div class="col-lg-4 mb-3">'+
                                        '<h5>Bank</h5>'+
                                        '<label>BDO</label>'+
                                        '<p style="margin-left: 15px;">'+
                                            'Acc Name: John Doe <br>'+
                                            'Acc No. 04-6598745-03'+
                                        '</p>'+
                                        '<label>BPI</label>'+
                                        '<p style="margin-left: 15px;">'+
                                            'Acc Name: John Doe <br>'+
                                            'Acc No. 05-6987452-01'+
                                        '</p>'+
                                    '</div>'+
                                    '<div class="col-lg-4 mb-3">'+
                                        '<h5>Remittance</h5>'+
                                        '<label>Western Union</label><br>'+
                                        '<label>Palawan Express</label><br>'+
                                        '<label>Cebuana Lhuillier</label>'+
                                        '<br>'+
                                        '<br>'+
                                        '<p style="margin-left: 15px;">'+
                                            'Name: John Doe <br>'+
                                            'Contact. 09265648521'+
                                        '</p>'+
                                    '</div>'+
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
