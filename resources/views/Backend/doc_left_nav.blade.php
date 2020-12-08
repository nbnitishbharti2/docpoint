<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="active"><a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a></li>
				<li><a href="{{ route('review') }}"><i class="fe fe-layout"></i> <span>Manage Review</span></a></li>
				<li><a href="{{ route('doctor.holiday', ['doctor_id' => Auth::user()->doctors->id]) }}"><i class="fa fa-hand-o-left"></i><span>Holiday</span></a></li>
				<li><a href="{{ route('appointment.slots') }}"><i class="fe fe-layout"></i> <span>Appoinment Slots</span></a></li>
				<li><a href="{{ route('manage.appointment') }}"><i class="fe fe-calendar"></i> <span>Manage Appointments</span></a></li>
			</ul>
		</div>
	</div>
</div>