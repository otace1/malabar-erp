
<div class="modal fade validerFacture_<?php echo $reponse['ref_fact'];?>" id="modal-default">
  <div class="modal-dialog modal-sm">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="ref_fact" value="<?php echo $reponse['ref_fact'];?>">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i> CONFIRMATION</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label  class="control-label" style="text-align: center;">
              <center>Voulez-vous valider la facture <b><?php echo $reponse['ref_fact'];?></b> ?</center>
            </label>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Annuler</button>
        <button type="submit" name="validerFacture" class="btn btn-primary btn-xs">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
