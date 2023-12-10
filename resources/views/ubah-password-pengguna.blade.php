@extends('main')

@section('extra_style')
<style>
.eye-input{
    margin-left: -30px;
    z-index: 199;
    align-self: center;
    color: rgb(98, 98, 98);
}
</style>
@endsection

@section('content')
<!-- partial -->
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12">
        <nav aria-label="breadcrumb" role="navigation">
          <ol class="breadcrumb bg-warning">
            <li class="breadcrumb-item active" aria-current="page">Profil pengguna</li>
          </ol>
        </nav>
      </div>
  	<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body row ml-4">
                    <form id="changePasswordForm" method="POST" action="ubah-password-pengguna">
                        @csrf
                  <div class="row">
                    <div class="form-group w-100">
                        <div class="d-block">
                            <label for="new_password" class="control-label">Kata Sandi Baru</label>
                        </div>
                        <div class="input-group">
                        <input id="new_password" type="password"
                            class="form-control @error('password') is-invalid @enderror" value="" type="password" name="password" id="password" required>
                            <div class="input-group-append eye-input">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="togglePassword"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-100">
                        <div class="d-block">
                            <label for="confirm_password" class="control-label">Konfirmasi Kata Sandi Baru</label>
                        </div>
                        <div class="input-group">
                        <input id="confirm_password" type="password"
                            class="form-control  @error('password_confirmation') is-invalid @enderror" value="" type="password" name="password_confirmation" id="KataSandiBaru" required>
                            <div class="input-group-append  eye-input">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleKataSandiBaru"></i>
                                </span>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                      <button class="btn btn-main w-100" id="simpan" type="submit">Ubah Kata Sandi</button>
                </div>
                </div>
            </form>
                  </div>
                </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
@endsection

@section('extra_script')
<script>
  @if (session('success'))
  iziToast.success({
      icon: 'fa fa-save',
      message: 'Perubahan Berhasil Disimpan!',
  });
  @endif

  @if (session('passwordUpadate'))
  iziToast.success({
      icon: 'fa fa-save',
      message: 'Password Berhasil Diubah',
  });
  @endif
</script>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('new_password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye-slash');
    });

    const toggleKataSandiBaru = document.getElementById('toggleKataSandiBaru');
    const confirm_password = document.getElementById('confirm_password');

    toggleKataSandiBaru.addEventListener('click', function () {
        const type = confirm_password.getAttribute('type') === 'password' ? 'text' : 'password';
        confirm_password.setAttribute('type', type);
        toggleKataSandiBaru.classList.toggle('fa-eye-slash');
    });
</script>
@endsection