@extends('main')
@section('content')

@include('survey-jadwal.detail')
@include('survey-jadwal.tambah')
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
          <li class="breadcrumb-item active" aria-current="page">List Penugasan Survey</li>
        </ol>
      </nav>
    </div>
  	<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">List Penugasan Survey</h4>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12" align="right" style="margin-bottom: 15px;">
                      {{-- @if(Auth::user()->akses('MASTER DATA STATUS','tambah')) --}}
                    	{{-- <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle border-0 shadown-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter Jenis Perizinan
                        </button>
                        <div class="dropdown-menu">
                             <a class="dropdown-item" href="#" onclick="handleFilter('Semua')">Semua</a>
                             @foreach ($jenis as $list)
                                <a class="dropdown-item" href="#" onclick="handleFilter('@php echo $list->nama; @endphp')">@php echo $list->nama; @endphp</a>
                             @endforeach --}}
                            {{-- <a class="dropdown-item" href="#" onclick="handleFilter('Pengisian Dokumen')">Pengisian Dokumen</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Validasi Operator')">Validasi Operator</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Verifikasi Verifikator')">Verifikasi Verifikator</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Penjadwalan Survey')">Penjadwalan Survey</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Verifikasi Hasil Survey')">Verifikasi Hasil Survey</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Verifikasi Kepala Dinas')">Verifikasi Kepala Dinas</a>
                            <a class="dropdown-item" href="#" onclick="handleFilter('Selesai')">Selesai</a> --}}
                        {{-- </div>
                    </div> --}}
                      {{-- @endif --}}
                    </div>
                    <div class="table-responsive">
        				        <table class="table table_status table-hover " id="table-data" cellspacing="0">
                          <thead class="bg-warning text-white">
                              <tr>
                                <th>No. Surat</th>
                                 <th>Jenis Surat</th>
                               {{-- <th>Nama Pemohon</th>--}}
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
// var selectedStatus = 'Semua'; 
// function handleFilter(status) {
//   console.log({status});
//     selectedStatus = status ;  // update selectedStatus
//     document.getElementById("filter_jenis_surat").innerHTML = status

//     // Update DataTable's Ajax URL
//     table.ajax.url("{{ url('/arsiptable') }}/" + selectedStatus).load();
// };
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
          url: "{{ url('/surveyjadwaltable') }}"  ,
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
          // {data: 'user', name: 'user'},
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

  function tambah() {
    // $('#user_id').val('');
    // $('#user_id').select2();
    // $('#tambah').modal('show');

  }

  function edit(id) {
    // body...
    $.ajax({
      url:baseUrl + '/editsurveyjadwal',
      data:{id},
      dataType:'json',
      success:function(data){
        console.log({data});
        $('.is_acc_penjadwalan').val(data.surat.is_acc_penjadwalan);
        $('.is_reschedule').val(data.surat.is_reschedule);
        $('.id').val(data.surat.id);
        $('.jadwal_survey').val(data.surat.jadwal_survey);
        $('#user_id').val(data.survey ? data.survey.user_id : '');
        $('#user_id').select2();
       
      
        // $('.datepicker').val(data.created_at)
        $('#tambah').modal('show');
      }
    });

  }

  function detail(id) {
    // body...
    $.ajax({
      url:baseUrl + '/editsurveyjadwal',
      data:{id},
      dataType:'json',
      success:function(data){
        console.log({data});
        $('.is_acc_penjadwalan').val(data.surat.is_acc_penjadwalan);
        $('.is_reschedule').val(data.surat.is_reschedule);
        $('.id').val(data.surat.id);
        $('.jadwal_survey').val(data.surat.jadwal_survey);
        $('#user_id').val(data.survey ? data.survey.user_id : '');
        $('#user_id').select2();
       
      
        // $('.datepicker').val(data.created_at)
        $('#detail').modal('show');
      }
    });

  }

  $('#simpan').click(function(){
    $.ajax({
      url: baseUrl + '/simpansurveyjadwal',
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

  function reloadall() {
    $('.table_modal :input').val("");
    $('#tambah').modal('hide');
    $('#user_id').val('');
    $('#user_id').select2();
    // $('#table_modal :input').val('');
   
    // $(".inputtext").val("");
    // var table1 = $('#table_modal').DataTable();
    // table1.ajax.reload();
    table.ajax.reload();
  }
</script>
@endsection
