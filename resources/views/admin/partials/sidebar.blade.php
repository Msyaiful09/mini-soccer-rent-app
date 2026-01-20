<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin-dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-futbol"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mini Soccer Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin-dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola Pengguna</span>
        </a>
    </li>

    <!-- Nav Item - Fields Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFields"
            aria-expanded="true" aria-controls="collapseFields">
            <i class="fas fa-fw fa-map-marker-alt"></i>
            <span>Lapangan & Jam Main</span>
        </a>
        <div id="collapseFields" class="collapse" aria-labelledby="headingFields" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.fields.index') }}">Kelola Lapangan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Bookings -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.rents.index') }}">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Data Sewa</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.income') }}">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Data Pemasukan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
