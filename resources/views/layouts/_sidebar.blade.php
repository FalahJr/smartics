<!-- partial:partials/_navbar.html -->

    @if (Auth::user()->role_id == 9)
      <style>
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item{
          border: none;
        }
      </style>
      <nav class="navbar col-lg-12 col-12 py-3 p-md-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-none d-md-flex align-items-center justify-content-center ">
          <a class="navbar-brand brand-logo" href="{{url('/home')}}">
            <img src="{{asset('public/assets/img/smartics.png')}}" alt="logo" style="margin: auto; width:45%; height:100%" >
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch pr-4">
          <ul class="navbar-nav navbar-nav-right">
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
            <li class="nav-item">
            <div class="dropdown">
              <img src="{{asset('assets/icon/avatar.png')}}" class="avatar mr-1 ml-3" alt="">
              {{Auth::user()->nama_lengkap}}
              <i class="fa-solid fa-chevron-down ml-1"></i>
              <div class="dropdown-content">
                <a href="{{ url('profil-pengguna') }}">Profil Pengguna</a>
                <a href="{{ url('ubah-password-pengguna') }}">Ubah Password</a>
                <a href="{{ url('arsip') }}">Arsip Perizinan</a>
                <a href="{{url('ulasan')}}">Ulasan</a>
                <a href="{{ url('logout') }}">Logout</a>
              </div>
            </div>
            </li>
          </ul>
        </div>
      </nav>
    @else
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center ">
        <a class="navbar-brand brand-logo" href="{{url('/home')}}">
          <img src="{{asset('public/assets/img/smartics.png')}}" alt="logo" style="margin: auto; width:45%; height:100%" >
          {{-- <h1 style="margin:auto; ">DompetQu</h1> --}}
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{url('/home')}}">
          {{-- <img src="{{asset('assets/atonergi-mini.png')}}" alt="logo"/> --}}
          <h1 style="margin:auto; ">Smartics</h1>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field ml-4 d-none d-md-block">
          <form class="d-flex align-items-stretch h-100" action="#">
            <div class="input-group">
              <input id="filterInput" type="text" class="form-control bg-transparent border-0" placeholder="Search Menu">
              <div class="input-group-btn">
                <button id="btn-reset" type="button" class="btn bg-transparent px-0 d-none" style="cursor: pointer;"><i class="fa fa-times"></i></button>

              </div>
              <div class="input-group-addon bg-transparent border-0 search-button">
                <button type="button" class="btn btn-sm bg-transparent px-0" id="btn-search-menu">
                  <i class="mdi mdi-magnify"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
          <li class="nav-item">
            <div class="dropdown">
              <img src="{{asset('assets/icon/avatar.png')}}" class="avatar mr-1 ml-3" alt="">
              {{Auth::user()->nama_lengkap}}
              <i class="fa-solid fa-chevron-down ml-1"></i>
              <div class="dropdown-content">
                <a href="{{ url('profil-pengguna') }}">Profil</a>
                <a href="{{ url('logout') }}">Logout</a>
              </div>
            </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    @endif

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar"">
          <ul class="nav" id="ayaysir">

            @if (Auth::user()->role_id == 9 )
            <li class="nav-item {{Request::is('profil-pengguna') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/profil-pengguna')}}">
                <span class="menu-title">Profil Pengguna</span>
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            @else
            <li class="nav-item {{Request::is('home') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/home')}}">
                <span class="menu-title">Dashboard</span>
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            @endif

            @if (Auth::user()->role_id == 9 )
            <li class="nav-item {{Request::is('ubah-password-pengguna') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/ubah-password-pengguna')}}">
                <span class="menu-title">Ubah Password</span>
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                <i class="mdi mdi-account-edit menu-icon"></i>
              </a>
            </li>
            @endif


            @if (Auth::user()->role_id == 1 )

            <li class="nav-item {{Request::is('data-master') || Request::is('data-master/*') ? 'active' : ''   }}">
              <a class="nav-link" data-toggle="collapse" href="#data-master" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Data Master</span>
                
                <i class="menu-arrow"></i>
                <i class="mdi mdi-settings menu-icon mdi-spin"></i>
              </a>
              <div class="collapse {{Request::is('data-master') || Request::is('data-master/*') ? 'show' : '' }}" id="data-master">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link {{Request::is('data-master/modul/keuangan/data-master/klasifikasi-akun') || Request::is('data-master/modul/keuangan/setting/klasifikasi-akun/*') ? 'active' : ''  }}" href="{{url('petugas/')}}">Petugas<span class="d-none">Setting</span></a></li>
                  <li class="nav-item"> <a class="nav-link {{Request::is('data-master/modul/keuangan/data-master/klasifikasi-akun') || Request::is('data-master/modul/keuangan/setting/klasifikasi-akun/*') ? 'active' : ''  }}" href="{{url('pemohon/')}}">Pemohon<span class="d-none">Setting</span></a></li>
                  <li class="nav-item"> <a class="nav-link {{Request::is('data-master/modul/keuangan/data-master/klasifikasi-akun') || Request::is('data-master/modul/keuangan/setting/klasifikasi-akun/*') ? 'active' : ''  }}" href="{{url('surat-jenis')}}">Jenis dan Syarat Surat<span class="d-none">Setting</span></a></li>

                </ul>
                </div>
            </li>
            @endif
            
            @if (Auth::user()->role_id == 8 )
            <li class="nav-item {{Request::is('audit') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/audit')}}">
                <span class="menu-title">Laporan Audit</span>
                <i class="fa-solid fa-envelope-open-text"></i>
              </a>
            </li>
            @endif

            @if (Auth::user()->role_id != 4 )
            <li class="nav-item {{Request::is('surat') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/surat')}}">
                <span class="menu-title">Daftar Permohonan</span>
                <span class="menu-sub-title">@php 
                  if(Auth::user()->role_id == 5){
                    $total = DB::table('surat')->where('status', 'Validasi Operator')->count();
                  echo "(".$total.")";
                  }
                  if(Auth::user()->role_id == 6){
                    $total = DB::table('surat')->where('status', 'Verifikasi Verifikator')->count();
                  echo "(".$total.")";
                  }
                @endphp</span>
                <i class="fa-solid fa-envelope-open-text"></i>
              </a>
            </li>
            @endif

            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 9)
            
            <li class="nav-item {{Request::is('arsip') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/arsip')}}">
                <span class="menu-title">Arsip Perizinan</span>
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                <i class="fa-solid fa-folder-open"></i>
              </a>
            </li>
            @endif
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7)

            <li class="nav-item {{Request::is('setting') || Request::is('setting/*') ? 'active' : ''  }}">
              <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Survey</span>
                
                <i class="menu-arrow"></i>
                <i class="fa-solid fa-file"></i>
                {{-- <i class="mdi mdi-settings menu-icon mdi-spin"></i> --}}
              </a>
              <div class="collapse {{Request::is('setting') || Request::is('setting/*') ? 'show' : '' }}" id="setting">
                <ul class="nav flex-column sub-menu">
                  @if (Auth::user()->role_id != 7)
                  <li class="nav-item"> <a class="nav-link {{Request::is('survey/jadwal') || Request::is('survey/jadwal/*') ? 'active' : ''  }}" href="{{url('survey/jadwal')}}">Jadwal Survey<span class="d-none">Setting</span></a></li>
                  <li class="nav-item"> <a class="nav-link {{Request::is('survey/laporan-survey') || Request::is('survey/laporan-survey/*') ? 'active' : ''  }}" href="{{url('survey/laporan-survey')}}">Laporan Survey<span class="d-none">Setting</span></a></li>
                  @endif
                  @if (Auth::user()->role_id == 7)
                 
                  <li class="nav-item"> <a class="nav-link {{Request::is('survey/penugasan') || Request::is('survey/penugasan/*') ? 'active' : ''  }}" href="{{url('survey/penugasan')}}">Penugasan Survey<span class="d-none">Setting</span></a></li>
                  <li class="nav-item"> <a class="nav-link {{Request::is('setting/modul/keuangan/setting/klasifikasi-akun') || Request::is('setting/modul/keuangan/setting/klasifikasi-akun/*') ? 'active' : ''  }}" href="{{url('setting/modul/keuangan/setting/klasifikasi-akun')}}">Laporan Survey<span class="d-none">Setting</span></a></li>
                  @endif

                </ul>
                </div>
            </li>
            @endif

            {{-- <li class="nav-item {{Request::is('mutasi') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/mutasi')}}">
                <span class="menu-title">Cek Mutasi</span> --}}
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                {{-- <i class="fa fa-history"></i>
              </a>
            </li> --}}
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 9 || Auth::user()->role_id == 4 || Auth::user()->role_id == 3)
            <li class="nav-item {{Request::is('ulasan') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/ulasan')}}">
                <span class="menu-title">Ulasan</span>
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                <i class="fa-solid fa-comment"></i>
              </a>
            </li>
            @endif

            @if (Auth::user()->role_id == 1)
            <li class="nav-item {{Request::is('chatbot') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/chatbot')}}">
                <span class="menu-title">Chatbot</span>
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                <i class="fa-solid fa-robot"></i>
              </a>
            </li>
            @endif

            @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 9)
            <li class="nav-item {{Request::is('chat') ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/chat')}}">
                <span class="menu-title">Live Chat</span>
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                <i class="fa-solid fa-headset"></i>
              </a>
            </li>
            @endif
             

          </ul>

        </nav>
