

<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

       <!-- CSRF Token -->
       <meta name="csrf-token" content="{{ csrf_token() }}">

       <title>JOREB Store | Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/front-login/images/favicon.png">
    <link href="/front-login/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
				<div class="col-md-6">
      <div class="authincation-content">
          <div class="row no-gutters">
              <div class="col-xl-12">
                  <div class="auth-form">
                      <h4 class="text-center mb-4">Sign in your account</h4>
                      <form method="POST" action="{{ route('login') }}">
                        @csrf
                          <div class="form-group">
                              <label class="mb-1"><strong>Mobile Number</strong></label>
                              <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number" autofocus>

                              @error('mobile_number')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="form-group">
                              <label class="mb-1"><strong>Password</strong></label>
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="form-row d-flex justify-content-between mt-4 mb-2">
                              <div class="form-group">
                                 <div class="custom-control custom-checkbox ml-1">
                                    <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
                                    <label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>
                        <p>Admin: Mobile - 09199406146 | Password - password</p>
                          <div class="text-center">
                              <button type="submit" class="btn btn-warning btn-block">Sign Me In</button>
                          </div>
                      </form>
                      <div class="new-account mt-3">
                          <p>Don't have an account? <a class="text-warning" href="{{ route('register') }}">Sign up</a></p>
                          <p>Return to <a class="text-danger" href="{{ route('home') }}">Home</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
            </div>
        </div>
    </div>
    <!--
    --></body>

    <script src="/front-login/vendor/global/global.min.js" type="text/javascript"></script>
                    <script src="/front-login/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
                        <script src="/front-login/js/custom.min.js" type="text/javascript"></script>
                    <script src="/front-login/js/deznav-init.js" type="text/javascript"></script>

</html>


