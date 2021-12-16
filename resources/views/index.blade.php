@extends('layouts.web')

@section('content')
  <section class="section-about section-t8" id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a mb-4">About Us</h2>
              <p>Lisland Rainforest Resort is a paradise within the city with a 1,500 sq. meter main swimming pool, with a 
                150 sq. meter childrens wading pool. It has a 200 sitting capacity bar and restaurant, conference hall, 
                a pavilion and picnic and garden area. Lisland caters to wedding ceremonies and receptions, conferences, 
                seminars, business meetings and parties. It has 32 air-conditioned rooms with private toilet and bath, 
                with hot and cold showers, TV and WIFI.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="bi bi-cup-straw"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">Resto Bar</h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                Dine amidst a rustic setting in Bai Marin Restaurant. We serve Filipino and international cuisine, promotes healthy 
                regional dishes like meat, vegetables, and fish. Try our delicious bulalo, sisig, crispy shrimp, and others.
              </p>
            </div>
            <div class="card-footer-c">
              <a href="{{ url('/resto-bar/view') }}" class="link-c link-icon">View
                <span class="bi bi-chevron-right"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="bi bi-box"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">Packages</h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                Nulla porttitor accumsan tincidunt. Curabitur aliquet quam id dui posuere blandit. Mauris blandit
                aliquet elit, eget tincidunt
                nibh pulvinar a.
              </p>
            </div>
            <div class="card-footer-c">
              <a href="{{ url('/packages/view') }}" class="link-c link-icon">View
                <span class="bi bi-chevron-right"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="bi bi-signpost-split"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">Tours</h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta. Praesent sapien massa,
                convallis a pellentesque
                nec, egestas non nisi.
              </p>
            </div>
            <div class="card-footer-c">
              <a href="{{ url('/tours/view') }}" class="link-c link-icon">View
                <span class="bi bi-chevron-right"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @if (count($data['room']) > 0)
    <section class="section-rooms section-t8" id="rooms">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Our Rooms</h2>
                <a href="{{ url('/3d-rooms') }}">View 3D Rooms <span class="bi bi-chevron-right"></span></a>
              </div>
            </div>
          </div>
        </div>

        <div id="property-carousel" class="swiper">
          <div class="swiper-wrapper">

            @foreach ($data['room'] as $item)

              @php
                  $image = str_replace('[', '', $item->images);
                  $image = str_replace('"', '', $image);
                  $image = str_replace(']', '', $image);

                  $image = explode(',', $image);
              @endphp

              <div class="carousel-item-b swiper-slide">
                <div class="card-box-a card-shadow">
                  <div class="img-box-a">
                    <img src="{{ asset('public/storage/room') . '/' . $image[0] }}" alt="" class="img-a img-fluid img-room">
                  </div>
                  <div class="card-overlay">
                    <div class="card-overlay-a-content">
                      <div class="card-header-a">
                        <h2 class="card-title-a">
                          <a href="javascript:void(0)">{{ $item->name }}</a>
                        </h2>
                      </div>
                      <div class="card-body-a">

                        <a href="{{ url('room/view') . '/' . $item->id }}" class="link-a">View
                          <span class="bi bi-chevron-right"></span>
                        </a>
                      </div>
                      <div class="card-footer-a">
                        <ul class="card-info d-flex justify-content-around">
                          <li>
                            <h4 class="card-info-title">Weekdays</h4>
                            <span>Php. {{  number_format($item->price_wd, 2) }}
                            </span>
                          </li>
                          <li>
                            <h4 class="card-info-title">Weekends (Fri-Sun)</h4>
                            <span>Php. {{ number_format($item->price_we, 2) }}</span>
                          </li>
                          <li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

          </div>
        </div>
        <div class="propery-carousel-pagination carousel-pagination"></div>

      </div>
    </section>
  @endif

  <section class="section-amenities section-t8 mb-5" id="amenities">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Amenities</h2>
            </div>
          </div>
        </div>
      </div>

      <div id="news-carousel" class="swiper">
        <div class="swiper-wrapper">

          <div class="carousel-item-c swiper-slide">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="{{ asset('public/assets/img/amenities/swimming-pool.jpg') }}" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single.html">Swimming Pool</a>
                    </h2>
                  </div>
                  <a href="{{ url('/pool/view') }}" class="link-a">View
                    <span class="bi bi-chevron-right"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item-c swiper-slide">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="{{ asset('public/assets/img/amenities/ktv.jpg') }}" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single.html">KTV Rooms</a>
                    </h2>
                  </div>
                  <a href="{{ url('/ktv/view') }}" class="link-a">View
                    <span class="bi bi-chevron-right"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item-c swiper-slide">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="{{ asset('public/assets/img/amenities/urduja.jpg') }}" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single.html">Urduja Pavilion</a>
                    </h2>
                  </div>
                  <a href="{{ url('/urduja-pavilion/view') }}" class="link-a">View
                    <span class="bi bi-chevron-right"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item-c swiper-slide">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="{{ asset('public/assets/img/amenities/conference.jpg') }}" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single.html">Conference Hall</a>
                    </h2>
                  </div>
                  <a href="{{ url('/conference/view') }}" class="link-a">View
                    <span class="bi bi-chevron-right"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="news-carousel-pagination carousel-pagination"></div>
    </div>
  </section>

  {{-- <section class="contact" id="contact">
    <div class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single">Contact US</h1>
              <span class="color-text-a">Aut voluptas consequatur unde sed omnis ex placeat quis eos. Aut natus officia corrupti qui autem fugit consectetur quo. Et ipsum eveniet laboriosam voluptas beatae possimus qui ducimus. Et voluptatem deleniti. Voluptatum voluptatibus amet. Et esse sed omnis inventore hic culpa.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 section-t8">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <input type="text" name="name" class="form-control form-control-lg form-control-a" placeholder="Your Name" required>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <input name="email" type="email" class="form-control form-control-lg form-control-a" placeholder="Your Email" required>
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <input type="text" name="subject" class="form-control form-control-lg form-control-a" placeholder="Subject" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <textarea name="message" class="form-control" name="message" cols="45" rows="8" placeholder="Message" required></textarea>
                </div>
              </div>
              <div class="col-md-12 my-3">
                <div class="mb-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
              </div>

              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-a">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section> --}}
@endsection