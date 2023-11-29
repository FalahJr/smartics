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
  <div class="content">
    <div class="row justify-content-between">
      <h4 class="align-self-center">List Permohonan Perizinan</h4>

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
          >Filter Status <i class="fa-solid fa-angle-down"></i
        ></label>
        <div class="section-dropdown">
          <a href="#" class="option" data-id="1">Verifikasi Operator</a>
          <a href="#" class="option" data-id="2"
            >Verifikasi Verifikator</a
          >
          <a href="#" class="option" data-id="3">Penjadwalan Survey</a>
          <a href="#" class="option" data-id="4"
            >Verifikasi Hasil Survey</a
          >
          <a href="#" class="option" data-id="5"
            >Verifikasi Kepala Dinas</a
          >
          <a href="#" class="option">Selesai</a>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Jenis Perizinan</th>
            <th scope="col">Status</th>
            <th scope="col">Jadwal Survey</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Rekomendasi Satuan Pendidikan Kerjasama</td>
            <td class="text-warning">Verifikasi Operator</td>
            <td>Belum Tersedia</td>
            <td>20 Oktober 2023</td>
            <td>
              <a href="#" class="btn btn-success"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </td>
          </tr>
          <tr>
            <th scope="row">1</th>
            <td>Rekomendasi Satuan Pendidikan Kerjasama</td>
            <td class="text-warning">Verifikasi Operator</td>
            <td>Belum Tersedia</td>
            <td>20 Oktober 2023</td>
            <td>
              <a href="#" class="btn btn-success"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </td>
          </tr>
          <tr>
            <th scope="row">1</th>
            <td>Rekomendasi Satuan Pendidikan Kerjasama</td>
            <td class="text-warning">Verifikasi Operator</td>
            <td>Belum Tersedia</td>
            <td>20 Oktober 2023</td>
            <td>
              <a href="#" class="btn btn-success"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endsection
