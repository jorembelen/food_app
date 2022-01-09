

<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>JOREB Store | Register</title>

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
                      <h4 class="text-center mb-4">Sign up your account</h4>
                      <form method="POST" action="{{ route('register') }}">
                        @csrf
                          <div class="form-group">
                              <label class="mb-1"><strong>First Name</strong></label>
                              <input type="text" class="form-control" placeholder="First Name" name="f_name" value="{{ old('f_name') }}" required>
                              @error('f_name') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div class="form-group">
                              <label class="mb-1"><strong>Last Name</strong></label>
                              <input type="text" class="form-control" placeholder="Last Name" name="l_name" value="{{ old('l_name') }}" required>

                            @error('l_name') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div class="form-group">
                              <label class="mb-1"><strong>Mobile Number</strong></label>
                              <input type="text" class="form-control" placeholder="mobile number" name="mobile_number" value="{{ old('mobile_number') }}" required>

                            @error('mobile_number') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div class="form-group">
                              <label class="mb-1"><strong>Password</strong></label>
                              <input type="password" class="form-control" name="password" required>
                              @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div class="form-group">
                            <label class="mb-1"><strong>Confirm Password</strong></label>
                            <input id="password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation">

                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                          <div class="text-center mt-4">
                              <button type="submit" class="btn btn-warning btn-block">Sign me up</button>
                          </div>
                      </form>
                      <div class="new-account mt-3">
                          <p>Already have an account? <a class="text-warning" href="{{ route('login') }}">Sign in</a></p>
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


    <script src="/front-login/vendor/global/global.min.js" type="text/javascript"></script>
    <script src="/front-login/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/front-login/js/custom.min.js" type="text/javascript"></script>
    <script src="/front-login/js/deznav-init.js" type="text/javascript"></script>


    <script src="{{ mix('js/app.js') }}"></script>
<!--

 	--></body>

</html>
