<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EOFFICE</title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('public/AdminLTE/dist/img/karyawan1.png') }}">
  
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/asset/plugins/fontawesome-free/css/all.min.css') }}">
  
  <!-- iCheck Bootstrap -->
  <link rel="stylesheet" href="{{ asset('public/asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('public/asset/dist/css/template.min.css') }}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <!-- Logo -->
        <img src="{{ asset('public/asset/dist/img/LOGO-MS.png') }}" style="width: 150px; height: 40px; margin-bottom: 15px;" alt="Logo">
        <br>
        <!-- Title -->
        <a href="{{ route('login') }}" class="h2"><b>EOFFICE</b></a>
      </div>

      <div class="card-body">
        <!-- Login Form -->
        <form action="/it/login-proses" method="POST">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" autofocus required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <!-- Uncomment if "Remember Me" functionality is needed
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
              -->
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('public/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('public/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('public/AdminLTE/dist/js/adminlte.min.js') }}"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Script for SweetAlert -->
  @if ($message = Session::get('failed'))
    <script>
      $(document).ready(function() {
        Swal.fire({
          icon: "error",
          title: '{{ $message }}',
          showConfirmButton: false,
          timer: 1000
        });
      });
    </script>
  @endif
</body>
</html>
