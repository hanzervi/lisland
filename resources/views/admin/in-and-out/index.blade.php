@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">In & Out</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <form action="javascript:void(0)" id="addForm">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Birthdate <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="birthdate" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Contact <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button class="btn btn-success btn-block">IN</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Infant / Toddler / Child</span>
                        <span class="info-box-number">
                            <div id="child">
                                {{ $data['child'] }}
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Teen / Adult</span>
                        <span class="info-box-number">
                            <div id="adult">
                                {{ $data['adult'] }}
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>

            <div class="col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Senior</span>
                        <span class="info-box-number">
                            <div id="senior">
                                {{ $data['senior'] }}
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="tb" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Birthdate</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>DateTime In</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        callDt();
    });

    function rfData() {
        $("#child").load(window.location.href + " #child" );
        $("#adult").load(window.location.href + " #adult" );
        $("#senior").load(window.location.href + " #senior" );
    }

    function callDt() {
        $("#tb").DataTable({
            bDestroy: true,
            ajax: {
                url: "{{ url('/admin/in-and-out/table') }}",
                dataSrc: ""
            },
            columns: [
                {
                    data: 'firstname',
                    render: function (data, type, row) {
                        return data + ' ' + row['lastname'];
                    }
                },
                {
                    data: 'address'
                },
                {
                    data: 'birthdate'
                },
                {
                    data: 'contact'
                },
                {
                    data: 'email'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return '<div class="btn-group float-right">' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-danger" onclick="out('+data+')"><i class="fas fa-door-open"></i></a>' +
                                '</div>';
                    }
                },
            ]
        });

        rfData();
    }

    $('#addForm').on('submit', function() {
        let uf = $('#addForm');
        let fd = new FormData(uf[0]);

        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'In',
            content: 'Person will be recorded as in, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-success',
                    action: function () {
                        $.ajax({
                            url: '{{ url("/admin/in-and-out/add") }}',
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
                                        content: 'Person has been recorded',
                                        buttons: {
                                            OK: function () {
                                                callDt();
                                                $('#addForm').trigger('reset');
                                            },
                                        }
                                    });
                                }
                                else {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Failed!',
                                        content: 'Person has failed to record.'
                                    });
                                    console.log(result);
                                }
                            }
                        });
                    }
                },
            }
        });
    })

    function out(id) {
        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Out',
            content: 'Person will be recorded as out, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-danger',
                    action: function(){

                        $.ajax({
                            url: "{{ url('/admin/in-and-out/out') }}/"+id,
                            method: 'post',
                            processData:false,
                            contentType: false,
                            success: function(result){
                                if (result == 'success') {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Success!',
                                        content: 'Person has been recorded.',
                                    });
                                    callDt();
                                }
                                else {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Failed!',
                                        content: 'Person has failed to record.',
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

</script>
@endsection
