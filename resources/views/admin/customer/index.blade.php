@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customer</h1>
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Sex</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Date Booked</th>
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
                url: "{{ url('/admin/customer/table') }}",
                dataSrc: ""
            },
            columns: [
                {
                    data: 'firstname'
                },
                {
                    data: 'lastname'
                },
                {
                    data: 'address'
                },
                {
                    data: 'sex'
                },
                {
                    data: 'contact_no'
                },
                {
                    data: 'email'
                },
                {
                    data: 'created_at'
                },
            ]
        });
    }

</script>
@endsection
