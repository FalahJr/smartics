@extends('main')
@section('content')

@include('arsip.detail')
@include('arsip.ulasan')
@php
 $jenis = DB::table("surat_jenis")->get();
@endphp
<style type="text/css">

</style>
<!-- partial -->
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb bg-warning">
          <li class="breadcrumb-item"><i class="fa fa-home"></i>&nbsp;<a href="/home">Home</a></li>
          {{-- <li class="breadcrumb-item">Setup Master Tagihan</li> --}}
          <li class="breadcrumb-item active" aria-current="page">Daftar Arsip Perizinan</li>
        </ol>
      </nav>
    </div>
  	<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body row">
                    <h4 class="card-title col-12 px-0 align-self-center col-md-8">Daftar Arsip Perizinan ( <span id="filter_jenis_surat">Semua</span> )</h4>
                    
                    <div class="col-12 col-md-4 px-0" align="right" style="margin-bottom: 15px;">
                      {{-- @if(Auth::user()->akses('MASTER DATA STATUS','tambah')) --}}
                    	<div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle border-0 shadown-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter Jenis Perizinan
                        </button>
                        <div class="dropdown-menu">
                             <a class="dropdown-item" href="#" onclick="handleFilter('Semua')">Semua</a>
                             @foreach ($jenis as $list)
                                <a class="dropdown-item" href="#" onclick="handleFilter('@php echo $list->id; @endphp')">@php echo $list->nama; @endphp</a>
                             @endforeach
                            {{-- <a class="dropdown-item" href="#" onclick="handleFilter('Pengisian Dokumen')">Pengisian Dokumen</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Validasi Operator')">Validasi Operator</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Verifikasi Verifikator')">Verifikasi Verifikator</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Penjadwalan Survey')">Penjadwalan Survey</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Verifikasi Hasil Survey')">Verifikasi Hasil Survey</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Verifikasi Kepala Dinas')">Verifikasi Kepala Dinas</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Selesai')">Selesai</a> --}}
                        </div>
                    </div>
                      {{-- @endif --}}
                    </div>
                    <div class="table-responsive mt-3">
        				        <table class="table table_status table-hover " id="table-data" cellspacing="0">
                          <thead class="bg-warning text-white">
                              <tr>
                                <th>No</th>
                                <th>Jenis Surat</th>
                                <th>Nama Pemohon</th>
                                <th>Jadwal Survey</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>

                            </tbody>


                        </table>
                    </div>
                  </div>
                </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
@endsection
@section('extra_script')
<script>
var selectedStatus = 'Semua'; 
function handleFilter(status) {
  console.log({status});
    selectedStatus = status ;  // update selectedStatus
    document.getElementById("filter_jenis_surat").innerHTML = status

    // Update DataTable's Ajax URL
    table.ajax.url("{{ url('/arsiptable') }}/" + selectedStatus).load();
};
var table = $('#table-data').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        paging: true,
        // dom: 'Bfrtip',
        title: '',
        buttons: [
            // 'pdf'
              // 'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength',
            
        ],
        ajax: {
          url: "{{ url('/arsiptable') }}/" + selectedStatus ,
        },
        columnDefs: [

              {
                 targets: 0 ,
                 className: 'center id'
              },
              {
                 targets: 1,
                 className: 'center'
              },
              {
                 targets: 2,
                 className: 'center'
              },
              {
                 targets: 3,
                 className: 'center'
              },
              {
                 targets: 4,
                 className: 'center'
              },
             
             
            ],
        "columns": [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'surat_jenis', name: 'surat_jenis'},
          {data: 'user', name: 'user'},
          {data:'jadwal_survey', name: 'jadwal_survey'},
          {data:'status', name: 'status'},
          {data:'tanggal_pengajuan', name: 'tanggal_pengajuan'},
          {data: 'aksi', name: 'aksi'},

        ],
        "language": {
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    }
                }
  });


  function ulasan(id) {
    $("#idulasan").val(id);
    $('#ulasan').modal('show');
  }

  let para;
let link;
let lineBreak;
let lineBreak2;

  function edit(id) {
    console.log({id})
    // body...
    $.ajax({
      url:baseUrl + '/editarsip',
      data:{id},
      dataType:'json',
      success:function(data){
        console.log({data})
        document.getElementById("jenis_perizinan").innerHTML = data.surat_jenis.nama;
        document.getElementById("surat_id").innerHTML = data.surat.id;
        document.getElementById("status_surat").innerHTML = data.surat.status;
        data.surat.status === "Selesai" ? document.getElementById("status_surat").style.color = "green" : data.surat.status === "Ditolak" ? document.getElementById("status_surat").style.color = "red" : document.getElementById("status_surat").style.color = "#F3B137";
        document.getElementById("nama_pemohon").innerHTML = data.user.nama_lengkap;
        document.getElementById("email").innerHTML = data.user.email;
        document.getElementById("tanggal_pengajuan").innerHTML = data.tanggal_pengajuan;
        document.getElementById("jadwal_survey").innerHTML = data.jadwal_survey;
        document.getElementById("alamat_lokasi").innerHTML = data.surat.alamat_lokasi;
        // data.surat_dokumen.forEach(function(surat_syarat) {
        // document.getElementsByClassName("nama_surat_syarat").innerHTML = surat_syarat.nama;
        // });

        data.surat_dokumen.forEach(myFunction);

// document.getElementById("nama_surat_syarat").innerHTML = text;
function myFunction(item, index) {
  const container = document.getElementById("nama_surat_syarat");

// Create paragraph element
para = document.createElement("p");
const node = document.createTextNode((index + 1) + ".) " + item.nama);
para.appendChild(node);

// Create link element
link = document.createElement("a");
link.setAttribute("href", item.dokumen_upload);  // Set the link's href attribute as needed
link.setAttribute("target", '_blank');  // Set the link's href attribute as needed
const text = document.createTextNode("Lihat Dokumen");
link.appendChild(text);

// Apply CSS styles to reduce the margin between para and link
para.style.marginBottom = "1px";  // Adjust the value as needed
link.style.color = "#F3B137"
// Append paragraph and link to the container
container.appendChild(para);
container.appendChild(link);

// Add a line break for better separation
lineBreak = document.createElement("br");
container.appendChild(lineBreak);
lineBreak2 = document.createElement("br");
container.appendChild(lineBreak2);

};
      
        // $('.datepicker').val(data.created_at)
        $('#detail').modal('show');
      }
    });

  }

  $('#simpan').click(function(){
    $.ajax({
      url: baseUrl + '/arsipsurat',
      data:$('.table_modal :input').serialize(),
      dataType:'json',
      success:function(data){
        if (data.status == 1) {
          iziToast.success({
              icon: 'fa fa-save',
              message: 'Data Berhasil Disimpan!',
          });
          reloadall();
        }else if(data.status == 2){
          iziToast.warning({
              icon: 'fa fa-info',
              message: 'Data Gagal disimpan!',
          });
        }else if (data.status == 3){
          iziToast.success({
              icon: 'fa fa-save',
              message: 'Data Berhasil Diubah!',
          });
          reloadall();
        }else if (data.status == 4){
          iziToast.warning({
              icon: 'fa fa-info',
              message: 'Data Gagal Diubah!',
          });
        }

      }
    });
  })


  function hapus(id) {
    iziToast.question({
      close: false,
  		overlay: true,
  		displayMode: 'once',
  		title: 'Hapus data',
  		message: 'Apakah anda yakin ?',
  		position: 'center',
  		buttons: [
  			['<button><b>Ya</b></button>', function (instance, toast) {
          $.ajax({
            url:baseUrl + '/arsipsurat',
            data:{id},
            dataType:'json',
            success:function(data){
              iziToast.success({
                  icon: 'fa fa-trash',
                  message: 'Data Berhasil Dihapus!',
              });

              reloadall();
            }
          });
  			}, true],
  			['<button>Tidak</button>', function (instance, toast) {
  				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
  			}],
  		]
  	});
  }
  function clearNamaSuratSyarat() {
    // Dapatkan referensi ke elemen div dengan ID "nama_surat_syarat"
    var container = document.getElementById("nama_surat_syarat");

    // Hapus semua elemen di dalam container
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }
}
  function closeModal() {
  // Menutup modal
  // ...
  // const container = document.getElementById("nama_surat_syarat");

// Create paragraph element
// const para = document.createElement("p");
// para.remove()
  // Menghapus elemen <p> jika sudah dibuat sebelumnya
  // if (para) {

    clearNamaSuratSyarat()
    

    // $('#detail').modal('hide');
    // table.ajax.reload();
    

  // }
}
  function reloadall() {
    $('.table_modal :input').val("");
    $('#tambah').modal('hide');
    $('#ulasan').modal('hide');
    // $('#table_modal :input').val('');
   
    // $(".inputtext").val("");
    // var table1 = $('#table_modal').DataTable();
    // table1.ajax.reload();
    table.ajax.reload();
  }

  $('#simpanUlasan').click(function(){
    $.ajax({
      url: baseUrl + '/simpanulasan',
      data:$('.table_modal :input').serialize(),
      dataType:'json',
      success:function(data){
        if (data.status == 1) {
          iziToast.success({
              icon: 'fa fa-save',
              message: 'Data Berhasil Disimpan!',
          });
          reloadall();
        }else if(data.status == 2){
          iziToast.warning({
              icon: 'fa fa-info',
              message: 'Data Gagal disimpan!',
          });
        }else if (data.status == 3){
          iziToast.success({
              icon: 'fa fa-save',
              message: 'Data Berhasil Diubah!',
          });
          reloadall();
        }else if (data.status == 4){
          iziToast.warning({
              icon: 'fa fa-info',
              message: 'Data Gagal Diubah!',
          });
        }

      }
    });
  })
</script>
@endsection
