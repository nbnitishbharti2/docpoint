<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Mydocpoint</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('public/storage/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/storage/frontend/css/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('public/storage/frontend/css/custom.css') }}">
	<link rel="stylesheet" href="{{ asset('public/storage/frontend/css/media.css') }}">
  </head>
<body>
<!-- header -->
<header>
  <div class="container sml-container">
    <div class="row">
      <div class="col-md-4">
        <!-- logo -->
        <div class="logo">
          <a href="#"><h2>Mydocpoint</h2></a>  
        </div>
        <!-- logo end -->
      </div>
      <div class="col-md-8">
        <!-- top text -->
        <div class="top-txt">
          <p>List your practice on Mydocpoint</p><span> | </span>
          <!-- dropdown -->
          <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Log in/Sing up
              <img src="{{ asset('public/storage/frontend/img/down-arrow.png') }}" alt="down arrow">
            </a>
          
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Login</a>
              <a class="dropdown-item" href="#">Signup</a>
            </div>
          </div>
          <!-- dropdown end -->
        </div>
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
                <li><a href="#">Home</a></li>
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
  <script src="{{ asset('public/storage/frontend/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/storage/frontend/js/slick.js') }}"></script>
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
  </body>
  </html>