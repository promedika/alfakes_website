<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Alfakes Dashboard</title>

  <!-- favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('/assets/img/favicon.png')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/dist/css/adminlte.min.css')}}">
 
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="text-center">
    <a href="{{route('login')}}">
      <img src="{{ asset('/assets/img/logo_alfakes.png') }}">
    </a>
  </div>
  <br>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{route('login')}}" class="h1"><b>Alfakes</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{route('action.login')}}" method="post">
        @csrf
        @if(session()->has('message'))
          <div class="alert alert-danger mt-2">
            {{ session()->get('message') }}
          </div>
        @endif
        <div class="input-group mb-3">
          <input class="form-control" placeholder="Phone" type="text" name="phone" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input class="form-control form-password" placeholder="Password" type="password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock icon-password"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            {{-- &nbsp; --}}
            <input type="checkbox" class="form-checkbox"> Show password
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalscrollable">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/assets/AdminLTE-3.2.0/dist/js/adminlte.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
        $('.icon-password').removeClass('fa-lock');
        $('.icon-password').addClass('fa-eye');
			}else{
				$('.form-password').attr('type','password');
        $('.icon-password').removeClass('fa-eye');
        $('.icon-password').addClass('fa-lock');
			}
		});
	});
</script>
</body>
</html>