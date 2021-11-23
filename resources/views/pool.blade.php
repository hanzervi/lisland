@extends('layouts.inner')

@section('content')

<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">
                        @if (count($data['pool']) > 0)
                            {{ $data['pool'][0]->name }}
                        @else
                            Lisland's Pool
                        @endif
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

@if (count($data['pool']) > 0)
    <section class="container mt-5">
        @foreach ($data['pool'] as $item)
            @php
                $image = str_replace('[', '', $item->images);
                $image = str_replace('"', '', $image);
                $image = str_replace(']', '', $image);

                $image = explode(',', $image);
            @endphp
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        @foreach ($image as $img)
                            <div class="col-lg-12 mb-3">
                                <img src="{{ asset('public/storage/pool') .'/'. $img }}" class="img-fluid" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3>{{ $item->description }}</h3>
                    <p>One of the highlights of this hotel is the large swimming pool surrounding the main building like a bluish lagoon reflecting the silhouette of the trees. What a pleasure to take a dip in its cool waters! You can relax in deckchairs, listening only to the sound of the birds that inhabit the little forest.</p>
                    <p>Entrance: P150/head (Adult/student/Child)</p>
                    <p> Children below 2 years old free of entrance</p>

                    <h4 class="mt-5">PICNIC HUTS</h4>
                    <p>Big Picnic Hut: P1,550.00</p>
                    <p>Regular Picnic Huts: P750.00</p>
                    <p>Long Table with 10 chairs: P330.00</p>
                    <p>Round Table with 5 chairs: P280.00</p>
                    <p>Extra Chairs: P30.00</p>

                    <h4 class="mt-5">Rules & Regulations</h4>
                    <p><strong>Opening Hours: </strong> Monday - Sunday (9:00 AM - 10:00 PM)</p>
                </div>
            </div>
        @endforeach
    </section>
@else
    <section class="container mt-5">
        <div class="text-center">
            <h4>No items in this record.</h4>
        </div>
    </section>
@endif

@endsection