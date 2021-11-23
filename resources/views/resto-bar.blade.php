@extends('layouts.inner')

@section('content')

<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">BAI MARIN RESTAURANT</h1>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                Dine amidst a rustic setting in Bai Marin Restaurant. We serve Filipino and international cuisine, promotes healthy regional dishes like meat, vegetables, and fish. Try our delicious bulalo, sisig, crispy shrimp, and others.
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    @if (count($data) == 0)
        <div class="text-center">
            <h4>No items in this record.</h4>
        </div>
    @else
        @if (count($data['fb']) > 0)
            <div class="row mb-5">
                <h3 class="mb-3">{{ $data['fb'][0]->category }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td><strong>Food</strong></td>
                            <td><strong>Description</strong></td>
                            <td><strong>Price</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['fb'] as $item)
                            <tr>
                                <td><img src="{{ asset('public/storage/fooddrink') . '/' . $item->image }}" class="img rounded" width="200px" height="auto"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{--  --}}
        @if (count($data['pb']) > 0)
            <div class="row mb-5">
                <h3 class="mb-3">{{ $data['pb'][0]->category }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td><strong>Food</strong></td>
                            <td><strong>Description</strong></td>
                            <td><strong>Price</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['pb'] as $item)
                            <tr>
                                <td><img src="{{ asset('public/storage/fooddrink') . '/' . $item->image }}" class="img rounded" width="200px" height="auto"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{--  --}}
        @if (count($data['ls']) > 0)
            <div class="row mb-5">
                <h3 class="mb-3">{{ $data['ls'][0]->category }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td><strong>Food</strong></td>
                            <td><strong>Description</strong></td>
                            <td><strong>Price</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['ls'] as $item)
                            <tr>
                                <td><img src="{{ asset('public/storage/fooddrink') . '/' . $item->image }}" class="img rounded" width="200px" height="auto"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        @if (count($data['is']) > 0)
            <div class="row mb-5">
                <h3 class="mb-3">{{ $data['is'][0]->category }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td><strong>Food</strong></td>
                            <td><strong>Description</strong></td>
                            <td><strong>Price</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['is'] as $item)
                            <tr>
                                <td><img src="{{ asset('public/storage/fooddrink') . '/' . $item->image }}" class="img rounded" width="200px" height="auto"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{--  --}}
        @if (count($data['is']) > 0)
            <div class="row mb-5">
                <h3 class="mb-3">{{ $data['is'][0]->category }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td><strong>Food</strong></td>
                            <td><strong>Description</strong></td>
                            <td><strong>Price</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['is'] as $item)
                            <tr>
                                <td><img src="{{ asset('public/storage/fooddrink') . '/' . $item->image }}" class="img rounded" width="200px" height="auto"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{--  --}}
        @if (count($data['ds']) > 0)
            <div class="row mb-5">
                <h3 class="mb-3">{{ $data['ds'][0]->category }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td><strong>Food</strong></td>
                            <td><strong>Description</strong></td>
                            <td><strong>Price</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['ds'] as $item)
                            <tr>
                                <td><img src="{{ asset('public/storage/fooddrink') . '/' . $item->image }}" class="img rounded" width="200px" height="auto"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif
</section>

@endsection
