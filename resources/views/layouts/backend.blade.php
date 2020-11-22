<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Dashboard</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/admin/assets/img/favicon.png') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/admin/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/admin/assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/admin/assets/css/feathericon.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/admin/assets/plugins/morris/morris.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('public/admin/assets/css/style.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('public/admin/assets/css/custom.css') }}">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<script src="{{ URL::asset('public/admin/assets/js/jquery-3.2.1.min.js') }}"></script>
		<link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/datatables/datatables.min.css')}}">
		<link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/datatables/dataTables.jqueryui.min.css')}}"/>
		<link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/toast/jquery.toast.css')}}">
    </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="index.html" class="logo">
						<img src="{{ URL::asset('public/admin/assets/img/doc-point-logo.png')}}" alt="Logo">
					</a>
					<a href="index.html" class="logo logo-small">
						<img src="{{ URL::asset('public/admin/assets/img/doc-point-logo.png')}}" alt="Logo" width="30" height="30">
					</a>
                </div>
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				<div class="top-nav-search">
					<form>
						<input type="text" class="form-control" placeholder="Search here">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">

					<!-- Notifications -->
					<li class="nav-item dropdown noti-dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="{{ URL::asset('public/admin/assets/img/doctors/doctor-thumb-01.jpg') }}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Dr. Ruby Perrin</span> Schedule <span class="noti-title">her appointment</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="{{ URL::asset('public/admin/assets/img/patients/patient1.jpg') }}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Charlene Reed</span> has booked her appointment to <span class="noti-title">Dr. Ruby Perrin</span></p>
													<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="{{ URL::asset('public/admin/assets/img/patients/patient2.jpg') }}">
												</span>
												<div class="media-body">
												<p class="noti-details"><span class="noti-title">Travis Trimble</span> sent a amount of $210 for his <span class="noti-title">appointment</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="{{ URL::asset('public/admin/assets/img/patients/patient3.jpg') }}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Carl Kelly</span> send a message <span class="noti-title"> to his doctor</span></p>
													<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="#">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src="{{ URL::asset('public/admin/assets/img/profiles/avatar-01.jpg')}}" width="31" alt="Ryan Taylor"></span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="{{ URL::asset('public/admin/assets/img/profiles/avatar-01.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6>{{{Auth::user()->name}}}</h6>
									<p class="text-muted mb-0">{{{Auth::user()->email}}}</p>
								</div>
							</div>
							<a class="dropdown-item" href="profile.html">My Profile</a>
							<a class="dropdown-item" href="settings.html">Settings</a>
							<a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
			<!-- /Header -->
			
			<!-- Sidebar -->
			@component ('Backend.left_nav') @endcomponent
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
                    @yield('content')
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		@yield('script')
        
		<script type="text/javascript">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>
		<script  src="{{ URL::asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
		<!-- Bootstrap Core JS -->
		<script src="{{ URL::asset('public/admin/assets/js/popper.min.js')}}"></script>
		<script src="{{ URL::asset('public/admin/assets/js/bootstrap.min.js')}}"></script>
		
		<!-- Slimscroll JS -->
        <script src="{{ URL::asset('public/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
		
		<script src="{{ URL::asset('public/admin/assets/plugins/raphael/raphael.min.js')}}"></script> 
		
		@if(Route::currentRouteName() == 'dashboard')
			<script src="{{ URL::asset('public/admin/assets/plugins/morris/morris.min.js')}}"></script>  
			<script src="{{ URL::asset('public/admin/assets/js/chart.morris.js')}}"></script>  
		@endif
    	<script src="{{ asset('public/admin/assets/plugins/validation/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('public/admin/assets/plugins/validation/additional-methods.min.js') }}"></script>
		<script src="{{ asset('public/admin/assets/plugins/toast/jquery.toast.js') }}"></script>
		<!-- Custom JS -->
		<script  src="{{ URL::asset('public/admin/assets/js/script.js')}}"></script>
		
    </body>
</html>