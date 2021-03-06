<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include('layouts.vendor.stylesheet')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper mt-5">
        <main class="signup-form">
            <div class="cotainer">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="card-header text-center">Register User</h3>
                            <div class="card-body">
                                <form action="{{ route('register.custom') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                            required autofocus>
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" placeholder="Email" id="email_address" class="form-control"
                                            name="email" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" placeholder="Password" id="password" class="form-control"
                                            name="password" required>
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="d-grid mx-auto">
                                        <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                                    </div>
                                    <p class="sign-up">Sudah punya akun?<a href="{{ url('/') }}"> Login</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div> 
    @include('layouts.vendor.javascript')
    @yield('extra_javascript')
</body>
</html>