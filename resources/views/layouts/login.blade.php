<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
		<meta charset="utf-8">
		<title>Login | Welcome Back</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link href="{{ asset('public/assets/img/favicon.png') }}" rel="icon">
		
		<link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
		
		<link rel="stylesheet" href="{{ asset('public/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('public/assets/plugins/fontawesome/css/all.min.css') }}">
		
		<link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('public/admin/assets/css/custom.css') }}">
	</head>
	<body class="account-page">
		<div class="main-wrapper">
			<header class="header">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="index-2.html" class="navbar-brand logo">
							<img src="{{ asset('public/admin/assets/img/doc-point-logo.png') }}" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="index-2.html" class="menu-logo">
								<img src="{{ asset('public/admin/assets/img/doc-point-logo.png') }}" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li class="login-link">
								<a href="login.html">Login / Signup</a>
							</li>
						</ul>
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item contact-item">
							<div class="header-contact-img">
								<i class="far fa-hospital"></i>							
							</div>
							<div class="header-contact-detail">
								<p class="contact-header">Contact</p>
								<p class="contact-info-header"> +91-9871578330</p>
							</div>
						</li>
					</ul>   
				</nav>
			</header>
			
            @yield('content')
   
			<footer class="footer">
				
				<div class="footer-top">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-3 col-md-6">
							
								<div class="footer-widget footer-about">
									<div class="footer-logo">
										<img src="{{ asset('public/admin/assets/img/doc-point-logo.png') }}" alt="logo" width="60%">
									</div>
									<div class="footer-about-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
										<div class="social-icon">
											<ul>
												<li>
													<a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
												</li>
												<li>
													<a href="#" target="_blank"><i class="fab fa-twitter"></i> </a>
												</li>
												<li>
													<a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
												</li>
												<li>
													<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
												</li>
												<li>
													<a href="#" target="_blank"><i class="fab fa-dribbble"></i> </a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">For Patients</h2>
									<ul>
										<li><a href="search.html"><i class="fas fa-angle-double-right"></i> Search for Doctors</a></li>
										<li><a href="login.html"><i class="fas fa-angle-double-right"></i> Login</a></li>
										<li><a href="register.html"><i class="fas fa-angle-double-right"></i> Register</a></li>
										<li><a href="booking.html"><i class="fas fa-angle-double-right"></i> Booking</a></li>
										<li><a href="patient-dashboard.html"><i class="fas fa-angle-double-right"></i> Patient Dashboard</a></li>
									</ul>
								</div>
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">For Doctors</h2>
									<ul>
										<li><a href="appointments.html"><i class="fas fa-angle-double-right"></i> Appointments</a></li>
										<li><a href="chat.html"><i class="fas fa-angle-double-right"></i> Chat</a></li>
										<li><a href="login.html"><i class="fas fa-angle-double-right"></i> Login</a></li>
										<li><a href="doctor-register.html"><i class="fas fa-angle-double-right"></i> Register</a></li>
										<li><a href="doctor-dashboard.html"><i class="fas fa-angle-double-right"></i> Doctor Dashboard</a></li>
									</ul>
								</div>
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<div class="footer-widget footer-contact">
									<h2 class="footer-title">Contact Us</h2>
									<div class="footer-contact-info">
										<div class="footer-address">
											<span><i class="fas fa-map-marker-alt"></i></span>
											<p> Noida Sec63,<br> New Delhi, India , 110005 </p>
										</div>
										<p>
											<i class="fas fa-phone-alt"></i>
											+91-9871578330
										</p>
										<p class="mb-0">
											<i class="fas fa-envelope"></i>
											info@mydocpoint.com
										</p>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
                <div class="footer-bottom">
					<div class="container-fluid">
					
						<div class="copyright">
							<div class="row">
								<div class="col-md-6 col-lg-6">
									<div class="copyright-text">
										<p class="mb-0"><a href="#">KK Web Solutions</a></p>
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
								
									<div class="copyright-menu">
										<ul class="policy-menu">
											<li><a href="term-condition.html">Terms and Conditions</a></li>
											<li><a href="privacy-policy.html">Policy</a></li>
										</ul>
									</div>
									
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
			</footer>
		   
		</div>
		<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
		<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('public/assets/js/script.js') }}"></script>
	</body>

</html>