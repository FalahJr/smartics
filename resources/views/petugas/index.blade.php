@extends('main')
@section('content')

@include('petugas.tambah')
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
          <li class="breadcrumb-item active" aria-current="page">Petugas</li>
        </ol>
      </nav>
    </div>
  	<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Petugas</h4>
                    <div class="col-md-12 col-sm-12 col-xs-12" align="right" style="margin-bottom: 15px;">
                      {{-- @if(Auth::user()->akses('MASTER DATA STATUS','tambah')) --}}
                    	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
                      {{-- @endif --}}
                    </div>
                    <div class="table-responsive">
        				        <table class="table table_status table-hover " id="table-data" cellspacing="0">
                            <thead class="bg-warning text-white">
                              <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Nama Lengkap</th>
                                <th>Role</th>
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

var table = $('#table-data').DataTable({
        processing: true,
        // responsive:true,
        serverSide: true,
        searching: true,
        paging: true,
        
        // dom: 'Bfrtip',
        title: '',
        buttons: [
            // 'pdf'
        ],
        ajax: {
            url:'{{ url('/petugastable') }}',
        },
        columnDefs: [

              {
                 targets: 0 ,
                 className: 'center id'
              },
              {
                 targets: 1,
                 className: 'nominal center'
              },
              {
                 targets: 2,
                 className: 'type center'
              },
              {
                 targets: 3,
                 className: 'center'
              },
              {
                 targets: 4,
                 className: 'center'
              }
            ],
        "columns": [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'username', name: 'username'},
          {data: 'password', name: 'password'},
          {data: 'nama_lengkap', name: 'Nama Lengkap'},
          {data: 'role', name: 'role'},
          {data: 'aksi', name: 'aksi'},

        ]
  });



  function edit(id) {
    // body...
    $.ajax({
      url:baseUrl + '/editpetugas',
      data:{id},
      dataType:'json',
      success:function(data){
        // console.log
        $('.id').val(data.id);
        $('.nama_lengkap').val(data.nama_lengkap);
        $('.username').val(data.username);
        $('.password').val(data.password);
        $('#role_id').val(data.role_id);
        $('#role_id').select2();

        
        
        // $('.datepicker').val(data.created_at)
        $('#tambah').modal('show');
      }
    });

  }

  $('#simpan').click(function(){
    $.ajax({
      url: baseUrl + '/simpanpetugas',
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
            url:baseUrl + '/hapuspetugas',
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
    $('#role_id').val('');
    $('#role_id').select2();
    // var table1 = $('#table_modal').DataTable();
    // table1.ajax.reload();
    table.ajax.reload();
  }
</script>
@endsection
