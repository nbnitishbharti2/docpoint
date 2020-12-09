<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/storage/frontend/img/doc-point-logo.ico') }}" type="image/x-icon" rel="icon">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/viewer.css') }}">
  </head>
<body>
<!-- header -->
<header>
  <div class="container sml-container">
    <div class="row">
      <div class="col-md-4">
        <!-- logo -->
        <div class="logo">
          <a href="{!! url('/') !!}"><h2>Mydocpoint</h2></a>  
        </div>
        <!-- logo end -->
      </div>
      <div class="col-md-8">
        <!-- top text -->
        @if(Auth::guest())
          <div class="top-txt">
            <p><a href="{!! route('doctor.registration') !!}">List your practice on Mydocpoint</a></p><span> | </span>
            <!-- dropdown -->
            <div class="dropdown">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Log in/Sing up
                <img src="{{ asset('public/storage/frontend/img/down-arrow.png') }}" alt="down arrow">
              </a>
            
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{!! route('user.login') !!}">Login</a>
                <a class="dropdown-item" href="{!! route('user.registration') !!}">Signup</a>
              </div>
            </div>
            <!-- dropdown end -->
          </div>
        @else
          <div class="top-txt">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
          </div>
        @endif
        <!-- top text end -->
      </div>
    </div>
  </div>
</header>
<!-- header end -->

@yield('content')

<!-- footer -->
<footer>
    <div class="footer">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-3">
            <!-- footer links -->
            <div class="ftr-links">
              <h4>Mydocpoint</h4>
              <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Press</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Help</a></li>
              </ul>
            </div>
            <!-- footer links end -->
          </div>
  
          <div class="col-lg-3">
            <!-- footer links -->
            <div class="ftr-links">
              <h4>Discover</h4>
              <ul>
                <li><a href="#">The Paper Gown Stories for and about patients</a></li>
                <li><a href="#">The Script Insights for doctors</a></li>
                <li><a href="#">Community Standards</a></li>
                <li><a href="#">Data and privacy</a></li>
                <li><a href="#">Verified reviews</a></li>
              </ul>
            </div>
            <!-- footer links end -->
          </div>
  
          <div class="col-lg-3">
            <!-- footer links -->
            <div class="ftr-links">
              <h4>Top Specialties</h4>
              <ul>
                <li><a href="#">Primary Care Doctor</a></li>
                <li><a href="#">Dermatologist</a></li>
                <li><a href="#">OB-GYN</a></li>
                <li><a href="#">Dentist</a></li>
                <li><a href="#">Psychiatrist</a></li>
                <li><a href="#">Ear, Nose & Throat Doctor</a></li>
                <li><a href="#">Podiatrist</a></li>
                <li><a href="#">Urologist</a></li>
              </ul>
            </div>
            <!-- footer links end -->
          </div>
  
          <div class="col-lg-3">
            <!-- footer links -->
            <div class="ftr-links last-column">
              <h4>Are You a top doctor or health service?</h4>
              <ul>
                <li>List your practice on Mydocpoint</li>
                <li>Become an API partner</li>
              </ul>
              <h4>Get the Mydocpoint</h4>
              <a href="#"><img src="{{ asset('public/storage/frontend/img/ftr-playstore.png') }}" alt="playstore"></a>
            </div>
            <!-- footer links end -->
          </div>
        </div>
      </div>
    </div>
  
    <!-- copyright -->
    <div class="copyright">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-12">
            <div class="btm-ribbon">
              <h2>Mydocpoint</h2>
              <ul class="cp-links">
                <li><a href="#">Terms</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Do not sell my personal information</a></li>
                <li><a href="#">Site map</a></li>
              </ul>
  
              <ul class="social">
                <li><a href="https://twitter.com/" target="_blank"><i class="icofont-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/" target="_blank"><i class="icofont-instagram"></i></a></li>
                <li><a href="https://www.facebook.com/" target="_blank"><i class="icofont-facebook"></i></a></li>
                <li><a href="https://www.linkedin.com/" target="_blank"><i class="icofont-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- copyright end -->
  </footer>
  <!-- footer end -->
  
  
  <!-- Optional JavaScript -->
  <script src="{{ asset('public/storage/frontend/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('public/storage/frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/slick.js') }}"></script>
  <script src="{{ asset('public/admin/assets/plugins/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('public/admin/assets/plugins/validation/additional-methods.min.js') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/custom.js?v=2') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/viewer.min.js') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/percent-rating.js') }}"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
  
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  /************  date slider ************/
  $('.date-slider').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    navText: [$('.prev'),$('.next')],
    dots:false,
    responsive:{
        0:{
          items:1
        },
        600:{
          items:4
        },
        1000:{
          items:4
        }
      }
    })
    /************  date slider end ************/

    /************ toggle active in tab option wrap ***************/
    var header = $('.tab-option-wrap');
    var btns = $('.tab-option-wrap li');
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace("active", "");
      this.className += "active";
      });
    }
    /************ toggle active in tab option wrap end ***************/

    /************ toggle active in short by ***************/
    var headerd = $('.short-by .dropdown-menu');
    var btnsd = $('.short-by .dropdown-item');
    for (var i = 0; i < btnsd.length; i++) {
      btnsd[i].addEventListener("click", function() {
      var currentd = document.getElementsByClassName("dropdown-item active");
      currentd[0].className = currentd[0].className.replace("dropdown-item active", "dropdown-item");
      this.className += " active";
      });
    }
    /************ toggle active in short by end ***************/

    /*********** horizontal scroll *****************/
    const slider = document.querySelector('.page-options ul');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
      isDown = true;
      slider.classList.add('active');
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => {
      isDown = false;
      slider.classList.remove('active');
    });
    slider.addEventListener('mouseup', () => {
      isDown = false;
      slider.classList.remove('active');
    });
    slider.addEventListener('mousemove', (e) => {
      if(!isDown) return;
      e.preventDefault();
      const x = e.pageX - slider.offsetLeft;
      const walk = (x - startX) * 2; //scroll-fast
      slider.scrollLeft = scrollLeft - walk;
    });
    /*********** horizontal scroll end *****************/
</script>
  </body>
</html>