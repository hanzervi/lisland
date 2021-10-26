@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Book <small>- Onsite</small></h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <a href="#" data-toggle="modal" data-target="#addModal">
            <button class="btn btn-custom btn-success">Add</button>
        </a>
        <div class="card mt-3">
            <div class="card-body">
                <table id="tb" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Customer</th>
                            <th>Pax</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Price Total</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- @include('admin.pool.view') --}}
@include('admin.book-onsite.add')
{{-- @include('admin.pool.update') --}}

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
                url: "{{ url('/admin/booking/onsite/table') }}",
                dataSrc: ""
            },
            columns: [
                {
                    data: 'room'
                },
                {
                    data: 'customer'
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
                            return '<span class="text-success">Active</span>';
                        else if (data == 2)
                            return '<span class="text-info">Checked Out</span>';
                    }
                },
                {
                    data: 'remarks'
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return '<div class="btn-group float-right">' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-info" onclick="view('+data+')"><i class="fas fa-eye"></i></a>' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-primary" onclick="update('+data+')"><i class="fas fa-edit"></i></a>' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-danger" onclick="remove('+data+')"><i class="fas fa-trash"></i></a>' +
                                '</div>';
                    }
                },
            ]
        });
    }

    $('[name=room_id]').on('change', function() {
        $('[name=adults]').val('');
        $('[name=children]').val('');
        $('[name=infants]').val('');

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
    });

    function btnCheckChange() {
        if ($('[name=room_id]').val() != '' && $('[name=adults]').val() != '' && $('[name=check_in]').val() != '' && $('[name=check_out]').val() != '') 
        {
            $('#btnCheck').prop('disabled', false);
        }
        else {
            $('#btnCheck').prop('disabled', true);
        }
        $('#checkRoom').fadeOut();
    }

    function checkRoom() {
        $.ajax({
            url: '{{ url("/admin/booking/onsite/check-room") }}',
            method: 'post',
            data: {
                'room_id': $('[name=room_id]').val(),
                'adults': $('[name=adults]').val(),
                'children': $('[name=children]').val(),
                'infants': $('[name=infants]').val(),
                'add_person': $('[name=add_person]').val(),
                'check_in': $('[name=check_in]').val(),
                'check_out': $('[name=check_out]').val(),
            },
            success: function (result) {
                if (result.status == 'available') {
                    $('#checkRoom').hide();
                    $('#checkRoom').html(
                        '<div class="alert mt-1 alert-success" role="alert">'+
                            'Room available, you can now proceed.<br>'+
                            'Price Total: '+(result.price).toLocaleString()+
                        '</div>'
                    );
                    $('#checkRoom').fadeIn();
                }
                console.log(result.status);
            }
        });
    }

    $('#addForm').on('submit', function () {
        let uf = $('#addForm');
        let fd = new FormData(uf[0]);

        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Add',
            content: 'Item will be added, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-success',
                    action: function () {
                        $.ajax({
                            url: '{{ url("/admin/booking/onsite/add") }}',
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
                                        content: 'Item has been added.',
                                        buttons: {
                                            OK: function () {
                                                callDt();
                                                $('#addModal').modal('hide');
                                                $('#addForm').trigger('reset');
                                                $('#checkRoom').hide();
                                            },
                                        }
                                    });
                                } 
                                else {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Failed!',
                                        content: 'Item has failed to add.'
                                    });
                                    console.log(result);
                                }
                            }
                        });
                    }
                },
            }
        });
    });

</script>
@endsection
