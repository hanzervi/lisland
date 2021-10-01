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
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">


    <style>
        .btn-custom {
            min-width: 100px !important;
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
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="{{ url('/admin') }}" class="brand-link">
                <img src="{{ asset('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
                                        <p>Online <span class="right badge badge-danger">New</span></p>
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
                            <a href="{{ url('/admin/pool') }}" class="nav-link {{ Request::is('admin/pool') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-swimming-pool"></i>
                                <p>Pool</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/food-and-drink') }}" class="nav-link {{ Request::is('admin/food-and-drink') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-utensils"></i>
                                <p>Food & Drink</p>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/user/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>User <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/user/profile') }}" class="nav-link {{ Request::is('admin/user/profile') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/user/accounts') }}" class="nav-link {{ Request::is('admin/user/accounts') || Request::is('admin/user/accounts/*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Accounts</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} Lisland.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>

    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
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
        });
    </script>

    @yield('js')
    
</body>

</html>
