@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pool</h1>
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
            <a href="{{ url('admin/pool/bin') }}" class="float-right">
                <button class="btn btn-outline-secondary"><i class="fa fa-trash"></i></button>
            </a>
        @endif
        <div class="card mt-3">
            <div class="card-body">
                <table id="tb" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.pool.view')
@include('admin.pool.add')
@include('admin.pool.update')

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
                url: "{{ url('/admin/pool/table') }}",
                dataSrc: ""
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'description'
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

    $('#images').on('change', function() {
        $('#ph-images').empty();
        for (i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#ph-images').append(
                    '<div class="col-lg-4">'+
                        '<div class="form-group">'+
                            '<img class="img-fluid pool-images" src="'+e.target.result+'">'+
                        '</div>'+
                    '</div>'
                );
            }
            reader.readAsDataURL(this.files[i]);
        }
    });

    $('[name=image360]').on('change', function() {
        $('#ph-image360').empty();
        for (i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#ph-image360').append(
                    '<div class="col-lg-12">'+
                        '<div class="form-group">'+
                            '<img class="img-fluid pool-image360" src="'+e.target.result+'">'+
                        '</div>'+
                    '</div>'
                );
            }
            reader.readAsDataURL(this.files[i]);
        }
    });

    $('#update_images').on('change', function() {
        $('#update_ph-images').empty();
        for (i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#update_ph-images').append(
                    '<div class="col-lg-4">'+
                        '<div class="form-group">'+
                            '<img class="img-fluid pool-images" src="'+e.target.result+'">'+
                        '</div>'+
                    '</div>'
                );
            }
            reader.readAsDataURL(this.files[i]);
        }
    });

    $('[name=update_image360]').on('change', function() {
        $('#update_ph-image360').empty();
        for (i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#update_ph-image360').append(
                    '<div class="col-lg-12">'+
                        '<div class="form-group">'+
                            '<img class="img-fluid pool-image360" src="'+e.target.result+'">'+
                        '</div>'+
                    '</div>'
                );
            }
            reader.readAsDataURL(this.files[i]);
        }
    });

    $('#addForm').on('submit', function () {
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
                        $.ajax({
                            url: '{{ url("/admin/pool/add") }}',
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
                                                $('#ph-images').empty(); 
                                                $('#ph-image360').empty();
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

    function remove(id) {
        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Remove',
            content: 'Item will be removed, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-danger',
                    action: function(){

                        $.ajax({
                            url: "{{ url('/admin/pool/remove') }}/"+id,
                            method: 'post',
                            processData:false,
                            contentType: false,
                            success: function(result){
                                if (result == 'success') {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Success!',
                                        content: 'Item has been removed.',
                                    });
                                    callDt();
                                }
                                else {
                                    $.alert({
                                        animation: 'none',
                                        theme: 'dark',
                                        title: 'Failed!',
                                        content: 'Item has failed to remove.',
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
        $('#update_ph-images').empty();
        $('#update_ph-image360').empty();

        $('#updateModal').modal({
            backdrop:'static'
        });

        $.ajax({
            url: "{{ url('/admin/pool/get') }}/"+id,
            type: "GET",
            success: function(items) {
                $.each(items, function (i, item) {
                    $('[name=update_id]').val(item.id);
                    $('[name=update_name]').val(item.name);
                    $('[name=update_description]').val(item.description);

                    $.each(JSON.parse(item.images), function(x, image) {
                        $('#update_ph-images').append(
                            '<div class="col-lg-4">'+
                                '<div class="form-group">'+
                                    '<img class="img-fluid pool-images" src="{{ asset('public/storage/pool') }}/'+image+'">'+
                                '</div>'+
                            '</div>'
                        );
                    });

                    $('#update_ph-image360').append(
                        '<div class="col-lg-12">'+
                            '<div class="form-group">'+
                                '<img class="img-fluid pool-image360" src="{{ asset('public/storage/pool') }}/'+item.image360+'">'+
                            '</div>'+
                        '</div>'
                    )
                });
            }
        });
    }

    $('#updateForm').on('submit', function () {
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
                            url: '{{ url("/admin/pool/update") }}',
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
                                                $('#updateForm').trigger('reset');
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
        $('#view_ph-images').empty();
        $('#view_ph-image360').empty();

        $('#viewModal').modal({
            backdrop:'static'
        });

        $.ajax({
            url: "{{ url('/admin/pool/get') }}/"+id,
            type: "GET",
            success: function(items) {
                $.each(items, function (i, item) {
                    $('[name=view_name]').html(item.name);
                    $('[name=view_description]').html(item.description);

                    $.each(JSON.parse(item.images), function(x, image) {
                        $('#view_ph-images').append(
                            '<div class="col-lg-4">'+
                                '<div class="form-group">'+
                                    '<img class="img-fluid pool-images" src="{{ asset('public/storage/pool') }}/'+image+'">'+
                                '</div>'+
                            '</div>'
                        );
                    });

                    $('#view_ph-image360').append(
                        '<div class="col-lg-12">'+
                            '<div class="form-group">'+
                                '<a href="{{ url('public/admin/pool/image360') }}/'+id+'" target="_blank">'+
                                    '<img class="img-fluid pool-image360" src="{{ asset('public/storage/pool') }}/'+item.image360+'">'+
                                '</a>'+
                            '</div>'+
                        '</div>'
                    )
                });
            }
        });
    }

</script>
@endsection
