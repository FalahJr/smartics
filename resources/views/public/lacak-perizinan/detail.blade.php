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
    <h1 class="text-center text-warning">{{$data->status}}</h1>
  </div>
  <div class="content">
    <div class="my-4">
      <h4 class="text-center">Nomor Surat</h4>
      <h1 class="text-center">{{$data->id}}</h1>
    </div>
    <div class="my-4">
      <h5 class="text-center">Jenis Perizinan</h5>
      <p class="text-center">{{$data->nama_perizinan}}</p>
    </div>
    <div class="my-4">
      <h5 class="text-center">Tanggal</h5>
      <p class="text-center">{{$data->created_at}}</p>
    </div>
    <div class="my-4">
      <h5 class="text-center">Alamat</h5>
      <p class="text-center">
        {{$data->alamat_lokasi}}
      </p>
    </div>
    <div class="my-4">
      <h5 class="text-center">Jadwal Survey</h5>
      <p class="text-center">{{(!$data->jadwal_survey) ? 'Belum Tersedia' : $data->jadwal_survey}}</p>
    </div>
    <a href="{{route('lacak-perizinan')}}" class="btn btn-main my-4 w-100"
      >Kembali</a
    >
  </div>
</div>
</div>

@endsection
