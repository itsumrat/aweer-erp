<!DOCTYPE html>
<html lang="en" >
    <head>
        <!-- Meta setup -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="">
        <meta name="decription" content="">
        <meta name="author" content="Mahmudul Hasan">
        
        <!-- Title -->
        <title>পাড়ার দোকান</title>
        
        <!-- Fav Icon -->
        <link rel="icon" href="{{ asset('assets/img/fav.png') }}" />  

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
        
        <!-- Main StyleSheet -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />  
    </head>

    <body style="background-color: #3f3e40">
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="row main-content bg-success text-center">
                <div class="col-md-4 text-center company__info">
                    <img src="{{ asset('assets/img/logo-xs.png') }}" alt="logo" width="100%">
                </div>
                <div class="col-md-8 col-xs-12 col-sm-12 login_form">
                    <div class="container-fluid">
                        <div class="row">
                            <h4 style="text-align: center; width: 100%;margin-top: 50px;margin-bottom: 20px;">Reset Password</h4>
                        </div>
                        <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                           
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                                <p style="font-size: 15px;font-weight: 600;color: #4c4c4c;">If you forget password then click on the bellow password reset btton. We will submit a reset link to your email.</p>
                                <div style="text-align: center;">
                                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                    <button type="submit" class="btn btn-password-reset">Reset Password</button><br>
                                    <a href="{{ route('login') }}" style="font-size: 14px;font-weight: 600;color: #4c4c4c;">Take Me to Login Area</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>      

            <!-- Bootstrap Propper jQuery -->
        <script src="{{ asset('assets/js/popper.js') }}"></script>
            
            <!-- Bootstrap jQuery -->
        <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    </body>
</html>
