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
                <li class="{{ ( $active == 'default-charge') ? 'active' : ''}}">
                    <a href="{{ route('default.charge') }}"><i class="fe fe-layout"></i> <span>Default cgarge</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
