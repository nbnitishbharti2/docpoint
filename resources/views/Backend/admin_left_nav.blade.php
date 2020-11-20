<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="active">
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-user-plus"></i> <span>Manange Doctors</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('doctor.index') }}">List</a></li>
                        <li><a href="{{ route('doctor.add') }}">Add</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-user-plus"></i> <span>Manange Specialities</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('Speciality.index') }}">List</a></li>
                        <li><a href="{{ route('Speciality.add') }}">Add</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="appointment-list.html"><i class="fe fe-layout"></i> <span>Appointments</span></a>
                </li>
                <li class="menu-title">
                    <span>Account</span>
                </li>
                <li>
                    <a href="components.html"><i class="fe fe-vector"></i> <span>Components</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-layout"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                        <li><a href="form-input-groups.html">Input Groups </a></li>
                        <li><a href="form-horizontal.html">Horizontal Form </a></li>
                        <li><a href="form-vertical.html"> Vertical Form </a></li>
                        <li><a href="form-mask.html"> Form Mask </a></li>
                        <li><a href="form-validation.html"> Form Validation </a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>App Settings</span>
                </li> --}}
                <li>
                    <a href="{{ route('countries') }}"><i class="fe fe-layout"></i> <span>Manage Locations</span></a>
                </li>
                <li>
                    <a href="{{ route('users') }}"><i class="fe fe-layout"></i> <span>Manage Users</span></a>
                </li>
                {{-- <li>
                    <a href="{{ route('user_groups') }}"><i class="fe fe-layout"></i> <span>Manage User Group</span></a>
                </li>
                <li class="menu-title">
                    <span>Logs</span>
                </li>
                <li>
                    <a href="#"><i class="fe fe-layout"></i> <span>Logs</span></a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
