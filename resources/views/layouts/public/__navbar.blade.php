<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-md-5">
    <a class="navbar-brand" href="{{route('homepage')}}">
      <img src="{{asset('assets/logo.png')}}" alt="" />
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto align-items-center text-right">
        <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
          <a class="nav-link" href="{{route('homepage')}}">Beranda</a>
        </li>
        <li class="nav-item {{Request::is('buat-permohonan') || Request::is('ajukan-perizinan') || Request::is('ajukan-syarat-perizinan') || Request::is('perizinan-berhasil-diajukan')? 'active' : ''}}">
          <a class="nav-link" href="{{route('buat-perizinan')}}">Buat Permohonan</a>
        </li>
        @if (Auth::check())
        <li class="nav-item {{Request::is('permohonan-saya') ? 'active' : ''}}">
          <a class="nav-link" href="{{route('list-perizinan')}}">Permohonan Saya</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{url('loginpemohon')}}">Permohonan Saya</a>
        </li>
        @endif
        <li class="nav-item {{Request::is('lacak-perizinan') || Request::is('detail-perizinan') ? 'active' : ''}}">
          <a class="nav-link" href="{{route('lacak-perizinan')}}">Lacak Perizinan</a>
        </li>
        @if (Auth::check())
        <li class="nav-item {{Request::is('chat') ? 'active' : ''}}">
          <a class="nav-link" href="chat">Live Chat</a>
        </li>
        @endif
        @if (Auth::check())
        <li class="nav-item">
        <div class="dropdown">
          <img src="{{ asset(optional(Auth::user())->avatar ? Auth::user()->avatar : 'assets/icon/avatar.png')  }}" class="avatar mr-1 ml-3" alt="">
          {{Auth::user()->nama_lengkap}}
          <i class="fa-solid fa-chevron-down ml-1"></i>
          <div class="dropdown-content">
            <a href="{{ url('profil-pengguna') }}">Profil Pengguna</a>
            <a href="{{ url('profil-password-pengguna') }}">Ubah Password</a>
            <a href="{{ url('arsip') }}">Arsip Perizinan</a>
            <a href="{{url('/ulasan')}}">Ulasan</a>
            <a href="{{ url('logout') }}">Logout</a>
          </div>
        </div>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link btn btn-main px-4 py-2 ml-0 ml-md-3" href="loginpemohon"
            >Masuk</a
          >
        </li>
        @endif
   

      </ul>
    </div>
  </nav>