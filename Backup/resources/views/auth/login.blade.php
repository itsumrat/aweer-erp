<!DOCTYPE html>
<html lang="en" >
    <head>
        <!-- Meta setup -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="">
        <meta name="decription" content="">
        <meta name="author" content="Devcorn">
        
        <!-- Title -->
        <title>EI-365 (Enterprise Intelligence)</title>
        
        <!-- Fav Icon -->
        <link rel="icon" href="{{ asset('public/fav.png') }}" />  
        <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/login-style.css') }}" />  
    </head>

    <body>
        
        <div class="container">
          <div class="box"></div>
          <div class="container-forms">
            <div class="container-info">
              <div class="info-item">
                <div class="table">
                  <div class="table-cell">
                    <p>
                      Have an account?
                    </p>
                    <div class="btn">
                      Log in
                    </div>
                  </div>
                </div>
              </div>
              <div class="info-item">
                <div class="table">
                  <div class="table-cell">
                    <p>
                      Don't have an account? 
                    </p>
                    <div class="btn">
                      Sign up
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="container-form">
              <div class="form-item log-in">
                <div class="table">
                  <div class="table-cell">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input id="email" placeholder="email" type="email" class="form__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" type="password" class="form__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <!--<div style="text-align: center;">-->
                            <button type="submit" class="btn btn-login">sign in</button>
                        <!--</div>-->
                        @if (Route::has('password.request'))
                            <a class="btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </form>
                  </div>
                </div>
              </div>
              <div class="form-item sign-up">
                <div class="table">
                  <div class="table-cell">
                    <div class="btn">
                      Sign up
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <script type="text/javascript" src="{{ asset('public/assets/js/jquery-3.4.1.min.js') }}"></script>      

            <!-- Bootstrap Propper jQuery -->
        <script type="text/javascript" src="{{ asset('public/assets/js/popper.js') }}"></script>
            
            <!-- Bootstrap jQuery -->
        <script type="text/javascript" src="{{ asset('public/assets/js/bootstrap.js') }}"></script>
    </body>
</html>
