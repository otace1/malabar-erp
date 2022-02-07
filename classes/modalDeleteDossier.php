<?php

?>
<div class="">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_dos" value="<?php echo $_GET['id_dos'];?>">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title"><i class="fa fa-times"></i> SUPPRESSION DOSSIER</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label  class="control-label" style="text-align: center;">
              Voulez-vous supprimer le dossier <b><?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?></b> ?
            </label>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" name="deleteDossier" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
