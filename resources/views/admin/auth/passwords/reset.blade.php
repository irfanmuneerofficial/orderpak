<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Log in | Orderpak</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:;">
            <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" height="50">
            <b>ORDERPAK</b>
        </a>
    </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-header card-primary card-outline">
        <h3 class="card-title float-none text-center">
            Reset Password
        </h3>
  </div>
    <div class="card-body login-card-body">
        <form action="{{ route($passwordUpdateRoute) }}/" method="post">
            {{ csrf_field() }}
    
            {{-- Token field --}}
            <input type="hidden" name="token" value="{{ $token }}">
    
            {{-- Email field --}}
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ $email ?? old('email') }}" placeholder="Email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope "></span>
                    </div>
                </div>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </div>
    
            {{-- Password field --}}
            <div class="input-group mb-3">
                <input type="password" name="password"
                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock "></span>
                    </div>
                </div>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
            </div>
    
            {{-- Password confirmation field --}}
            <div class="input-group mb-3">
                <input type="password" name="password_confirmation"
                       class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                       placeholder="Confirm Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock "></span>
                    </div>
                </div>
                @if($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </div>
                @endif
            </div>
    
            {{-- Confirm password reset button --}}
            <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                <span class="fas fa-sync-alt"></span>
                Reset Password
            </button>
    
        </form>

    </div>


    </div>
    <!-- /.login-card-body -->
  
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.min.js"></script>

</body>
</html>
