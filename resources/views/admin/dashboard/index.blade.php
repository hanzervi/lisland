@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-history"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">{{ $data['pending'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-layer-group"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Reserve</span>
                        <span class="info-box-number">{{ $data['reserve'] }}</span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>

            <div class="col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Checked In</span>
                        <span class="info-box-number">{{ $data['checkedin'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-light elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Number of Guest/s</span>
                        <span class="info-box-number">{{ $data['number'] }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{--  --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">No. of Books</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">{{ number_format($data['thisYear']) }}</span>
                                <span>This Year</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-bold text-lg">{{ number_format($data['lastYear']) }}</span>
                                <span>Last Year</span>
                            </p>
                        </div>

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This year
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Last year
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- - --}}

            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header border-0">
                        <h3 class="card-title">Booked Room</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Room</th>
                                    <th>Pax</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            @if (count($data['book']) > 0)
                                @foreach ($data['book'] as $item)
                                    <tr>
                                        <td>{{ $item->room }}</td>
                                        <td>{{ $item->pax }}</td>
                                        <td>
                                            @php
                                                if ($item->status == 0)
                                                    echo '<div class="text-warning">Pending</div>';
                                                else if ($item->status == 1)
                                                    echo '<div class="text-info">Reserve</div>';
                                                else if ($item->status == 2)
                                                    echo '<div class="text-success">Checked In</div>';
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="3">All rooms are available.</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    
    $(document).ready(function() {
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart')
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                data: [
                    "{{ $data['tyMonth'][0] }}",
                    "{{ $data['tyMonth'][1] }}",
                    "{{ $data['tyMonth'][2] }}",
                    "{{ $data['tyMonth'][3] }}",
                    "{{ $data['tyMonth'][4] }}",
                    "{{ $data['tyMonth'][5] }}",
                    "{{ $data['tyMonth'][6] }}",
                    "{{ $data['tyMonth'][7] }}",
                    "{{ $data['tyMonth'][8] }}",
                    "{{ $data['tyMonth'][9] }}",
                    "{{ $data['tyMonth'][10] }}",
                    "{{ $data['tyMonth'][11] }}",
                    ]
                },
                {
                backgroundColor: '#ced4da',
                borderColor: '#ced4da',
                data: [
                    "{{ $data['lyMonth'][0] }}",
                    "{{ $data['lyMonth'][1] }}",
                    "{{ $data['lyMonth'][2] }}",
                    "{{ $data['lyMonth'][3] }}",
                    "{{ $data['lyMonth'][4] }}",
                    "{{ $data['lyMonth'][5] }}",
                    "{{ $data['lyMonth'][6] }}",
                    "{{ $data['lyMonth'][7] }}",
                    "{{ $data['lyMonth'][8] }}",
                    "{{ $data['lyMonth'][9] }}",
                    "{{ $data['lyMonth'][10] }}",
                    "{{ $data['lyMonth'][11] }}",
                    ]
                }
            ]
            },
            options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                // display: false,
                gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks: $.extend({
                    beginAtZero: true,

                    // Include a dollar sign in the ticks
                    callback: function (value) {
                    if (value >= 1000) {
                        value /= 1000
                        value += 'k'
                    }

                    return value
                    }
                }, ticksStyle)
                }],
                xAxes: [{
                display: true,
                gridLines: {
                    display: false
                },
                ticks: ticksStyle
                }]
            }
            }
        })
    });

</script>
@endsection
