@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Food & Drink</h1>
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
            <a href="{{ url('admin/food-and-drink/bin') }}" class="float-right">
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
                            <th>Category</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.food-drink.add')
@include('admin.food-drink.update')

@endsection

@section('js')
<script>
    $(document).ready(function () {
        callDt();
    });

    $('[name=food-image]').on('change', function() {
        $('#ph-image').empty();
        for (i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#ph-image').append(
                    '<div class="col-lg-12">'+
                        '<div class="form-group">'+
                            '<img class="img-fluid food-drink" src="'+e.target.result+'">'+
                        '</div>'+
                    '</div>'
                );
            }
            reader.readAsDataURL(this.files[i]);
        }
    });

    $('[name=update_food-image]').on('change', function() {
        $('#update_ph-image').empty();
        for (i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#update_ph-image').append(
                    '<div class="col-lg-12">'+
                        '<div class="form-group">'+
                            '<img class="img-fluid food-drink" src="'+e.target.result+'">'+
                        '</div>'+
                    '</div>'
                );
            }
            reader.readAsDataURL(this.files[i]);
        }
    });

    function callDt() {
        $("#tb").DataTable({
            bDestroy: true,
            ajax: {
                url: "{{ url('/admin/food-and-drink/table') }}",
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
                    data: 'category'
                },
                {
                    data: 'price'
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        if ("{{ Auth::id() }}" === 1) {
                            return '<div class="btn-group float-right">' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-primary" onclick="update('+data+')"><i class="fas fa-edit"></i></a>' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-danger" onclick="remove('+data+')"><i class="fas fa-trash"></i></a>' +
                                '</div>';
                        }
                        else {
                            return '<div class="btn-group float-right">' +
                                    '<a href="javascript:void(0)" type="button" class="btn btn-primary" onclick="update('+data+')"><i class="fas fa-edit"></i></a>' +
                                '</div>';
                        }
                    }
                },
            ]
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
                            url: '{{ url("/admin/food-and-drink/add") }}',
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
                                                $('#ph-image').empty();

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

    function remove(id) {
        $.confirm({
            animation: 'none',
            theme: 'dark',
            title: 'Remove',
            content: 'Item will be remove, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-danger',
                    action: function(){

                        $.ajax({
                            url: "{{ url('/admin/food-and-drink/remove') }}/"+id,
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
        $('#update_ph-image').empty();

        $('#updateModal').modal({
            backdrop:'static'
        });

        $.ajax({
            url: "{{ url('/admin/food-and-drink/get') }}/"+id,
            type: "GET",
            success: function(items) {
                $.each(items, function (i, item) {
                    $('[name=update_id]').val(item.id);
                    $('[name=update_name]').val(item.name);
                    $('[name=update_description]').val(item.description);
                    $('[name=update_category]').val(item.category);
                    $('[name=update_price]').val(item.price);

                    $('#update_ph-image').append(
                        '<div class="col-lg-12">'+
                            '<div class="form-group">'+
                                '<img class="img-fluid food-drink" src="{{ asset('public/storage/fooddrink') }}/'+item.image+'">'+
                            '</div>'+
                        '</div>'
                    )

                    $('.select2').select2();
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
            content: 'Item will be updated, continue?',
            buttons: {
                No: function () {
                    //
                },
                Yes: {
                    btnClass: 'btn-primary',
                    action: function () {
                        $.ajax({
                            url: '{{ url("/admin/food-and-drink/update") }}',
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

</script>
@endsection
