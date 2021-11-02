@extends('layouts.inner')

@section('content')
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">{{ $data['getRoom']->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="property-single nav-arrow-b">
    <div class="container">
        @php
            $image = str_replace('[', '', $data['getRoom']->images);
            $image = str_replace('"', '', $image);
            $image = str_replace(']', '', $image);

            $image = explode(',', $image);
        @endphp

        <div class="row justify-content-center mt-5">
            <div class="col-lg-12">
                <div id="property-single-carousel" class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($image as $item)
                            <div class="carousel-item-b swiper-slide">
                                <img src="{{ asset('public/storage/room') . '/' . $item }}" class="img-thumbnail" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="property-single-carousel-pagination carousel-pagination"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                        <div class="property-summary">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d section-t4">
                                        <h3 class="title-d">Summary</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="summary-list">
                                <ul class="list">
                                    <li class="d-flex justify-content-between">
                                        <strong>Description:</strong>
                                        <span>{{ $data['getRoom']->description }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>No. of Rooms:</strong>
                                        <span>{{ $data['getRoom']->no_rooms }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Price Weekdays:</strong>
                                        <span>{{ number_format($data['getRoom']->price_wd) }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Price Weekends:</strong>
                                        <span>{{ number_format($data['getRoom']->price_we) }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Capacity Adults:</strong>
                                        <span>{{ $data['getRoom']->adults }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Capacity Children:</strong>
                                        <span>{{ $data['getRoom']->children }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Capacity Infants:</strong>
                                        <span>{{ $data['getRoom']->infants }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Includes:</strong>
                                        <span>{{ $data['getRoom']->includes }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="property-summary">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d section-t4">
                                        <h3 class="title-d">Overview</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="summary-list">
                                <ul class="list">
                                    <li class="d-flex justify-content-between">
                                        Check-in time is 2:00pm
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        Check-out time is 12:00nn
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        Additional person - PHP 750.00 with Breakfast
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        Rates are inclusive of 12% Government Tax
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        To guarantee your room reservation, a cash deposit may be required
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        All reservations are guaranteed until 6:00pm
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        A refundable PHP 1,000.00 deposit is required to cover incidental charges
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        All rates are subject to change without prior notice
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 mt-5">
                <div class="title-box-d section-t4">
                    <h3 class="title-d">360 Image</h3>
                </div>
                <div class="panorama">
                    <img src="" id="image360">
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="{{ asset('public/plugins/panorama-viewer/jquery.panorama_viewer.js') }}"></script>

<script>

    $( document ).ready(function() {
        $(".panorama").panorama_viewer({
            repeat: true,
            direction: "horizontal",
            animationTime: 700,
            easing: "ease-out",
            overlay: true
        });

        $image360 = "{{ $data['getRoom']->image360 }}";

        $('#image360').prop('src', '{{ asset('public/storage/room') }}/'+$image360);
    });
</script>

@endsection
