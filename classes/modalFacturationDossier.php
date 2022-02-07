<?php

?>
<div class="modal fade facture_<?php echo $reponse['id_dos'];?>" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_dos" value="<?php echo $reponse['id_dos'];?>">
      <input type="hidden" name="ref_dos" value="<?php echo $reponse['ref_dos'];?>">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title"><i class="fa fa-calculator"></i> FACTURATION</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label  class="control-label" style="text-align: center;">
              Voulez-vous facturer le dossier <b><?php echo $reponse['ref_dos'];?></b> ?
            </label>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="facturerDossier" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
