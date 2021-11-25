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
                            <th>Ref #</th>
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

@include('admin.book-onsite.view')
@include('admin.book-onsite.add')
@include('admin.book-onsite.remarks')

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
                    data: 'ref'
                },
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
                    data: 'id',
                    render: function (data, type, row) {
                        if (row['status'] == 0) {
                            return '<div class="btn-group">'+
                                        '<button type="button" class="btn btn-default" onclick="remarks('+data+')"><i class="fas fa-marker"></i></button>'+
                                        '<button type="button" class="btn btn-info" onclick="view('+data+')"><i class="fas fa-eye"></i></button>'+
                                        '<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">'+
                                            '<span class="sr-only">Toggle Dropdown</span>'+
                                        '</button>'+
                                        '<div class="dropdown-menu dropdown-menu-right" role="menu">'+
                                            '<a class="dropdown-item text-info" href="javascript:void(0)" onclick="updateStatus('+data+', 1)">Reserve</a>'+
                                            '<a class="dropdown-item" href="javascript:void(0)" onclick="updateStatus('+data+', -1)">Cancel</a>'+
                                        '</div>'+
                                    '</div>';
                        }
                        else if (row['status'] == 1) {
                            return '<div class="btn-group">'+
                                        '<button type="button" class="btn btn-default" onclick="remarks('+data+')"><i class="fas fa-marker"></i></button>'+
                                        '<button type="button" class="btn btn-info" onclick="view('+data+')"><i class="fas fa-eye"></i></button>'+
                                        '<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">'+
                                            '<span class="sr-only">Toggle Dropdown</span>'+
                                        '</button>'+
                                        '<div class="dropdown-menu dropdown-menu-right" role="menu">'+
                                            '<a class="dropdown-item text-success" href="javascript:void(0)" onclick="updateStatus('+data+', 2)">Check In</a>'+
                                            '<a class="dropdown-item" href="javascript:void(0)" onclick="updateStatus('+data+', -1)">Cancel</a>'+
                                        '</div>'+
                                    '</div>';
                        }
                        else if (row['status'] == 2) {
                            return '<div class="btn-group">'+
                                        '<button type="button" class="btn btn-default" onclick="remarks('+data+')"><i class="fas fa-marker"></i></button>'+
                                        '<button type="button" class="btn btn-info" onclick="view('+data+')"><i class="fas fa-eye"></i></button>'+
                                        '<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">'+
                                            '<span class="sr-only">Toggle Dropdown</span>'+
                                        '</button>'+
                                        '<div class="dropdown-menu dropdown-menu-right" role="menu">'+
                                            '<a class="dropdown-item text-warning" href="javascript:void(0)" onclick="updateStatus('+data+', 3)">Check Out</a>'+
                                        '</div>'+
                                    '</div>';
                        }
                        else {
                            return '<div class="btn-group">'+
                                        '<button type="button" class="btn btn-default" onclick="remarks('+data+')"><i class="fas fa-marker"></i></button>'+
                                        '<button type="button" class="btn btn-info" onclick="view('+data+')"><i class="fas fa-eye"></i></button>'+
                                    '</div>';
                        }
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
                else if (result.status == 'unavailable'){
                    $('#checkRoom').hide();
                    $('#checkRoom').html(
                        '<div class="alert mt-1 alert-danger" role="alert">'+
                            'Room unavailable, choose other room or adjust the check in date.'+
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

                                                $('[name=room_id]').val('');
                                                $('[name=sex]').val('');
                                                $('.select2').select2();
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

    function updateStatus(id, status) {
        if (status == -1) {
            $.confirm({
                animation: 'none',
                theme: 'dark',
                title: 'Cancel',
                content: 'Book will be cancelled, continue?',
                buttons: {
                    No: function () {
                        //
                    },
                    Yes: {
                        btnClass: 'btn-dark',
                        action: function () {
                            $.ajax({
                                url: '{{ url("/admin/booking/onsite/status") }}/'+id+'/'+status,
                                method: 'get',
                                success: function (result) {
                                    if (result == 'success') {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Success!',
                                            content: 'Book has been cancelled.',
                                            buttons: {
                                                OK: function () {
                                                    callDt();
                                                },
                                            }
                                        });
                                    } 
                                    else {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Failed!',
                                            content: 'Book has failed to cancel.'
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
        else if (status == 1) {
            $.confirm({
                animation: 'none',
                theme: 'dark',
                title: 'Reserve',
                content: 'Book will be reserved, continue?',
                buttons: {
                    No: function () {
                        //
                    },
                    Yes: {
                        btnClass: 'btn-dark',
                        action: function () {
                            $.ajax({
                                url: '{{ url("/admin/booking/onsite/status") }}/'+id+'/'+status,
                                method: 'get',
                                success: function (result) {
                                    if (result == 'success') {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Success!',
                                            content: 'Book has been reserved.',
                                            buttons: {
                                                OK: function () {
                                                    callDt();
                                                },
                                            }
                                        });
                                    } 
                                    else {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Failed!',
                                            content: 'Book has failed to reserve.'
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
        else if (status == 2) {
            $.confirm({
                animation: 'none',
                theme: 'dark',
                title: 'Check In',
                content: 'Book will be checked in, continue?',
                buttons: {
                    No: function () {
                        //
                    },
                    Yes: {
                        btnClass: 'btn-dark',
                        action: function () {
                            $.ajax({
                                url: '{{ url("/admin/booking/onsite/status") }}/'+id+'/'+status,
                                method: 'get',
                                success: function (result) {
                                    if (result == 'success') {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Success!',
                                            content: 'Book has been checked in.',
                                            buttons: {
                                                OK: function () {
                                                    callDt();
                                                },
                                            }
                                        });
                                    } 
                                    else {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Failed!',
                                            content: 'Book has failed to check in.'
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
        else if (status == 3) {
            $.confirm({
                animation: 'none',
                theme: 'dark',
                title: 'Cancel',
                content: 'Book will be checked out, continue?',
                buttons: {
                    No: function () {
                        //
                    },
                    Yes: {
                        btnClass: 'btn-dark',
                        action: function () {
                            $.ajax({
                                url: '{{ url("/admin/booking/onsite/status") }}/'+id+'/'+status,
                                method: 'get',
                                success: function (result) {
                                    if (result == 'success') {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Success!',
                                            content: 'Book has been checked out.',
                                            buttons: {
                                                OK: function () {
                                                    callDt();
                                                },
                                            }
                                        });
                                    } 
                                    else {
                                        $.alert({
                                            animation: 'none',
                                            theme: 'dark',
                                            title: 'Failed!',
                                            content: 'Book has failed to check out.'
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
    }

    function remarks(id) {
        $('#remarksModal').modal({
            backdrop:'static'
        });

        $.ajax({
            url: "{{ url('/admin/booking/onsite/get') }}/"+id,
            type: "GET",
            success: function(items) {
                $.each(items, function (i, item) {
                    $('[name=remarks_id]').val(item.id);
                    $('[name=remarks_remarks]').val(item.remarks);
                });
            }
        });
    }

    $('#remarksForm').on('submit', function() {
        let uf = $('#remarksForm');
        let fd = new FormData(uf[0]);

        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Update',
            content: 'Item be updated, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-primary',
                    action: function () {
                        $.ajax({
                            url: '{{ url("/admin/booking/onsite/remarks-update") }}',
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
                                        content: 'Item has been updated.',
                                        buttons: {
                                            OK: function () {
                                                callDt();
                                                $('#remarksModal').modal('hide');
                                            },
                                        }
                                    });
                                } 
                                else {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Failed!',
                                        content: 'Item has failed to update.'
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

    function view(id) {
        $('#viewModal').modal({
            backdrop:'static'
        });

        $.ajax({
            url: "{{ url('/admin/booking/onsite/get') }}/"+id,
            type: "GET",
            success: function(items) {
                $.each(items, function (i, item) {
                    $('[name=view_room]').html(item.room);
                    $('[name=view_adults]').html(item.adults);
                    $('[name=view_children]').html(item.children == null ? 0 : item.children);
                    $('[name=view_infants]').html(item.infants == null ? 0 : item.infants);
                    $('[name=view_add_person]').html(item.add_person == null ? 0 : item.add_person);
                    $('[name=view_check_in]').html(item.check_in);
                    $('[name=view_check_out]').html(item.check_out);
                    $('[name=view_firstname]').html(item.firstname);
                    $('[name=view_lastname]').html(item.lastname);
                    $('[name=view_address]').html(item.address);
                    $('[name=view_sex]').html(item.sex);
                    $('[name=view_contact_no]').html(item.contact_no);
                    $('[name=view_email]').html(item.email == null ? '--' : item.email);
                    $('[name=view_remarks]').html(item.remarks == null ? '--' : item.remarks);
                });
            }
        });
    }

</script>
@endsection
