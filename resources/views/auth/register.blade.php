<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition register-page">
    <div class="container mt-5">
        <div class="login-logo">
            <a href="#">Customer Account Registration</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="javascript:void(0)" method="POST" id="registerForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Sex <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="sex" required>
                                        <option value="" selected disabled></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Contact <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contact" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="confirmPw" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-custom btn-default" data-dismiss="modal" onclick="window.history.back()">Back</button>
                        <button role="submit" class="btn btn-custom btn-success">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('public/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
</body>

<script>

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $('#registerForm').on('submit', function () {
        let pw = $('[name=password]').val();
        let conPw = $('[name=confirmPw]').val();

        let uf = $('#registerForm');
        let fd = new FormData(uf[0]);

        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Register',
            content: 'Your account will be registered, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-success',
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
                                url: '{{ url("/admin/users/add") }}',
                                method: 'post',
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function (result) {
                                    console.log(result);
                                    if (result == 'success') {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Success!',
                                            content: 'Your account has been registered.',
                                            buttons: {
                                                OK: function () {
                                                    window.history.back();
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
                                            content: 'Your account has failed to register.'
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

</html>