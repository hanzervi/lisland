@extends('layouts.inner')

@section('content')
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">3D Rooms</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="property-single nav-arrow-b">
    <div class="container">

        <div class="row mt-5">
            <div class="col-lg-6 text-center">
                <h5 class="mb-3">Standard Room</h5>
                <iframe src="https://3dwarehouse.sketchup.com/embed/6757ac7e-caf1-438b-b00a-70729f6c77bc" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="580" height="326" allowfullscreen></iframe>
            </div>
            <div class="col-lg-6 text-center">
                <h5 class="mb-3">Family Room</h5> 
                <iframe src="https://3dwarehouse.sketchup.com/embed/c79bff90-7530-4814-9fcd-5551f9989cc0" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="580" height="326" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>

@endsection
