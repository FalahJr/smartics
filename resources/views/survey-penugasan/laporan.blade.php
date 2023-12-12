@extends('main')

@section('extra_style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
body {
    background-color: #f3f8fb;
}
#map {
    height: 50vh;
    width: 100%;
    z-index: 1;
}
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb bg-warning">
                    <li class="breadcrumb-item active" aria-current="page">Profil pengguna</li>
                </ol>
            </nav>
        </div>
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="foto_survey">Foto Survey</label>
                                <input type="file" class="form-control" id="foto_survey" name="foto_survey" value="{{ $data->foto_survey }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="alamat_survey">Alamat</label>
                                <textarea class="form-control" id="alamat_survey" name="alamat_survey">{{ $data->alamat_survey }}</textarea>
                            </div>
                            <div class="form-group col-12">
                                <label for="map">Alamat pada Peta</label>
                                <div id="map"></div>
                                
                            </div>
                            <div class="form-group col-6">
                                <label for="foto_survey">Foto Survey</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $data->longitude }}" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="foto_survey">Foto Survey</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $data->latitude }}" disabled>
                            </div>
                        </div>
                        <div class="row btn-update-profile mt-4">
                            <button type="submit" class="btn btn-main text-light">Kirim Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
var latitude = -7.3360141; // Default latitude
var longitude = 112.7028162; // Default longitude

function askForLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, handleError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    document.getElementById("longitude").value = longitude;
    document.getElementById("latitude").value = latitude;

    initializeMap();
}

function initializeMap() {
    var map = L.map('map').setView([latitude, longitude], 17);
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map);

    // map.on('click', function(event) {
    //     var clickedLatLng = event.latlng;
    //     latitude = clickedLatLng.lat;
    //     longitude = clickedLatLng.lng;

    //     marker.setLatLng(clickedLatLng);
    //     document.getElementById("longitude").value = longitude;
    //     document.getElementById("latitude").value = latitude;
    // });
}

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

askForLocation();

@if (session('success'))
  iziToast.success({
      icon: 'fa fa-save',
      message: 'Perubahan Berhasil Disimpan!',
  });
  @endif
</script>
@endsection
