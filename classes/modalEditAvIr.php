
<div class="modal fade editAvIr_<?php echo str_replace('-', '_', str_replace(' ', '_', $reponse['ref_crf']));?>" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="ref_crf" value="<?php echo $reponse['ref_crf'];?>">
    <div class="modal-content">
      <div class="modal-header btn-success">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Création Attestation de Verification </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Rapport Inspection</label>
            <input type="text" disabled value="<?php echo $reponse['ref_crf'];?>" class="form-control cc-exp bg-dark" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Ref. AV</label>
            <input type="text" name="cod" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date AV</label>
            <input type="date" name="date_av" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Montant AV</label>
            <input type="number" name="montant_av" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Monnaie</label>
            <select name="id_mon" onchange="" class="form-control cc-exp" required>
              <option></option>
                <?php
                  $this->selectionnerMonnaie();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Num. Licence</label>
            <input type="text" name="num_lic" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FXI</label>
            <input type="text" name="fxi" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FICHIER</label>
            <input type="file" name="fichier_av" class="form-control cc-exp" required>
          </div>
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
