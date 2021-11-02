<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">

    <style>
        .btn-custom {
            min-width: 100px !important;
        }

        .food-drink {
            height: 260px;
            width: 360px;
            object-fit: cover;
        }

        .pool-images {
            height: 150px;
            width: 150px;
            object-fit: cover;
        }

        .pool-image360 {
            height: auto;
            width: 100%;
            object-fit: cover;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown" id="userBtn">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <b>{{ Auth::user()->name }}</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item" onclick="profile({{ Auth::id() }})">
                            <i class="fas fa-user-secret mr-2"></i> Credential
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item" >
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="{{ url('/admin') }}" class="brand-link">
                <img src="{{ asset('public/assets/img/lisland-icon.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Lisland</span>
            </a>

            <div class="sidebar">

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-chart-line"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/booking/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Booking <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/booking/online') }}" class="nav-link {{ Request::is('admin/booking/online') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Online <span class="right badge badge-warning" id="countPending" style="display: none"></span></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/booking/onsite') }}" class="nav-link {{ Request::is('admin/booking/onsite') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Onsite</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/customer') }}" class="nav-link {{ Request::is('admin/customer') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/room') }}" class="nav-link {{ Request::is('admin/room') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Room</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/pool') }}" class="nav-link {{ Request::is('admin/pool') || Request::is('admin/pool/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-swimming-pool"></i>
                                <p>Pool</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/food-and-drink') }}" class="nav-link {{ Request::is('admin/food-and-drink') || Request::is('admin/food-and-drink/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-utensils"></i>
                                <p>Food & Drink</p>
                            </a>
                        </li>
                        @if (Auth::id() == 1)
                            <li class="nav-item">
                                <a href="{{ url('/admin/users') }}" class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') . ' ' . config('app.name', 'Laravel') }}.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        @include('admin.users.profile')

    </div>

    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('public/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('public/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/adminlte.js') }}"></script>

    <script>
        $( document ).ready(function() {
            //$.fn.dataTable.ext.errMode = 'none';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.select2').select2();
            $('.select2').width('100%');


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
                
            today = yyyy + '-' + mm + '-' + dd;
            $('input[type="date"]').attr('min', today);


            countPending();
        });

        function countPending() {
            $.ajax({
                url: "{{ url('/admin/booking/online/count-pending') }}",
                type: "GET",
                success: function(result) {
                    if (result > 0) {
                        $('#countPending').html(result);
                        $('#countPending').css('display', 'block');
                    }
                    else {
                        $('#countPending').css('display', 'none');
                    }
                }
            });
        }

        function profile(id) {
            $('#profileModal').modal({
                backdrop:'static'
            });

            $('[name=profile_password]').val('');
            $('[name=profile_confirmPw]').val('');

            $.ajax({
                url: "{{ url('/admin/users/get') }}/"+id,
                type: "GET",
                success: function(items) {
                    $.each(items, function (i, item) {
                        $('[name=profile_id]').val(item.id);
                        $('[name=profile_name]').val(item.name);
                        $('[name=profile_username]').val(item.username);
                    });
                }
            });
        }

        $('#profileForm').on('submit', function () {
            let pw = $('[name=profile_password]').val();
            let conPw = $('[name=profile_confirmPw]').val();

            let uf = $('#profileForm');
            let fd = new FormData(uf[0]);

            $.confirm({
                animation: 'none',
                theme: 'dark',
                title: 'Update',
                content: 'User profile will be updated, continue?',
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
                                    url: '{{ url("/admin/users/profile") }}',
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
                                                content: 'User profile has been updated.',
                                                buttons: {
                                                    OK: function () {
                                                        $('#profileModal').modal('hide');
                                                        $('#userBtn').load(document.URL +  ' #userBtn');
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
                                                content: 'User profile has failed to update.'
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

    @yield('js')
    
</body>

</html>
