@extends('layouts.inner')

@section('content')

<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">LIS FAMILY KTV ROOMS</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <img src="{{ asset('public/assets/img/amenities/ktv.jpg') }}" class="img rounded">
        </div>
        <div class="col-lg-6">
            <p>Our family ktv rooms are cozy so that you can unwind and be relaxed with over 1000 songs to choose from.</p>
        </div>
    </div>
</section>

@endsection