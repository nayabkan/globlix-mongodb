<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Shashikanta">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token Ends -->
    <link rel="icon" href="{{ url('/') }}/admin/assets/images/favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('/') }}/admin/assets/images/favicon.jpg" type="image/x-icon">
    <title>Administrator Login || {{ config('app.name', 'Laravel') }}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('/') }}/admin/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/admin/assets/css/responsive.css">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card">
            <div>
                <div style="max-width:100px;margin: auto">
                    <a class="logo" href="{{ url('/') }}">
                      <img class="img-fluid for-light" src="{{ url('/') }}/admin/assets/images/logo/globlix.jpg" alt="looginpage">
                      <img class="img-fluid for-dark" src="{{ url('/') }}/admin/assets/images/logo/globlix.jpg" alt="looginpage">
                    </a>
                </div>
                @if ($message = Session::get('success-message'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error-message'))
                    <div class="alert alert-danger alert-block">
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
              <div class="login-main"> 
                <form class="theme-form" action="{{ route('admin-login') }}" method="post">
                  @csrf
                  <h4>Sign in as Administrator</h4>
                  <p>Enter your email & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control" type="email" required="" name="email" placeholder="Admin@email.com">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="" placeholder="*********">
                      <!-- <div class="show-hide"><span class="show"></span></div> -->
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <!-- <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox" name="remember">
                      <label class="text-muted" for="checkbox1">Remember password</label>
                    </div> -->
                    <a class="link" href="#">Forgot password?</a>
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                    </div>
                  </div>
                  <!-- <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{url('/register')}}">Create Account</a></p> -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- latest jquery-->
      <script src="{{ url('/') }}/admin/assets/js/jquery-3.5.1.min.js"></script>
      <!-- Bootstrap js-->
      <script src="{{ url('/') }}/admin/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="{{ url('/') }}/admin/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="{{ url('/') }}/admin/assets/js/icons/feather-icon/feather-icon.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="{{ url('/') }}/admin/assets/js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{ url('/') }}/admin/assets/js/script.js"></script>
      <!-- login js-->
      <!-- Plugin used-->
    </div>
  </body>
</html>