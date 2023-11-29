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
        <li class="nav-item {{Request::is('permohonan-saya') ? 'active' : ''}}">
          <a class="nav-link" href="{{route('list-perizinan')}}">Permohonan Saya</a>
        </li>
        <li class="nav-item {{Request::is('lacak-perizinan') || Request::is('detail-perizinan') ? 'active' : ''}}">
          <a class="nav-link" href="{{route('lacak-perizinan')}}">Lacak Perizinan</a>
        </li>
        <li class="nav-item {{Request::is('chat') ? 'active' : ''}}">
          <a class="nav-link" href="chat">Live Chat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-main px-4 py-2 ml-0 ml-md-3" href="loginpemohon"
            >Masuk</a
          >
        </li>
      </ul>
    </div>
  </nav>