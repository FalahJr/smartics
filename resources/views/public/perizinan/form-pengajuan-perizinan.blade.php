@extends('layouts.public.app')
@section('title','Ajukan Perizinan')

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
id="ajukan-perizinan"
>
<div class="col-md-6 col-12">
  <div class="content mt-5">
    <h3 class="text-center mb-5">Ajukan Perizinan</h3>
    <form>
      <div class="form-group">
        <label for="kategori_perizinan">Kategori Perizinan</label>
        <select class="form-control" id="kategori_perizinan">
          <option>Pilih Kategori</option>
        </select>
      </div>
      <div class="form-group">
        <label for="nama_perizinan">Nama</label>
        <input
          type="text"
          class="form-control"
          id="nama_perizinan"
          name="nama_perizinan"
        />
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" id="alamat" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="longitude">Longitude</label>
        <input
          type="text"
          class="form-control"
          id="longitude"
          name="longitude"
          disabled
        />
      </div>
      <div class="form-group">
        <label for="latitude">Latitude</label>
        <input
          type="text"
          class="form-control"
          id="latitude"
          name="latitude"
          disabled
        />
      </div>
      <a
        href="{{route('ajukan-syarat-perizinan')}}"
        type="submit"
        class="btn btn-main mt-5 w-100"
      >
        Lanjut
      </a>
    </form>
  </div>
</div>
</div>
@endsection
