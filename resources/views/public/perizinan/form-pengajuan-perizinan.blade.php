@extends('layouts.public.app')
@section('title','Ajukan Perizinan')

@push('extra_style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<style>
body {
    background-color: #f3f8fb;
  }
  #map {
          height: 50vh;
    /* height: 100%; */
    width: 100%;
    z-index: 1;
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
  <input
  type="hidden" id="noPerizinan"
  class="form-control"
  name="id"
  value="{{ isset($updatePerizinan) ? $updatePerizinan->id : '' }}"
/>

<div class="form-group">
  <label for="kategori_perizinan">Kategori Perizinan</label>
  <select class="form-control" name="kategori" id="kategori_perizinan" required>
    <option disabled selected>Pilih Kategori</option>
    <option value="TK" @if (isset($updatePerizinan) && $updatePerizinan->kategori == 'TK') selected @endif>TK</option>
    <option value="PAUD" @if (isset($updatePerizinan) && $updatePerizinan->kategori == 'PAUD') selected @endif>PAUD</option>
    <option value="SD" @if (isset($updatePerizinan) && $updatePerizinan->kategori == 'SD') selected @endif>SD</option>
    <option value="SMP" @if (isset($updatePerizinan) && $updatePerizinan->kategori == 'SMP') selected @endif>SMP</option>
  </select>
</div>

<div class="form-group">
  <label for="nama_perizinan">Nama</label>
  <input
    type="text"
    class="form-control"
    id="nama_perizinan"
    name="nama"
    required
    value="{{ isset($updatePerizinan) ? $updatePerizinan->nama : '' }}"
  />
</div>

<div class="form-group">
  <label for="alamat">Alamat</label>
  <textarea class="form-control" name="alamat_lokasi" id="alamat" required rows="3">{{ isset($updatePerizinan) ? $updatePerizinan->alamat_lokasi : '' }}</textarea>
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
 
</script>
<script>
  // Minta izin lokasi
  var latitude = ''; // Default latitude
var longitude = ''; // Default longitude

function askForLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, handleError);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

// Tanggapan ketika lokasi ditemukan
function showPosition(position) {
  latitude = position.coords.latitude;
  longitude = position.coords.longitude;

  // Memperbarui nilai elemen HTML dengan longitude dan latitude terbaru
  document.getElementById("longitude").value = longitude;
  document.getElementById("latitude").value = latitude;

  console.log({ latitude, longitude }); // Menampilkan nilai latitude dan longitude ke konsol

  // Setelah lokasi ditemukan, inisialisasi peta dan marker
  initializeMap();
}

// Inisialisasi peta dan marker setelah lokasi ditemukan
function initializeMap() {
  var map = L.map('map').setView([latitude, longitude], 17);
  var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  var marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);

  // Fungsi yang dipanggil saat marker digeser
  function onMarkerDrag(event) {
    var marker = event.target;
    var position = marker.getLatLng();
    latitude = position.lat;
    longitude = position.lng;

    updatePopupContent();
    document.getElementById("longitude").value = longitude;
    document.getElementById("latitude").value = latitude;
  }

  // Fungsi untuk memperbarui konten popup marker
  function updatePopupContent() {
    marker.setPopupContent(`Latitude: ${latitude}<br>Longitude: ${longitude}`);
  }

  // Panggil fungsi saat marker digeser
  marker.on('drag', onMarkerDrag);

  // Fungsi yang dipanggil saat peta diklik
  function onMapClick(event) {
    var clickedLatLng = event.latlng;
    latitude = clickedLatLng.lat;
    longitude = clickedLatLng.lng;

    marker.setLatLng(clickedLatLng);
    updatePopupContent();
  }

  // Panggil fungsi saat peta diklik
  map.on('click', onMapClick);

  // Inisialisasi konten popup
  updatePopupContent();
}

// Panggil fungsi untuk meminta lokasi saat halaman dimuat
askForLocation();

// Tanggapan jika terjadi kesalahan
function handleError(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      alert("User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      alert("Location information is unavailable.");
      break;
    case error.TIMEOUT:
      alert("The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
      alert("An unknown error occurred.");
      break;
  }
}

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