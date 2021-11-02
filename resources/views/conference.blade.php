@extends('layouts.inner')

@section('content')

<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">CONFERENCE HALL</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <img src="{{ asset('public/assets/img/amenities/conference.jpg') }}" class="img rounded">
        </div>
        <div class="col-lg-6">
            <p>The conference room offers a flexible space for meetings, receptions and presentations and has fully integrated press conference facilities. Catering can be provided either in the room for smaller meetings or larger events.</p>
        </div>
    </div>
</section>

@endsection