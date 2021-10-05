@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <a href="#" data-toggle="modal" data-target="#addModal">
            <button class="btn btn-custom btn-success">Add</button>
        </a>
        @if (Auth::id() == 1)
            <a href="{{ url('admin/users/bin') }}" class="float-right">
                <button class="btn btn-outline-secondary"><i class="fa fa-trash"></i></button>
            </a>
        @endif
        <div class="card mt-3">
            <div class="card-body">
                <table id="tb" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.users.add')
@include('admin.users.update')

@endsection

@section('js')
<script>
    $(document).ready(function () {
        callDt();
    });

    function callDt() {
        $("#tb").DataTable({
            bDestroy: true,
            ajax: {
                url: "{{ url('/admin/users/table') }}",
                dataSrc: ""
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'username'
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return '<div class="btn-group float-right">' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-primary" onclick="update('+data+')"><i class="fas fa-edit"></i></a>' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-danger" onclick="remove('+data+')"><i class="fas fa-trash"></i></a>' +
                                '</div>';
                    }
                },
            ]
        });
    }

    $('#addForm').on('submit', function () {
        let pw = $('[name=password]').val();
        let conPw = $('[name=confirmPw]').val();

        let uf = $('#addForm');
        let fd = new FormData(uf[0]);

        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Add',
            content: 'User account will be added, continue?',
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
                                    if (result == 'success') {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Success!',
                                            content: 'User account has been added.',
                                            buttons: {
                                                OK: function () {
                                                    callDt();
                                                    $('#addModal').modal('hide');
                                                    $('#addForm').trigger('reset');
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
                                            content: 'User account has failed to add.'
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

    function remove(id) {
        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Remove',
            content: 'User acocunt will be removed, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-danger',
                    action: function(){

                        $.ajax({
                            url: "{{ url('/admin/users/remove') }}/"+id,
                            method: 'post',
                            processData:false,
                            contentType: false,
                            success: function(result){
                                if (result == 'success') {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Success!',
                                        content: 'User account has been removed.',
                                    });
                                    callDt();
                                }
                                else {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Failed!',
                                        content: 'User account has failed to remove.',
                                    });
                                    console.log(result);
                                }
                            }
                        });
                    }
                },
            }
        });
    }

    function update(id) {
        $('#updateModal').modal({
            backdrop:'static'
        });

        $('[name=update_password]').val('');
        $('[name=update_confirmPw]').val('');

        $.ajax({
            url: "{{ url('/admin/users/get') }}/"+id,
            type: "GET",
            success: function(items) {
                $.each(items, function (i, item) {
                    $('[name=update_id]').val(item.id);
                    $('[name=update_name]').val(item.name);
                    $('[name=update_username]').val(item.username);
                });
            }
        });
    }

    $('#updateForm').on('submit', function () {
        let pw = $('[name=update_password]').val();
        let conPw = $('[name=update_confirmPw]').val();

        let uf = $('#updateForm');
        let fd = new FormData(uf[0]);

        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Update',
            content: 'User account will be updated, continue?',
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
                                            content: 'User account has been updated.',
                                            buttons: {
                                                OK: function () {
                                                    callDt();
                                                    $('#updateModal').modal('hide');
                                                    $('#updateForm').trigger('reset');
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
                                            content: 'User account has failed to update.'
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
@endsection
