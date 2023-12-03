<!-- Modal -->
<div id="ulasan" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xs">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h4 class="modal-title">Beri Ulasan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <table class="table table_modal">
          <input type="hidden" class="form-control form-control-sm id" id="idulasan" name="id">
          <tr>
            <td style="padding-top:0 !important;"><b>Isi Ulasan</b></td>
          </tr>
          <tr>
            <td style="padding-top:0 !important;">
                <textarea style="border: 0; padding: 10px; font-weight:bold;" name="ulasan" id="ulasan" cols="57" rows="10" placeholder="keren, pelayanannya cepat!!"></textarea>
            </td>
          </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="simpanUlasan" type="button">Process</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>

  </div>
</div>
