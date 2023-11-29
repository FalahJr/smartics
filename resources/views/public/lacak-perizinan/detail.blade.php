@extends('layouts.public.app')
@section('title','Lacak Perizinan')

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
id="detail-perizinan"
>
<div class="col-md-6 col-12 mt-4">
  <div class="content">
    <h4 class="text-center">Status</h4>
    <h1 class="text-center text-warning">Verifikasi Operator</h1>
  </div>
  <div class="content">
    <div class="my-4">
      <h4 class="text-center">Nomor Surat</h4>
      <h1 class="text-center">002113</h1>
    </div>
    <div class="my-4">
      <h5 class="text-center">Jenis Perizinan</h5>
      <p class="text-center">Daftar Ulang Perizinan Operasional</p>
    </div>
    <div class="my-4">
      <h5 class="text-center">Tanggal</h5>
      <p class="text-center">20 Oktober 2023</p>
    </div>
    <div class="my-4">
      <h5 class="text-center">Alamat</h5>
      <p class="text-center">
        Jl. Kebonsari Sekolahan No.15, Kebonsari, Kec. Jambangan,
        Surabaya, Jawa Timur 60233
      </p>
    </div>
    <div class="my-4">
      <h5 class="text-center">Jadwal Survey</h5>
      <p class="text-center">Belum Tersedia</p>
    </div>
    <a href="{{route('lacak-perizinan')}}" class="btn btn-main my-4 w-100"
      >Kembali</a
    >
  </div>
</div>
</div>

@endsection
