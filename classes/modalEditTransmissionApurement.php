<?php

?>
<div class="modal fade editTransmission_<?php echo $reponse['id_trans_ap'];?>" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_trans_ap" value="<?php echo $reponse['id_trans_ap'];?>">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-upload"></i>Transmission Apurement <input type="text" value="<?php echo $reponse['ref_trans_ap'];?>" disabled="disabled" style="color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">ACCUSEE DE RECEPTION</label>
            <input type="file" name="fichier_trans_ap" class="form-control cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="modifierTransmissionApurement" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
