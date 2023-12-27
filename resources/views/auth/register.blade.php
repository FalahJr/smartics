<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Register</title>
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
    </style>
  </head>
  <body>
    <div class="limiter">
      <div class="container-login100" style="background-image: url('assets/login-v3/images/bg-01.jpg');">
        <div class="wrap-login100 bg-warning" style="width: 800px;">
          <form class="login100-form validate-form" autocomplete="off" method="GET" action="{{ url('doregister') }}">
            {{ csrf_field() }}
           <!--  <span class="login100-form-logo">
              <i class="zmdi zmdi-landscape"></i>
            </span> -->
            {{-- <div class="login100-form-title p-b-34 p-t-27"> --}}
              {{-- <img src="{{asset('assets/atonergi.png')}}" width="256px" height="64px"> --}}
                {{-- <h2>Smartics</h2>
            </div> --}}

            <span class="login100-form-title p-b-34 p-t-27">
              Daftar Smartics
            </span>

            @if (session('sukses'))
            <div class="alert alert-success" role="alert">
              <a href="{{url('/verification')}}/{{encrypt($id)}}">Success, Akun anda sudah terdaftar, Klik disini untuk verifikasi, Kode Verifikasi dikirim melalui email anda.</a>
            </div>
            @endif

            @if (session('gagal'))
            <div class="alert alert-danger" role="alert">
              Gagal, Akun anda gagal terdaftar, terjadi kesalahan, silahkan cek ulang data diri anda, dan coba lagi.
            </div>
            @endif
            <div class="row text-light">
            <div class="col-md-6 mb-3">
              <label for="nama_lengkap" class="mb-2">Nama Lengkap</label>
              <input type="text" class="form-control form-control-sm inputtext nama_lengkap" name="nama_lengkap">
            </div>
            <div class="col-md-6 mb-3">
              <label for="pekerjaan" class="mb-2">Pekerjaan</label>
              <input type="text" class="form-control form-control-sm inputtext pekerjaan" name="pekerjaan">
            </div>
            <div class="col-md-6  mb-3">
              <label for="alamat" class="mb-2">Alamat</label>
              <input type="text" class="form-control form-control-sm inputtext alamat" name="alamat">
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="mb-2">Email</label>
              <input type="email" class="form-control form-control-sm inputtext email" name="email">
            </div>
            <div class="col-md-6 mb-3">
              <label for="provinsi" class="mb-2">Provinsi</label>
              <input type="text" class="form-control form-control-sm inputtext provinsi" name="provinsi">
            </div>
            <div class="col-md-6 mb-3">
              <label for="no_telp" class="mb-2">Nomor Telepon</label>
              <input type="email" class="form-control form-control-sm inputtext no_telp" name="no_telp">
            </div>
            <div class="col-md-6 mb-3">
              <label for="kabupaten_kota" class="mb-2">Kabupaten / Kota</label>
              <input type="text" class="form-control form-control-sm inputtext kabupaten_kota" name="kabupaten_kota">
            </div>
            <div class="col-md-6 mb-3">
              <label for="tempat_lahir" class="mb-2">Tempat Lahir</label>
              <input type="text" class="form-control form-control-sm inputtext tempat_lahir" name="tempat_lahir">
            </div>
            <div class="col-md-6 mb-3">
              <label for="kecamatan" class="mb-2">Kecamatan</label>
              <input type="text" class="form-control form-control-sm inputtext kecamatan" name="kecamatan">
            </div>
            <div class="col-md-6 mb-3">
              <label for="tanggal_lahir" class="mb-2">Tanggal Lahir</label>
              <input type="date" class="form-control form-control-sm inputtext tanggal_lahir" name="tanggal_lahir">
            </div>
            <div class="col-md-6 mb-3">
              <label for="jenis_kelamin" class="mb-2">Jenis Kelamin</label>
              <input type="text" class="form-control form-control-sm inputtext jenis_kelamin" name="jenis_kelamin">
            </div>
            <div class="col-md-6 mb-3">
              <label for="kelurahan" class="mb-2">Kelurahan</label>
              <input type="text" class="form-control form-control-sm inputtext kelurahan" name="kelurahan">
            </div>
            <div class="col-md-6 mb-3">
              <label for="jenis_identitas" class="mb-2">Jenis Identitas</label>
              <input type="text" class="form-control form-control-sm inputtext jenis_identitas" name="jenis_identitas">
            </div>
            <div class="col-md-6 mb-3">
              <label for="password" class="mb-2">Password</label>
              <input type="password" class="form-control form-control-sm inputtext password" name="password">
            </div>
            <div class="col-md-6 mb-3">
              <label for="nomor_identitas" class="mb-2">Nomor Identitas</label>
              <input type="text" class="form-control form-control-sm inputtext nomor_identitas" name="nomor_identitas">
            </div>
            <div class="col-md-6 mb-3">
              <label for="konfirmasi_password" class="mb-2">Konfirmasi Password</label>
              <input type="text" class="form-control form-control-sm inputtext konfirmasi_password" name="konfirmasi_password">
            </div>


            {{-- <div class="  bg-danger" data-validate = "Enter Fullname"> --}}
              {{-- <input required="" class="input w-100" autocomplete="off" value="" type="text" name="fullname" id="fullname" placeholder="Fullname (Contoh : Kevin Tanes Cahyani)" > --}}
              {{-- <span class="focus-input100" data-placeholder="&#xf0e0;"></span> --}}
              {{-- @if (session('username'))
                <div class="red"  style="color: red"><b>Fullname </b></div>
              @endif --}}
            {{-- </div> --}}
           
           

            {{-- <div class="text-center p-t-90">
               <a class="txt1" href="#">
                 Forgot Password?
               </a>
             </div> --}}
            

            <div class="container-login100-form-btn mt-4">
              <button type="submit" class="login100-form-btn" style="width: 300px;">
                Daftar Sekarang
              </button>
            </div>

            <br>
            <div class="container-login100-form-btn mt-4">
              Sudah punya akun? <a href="{{url('/login')}}" class="ml-2 text-light text-bold"> Login sekarang </a>
            </div>


          </form>
        </div>
      </div>
    </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    {{-- <script src="../../assets/vendors/js/vendor.bundle.base.js"></script> --}}
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>

    <!-- endinject -->
  </body>
</html>
