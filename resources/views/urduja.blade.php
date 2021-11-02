@extends('layouts.inner')

@section('content')

<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">URDUJA PAVILLION</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <img src="{{ asset('public/assets/img/amenities/urduja.jpg') }}" class="img rounded">
        </div>
        <div class="col-lg-6">
            <p>In case you wish to have a taste of entertainment fully you must go to the pavillion place site, the heart of ballroom dancing, group functions and other activities.</p>
        </div>
    </div>
</section>

@endsection