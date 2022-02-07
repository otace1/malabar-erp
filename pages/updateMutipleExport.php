<?php
if(isset($_GET['id_mod_trac']) && isset($_GET['id_mod_trac'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade updateExport" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="nbre" value="<?php echo $maClasse-> getNombreDossierClientModeTransportModeLicence3($_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_mod_trac'], $_GET['commodity']);?>">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Update Multiple Files.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">BEGIN</label>
            <select name="debut" onchange="" class="form-control cc-exp">
                <?php
                  $maClasse-> selectionnerDossierClientModeTransportModeLicence2($_GET['id_cli'], $_GET['id_mod_trans']
                                                                    , $_GET['id_mod_trac'], $_GET['commodity']);
                  //$maClasse->selectionnerClientModeleLicence($modele['id_mod_trac']);
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">END</label>
            <select name="fin" onchange="" class="form-control cc-exp">
                <?php
                  $maClasse-> selectionnerDossierClientModeTransportModeLicence2($_GET['id_cli'], $_GET['id_mod_trans']
                                                                    , $_GET['id_mod_trac'], $_GET['commodity']);
                  //$maClasse->selectionnerClientModeleLicence($modele['id_mod_trac']);
                ?>
            </select>
          </div>

          <div class="col-md-12">
            <hr>
          </div>
          <?php
            $maClasse-> afficherRowUpdate($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans']);
          ?>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="updateMultipleFiles" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php
}
?>
