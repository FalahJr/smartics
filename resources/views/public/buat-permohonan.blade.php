@extends('layouts.public.app')
@section('title','Permohonan Saya')

@push('extra_style')
<style>
body {
    background-color: #f3f8fb;
  }
</style>
@endpush

@section('content')
<div
class="row col-12 justify-content-center mt-5 pt-5"
id="buat-perizinan"
>
<div class="col-md-10 col-12">
  <div class="content row justify-content-between">
    <h4 class="align-self-center">Panduan Permohonan Perizinan</h4>

    <div class="sec-center">
      <input
        class="dropdown"
        type="checkbox"
        id="dropdown"
        name="dropdown"
      />
      <label
        class="for-dropdown text-white justify-content-between px-4"
        for="dropdown"
        >Pilih Jenis Perizinan <i class="fa-solid fa-angle-down"></i
      ></label>
      <div class="section-dropdown">
        <a href="#" class="option" data-id="1"
          >Daftar Ulang Izin Operasional</a
        >
        <a href="#" class="option" data-id="2">Perizinan Pendirian</a>
        <a href="#" class="option" data-id="3">Perizinan Operasional</a>
        <a href="#" class="option" data-id="4">Perizinan Perubahan</a>
        <a href="#" class="option" data-id="5"
          >Rekomendasi Satuan Pendidikan Kerjasama</a
        >
        <a href="#" class="option">Pencabutan Izin</a>
      </div>
    </div>
  </div>
  <div class="content px-5" id="panduan">
    <div class="row px-2 justify-content-between">
      <h4 class="align-self-center">Panduan Permohonan Perizinan</h4>
      <a href="{{route('ajukan-perizinan')}}" class="btn btn-success px-4 py-3"
        >Syarat Saya Lengkap, Siap Ajukan Permohonan</a
      >
    </div>
    <div class="row mt-5">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Syarat Perizinan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>
              Akta pendirian dan perubahan badan penyelenggara satuan
              pendidikan berbentuk badan hukum dan memperoleh pengesahan
              dari Kementerian Hukum dan Hak Asasi Manusia
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>
              Surat permohonan mendirikan Sekolah Baru dari Ketua Yayasan
              / Perkumpulan / Badan Penyelenggara sesuai akta yayasan yang
              terakhir
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endsection

@push('extra_script')
<script>
    $(".option").click(function (e) {
      $("#panduan").css({ opacity: 1 });
    });
  </script>
@endpush
