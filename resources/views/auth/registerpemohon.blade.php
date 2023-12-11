<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Register | Smartics</title>
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
    <link rel="stylesheet" href="{{asset('assets/node_modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css')}}">
  <!--===============================================================================================-->
    <style type="text/css">
      .merah{
        background: red;
      }

      .test{
      display: flex;
      flex-direction: row;
      /* gap: 20px; */
    }
    .eye-input{
    /* margin-left: 260pt;
    margin-top: 0px; */
    /* z-index: 199; */
    /* width: 100%; */
    /* display: flex;
    justify-content: center;
    align-items: center; */
    background-color: #EAEAEA;
    padding:0 10px;
    align-self: center;
    color: black;
    font-size: 20px;
    /* background-color: red; */
}
    </style>
  </head>
  <body>
    <div class="limiter">
      <div class="container-login100" style="background-image: url('assets/login-v3/images/bg-01.jpg');">
        <div class="wrap-login100 bg-warning" style="width: 800px;">
          <form class="login100-form validate-form" autocomplete="off" method="POST" action="{{ url('registerpemohon/register') }}">
            {{ csrf_field() }}
           <!--  <span class="login100-form-logo">
              <i class="zmdi zmdi-landscape"></i>
            </span> -->
            {{-- <div class="login100-form-title p-b-34 p-t-27"> --}}
              {{-- <img src="{{asset('assets/atonergi.png')}}" width="256px" height="64px"> --}}
                {{-- <h2>DompetQu</h2>
            </div> --}}

            <span class="login100-form-title p-b-34 p-t-27">
              Daftar Smartics
            </span>

            @if (session('sukses'))
            <div class="alert alert-success" role="alert">
              Success, Akun anda sudah terdaftar
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
              @if (isset($nama))
              <input type="text" class="form-control form-control-sm inputtext nama_lengkap" name="nama_lengkap" value="{{$nama}}">
              @else
              <input type="text" class="form-control form-control-sm inputtext nama_lengkap" name="nama_lengkap">
              @endif
            </div>
            <div class="col-md-6 mb-3">
              <label for="pekerjaan" class="mb-2">Pekerjaan</label>
              <input type="text" class="form-control form-control-sm inputtext pekerjaan" name="pekerjaan">
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="mb-2">Email</label>
              @if (isset($email))
              <input type="email" class="form-control form-control-sm inputtext email" name="email" value="{{$email}}">
              @else
              <input type="email" class="form-control form-control-sm inputtext email" name="email">
              @endif
              @if (session('email'))
              <div class="red"  style="color: red"><b>Email sudah terdaftar</b></div>
              @endif
            </div>
            <div class="col-md-6  mb-3">
              <label for="alamat" class="mb-2">Alamat</label>
              <input type="text" class="form-control form-control-sm inputtext alamat" name="alamat">
            </div>
            <div class="col-md-6 mb-3">
              <label for="no_telp" class="mb-2">Nomor Telepon</label>
              <input type="number" class="form-control form-control-sm inputtext no_telp" name="no_telp">
              @if (session('nohp'))
              <div class="red"  style="color: red"><b>No Telepon sudah terdaftar</b></div>
              @endif
            </div>
            <div class="col-md-6 mb-3">
              <label for="provinsi" class="mb-2">Provinsi</label>
              <select class="form-control form-control-sm provinsi" name="provinsiselect" id="provinsiselect" onchange="selectProvinsi()" >
                <option disabled>Pilih</option>
              </select>
              <input type="hidden" name="provinsi" id="provinsivalue">
            </div>
            <div class="col-md-6 mb-3">
              <label for="tempat_lahir" class="mb-2">Tempat Lahir</label>
              <input type="text" class="form-control form-control-sm inputtext tempat_lahir" name="tempat_lahir">
            </div>
            <div class="col-md-6 mb-3">
              <label for="kabupaten_kota" class="mb-2">Kabupaten / Kota</label>
              <select class="form-control form-control-sm provinsi" name="kabupatenselect" id="kabupatenselect" onchange="selectKabupaten()" >
                <option disabled>Pilih</option>
              </select>
              <input type="hidden" name="kabupaten_kota" id="kabupatenvalue">
            </div>
            <div class="col-md-6 mb-3">
              <label for="tanggal_lahir" class="mb-2">Tanggal Lahir</label>
              <input type="date" class="form-control form-control-sm inputtext tanggal_lahir" name="tanggal_lahir">
              @if (session('tanggal_lahir'))
              <div class="red"  style="color: red"><b>Tanggal Lahir kosong</b></div>
              @endif
            </div>
            <div class="col-md-6 mb-3">
              <label for="kecamatan" class="mb-2">Kecamatan</label>
              <select class="form-control form-control-sm provinsi" name="kecamatanselect" id="kecamatanselect" onchange="selectKecamatan()" >
                <option disabled>Pilih</option>
              </select>
              <input type="hidden" name="kecamatan" id="kecamatanvalue">
            </div>
            <div class="col-md-6 mb-3">
              <label for="jenis_kelamin" class="mb-2">Jenis Kelamin</label>
              <select class="form-control form-control-sm jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin" >
                <option disabled>Pilih</option>
                <option value="Laki-Laki">Laki - Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="kelurahan" class="mb-2">Kelurahan</label>
              <select class="form-control form-control-sm provinsi" name="kelurahanselect" id="kelurahanselect" onchange="selectKelurahan()" >
                <option disabled>Pilih</option>
              </select>
              <input type="hidden" name="kelurahan" id="kelurahanvalue">
            </div>
            <div class="col-md-6 mb-3">
              <label for="jenis_identitas" class="mb-2">Jenis Identitas</label>
              <select class="form-control form-control-sm jenis_identitas" name="jenis_identitas" id="jenis_identitas" >
                <option disabled>Pilih</option>
                <option value="KTP">KTP</option>
                <option value="Paspor">Paspor</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="password" class="mb-2">Password</label>
              <div class="test">
              <input type="password" class="form-control form-control-sm inputtext password" name="password" id="password">
              <span class=" eye-input">
                <i class="fa fa-eye" id="togglePassword"></i>
            </span>
          </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nomor_identitas" class="mb-2">Nomor Identitas</label>
              <input type="text" class="form-control form-control-sm inputtext nomor_identitas" name="nomor_identitas">
            </div>
            <div class="col-md-6 mb-3">
              <label for="konfirmasi_password" class="mb-2">Konfirmasi Password</label>
              <div class="test">

              <input type="password" class="form-control form-control-sm inputtext konfirmasi_password" name="konfirmasi_password" id="passwordKonfirmasi">
              <span class=" eye-input">
                <i class="fa fa-eye" id="togglePasswordKonfirmasi"></i>
            </span>
              </div>
              @if (session('password'))
              <div class="red"  style="color: red"><b> Password confirm anda tidak sama! </b></div>
              @endif
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
              Sudah punya akun? <a href="loginpemohon" class="ml-2 text-light text-bold"> Login sekarang </a>
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
    <script src="{{asset('assets/node_modules/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>

    <!-- endinject -->
  </body>

  <script>
$(document).ready(function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        });

        const togglePasswordKonfirmasi = document.getElementById('togglePasswordKonfirmasi');
        const passwordInputKonfirmasi = document.getElementById('passwordKonfirmasi');

        togglePasswordKonfirmasi.addEventListener('click', function () {
            const type = passwordInputKonfirmasi.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInputKonfirmasi.setAttribute('type', type);
            togglePasswordKonfirmasi.classList.toggle('fa-eye-slash');
        });
    });
  provinsi();

  function provinsi() {
    $.ajax({
      url: "https://twilight-frost-2680.fly.dev/prov",
      method: "get",
      dataType:'json',
      success:function(data){
        var x = document.getElementById("provinsiselect");

        for (let i = 0; i < data.data.length; i++) {
          var option = document.createElement("option");
          option.text = data.data[i].name;
          option.value = data.data[i].id;
          x.add(option);
        }
      }
    });
  }

  function selectProvinsi() {
    var value = $('#provinsiselect').find(":selected").val();
    var name = $('#provinsiselect').find(":selected").text();

    $("#provinsivalue").val(name)

    $.ajax({
      url: "https://twilight-frost-2680.fly.dev/prov/"+value,
      method: "get",
      dataType:'json',
      success:function(data){
        $('#kabupatenselect').find('option:not(:first)').remove();
        var x = document.getElementById("kabupatenselect");

        for (let i = 0; i < data.kabupaten.length; i++) {
          var option = document.createElement("option");
          option.text = data.kabupaten[i].name;
          option.value = data.kabupaten[i].id;
          x.add(option);
        }
      }
    });
  }

  function selectKabupaten() {
    var value = $('#kabupatenselect').find(":selected").val();
    var name = $('#kabupatenselect').find(":selected").text();

    $("#kabupatenvalue").val(name)

    $.ajax({
      url: "https://twilight-frost-2680.fly.dev/kab/"+value,
      method: "get",
      dataType:'json',
      success:function(data){
        $('#kecamatanselect').find('option:not(:first)').remove();
        var x = document.getElementById("kecamatanselect");

        for (let i = 0; i < data.kecamatan.length; i++) {
          var option = document.createElement("option");
          option.text = data.kecamatan[i].name;
          option.value = data.kecamatan[i].id;
          x.add(option);
        }
      }
    });
  }

  function selectKecamatan() {
    var value = $('#kecamatanselect').find(":selected").val();
    var name = $('#kecamatanselect').find(":selected").text();

    $("#kecamatanvalue").val(name)

    $.ajax({
      url: "https://twilight-frost-2680.fly.dev/kec/"+value,
      method: "get",
      dataType:'json',
      success:function(data){
        $('#kelurahanselect').find('option:not(:first)').remove();
        var x = document.getElementById("kelurahanselect");

        for (let i = 0; i < data.kelurahan.length; i++) {
          var option = document.createElement("option");
          option.text = data.kelurahan[i].name;
          option.value = data.kelurahan[i].id;
          x.add(option);
        }
      }
    });
  }

  function selectKelurahan() {
    var value = $('#kelurahanselect').find(":selected").val();
    var name = $('#kelurahanselect').find(":selected").text();

    $("#kelurahanvalue").val(name)
  }
  
  $('select').select2({
    width: '100%'
  });

  </script>
</html>
