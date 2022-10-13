
  <div class="modal fade creerPartielle_<?php echo $reponse['ref_crf_dos'];?>" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nouvelle Partielle</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">COD</label>
              <input type="hidden" name="cod" value="<?php echo $reponse['cod'];?>">
              <input type="text" value="<?php echo $reponse['cod'];?>" class="form-control form-control-sm cc-exp bg bg-dark" disabled>
            </div>

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">CRF</label>
              <input type="text" value="<?php echo $reponse['ref_crf'];?>" class="form-control form-control-sm cc-exp bg bg-dark" disabled>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">Num.Partielle</label>
              <input type="text" name="num_part" class="form-control form-control-sm cc-exp" required>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">FOB</label>
              <input type="number" step="0.01" min="0" max="<?php echo $this-> getLicence($reponse['num_lic'])['fob']-$this-> getPartielleCOD($reponse['cod'])['fob'];?>" name="fob" class="form-control form-control-sm cc-exp" required>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">Poids</label>
              <input type="number" step="0.01" min="0" name="poids" class="form-control form-control-sm cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annuler</button>
          <button type="submit" name="creerPartielle" class="btn btn-primary btn-sm">Valider</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
