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
		<link rel="stylesheet" href="{{ URL::asset('public/admin/assets/css/custom.css?v=2') }}">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<script src="{{ URL::asset('public/admin/assets/js/jquery-3.2.1.min.js') }}"></script>
		<link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/datatables/datatables.min.css')}}">
		<link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/datatables/dataTables.jqueryui.min.css')}}"/>
		<link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/toast/jquery.toast.css')}}">
		<link rel="stylesheet" href="{{ asset('public/admin/assets/css/rowReorder.dataTables.css')}}">
		<link rel="stylesheet" href="{{ asset('public/storage/frontend/css/bootstrap-datepicker.min.css') }}" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous"/>
		 
		<link rel="stylesheet" href="{{ asset('public/storage/frontend/css/bootstrap-datepicker.standalone.min.css') }}" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" />

		<link rel="stylesheet" href="{{ asset('public/storage/frontend/css/bootstrap-datepicker3.min.css') }}" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" />

		<link rel="stylesheet" href="{{ asset('public/storage/frontend/css/bootstrap-datepicker3.standalone.min.css') }}" integrity="sha512-p4vIrJ1mDmOVghNMM4YsWxm0ELMJ/T0IkdEvrkNHIcgFsSzDi/fV7YxzTzb3mnMvFPawuIyIrHcpxClauEfpQg==" crossorigin="anonymous" />

		<!-- multiselect -->
		<link href="{{ asset('public/storage/frontend/css/jquery.multiselect.css') }}" rel="stylesheet" />
    	<script src="{{ asset('public/storage/frontend/js/jquery.multiselect.js') }}"></script>
	 
    </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
					<a href="{{ url('/dashboard') }}" class="logo">
						<img src="{{ URL::asset('public/admin/assets/img/doc-point-logo.png')}}" alt="Logo">
					</a>
					<a href="{{ url('/dashboard') }}" class="logo logo-small">
						<img src="{{ URL::asset('public/admin/assets/img/doc-point-logo.png')}}" alt="Logo" width="30" height="30">
					</a>
                </div>
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				{{-- <div class="top-nav-search">
					<form>
						<input type="text" class="form-control" placeholder="Search here">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div> --}}
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
							<span class="user-img">
								<!-- <img class="rounded-circle" src="{{-- URL::asset('public/admin/assets/img/profiles/avatar-01.jpg') --}}" width="31" alt="Ryan Taylor"> -->
								<img src="{{ (Auth::user()->pic && file_exists('public/storage/images/doctor/'.Auth::user()->pic)) ? asset('public/storage/images/doctor/'.Auth::user()->pic) : asset('public/files/doctor/profile/doctor-icon.png') }}" alt="User Image" class="avatar-img rounded-circle" width="31" >
							</span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="{{ (Auth::user()->pic && file_exists('public/storage/images/doctor/'.Auth::user()->pic)) ? asset('public/storage/images/doctor/'.Auth::user()->pic) : asset('public/files/doctor/profile/doctor-icon.png') }}" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6>{{ Auth::user()->name }}</h6>
									<p class="text-muted mb-0">{{ Auth::user()->email }}</p>
								</div>
							</div>
							@if (Auth::user()->doctors == null)
								<a class="dropdown-item" href="{{ route('admin.profile', [Auth::user()->id]) }}">My Profile</a>
							@else
								<a class="dropdown-item" href="{{ route('doctor.profile', [Auth::user()->doctors->id]) }}">My Profile</a>

								@if(Auth::user()->doctors->request_for_sponsored == 'Not Sent')
								<a class="dropdown-item" href="{{ route('doctor.sponsoredRequest', ['doctor_id'=>Auth::user()->doctors->id, 'sponsored_request'=>\App\Models\Doctor::SENT]) }}">Request For Sponsored</a>
								@elseif(Auth::user()->doctors->request_for_sponsored == 'Sent')
								<a class="dropdown-item" href="javascript:void(0);">Sponsored Request Sent</a>
								@elseif(Auth::user()->doctors->request_for_sponsored == 'Accepted')
								<a class="dropdown-item" href="javascript:void(0);">You are sponsered</a>
								@else
								<a class="dropdown-item" href="javascript:void(0);">Sponsered request cancelled</a>
								@endif

							@endif


							
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
			@if(CommanHelper::userRole() == "Admin")
				@component ('Backend.admin_left_nav', ['active' => $active]) @endcomponent
			@else
				@component ('Backend.doc_left_nav', ['active' => $active]) @endcomponent
			@endif
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
		<script  src="{{ URL::asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
		<script type="text/javascript"></script>
		<script  src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>
		
		
		

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
		<script  src="{{ URL::asset('public/admin/assets/js/script.js?v=2')}}"></script>
		<script src="{{ asset('public/storage/frontend/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ asset('public/admin/assets/js/moment.min.js') }}"></script>
		{{-- <script src="{{ asset('public/admin/assets/js/dataTables.rowReorder.js') }}"></script> --}}

	 

    </body>
</html>