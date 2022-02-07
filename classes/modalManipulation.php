
<div class="modal fade manipulation_<?php echo $reponse['num_lic'];?>" id="modal-xl">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="num_lic_<?php echo $compteur;?>" value="<?php echo $reponse['num_lic'];?>">
    <div class="modal-content">
      <div class="modal-header <?php echo $bg;?>">
        <h4 class="modal-title"><i class="fa fa-indent"></i> MANIPULATION LICENCE <input type="text" value="<?php echo $reponse['num_lic'];?>" disabled="disabled" style="width: 25em; color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">DATE VALIDATION</label>
            <input type="text" value="<?php echo $reponse['date_val'];?>" disabled="disabled" style="text-align: center; color: white; background-color: black;" class="form-control cc-exp">
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">DATE EXTREME VAL.</label>
            <input type="text" value="<?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?>" disabled="disabled" style="text-align: center; color: white; background-color: black;" class="form-control cc-exp">
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">MONNAIE</label>
            <input type="text" value="<?php echo $reponse['sig_mon'];?>" disabled="disabled" style="text-align: center; color: white; background-color: black;" class="form-control cc-exp">
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">FOB</label>
            <input type="text" value="<?php echo number_format($reponse['fob'], 2, ',', ' ');?>" disabled="disabled" style="text-align: center; color: white; background-color: black;" class="form-control cc-exp">
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">BALANCE</label>
            <input type="text" value="<?php //echo $reponse['num_lic'];?>" disabled="disabled" style="text-align: center; color: white; background-color: black;" class="form-control cc-exp">
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">ETAT</label>
            <input type="text" value="<?php //echo $reponse['num_lic'];?>" disabled="disabled" style="text-align: center; color: white; background-color: black;" class="form-control cc-exp">
          </div>

          <div class="col-md-12"><hr></div>

          <!--<div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">MCA FILE REF</label>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">N.COD</label>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">FXI</label>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">MONTANT AV</label>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">FOB FACTURE</label>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">ETAT</label>
          </div>-->
          <?php
            $this-> manipulationLicence($reponse['num_lic'], $compteur);
           ?>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="update" class="btn btn-primary">Valider</button>
      </div>
    </div>
    <input type="hidden" name="debut" value="<?php echo $compteur;?>">
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
