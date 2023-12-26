<!-- Modal -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xs">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h4 class="modal-title" id="titleText">Tambah Laporan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <table class="table table_modal">
          <tr>
            <td>Periode</td>
            <td>
              <input type="month" class="form-control form-control-sm inputtext periode" name="periode" 
              {{-- min="@php
              use Carbon\Carbon;

               echo Carbon::parse(Carbon::now())->format('F Y')
              @endphp" --}}
              >
              <input type="hidden" class="form-control form-control-sm id" name="id">
            </td>
          </tr>
          <tr>
            <td>Dokumen Hasil Audit</td>
            <td>
              <input type="file" class="form-control form-control-sm inputtext file_upload" name="file_upload">

              {{-- <select class="form-control form-control-sm role_id" name="role" id="role_id" >
                <option disabled>Pilih</option>
                @foreach ($roles as $key => $value)
                <option value="{{$value->id}}">{{$value->nama}}</option>
              @endforeach
              </select> --}}
            </td>
          </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="simpan" type="button">Process</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>

  </div>
</div>
