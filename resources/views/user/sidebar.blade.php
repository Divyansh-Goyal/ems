<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Profile</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('/profile')}}">Personal Details</a>
                <a class="collapse-item" href="{{url('/password')}}">Change Password</a>
            </div>
        </div>
    </li>
    @if(Auth::user()->role == 'Manager')
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/getTeamList') }}">
            <i class="fas fa-fw fa-certificate"></i>
            <span>Team Members</span></a>
    </li>
    @endif
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/attendance') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Attandance</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/salary') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Salary</span></a>
    </li>

    
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    

</ul>
<!-- End of Sidebar -->