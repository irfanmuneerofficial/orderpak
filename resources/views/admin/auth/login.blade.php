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
          Sign in to start your session
      </h3>
  </div>
    <div class="card-body login-card-body">
      @if($errors->has('invalid'))
        <div class="alert alert-danger">
          {{ $errors->first('invalid') }}
        </div>
      @endif 

      <form action="{{ route($loginRoute) }}/" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                 value="{{ old('email') }}" placeholder="Email" autofocus>
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
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
          <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                 placeholder="Password">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
          </div>
          @if($errors->has('password'))
              <div class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
              </div>
          @endif
      </div>
        <!--<div class="row">-->
        <!--  <div class="col-8">-->
        <!--    <div class="icheck-primary">-->
        <!--      <input type="checkbox" id="remember">-->
        <!--      <label for="remember">-->
        <!--        Remember Me-->
        <!--      </label>-->
        <!--    </div>-->
        <!--  </div>-->
          <!-- /.col -->
           {{-- Login field --}}
          <div class="row">
            {{-- <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remeber Me</label>
                </div>
            </div> --}}
            <div class="col-5">
                <button type=submit class="btn btn-block btn-primary">
                    <span class="fas fa-sign-in-alt"></span>
                    Sign In
                </button>
            </div>
        </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="card-footer">
        {{-- Password reset link --}}
        @if($forgotPasswordRoute)
          <p class="my-0">
              <a href="{{ route($forgotPasswordRoute) }}">
                I forgot my password
              </a>
          </p>
        @endif
      </div>

      <!--<div class="social-auth-links text-center mb-3">-->
      <!--  <p>- OR -</p>-->
      <!--  {{-- <a href="#" class="btn btn-block btn-primary">-->
      <!--    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook-->
      <!--  </a> --}}-->
      <!--  <a href="#" class="btn btn-block btn-danger">-->
      <!--    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+-->
      <!--  </a>-->
      <!--</div>-->
      <!-- /.social-auth-links -->

      <!--<p class="mb-1">-->
      <!--  <a href="forgot-password.html">I forgot my password</a>-->
      <!--</p>-->
      <!--<p class="mb-0">-->
      <!--  <a href="register.html" class="text-center">Register a new membership</a>-->
      <!--</p>-->
    </div>
    <!-- /.login-card-body -->
  </div>
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
