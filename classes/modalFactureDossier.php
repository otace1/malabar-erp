
<div class="modal fade facture_<?php echo $reponse['id_dos'];?>" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_dos" value="<?php echo $reponse['id_dos'];?>">
      <input type="hidden" name="ref_dos" value="<?php echo $reponse['ref_dos'];?>">
      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
    <div class="modal-content">
      <div class="modal-header btn-secondary">
        <h4 class="modal-title"><i class="fa fa-calculator"></i> Facturer Dossier  </h4>
        
      </div>
      <div class="modal-body">
        <div class="row">


          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">NUMERO DOSSIER</label>
            <input type="text" name="ref_dos" value="<?php echo $reponse['ref_dos'];?>" class="form-control cc-exp bg-dark" required disabled>
          </div>
          
          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">NUMERO FACTURE</label>
            <!-- <input type="text" value="<?php echo $this-> buildRefFactureGlobale($_GET['id_cli']);?>" class="form-control cc-exp bg-dark"  required> -->
            <input type="text" name="ref_fact" value="<?php echo $this-> buildRefFactureGlobale($_GET['id_cli']);?>" class="form-control cc-exp bg-dark" required>
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
