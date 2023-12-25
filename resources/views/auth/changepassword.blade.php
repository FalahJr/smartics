<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login | Smartics</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  {{-- <link rel="shortcut icon" href="{{asset('assets/dompetqu.png')}}" /> --}}
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
        <form class="login100-form validate-form" autocomplete="off" method="GET" action="{{ url('dochangepassword') }}">
          {{ csrf_field() }}
         <!--  <span class="login100-form-logo">
            <i class="zmdi zmdi-landscape"></i>
          </span> -->
          {{-- <div class="login100-form-title p-b-34 p-t-27"> --}}
            {{-- <img src="{{asset('assets/atonergi.png')}}" width="256px" height="64px"> --}}
              {{-- <h2>DompetQu</h2>
          </div> --}}

          <span class="login100-form-title p-b-34 p-t-27">
            Lupa Kata Sandi
          </span>

          @if (session('sukses'))
            <div class="alert alert-success" role="alert">
              Success, Password sudah diperbarui!
            </div>
            <br>
           @endif

           @if (isset($data))
           <input type="hidden" name="email" value="{{$data->email}}">
           @endif

        <div class="test wrap-input100 validate-input">
          <div class=" w-100" data-validate="Enter password">
            <input required="" class="input100" autocomplete="off" value="" type="password" name="password" id="password" placeholder="Kata sandi baru">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>

            @if (session('password'))
            <div class="red"  style="color: red"><b>Password Yang Anda Masukan Salah</b></div>
            @endif
            
          </div>
          
          <span class="eye-input">
              <i class="fa fa-eye" id="togglePassword"></i>
          </span>
         </div>
         
         <div class="test wrap-input100 validate-input">
          <div class=" w-100" data-validate="Enter password">
            <input required="" class="input100" autocomplete="off" value="" type="password" name="confirmpassword" id="confirmpassword" placeholder="Konfirmasi kata sandi">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>

            @if (session('confirmpassword'))
            <div class="red"  style="color: red"><b>Password Tidak Sama!</b></div>
            @endif
            
          </div>
          
          <span class="eye-input">
              <i class="fa fa-eye" id="toggleConfirmPassword"></i>
          </span>
         </div>

          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
              Ubah Sekarang
            </button>
          </div>

          <div class="contact100-form-checkbox text-center mt-4 text-light">
             Ingat kata sandi?, <a href="{{url('/login')}}" style="color: white;">Login Sekarang</a>
            </label>
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
//  $(document).ready(function() {
      var togglePassword = document.getElementById('togglePassword');
      var passwordInput = document.getElementById('password');

      togglePassword.addEventListener('click', function () {
          var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          togglePassword.classList.toggle('fa-eye-slash');
      });

      var togglePassword1 = document.getElementById('toggleConfirmPassword');
      var passwordInput1 = document.getElementById('confirmpassword');

      togglePassword1.addEventListener('click', function () {
          var type1 = passwordInput1.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput1.setAttribute('type', type1);
          togglePassword1.classList.toggle('fa-eye-slash');
      });
  // });
</script>