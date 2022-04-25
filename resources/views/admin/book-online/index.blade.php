@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Book <small>- Online</small></h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
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

@include('admin.book-online.view')
@include('admin.book-online.update')

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
                                        '<button type="button" class="btn btn-primary" onclick="update('+data+')"><i class="fas fa-edit "></i></button>'+
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
                                        '<button type="button" class="btn btn-primary" onclick="update('+data+')"><i class="fas fa-edit "></i></button>'+
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
                                        '<button type="button" class="btn btn-primary" onclick="update('+data+')"><i class="fas fa-edit "></i></button>'+
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
                                        '<button type="button" class="btn btn-primary" onclick="update('+data+')"><i class="fas fa-edit "></i></button>'+
                                        '<button type="button" class="btn btn-info" onclick="view('+data+')"><i class="fas fa-eye"></i></button>'+
                                    '</div>';
                        }
                    }
                },
            ]
        });
    }

    function update(id) {
        $('#updateModal').modal({
            backdrop:'static'
        });

        $.ajax({
            url: "{{ url('/admin/booking/online/get') }}/"+id,
            type: "GET",
            success: function(items) {
                $.each(items, function (i, item) {
                    $('[name=update_id]').val(item.id);
                    $('[name=update_adults]').val(item.adults);
                    $('[name=update_children]').val(item.children == null ? 0 : item.children);
                    $('[name=update_infants]').val(item.infants == null ? 0 : item.infants);
                    $('[name=update_add_person]').val(item.add_person == null ? 0 : item.add_person);
                    $('[name=update_remarks]').val(item.remarks);
                    $('[name=update_payment]').val(item.payment);
                    $('[name=update_payment_ref]').val(item.payment_ref);
                });
            }
        });
    }

    $('#updateForm').on('submit', function() {
        let uf = $('#updateForm');
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
                            url: '{{ url("/admin/booking/online/update") }}',
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
                                                $('#updateModal').modal('hide');
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
                                url: '{{ url("/admin/booking/online/status") }}/'+id+'/'+status,
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
                                url: '{{ url("/admin/booking/online/status") }}/'+id+'/'+status,
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
                                url: '{{ url("/admin/booking/online/status") }}/'+id+'/'+status,
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
                                url: '{{ url("/admin/booking/online/status") }}/'+id+'/'+status,
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

    function view(id) {
        $('#viewModal').modal({
            backdrop:'static'
        });

        $.ajax({
            url: "{{ url('/admin/booking/online/get') }}/"+id,
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
                    $('[name=view_paidThru]').html(item.payment == null ? '--' : item.payment);
                    $('[name=view_paymentRef]').html(item.payment_ref == null ? '--' : item.payment_ref);
                });
            }
        });
    }

</script>
@endsection
