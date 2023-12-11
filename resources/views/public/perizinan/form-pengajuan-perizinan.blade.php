@extends('layouts.public.app')
@section('title','Ajukan Perizinan')

@push('extra_style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<style>
body {
    background-color: #f3f8fb;
  }
  #map {
          height: 100px;
    /* height: 100%; */
    width: 100%;
    /* overflow: hidden; */
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
    <h3 class="text-center mb-5">Ajukan {{$perizinan->nama}}</h3>
    <form id="form1">
      <input
      type="hidden"
      class="form-control"
      name="surat_jenis_id"
      value="{{$perizinan->id}}"
    />
    <input
    type="hidden"
    class="form-control"
    name="nama_perizinan"
    value="{{$perizinan->nama}}"
  />
      <div class="form-group">
        <label for="kategori_perizinan">Kategori Perizinan</label>
        <select class="form-control" name="kategori" id="kategori_perizinan">
          <option disabled selected>Pilih Kategori</option>
          <option value="TK">TK</option>
          <option value="PAUD">PAUD</option>
          <option value="SD">SD</option>
          <option value="SMP">SMP</option>
        </select>
      </div>
      <div class="form-group">
        <label for="nama_perizinan">Nama</label>
        <input
          type="text"
          class="form-control"
          id="nama_perizinan"
          name="nama"
        />
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" name="alamat_lokasi" id="alamat" rows="3"></textarea>
      </div>
      <div class="form-group">
        <div id="map" class="" ></div>

      </div>
      <div class="form-group">
        <label for="longitude">Longitude</label>
        <input
        value="112.7028162"

          type="text"
          class="form-control"
          id="longitude"
          name="longitude"
          readonly
        />
      </div>
      <div class="form-group">
        <label for="latitude">Latitude</label>
        <input
        value="-7.3360141"
          type="text"
          class="form-control"
          id="latitude"
          name="latitude"
          readonly
        />
      </div>
      <button
        type="submit"
        class="btn btn-main mt-5 w-100"
      >
        Lanjut
      </butt>
    </form>
  </div>
</div>
</div>
@endsection

@push('extra_script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
  var map = L.map('map').setView([-7.157358, 112.656169], 13);
  var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
</script>
<script>
  $(document).ready(function () {
      $('#form1').submit(function (e) {
          e.preventDefault();

          var formData = $(this).serializeArray();

          sessionStorage.setItem('form1Data', JSON.stringify(formData));
          window.location.href = 'ajukan-syarat-perizinan';
      });
  });
</script>

@endpush