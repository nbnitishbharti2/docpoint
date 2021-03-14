<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ ( $active == 'dashboard') ? 'active' : ''}}">
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu {{ ( $active == 'doctors') ? 'active' : ''}}">
                    <a href="#"><i class="fe fe-user-plus"></i> <span>Manange Doctors</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('doctor.index') }}">List</a></li>
                        <li><a href="{{ route('registered.doctor') }}">Registered</a></li>
                        <li><a href="{{ route('doctor.add') }}">Add</a></li>
                    </ul>
                </li>
                <li class="submenu {{ ( $active == 'speciality') ? 'active' : ''}}">
                    <a href="#"><i class="fe fe-user-plus"></i> <span>Manange Specialities</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('Speciality.index') }}">List</a></li>
                        <li><a href="{{ route('Speciality.add') }}">Add</a></li>
                    </ul>
                </li>
                <li class="{{ ( $active == 'locations') ? 'active' : ''}}">
                    <a href="{{ route('countries') }}"><i class="fe fe-layout"></i> <span>Manage Locations</span></a>
                </li>
                <li class="{{ ( $active == 'users') ? 'active' : ''}}">
                    <a href="{{ route('users') }}"><i class="fe fe-layout"></i> <span>Manage Users</span></a>
                </li>
                <li class="{{ ( $active == 'reason') ? 'active' : ''}}">
                    <a href="{{ route('reason.index') }}"><i class="fe fe-calendar"></i> <span>Manage Reasons</span></a>
                </li>
                <li class="{{ ( $active == 'sponsored_requests') ? 'active' : ''}}">
                    <a href="{{ route('doctor.sponsored-request.listing') }}"><i class="fe fe-calendar"></i> <span>Manage Sponsored Requests</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
