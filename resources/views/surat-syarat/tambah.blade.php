<!-- Modal -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xs">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h4 class="modal-title" id="titleText">Tambah Syarat Perizinan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <table class="table table_modal">
          <tr>
            <td>Nama Syarat</td>
            <td>
              <input type="text" class="form-control form-control-sm inputtext nama" id="namaSyarat" name="nama">
              <div class="error-syarat text-danger" id="error_syarat"></div>
              <input type="hidden" class="form-control form-control-sm id" name="id" id="surat_syarat_id">
              <input type="hidden" class="form-control form-control-sm id" name="surat_jenis_id" id="surat_jenis_id">
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