@extends('main')
@section('content')

@include('surat.detail')
@include('surat.tolak')
@php
 $testing = DB::table("surat")->where("id", "2")->first();
@endphp
<style type="text/css">

</style>
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb bg-warning">
          <li class="breadcrumb-item"><i class="fa fa-home"></i>&nbsp;<a href="/home">Home</a></li>
          {{-- <li class="breadcrumb-item">Setup Master Tagihan</li> --}}
          <li class="breadcrumb-item active" aria-current="page">Pemohon</li>
        </ol>
      </nav>
    </div>
  	<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Pemohon</h4>
                    <div class="col-md-12 col-sm-12 col-xs-12" align="right" style="margin-bottom: 15px;">
                      {{-- @if(Auth::user()->akses('MASTER DATA STATUS','tambah')) --}}
                    	
                      {{-- @endif --}}
                    </div>
                    <div class="table-responsive">
        				        <table class="table table_status table-hover " id="table-data" cellspacing="0">
                            <thead class="bg-warning text-white">
                              <tr>
                              @if (Auth::user()->role_id == 6)
                              <th>No. Surat</th>
                              <th>Jenis Surat</th>
                              <th>Nama Surveyor</th>
                              <th>Status</th>
                              <th>Tanggal</th>
                              <th>Action</th>
                              @else
                              <th>No. Surat</th>
                              <th>Jenis Perizinan</th>
                              <th>Jadwal Survey</th>
                              <th>Verifikasi Verifikator</th>
                              <th>Action</th>
                              @endif
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
          url: "{{ url('/laporansurveytable') }}"  ,
        },
        columnDefs: [

              {
                 targets: 0 ,
                 className: 'center id'
              },
              {
                 targets: 1,
                 className: ' center'
              },
              {
                 targets: 2,
                 className: ' center'
              },
              {
                 targets: 3,
                 className: ' center'
              },
              {
                 targets: 4,
                 className: ' center'
              },
          @if (Auth::user()->role_id == 6)

              {
                 targets: 5,
                 className: 'type center'
              },
              @endif
             
            ],
        "columns": [
          @if (Auth::user()->role_id == 6)

          {data: 'id', name: 'id'},
          {data: 'surat_jenis', name: 'surat_jenis'},
          {data: 'nama_surveyor', name: 'nama_surveyor'},
          {data:'status', name: 'status'},
          {data:'jadwal_survey', name: 'jadwal_survey'},
          {data: 'aksi', name: 'aksi'}, 
          @else
          {data: 'id', name: 'id'},
          {data: 'surat_jenis', name: 'surat_jenis'},
          {data:'jadwal_survey', name: 'jadwal_survey'},
          {data:'status_survey', name: 'status_survey'},
          {data: 'aksi', name: 'aksi'}, 
          @endif
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



  function edit(id) {
    // body...
    $.ajax({
      url:baseUrl + '/editsurat',
      data:{id},
      dataType:'json',
      success:function(data){
        console.log({data})
        $('.id').val(data.surat.id);
        document.getElementById("jenis_perizinan").innerHTML = data.surat_jenis.nama;
        document.getElementById("surat_id").innerHTML = data.surat.id;
        document.getElementById("status_surat").innerHTML = data.surat.status;
        data.surat.status == "Selesai" ? document.getElementById("status_surat").style.color = "green" : data.surat.status == "Ditolak" ? document.getElementById("status_surat").style.color = "red" : document.getElementById("status_surat").style.color = "#F3B137";
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
    const para = document.createElement("p");
    const node = document.createTextNode((index + 1) + ".) " + item.nama);
    para.appendChild(node);

    // Create link element
    const link = document.createElement("a");
    link.setAttribute("href", item.dokumen_upload);  // Set the link's href attribute as needed
    link.setAttribute("target", '_blank');  // Set the link's href attribute as needed
    const text = document.createTextNode("Lihat Dokumen");
    link.appendChild(text);

    // Apply CSS styles to reduce the margin between para and link
    para.style.marginBottom = "1px";  // Adjust the value as needed
    link.style.color = "#499DB1"
    // Append paragraph and link to the container
    container.appendChild(para);
    container.appendChild(link);

    // Add a line break for better separation
    const lineBreak = document.createElement("br");
    container.appendChild(lineBreak);
    const lineBreak2 = document.createElement("br");
    container.appendChild(lineBreak2);


};
      
        // $('.datepicker').val(data.created_at)
        $('#detail').modal('show');
      }
    });

  }

  $('#simpan').click(function(){
    $.ajax({
      url: baseUrl + '/simpansurat',
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

  $('#validasi').click(function(){
    iziToast.question({
      close: false,
  		overlay: true,
  		displayMode: 'once',
  		title: @if (Auth::user()->role_id == 5)
      'Validasi Surat',
      @else
      'Verifikasi Surat',
      @endif 
  		message: 'Apakah anda yakin ?',
  		position: 'center',
  		buttons: [
  			['<button><b>Ya</b></button>', function (instance, toast) {
          $.ajax({
            url:baseUrl + '/validasisurat',
            data:$('.table_modal :input').serialize(),
            dataType:'json',
            success:function(data){
              console.log({data})
              if (data.status == 3) {
          iziToast.success({
              icon: 'fa fa-save',
              message:
              @if (Auth::user()->role_id == 5)
              'Data Berhasil Divalidasi!',
              @else
              'Data Berhasil Diverifikasi!',
              @endif
          });
          reloadall();
        }else if(data.status == 4){
          iziToast.warning({
              icon: 'fa fa-info',
              message: 'Data Gagal Divalidasi!',
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

  $('#showModalTolak').click(function(){
   var tes = document.getElementById("id").value ;
   $('.id').val(tes);
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
  		title: 'Kembalikan Surat',
  		message: 'Apakah anda yakin ?',
  		position: 'center',
  		buttons: [
  			['<button><b>Ya</b></button>', function (instance, toast) {
          $.ajax({
            url:baseUrl + '/kembalikansurat',
            data:$('.table_modal :input').serialize(),
            dataType:'json',
            success:function(data){
              if (data.status == 3) {
          iziToast.success({
              icon: 'fa fa-save',
              message: 'Surat Berhasil Dikembalikan!',
          });
          reloadall();
        }else if(data.status == 4){
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
            url:baseUrl + '/hapussurat',
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

  function reloadall() {
    $('.table_modal :input').val("");
    $('#tambah').modal('hide');
    $('#detail').modal('hide');
    $('#showTolak').modal('hide');
    // $('#table_modal :input').val('');
   
    // $(".inputtext").val("");
    // var table1 = $('#table_modal').DataTable();
    // table1.ajax.reload();
    table.ajax.reload();
  }
</script>
@endsection
