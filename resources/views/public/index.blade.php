@extends('layouts.public.app')
@section('title','Homepage')

@section('content')
  <section id="header">
    <div class="container">
      <div class="row col-12">
        <div class="col-12 col-md-6" data-aos="fade-right">
          <h1>
            Aplikasi & Website Pengurus Permohonan Perizinan Sekolah
            “SMARTICS”
          </h1>
          <p>
            Dengan Smartics Anda dapat mengajukan permohonan izin secara
            mandiri dengan sistem daring (online).
          </p>
          <a href="{{route('buat-perizinan')}}" class="btn btn-main">Buat Permohonan</a>
        </div>
        <div class="col-12 col-md-6" data-aos="fade-left">
          <img
            src="{{asset('assets/image/header.png')}}"
            class="w-100 mt-5 mt-md-0"
            alt=""
          />
        </div>
      </div>
    </div>
  </section>

  <section id="total" class="mt-5">
    <div class="container mb-5 mt-5 mt-md-0">
      <div class="row col-12 justify-content-center mx-0 px-0">
        <div
          class="col-12 col-md-4 mb-4 row align-self-center justify-content-center"
          data-aos="fade-up"
          data-aos-offset="200"
        >
          <div class="col-6 align-items-center d-flex">
            <img src="{{asset('assets/icon/pengguna.png')}}" class="w-100" />
          </div>
          <div class="col-3 align-self-center p-0">
            <h2>15k+</h2>
            <p class="m-0">Pengguna</p>
          </div>
        </div>

        <div
          class="col-12 col-md-4 mb-4 row align-self-center justify-content-center"
          data-aos-offset="200"
          data-aos="fade-up"
        >
          <div class="col-6 align-items-center d-flex">
            <img src="{{asset('assets/icon/pengajuan.png')}}" class="w-100" />
          </div>
          <div class="col-3 align-self-center p-0">
            <h2>15k+</h2>
            <p class="m-0">Pengajuan</p>
          </div>
        </div>

        <div
          class="col-12 col-md-4 mb-4 row align-self-center justify-content-center"
          data-aos-offset="200"
          data-aos="fade-up"
        >
          <div class="col-6 align-items-center d-flex">
            <img src="{{asset('assets/icon/petugas.png')}}" class="w-100" />
          </div>
          <div class="col-3 align-self-center p-0">
            <h2>15k+</h2>
            <p class="m-0">Petugas</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div id="fitur-unggulan">
    <div class="container pb-5 mb-5">
      <img
        src="{{asset('assets/image/komponen-fitur-line.png')}}"
        class="komponenFiturLine"
        alt=""
      />
      <div class="row col-12 mx-0 px-0">
        <div
          class="col-12 col-md-4 justify-content-center d-flex"
          data-aos-offset="200"
          data-aos="fade-up"
        >
          <div class="card">
            <div class="row justify-content-center">
              <img src="{{asset('assets/icon/perizinan.png')}}" alt="" />
            </div>

            <h3>Perbaikan Data Perizinan</h3>
            <p>
              Pemohon dapat memperbaiki data yang sudah diajukan jika menerima
              pemberitahuan status berkas apabila terjadi pengembalian
            </p>
          </div>
        </div>
        <div
          class="col-12 col-md-4 justify-content-center d-flex"
          data-aos-offset="200"
          data-aos="fade-up"
        >
          <div class="card">
            <div class="row justify-content-center">
              <img src="{{asset('assets/icon/pelacakan.png')}}" alt="" />
            </div>

            <h3>Pelacakan Perizinan Real Time</h3>
            <p>
              Pemohon bisa mengetahui status berkas perizinan yang sedang /
              telah diproses oleh petugas berupa ID atau Scan QR Code
            </p>
          </div>
        </div>
        <div
          class="col-12 col-md-4 justify-content-center d-flex"
          data-aos-offset="200"
          data-aos="fade-up"
        >
          <div class="card">
            <div class="row justify-content-center">
              <img src="{{asset('assets/icon/cetak.png')}}" alt="" />
            </div>

            <h3>Unduh dan Cetak Perizinan</h3>
            <p>
              Dilengkapi bukti keabsahan berupa Kode QR, Anda dapat mencetak
              surat perizinan Anda secara mandiri, tanpa perlu datang ke
              Kantor Penerbit Perizinan
            </p>
          </div>
        </div>
      </div>
      <img
        src="{{asset('assets/image/komponen-fitur-dots.png')}}"
        class="komponenFiturDots"
        alt=""
      />
    </div>
  </div>

  <div id="semua-fitur">
    <div class="container">
      <div class="row col-12">
        <div
          class="col-12 col-md-6"
          data-aos-offset="200"
          data-aos="fade-right"
        >
          <img src="{{asset('assets/image/web-fitur.png')}}" class="w-100" alt="" />
        </div>
        <div
          class="col-12 col-md-6 align-self-center mt-5 mt-md-0"
          data-aos-offset="200"
          data-aos="fade-left"
        >
          <h2>01 - Website</h2>
          <p>
            Lorem Ipsun Dolor Sit Amet Lorem Ipsun Dolor Sit Amet Lorem Ipsun
          </p>
          <ul>
            <li>
              <img src="{{asset('assets/icon/checklist.png')}}" class="mr-2" /> Mudah
              Digunakan
            </li>
            <li>
              <img src="{{asset('assets/icon/checklist.png')}}" class="mr-2" /> Memanjakan
              Mata
            </li>
          </ul>
        </div>
      </div>
      <div class="row col-12 flex-column-reverse flex-md-row">
        <div
          class="col-12 col-md-6 align-self-center mt-5 mt-md-0"
          data-aos-offset="200"
          data-aos="fade-right"
        >
          <h2>02 - Mobile</h2>
          <p>
            Lorem Ipsun Dolor Sit Amet Lorem Ipsun Dolor Sit Amet Lorem Ipsun
          </p>
          <ul>
            <li>
              <img src="{{asset('assets/icon/checklist.png')}}" class="mr-2" /> Mudah
              Digunakan
            </li>
            <li>
              <img src="{{asset('assets/icon/checklist.png')}}" class="mr-2" /> Memanjakan
              Mata
            </li>
          </ul>
        </div>

        <div
          class="col-12 col-md-6"
          data-aos-offset="200"
          data-aos="fade-left"
        >
          <img src="{{asset('assets/image/mobile-fitur.png')}}" class="w-100" alt="" />
        </div>
      </div>
    </div>
  </div>

  <div id="download-app">
    <div class="container">
      <div class="row col-12 justify-content-center text-center text-md-left">
        <div
          class="col-12 col-md-5"
          data-aos-offset="200"
          data-aos="fade-right"
        >
          <img src="{{asset('assets/image/mobile-mockup.png')}}" class="w-75" alt="" />
        </div>
        <div
          class="col-12 col-md-5 text-white align-self-center"
          data-aos-offset="200"
          data-aos="fade-left"
        >
          <h2>Mobile App</h2>
          <p>
            Smartics kini tersedia di mobile app download aplikasi smartics di
            play store sekarang!!
          </p>
          <a href="" class="btn btn-white">Play Store</a>
        </div>
      </div>
    </div>
  </div>
@endsection
