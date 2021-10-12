<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link href="{{ asset('public/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('public/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <link href="{{ asset('public/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

  <div class="click-closed"></div>
  
  <div class="box-collapse">
    <div class="title-box-d">
      <h3 class="title-d">Book Now</h3>
    </div>
    <span class="close-box-collapse right-boxed bi bi-x"></span>
    <div class="box-collapse-wrap form">
      <form class="form-a">
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="form-group">
              <label class="pb-2" for="room">Room Type</label>
              <select class="form-control form-select form-control-a" id="room">
                <option value="" selected disabled>Select Room</option>
                <option>The Lodge</option>
                <option>Suite Room</option>
                <option>Family Room</option>
                <option>Deluxe Room</option>
                <option>Superior Room</option>
                <option>Standard Room</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2">Check In Date</label>
              <input type="date" class="form-control" placeholder="Check In Date">
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2">Check Out Date</label>
              <input type="date" class="form-control" placeholder="Check Out Date">
            </div>
          </div>
          <div class="col-md-4 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2">Adults</label>
              <input type="number" class="form-control" min="0" value="0" step="1" placeholder="Adults">
            </div>
          </div>
          <div class="col-md-4 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2">Children</label>
              <input type="number" class="form-control" min="0" value="0" step="1" placeholder="Children">
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="form-group mt-3">
              <label class="pb-2">Infant</label>
              <input type="number" class="form-control" min="0" value="0" step="1" placeholder="Infant">
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-b">Check Availability</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html"><img src="{{ asset('public/assets/img/logo.png') }}" width="145px"></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="#about">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="#rooms">Rooms</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="#amenities">Amenities</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="#contact">Contact</a>
          </li>

        </ul>
      </div>

      <button type="button" class="btn btn-b-n btn-book navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
        Book Now
      </button>

    </div>
  </nav>

  <div class="intro swiper position-relative" id="home">

    <div class="swiper-wrapper">

      <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url({{ asset('public/assets/img/home-bg.jpg') }})">
        <div class="overlay overlay-a"></div>
        <div class="intro-content display-table">
          <div class="table-cell">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="intro-body">
                    <p class="intro-title-top">182 McArthur Highway
                      <br> Urdaneta City
                    </p>
                    <h1 class="intro-title mb-4">
                      <span class="color-b">Lisland</span>
                      <br> Rainforest Resort
                    </h1>
                    <p class="intro-subtitle intro-price">
                      <a href="#main"><span class="price-a">Get Started</span></a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <main id="main">
    @yield('content')
  </main>

  <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Lisland</h3>
            </div>
            <div class="w-body-a">
              <p class="w-text-a color-text-a">
                Rainforest Resort
              </p>
            </div>
            <div class="w-footer-a">
              <ul class="list-unstyled">
                <li class="color-a">
                  inquiries_lisland@yahoo.com
                </li>
                <li class="color-a">
                  (+63) 915 750-1817
                </li>
                <li class="color-a">
                  (075) 656-2379
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-body-a">
              <div class="w-body-a">
                <ul class="list-unstyled">
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="#home">Home</a>
                  </li>
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="#about">About</a>
                  </li>
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="#rooms">Rooms</a>
                  </li>
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="#amenities">Amenities</a>
                  </li>
                  <li class="item-list-a">
                    <i class="bi bi-chevron-right"></i> <a href="#contact">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-body-a">
              <ul class="list-unstyled">
                <li class="item-list-a">
                  <i class="bi bi-chevron-right"></i> <a href="#">Terms and Condition</a>
                </li>
                <li class="item-list-a">
                  <i class="bi bi-chevron-right"></i> <a href="#">Privacy Policy</a>
                </li>
                <li class="item-list-a">
                  <i class="bi bi-chevron-right"></i> <a href="#">Cookie Policy</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="socials-a">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">
                  <i class="bi bi-facebook" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="bi bi-twitter" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="bi bi-instagram" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; Copyright
              <span class="color-a">Lisland</span> All Rights Reserved.
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <script src="{{ asset('public/assets/js/main.js') }}"></script>

</body>

</html>