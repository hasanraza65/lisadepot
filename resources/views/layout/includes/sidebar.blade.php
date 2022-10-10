<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon">
        <img width="80" height="auto" src="/assets/img/logo transparent.png">
    </div>
    
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
@if (request()->is('/'))
<li class="nav-item active">
@else 
<li class="nav-item">
@endif    
    <a class="nav-link" href="/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Main Options
</div>

<!-- Nav Item - Services Menu -->
@if (request()->is('service') || Request::is('service/*') )
<li class="nav-item active">
@else   
<li class="nav-item">
@endif     
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#services"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Services</span>
    </a>
    <div id="services" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        @if(Auth::user()->user_role==1)
            <a class="collapse-item" href="/service">All Services</a>
            <a class="collapse-item" href="/service/create">Add Service</a>
            @else
            <a class="collapse-item" href="/buy-service">Buy New Service</a>
            <a class="collapse-item" href="/my-services">My Services</a>
            @endif
        </div>
    </div>
</li>
@if (request()->is('client-account') || Request::is('client-account/*') )
<li class="nav-item active">
@else   
<li class="nav-item">
@endif     
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#accounts"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user"></i>
        <span>Accounts</span>
    </a>
    <div id="accounts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
           
            @if(Auth::user()->user_role==1)
            <a class="collapse-item" href="/client-account">All Accounts</a>
            <a class="collapse-item" href="/client-account/create">Add Account</a>
            @else
            <a class="collapse-item" href="/client-account">My Account</a>
            @endif
        </div>
    </div>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="/my-package">
        <i class="fas fa-fw fa-table"></i>
        <span>My Package</span></a>
</li>
@if (request()->is('client-progress') || Request::is('client-progress/*') )
<li class="nav-item active">
@else   
<li class="nav-item">
@endif     
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#client-progress"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-table"></i>
        <span>Progress</span>
    </a>
    <div id="client-progress" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
           
            @if(Auth::user()->user_role==1)
            <a class="collapse-item" href="/client-progress">All Progresses</a>
            <a class="collapse-item" href="/client-progress/create">Add progress</a>
            @else
            <a class="collapse-item" href="/client-progress">My Progress</a>
            @endif
        </div>
    </div>
</li>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->

