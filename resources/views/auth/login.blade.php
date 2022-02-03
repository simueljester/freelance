
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/gif/png" href="{{ asset('system_info/').'/'.App\SystemInformation::whereActive(1)->first()->logo }}">
    
    <title>Login</title>
    @include('layouts.styles') 
</head>
<body  
{{-- style="background-image: url('{{asset('system_info/bg-login-background.jpg')}}');  background-size: cover;" --}}
style="background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,0) 37%, rgba(77,87,86,0.5746673669467788) 91%);"
>
    <div class="container " style="top:100px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border:none;background:transparent;top:100px">
                
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success mt-3" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session()->get('success') }}
                            </div>
                        @endif
        
                        @if(session()->has('error'))
                            <div class="alert alert-danger mt-3" role="alert">
                                <i class="fas fa-times-circle"></i> {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="text-center rubberBand" >
                            <img src="{{ asset('system_info/').'/'.App\SystemInformation::whereActive(1)->first()->logo }}"  style="width:250px">
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <br>
                                    <input type="checkbox" onclick="myFunction()"> Show Password
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <a href="#" class="ml-3" data-toggle="modal" data-target="#exampleModal"> Forgot Password? </a>
                                </div>
                            </div>
    
                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                 
                                    </div>
                                </div>
                            </div> --}}
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-info">
                                        {{ __('Login') }} <i class="fas fa-sign-in-alt"></i>
                                    </button>
    
                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <form action="{{route('recover-account')}}" method="POST">
        @csrf
        @method('POST')
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Forgot Password </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span> Please provide existing user email. We will send an OTP to user's email account to update password. </span>
                        <div class="form-group mt-3">
                            <span> Email </span>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info btn-sm"> Send Email </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    

    <style>
.rubberBand {
  -webkit-animation-name: rubberBand;
  animation-name: rubberBand;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes rubberBand {
  0% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  30% {
  -webkit-transform: scale3d(1.25, 0.75, 1);
  transform: scale3d(1.25, 0.75, 1);
  }
  40% {
  -webkit-transform: scale3d(0.75, 1.25, 1);
  transform: scale3d(0.75, 1.25, 1);
  }
  50% {
  -webkit-transform: scale3d(1.15, 0.85, 1);
  transform: scale3d(1.15, 0.85, 1);
  }
  65% {
  -webkit-transform: scale3d(.95, 1.05, 1);
  transform: scale3d(.95, 1.05, 1);
  }
  75% {
  -webkit-transform: scale3d(1.05, .95, 1);
  transform: scale3d(1.05, .95, 1);
  }
  100% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  }
  @keyframes rubberBand {
  0% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  30% {
  -webkit-transform: scale3d(1.25, 0.75, 1);
  transform: scale3d(1.25, 0.75, 1);
  }
  40% {
  -webkit-transform: scale3d(0.75, 1.25, 1);
  transform: scale3d(0.75, 1.25, 1);
  }
  50% {
  -webkit-transform: scale3d(1.15, 0.85, 1);
  transform: scale3d(1.15, 0.85, 1);
  }
  65% {
  -webkit-transform: scale3d(.95, 1.05, 1);
  transform: scale3d(.95, 1.05, 1);
  }
  75% {
  -webkit-transform: scale3d(1.05, .95, 1);
  transform: scale3d(1.05, .95, 1);
  }
  100% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  } 
    </style>

<script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>
</body>
</html>


