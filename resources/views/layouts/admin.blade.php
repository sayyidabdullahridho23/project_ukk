<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
  <title>
    Argon Dashboard 3 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />

  <style>
    /* Dark theme overrides */
    body {
        background-color: #121212 !important;
        color: #ffffff;
    }

    .bg-gray-100 {
        background-color: #1A1A1A !important;
    }

    .sidenav {
        background-color: #1E1E1E !important;
        border-color: #333333 !important;
    }

    .sidenav .navbar-brand {
        color: #E0E0E0 !important;
    }

    .nav-link {
        color: #E0E0E0 !important;
    }

    .nav-link:hover {
        color: #FFFFFF !important;
        background-color: #2D2D2D !important;
    }

    .nav-link.active {
        background-color: #2D4263 !important;
        color: #FFFFFF !important;
    }

    .card {
        background-color: #1E1E1E !important;
        border: 1px solid #333333 !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3) !important;
    }

    .card-header {
        background-color: #252525 !important;
        border-bottom: 1px solid #333333 !important;
    }

    .card-body {
        color: #E0E0E0 !important;
    }

    .table {
        color: #E0E0E0 !important;
    }

    .table td, .table th {
        border-color: #333333 !important;
    }

    .table-hover tbody tr:hover {
        background-color: #2D2D2D !important;
        color: #FFFFFF !important;
    }

    .form-control {
        background-color: #2D2D2D !important;
        border: 1px solid #404040 !important;
        color: #ffffff !important;
    }

    .form-control:focus {
        background-color: #333333 !important;
        border-color: #505050 !important;
        color: #ffffff !important;
    }

    .btn-primary {
        background-color: #2D4263 !important;
        border-color: #2D4263 !important;
    }

    .btn-primary:hover {
        background-color: #1E2B41 !important;
        border-color: #1E2B41 !important;
    }

    .btn-secondary {
        background-color: #4A4A4A !important;
        border-color: #4A4A4A !important;
    }

    .btn-secondary:hover {
        background-color: #3D3D3D !important;
        border-color: #3D3D3D !important;
    }

    .modal-content {
        background-color: #1E1E1E !important;
        border: 1px solid #333333 !important;
    }

    .modal-header {
        border-bottom: 1px solid #333333 !important;
    }

    .modal-footer {
        border-top: 1px solid #333333 !important;
    }

    .text-dark {
        color: #E0E0E0 !important;
    }

    .text-muted {
        color: #AAAAAA !important;
    }

    .border-radius-lg {
        border: 1px solid #333333 !important;
    }

    .alert {
        background-color: #252525 !important;
        border-color: #333333 !important;
        color: #E0E0E0 !important;
    }

    .alert-success {
        background-color: #1B3323 !important;
        border-color: #265C33 !important;
    }

    .alert-danger {
        background-color: #331B1B !important;
        border-color: #5C2626 !important;
    }

    .alert-info {
        background-color: #1B2633 !important;
        border-color: #26405C !important;
    }

    /* Dashboard specific styles */
    .icon-shape {
        background: #2D2D2D !important;
    }

    .chart-canvas {
        filter: invert(0.9) hue-rotate(180deg);
    }

    /* Fixed plugin customizer */
    .fixed-plugin .card {
        background-color: #1E1E1E !important;
    }

    .badge.filter {
        border: 1px solid #333333 !important;
    }

    /* Pagination */
    .pagination .page-link {
        background-color: #2D2D2D !important;
        border-color: #404040 !important;
        color: #E0E0E0 !important;
    }

    .pagination .page-link:hover {
        background-color: #404040 !important;
        border-color: #505050 !important;
        color: #FFFFFF !important;
    }

    .pagination .active .page-link {
        background-color: #2D4263 !important;
        border-color: #2D4263 !important;
    }
  </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-dark position-absolute w-100"></div>
<!-- Sidebar -->
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <span class="ms-1 font-weight-bold">Perpustakaan</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home')}}">
            
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <!-- Master Data Section -->
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master Data</h6>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.rak.*') ? 'active' : '' }}" href="{{ route('admin.rak.index')}}">
            
            <span class="nav-link-text ms-1">Rak</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.ddc.*') ? 'active' : '' }}" href="{{ route('admin.ddc.index')}}">
            
            <span class="nav-link-text ms-1">DDC</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.format.*') ? 'active' : '' }}" href="{{ route('admin.format.index')}}">
            
            <span class="nav-link-text ms-1">Format</span>
          </a>
        </li>

        <!-- Publisher & Author Section -->
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Penerbit & Pengarang</h6>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.penerbit.*') ? 'active' : '' }}" href="{{ route('admin.penerbit.index')}}">
            
            <span class="nav-link-text ms-1">Penerbit</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.pengarang.*') ? 'active' : '' }}" href="{{ route('admin.pengarang.index')}}">
            
            <span class="nav-link-text ms-1">Pengarang</span>
          </a>
        </li>

        <!-- Library Management Section -->
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manajemen Perpustakaan</h6>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.perpustakaan.*') ? 'active' : '' }}" 
             href="{{ route('admin.perpustakaan.index')}}">
              
              <span class="nav-link-text ms-1">Profil Perpustakaan</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.pustaka.*') ? 'active' : '' }}" href="{{ route('admin.pustaka.index')}}">
      
            <span class="nav-link-text ms-1">Pustaka</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.jenis-anggota.*') ? 'active' : '' }}" href="{{ route('admin.jenis-anggota.index')}}">
            
            <span class="nav-link-text ms-1">Jenis Anggota</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}" href="{{ route('admin.transaksi.index')}}">

            <span class="nav-link-text ms-1">Transaksi</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <!-- End Sidebar -->

  <main class="main-content position-relative border-radius-lg ">

  @include('partialsAdmin.navbar')  

  @yield('content')

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html>