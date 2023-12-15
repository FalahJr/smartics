@extends('main')

@section('extra_style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
body {
    background-color: #f3f8fb;
}
#map {
    height: 35vh;
    width: 100%;
    z-index: 1;
}
</style>
@endsection

@section('content')
@include('laporan-survey.tolak')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb bg-warning">
                    <li class="breadcrumb-item active" aria-current="page">Laporan Survey</li>
                </ol>
            </nav>
        </div>
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                  
                    {{-- <form id="form1" >
                        @csrf
                        @method('post') --}}
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="foto_survey">Foto Survey</label>
                                <br>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $data->surat_id }}">
                                <input type="hidden" class="form-control" id="jadwal_survey" name="jadwal_survey" value="@php
                            use Carbon\Carbon;
                                
                                echo Carbon::now('Asia/Jakarta'); @endphp">

                                <img src="{{ asset($data->foto_survey) }}" alt="" class="w-100">
                            </div>
                            <div class="form-group col-6">
                                <label for="map">Alamat pada Peta</label>
                                <div id="map"></div>
                                
                            </div>
                            <div class="form-group col-6">
                                <strong for="longitude">longitude</strong>
                                <p class="" id="longitude">{{ $data->longitude }}</p>

                            </div>
                            <div class="form-group col-6">
                                <strong for="latitude">latitude</strong>
                                <p class="" id="latitude">{{ $data->latitude }}</p>

                            </div>
                            <div class="form-group col-6">
                                <strong>Nama Surveyor</strong>
                                <p class="" >{{ $data->nama_surveyor }}</p>

                            </div>
                            <div class="form-group col-6">
                                <strong>Email</strong>
                                <p class="" >{{ $data->email_surveyor }}</p>

                            </div>
                         
                            <div class="form-group col-6">
                                <strong>Tanggal Survey</strong>
                                <p class="" >{{ $data->jadwal_survey }}</p>

                            </div>
                            <div class="form-group col-6">
                                <strong>Status</strong>
                                <p class="" >{{ $data->surat_status }}</p>

                            </div>
                            {{-- <div class="form-group col-6">
                                <label for="dokumen_survey">Upload Dokumen Hasil Survey</label>
                              

                                <input type="file" class="form-control" id="dokumen_survey" name="dokumen_survey">
                            </div> --}}
                            <div class="form-group col-12">
                                <strong for="alamat_survey">Alamat</strong>
                                <p class="" >{{ $data->alamat_survey }}</p>
                            </div>
                           
                            
                        </div>
                        @if(Auth::user()->role_id == 6)
                        <div class="row btn-update-profile mt-4 col-12">
                            <button type="button" class="btn btn-main text-light col-12" id="simpan">Setuju</button>
                            <button type="button" class="btn btn-light col-12 mt-4" id="showModalTolak" style="border-color: #FAB754 !important; color:#FAB754">Tolak</button>
                        </div>
                        @endif
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
    </section>
    </div>
@endsection


@section('extra_script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


<script>
var latitude = document.getElementById("latitude").textContent; // Default latitude
var longitude = document.getElementById("longitude").textContent; // Default longitude
var idSurat = "{{ $data->surat_id }}";



// function askForLocation() {
//     if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(showPosition, handleError);
//     } else {
//         alert("Geolocation is not supported by this browser.");
//     }
// }

// function showPosition(position) {
//     latitude = position.coords.latitude;
//     longitude = position.coords.longitude;
//     document.getElementById("longitude").value = longitude;
//     document.getElementById("latitude").value = latitude;

//     initializeMap();
// }
initializeMap();

function initializeMap() {
    var map = L.map('map').setView([latitude, longitude], 17);
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map);

    
}

// function handleError(error) {
//     switch (error.code) {
//         case error.PERMISSION_DENIED:
//             alert("User denied the request for Geolocation.");
//             break;
//         case error.POSITION_UNAVAILABLE:
//             alert("Location information is unavailable.");
//             break;
//         case error.TIMEOUT:
//             alert("The request to get user location timed out.");
//             break;
//         case error.UNKNOWN_ERROR:
//             alert("An unknown error occurred.");
//             break;
//     }
// }

// askForLocation();

$('#simpan').click(function(){
   
    var formData = {
        'id' : idSurat
    }
    console.log({formData})
    
    $.ajax({
        url: baseUrl + '/surat/verifikasi-survey',
        type: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        // processData: false,
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
        success:function(data){
            if (data.status == 1) {
                iziToast.success({
                    icon: 'fa fa-save',
                    message: 'Data Berhasil Diverifikasi!',
                });
                let id = data.id;
                window.location.href = baseUrl + '/survey/laporan-survey';

                // reloadall();
            } else if(data.status == 2){
                iziToast.warning({
                    icon: 'fa fa-info',
                    message: data.message,
                });
            } else if (data.status == 3){
                iziToast.success({
                    icon: 'fa fa-save',
                    message: 'Data Berhasil Diubah!',
                });
                reloadall();
            } else if (data.status == 4){
                iziToast.warning({
                    icon: 'fa fa-info',
                    message: 'Data Gagal Diubah!',
                });
            }
        }
    });
});

$('#showModalTolak').click(function(){
//    var tes = document.getElementById("id").value ;
console.log({idSurat})
   $('.id').val(idSurat);
   $('.alasan_dikembalikan').val("");
   $('#detail').modal('hide'); 
   $('#showTolak').modal('show');
      // }
    // });
    
  })

  $('#dikembalikanProcess').click(function(){
    iziToast.question({
      close: false,
  		overlay: true,
  		displayMode: 'once',
  		title: 'Tolak Hasil Survey',
  		message: 'Apakah anda yakin ?',
  		position: 'center',
  		buttons: [
  			['<button><b>Ya</b></button>', function (instance, toast) {
          $.ajax({
            type:'POST',
            url:baseUrl + '/surat/tolak-survey',
            data:$('.table_modal :input').serialize(),
            dataType:'json',
            headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
            success:function(data){
              if (data.status == 1) {
          iziToast.success({
              icon: 'fa fa-save',
              message: 'Hasil Survey Berhasil Ditolak!',
          });
          window.location.href = baseUrl + '/survey/laporan-survey';
         
        }else if(data.status == 2){
          iziToast.warning({
              icon: 'fa fa-info',
              message: 'Surat Gagal Dikembalikan!',
          });
        }

              reloadall();
            }
          });
  			}, true],
  			['<button>Tidak</button>', function (instance, toast) {
  				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
  			}],
  		]
  	});
  })
</script>
@endsection
