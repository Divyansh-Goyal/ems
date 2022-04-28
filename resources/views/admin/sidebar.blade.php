<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ Auth::user()->name }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Profile</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('/adminprofile')}}">Personal Details</a>
                <a class="collapse-item" href="{{url('/passwordChange')}}">Change Password</a>
            </div>
        </div>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/employee') }}">
            <i class="fas fa-fw fa-american-sign-language-interpreting"></i>
            <span>Add Employee</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/employees') }}">
            <i class="fas fa-fw fa-bars"></i>
            <span>Employees List</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Attendance</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/employees-attendance') }}">Attendance Updates</a>
                <a class="collapse-item" href="{{url('/requestPending')}}">Attendance Requests</a>
            </div>
        </div>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/employees-salary') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Employees Salary</span></a>
    </li>


    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->