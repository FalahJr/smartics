<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login | Smartics</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  {{-- <link rel="shortcut icon" href="{{asset('assets/Smartics.png')}}" /> --}}
  <link rel="shortcut icon" href="{{asset('assets/favicon.ico')}}" type="image/x-icon" />
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v3/css/main.css')}}">
<!--===============================================================================================-->
  <style type="text/css">
    .merah{
      background: red;
    }
    .test{
      display: flex;
      flex-direction: row;
      
    }
    .eye-input{
    /* margin-left: 260pt;
    margin-top: 0px; */
    /* z-index: 199; */
    /* width: 100%; */
    /* display: flex;
    justify-content: center;
    align-items: center; */
    align-self: center;
    color: white;
    font-size: 20px;
    /* background-color: red; */
}
  </style>
</head>
<body>

  <div class="limiter">
    <div class="container-login100" style="background-image: url('assets/login-v3/images/bg-01.jpg');">
      <div class="wrap-login100 bg-warning">
        <form class="login100-form validate-form" autocomplete="off" method="GET" action="{{ url('login/auth') }}">
          {{ csrf_field() }}
         <!--  <span class="login100-form-logo">
            <i class="zmdi zmdi-landscape"></i>
          </span> -->
          {{-- <div class="login100-form-title p-b-34 p-t-27"> --}}
            {{-- <img src="{{asset('assets/atonergi.png')}}" width="256px" height="64px"> --}}
              {{-- <h2>Smartics</h2>
          </div> --}}

          <span class="login100-form-title p-b-34 p-t-27">
            Login Smartics
          </span>
          @if (session('sukses-registrasi'))
          <div class="alert alert-success" role="alert">
            Berhasil Registrasi Tunggu Admin Mengaktivasi Akun Anda dan Mengirimkan Email
          </div>
          @endif
          <div class="wrap-input100 validate-input" data-validate = "Enter Email">
            <input required="" class="input100" autocomplete="off" value="" type="text" name="username" id="username" placeholder="Email / Username" autofocus="">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
            @if (session('username'))
              <div class="red"  style="color: red"><b>Email / Username Tidak Ada</b></div>
            @endif
          </div>
          <div class="test wrap-input100 validate-input">
          <div class=" w-100" data-validate="Enter password">
            <input required="" class="input100" autocomplete="off" value="" type="password" name="password" id="password" placeholder="Password">
            {{-- <div class="testing"> --}}
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
            {{-- <div class="input-group-append eye-input"> --}}
             
            {{-- </div> --}}
          {{-- </div> --}}
            {{-- <div class="input-group-append eye-input">
              <span class="input-group-text">
                  <i class="fa fa-eye" id="togglePassword"></i>
              </span>
          </div> --}}
            @if (session('password'))
            <div class="red"  style="color: red"><b>Password Yang Anda Masukan Salah</b></div>
            @endif
            
          </div>
          <span class=" eye-input">
            <i class="fa fa-eye" id="togglePassword"></i>
        </span>
      </div>
         

          {{-- <div class="text-center p-t-90">
             <a class="txt1" href="#">
               Forgot Password?
             </a>
           </div> --}}

          <div class="contact100-form-checkbox text-center text-white">
            {{-- <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
            <label class="label-checkbox100" for="ckb1"> --}}
              Belum punya akun?, <a href="{{url('/registerpemohon')}}" style="color: white;">Register now!</a>
            </label>
          </div>

          <div class="contact100-form-checkbox text-center">
            {{-- <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember"> --}}
            {{-- <label class="label-checkbox100" for="ckb1"> --}}
             <a href="{{url('/forgotpassword')}}" style="color: white;">Lupa password?</a>
            </label>
          </div>

          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
              Login
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>

<!--===============================================================================================-->
  <script src="{{asset('assets/login-v3/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login-v3/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login-v3/vendor/bootstrap/js/popper.js')}}"></script>
  <script src="{{asset('assets/login-v3/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login-v3/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login-v3/vendor/daterangepicker/moment.min.js')}}"></script>
  <script src="{{asset('assets/login-v3/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login-v3/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login-v3/js/main.js')}}"></script>

</body>
</html>
<script type="text/javascript">
 $(document).ready(function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        });
    });
window.onload = function(e){
$('#username').val(null);
$('#password').val(null);
}

</script>