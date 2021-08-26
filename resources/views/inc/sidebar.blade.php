<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('direktur.dashboard') }}">
      <div class="sidebar-brand-icon">
        {{-- <i class="fas fa-laugh-wink"></i> --}}
        <img src="{{ asset('sb-admin2/img/pku_brand.png') }}" alt="">
      </div>
      <div class="sidebar-brand-text mx-3 text-xs">RS PKU Muhammadiyah Sukoharjo</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('direktur.dashboard') }}">
        <i class="fas fa-fw fa-medkit"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Fasilitas
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('direktur.kamar') }}">
            <i class="fas fa-fw fa-stethoscope"></i>
            <span>Kamar Pasien</span>
        </a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Setoran Bank</span>
        </a>
    </li> -->

</ul>
<!-- End of Sidebar -->
