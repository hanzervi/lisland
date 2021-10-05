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
        <a href="{{ url('admin/users') }}">
            <button class="btn btn-custom btn-outline-secondary">Back</button>
        </a>
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
                url: "{{ url('/admin/users/bin/table') }}",
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
                                    '<a href="javascript:void(0)" type="button" class="btn btn-secondary" onclick="restore('+data+')"><i class="fas fa-undo-alt"></i></a>' +
                                '</div>';
                    }
                },
            ]
        });
    }

    function restore(id) {
        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Restore',
            content: 'User acocunt will be restored, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-secondary',
                    action: function(){

                        $.ajax({
                            url: "{{ url('/admin/users/bin/restore') }}/"+id,
                            method: 'post',
                            processData:false,
                            contentType: false,
                            success: function(result){
                                if (result == 'success') {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Success!',
                                        content: 'User account has been restored.',
                                    });
                                    callDt();
                                }
                                else {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Failed!',
                                        content: 'User account has failed to restore.',
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