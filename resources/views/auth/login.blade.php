<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIJULAK | KAB. MALINAU</title>

    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet">
    <style>
        .putih {
          color: #fff;
        }
    </style>
  </head>

  <body class="login" style="background-image:url({{asset('assets/images/login.jpeg')}});background-repeat: no-repeat; background-size: cover;">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
                <img src="{{asset('assets/images/malinau.png')}}" alt="" style="max-width:130px;">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <h1 class="putih"><b> SIJULAK.COM</b></h1>
              <p class="putih">Sistem Infomasi Jadwal, Undangan dan Kegiatan Bupati Malinau.</p>
              <div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail" name="email" value="{{ old('email') }}" required="" />
                @error('email')
                    <div class="alert alert-danger form-control" role="alert">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                      <label class="form-check-label putih" for="remember">
                          {{ __('Remember Me') }}
                      </label>
                {{-- <a class="reset_pass" href="#">Lost your password?</a> --}}
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1 class="putih"></i> KABUPATEN MALINAU</h1>
                  <p class="putih">©{{date('Y')}} All Rights Reserved. </p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
