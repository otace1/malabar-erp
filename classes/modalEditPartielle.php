
  <div class="modal fade editPartielle_<?php echo $reponse['id_part'];?>" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modification Partielle</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <input type="hidden" name="id_part" value="<?php echo $reponse['id_part'];?>">

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">Num.Partielle</label>
              <input type="text" value="<?php echo $reponse['num_part'];?>" class="form-control form-control-sm bg-dark cc-exp" disabled>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">FOB</label>
              <input type="number" step="0.01" min="0" max="<?php echo $this-> getLicence($_GET['num_lic'])['fob']-$this-> getPartielleCOD($_GET['cod'])['fob']+$reponse['fob_part'];?>" name="fob" value="<?php echo $reponse['fob_part'];?>" class="form-control form-control-sm cc-exp" required>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">Poids</label>
              <input type="number" step="0.01" min="0" name="poids" value="<?php echo $reponse['poids_part'];?>" class="form-control form-control-sm cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Annuler</button>
          <button type="submit" name="editPartielle" class="btn btn-primary btn-xs">Valider</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
