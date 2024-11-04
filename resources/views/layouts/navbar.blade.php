<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('public/asset/dist/img/LOGO-MS.png') }}">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('public/asset/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/asset/dist/css/template.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/asset/plugins/bootstrap-icons/font/bootstrap-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/asset/ajax/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/asset/bootstrap/bootstrap-5.3.3/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/asset/bootstrap/bootstrap-5.3.3/css/bootstrap.bundle.min.css') }}">
  
  <!-- Select2 CSS (temporary) -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  
  @yield('css')
</head>
<body style="background-color: rgb(222, 229, 231)">

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #0075cc">
    <a href="/aset/dashboard" class="navbar-brand" style="margin-left:34px;"><b>E-Office</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <!-- Aset Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Menu 1</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('asset.index') }}"><i class="bi bi-card-list" style="margin-right: 5px;"></i>Sub Menu 1</a>
            <a class="dropdown-item" href="{{ route('asset.create') }}"><i class="bi bi-clipboard2-plus" style="margin-right: 5px;"></i>Sub Menu 2</a>
            <a class="dropdown-item" href="{{ route('asset.cari') }}"><i class="bi bi-search" style="margin-right: 5px;"></i>Sub Menu 3</a>
            <a class="dropdown-item" href="{{ route('asset.laporan') }}"><i class="bi bi-file-bar-graph" style="margin-right: 5px;"></i>Sub Menu 4</a>
          </div>
        </li>
        
        <!-- Reminders Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Menu 2</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#"><i class="bi bi-houses" style="margin-right: 8px;"></i>Sub Menu 1</a>
            <a class="dropdown-item" href="#"><i class="bi bi-journal-text" style="margin-right: 8px;"></i>Sub Menu 2</a>
            <a class="dropdown-item" href="#"><i class="bi bi-car-front" style="margin-right: 8px;"></i>Sub Menu 3</a>
            <a class="dropdown-item" href="#"><i class="bi bi-cash-stack" style="margin-right: 8px;"></i>Sub Menu 4</a>
            <a class="dropdown-item" href="#"><i class="bi bi-person-rolodex" style="margin-right: 8px;"></i>Sub Menu 5</a>
            <a class="dropdown-item" href="#"><i class="bi bi-tools" style="margin-right: 8px;"></i>Sub Menu 6</a>
            <a class="dropdown-item" href="#"><i class="bi bi-activity" style="margin-right: 8px;"></i>Sub Menu 7</a>
          </div>
        </li>
        
        <!-- Old Aset Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Menu 3</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#"><i class="bi bi-card-list" style="margin-right: 5px;"></i>Sub Menu 1</a>
            <a class="dropdown-item" href="#"><i class="bi bi-search" style="margin-right: 5px;"></i>Sub Menu 2</a>
            <a class="dropdown-item" href="#"><i class="bi bi-file-bar-graph" style="margin-right: 5px;"></i>Sub Menu 3</a>
          </div>
        </li>
      </ul>
      
      <!-- User Dropdown -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle mr-4" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-profile rounded-circle" src="{{ asset('public/asset/dist/img/avatar.png') }}" style="width: 25px">
            @auth
              <span class="mr-1 ml-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->nama }}</span>
            @endauth
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-right: 20px;">
            <a class="dropdown-item" href="#">
              <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
              Change Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  {{-- End of Navbar --}}
  
 
