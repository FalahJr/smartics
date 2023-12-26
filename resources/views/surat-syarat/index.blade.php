@extends('main')
@section('content')

@include('surat-syarat.tambah')
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
          <li class="breadcrumb-item active" aria-current="page">Syarat Perizinan</li>
        </ol>
      </nav>
    </div>
  	<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" id="filter_surat_jenis"></h4>
                    <div class="col-md-12 col-sm-12 col-xs-12" align="right" style="margin-bottom: 15px;">
                      {{-- @if(Auth::user()->akses('MASTER DATA STATUS','tambah')) --}}
                      <button type="button" class="btn btn-warning shadow-none border-0" data-toggle="modal" data-target="#tambah" onclick="tambah()"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
                      {{-- @endif --}}
                    </div>
                    <div class="table-responsive">
        				        <table class="table table_status table-hover " id="table-data" cellspacing="0">
                          <thead class="bg-warning text-white" >
                              <tr>
                                <th>No</th>
                                <th>Syarat Perizinan</th>
                                <th>Surat Jenis</th>
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

const searchParams = new URLSearchParams(window.location.search);
const surat_jenis_id = searchParams ? searchParams.get('id') : null;
@php
$getId = $_GET ? $_GET['id'] : null;
  $surat_jenis = DB::table("surat_jenis")->where("id", $getId !== null ? $getId : '' )->first()
@endphp
var surat_jenis_nama = <?php echo json_encode($surat_jenis ? $surat_jenis->nama : '') ?>;
document.getElementById("filter_surat_jenis").innerHTML = surat_jenis_id ? 'Syarat Perizinan ( ' + surat_jenis_nama + ' )' : 'Syarat Perizinan';

// console.log({surat_jenis_id});
var table = $('#table-data').DataTable({
        processing: true,
        // responsive:true,
        // pageLength : 2,
        // lengthMenu: [ 2, 4 ],
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
            url:  surat_jenis_id !== null ? "{{ url('/suratsyarattable') }}/" + surat_jenis_id : "{{ url('/suratsyarattableall') }}" ,
        },
        columnDefs: [

              {
                 targets: 0 ,
                 className: 'center id '
              },
              {
                 targets: 1,
                 className: ' w-50'
              },
              {
                 targets: 2,
                 className: 'type center'
              },
             
            ],
        "columns": [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama'},
          {data: 'surat_jenis', name: 'surat_jenis'},
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



  function edit(id) {
    // body...
    $.ajax({
      url:baseUrl + '/editsuratsyarat',
      data:{id},
      dataType:'json',
      success:function(data){
        // console.log
        $("#titleText").text("Edit Syarat Perizinan");
        $('.id').val(data.id);
        $('.nama').val(data.nama);
        $('#surat_jenis_id').val(data.surat_jenis_id);
        $('#surat_jenis_id').select2();
      
        // $('.datepicker').val(data.created_at)
        $('#tambah').modal('show');
      }
    });

  }

  $('#simpan').click(function(){
    $.ajax({
      url: baseUrl + '/simpansuratsyarat',
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

  function tambah() {
    $("#titleText").text("Tambah Syarat Perizinan");
  }

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
            url:baseUrl + '/hapussuratsyarat',
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
    // $('#table_modal :input').val('');
   
    // $(".inputtext").val("");
    $('#surat_jenis_id').val('');
    $('#surat_jenis_id').select2();
    // var table1 = $('#table_modal').DataTable();
    // table1.ajax.reload();
    table.ajax.reload();
  }
</script>
@endsection
