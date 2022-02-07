
<div class="card" id="">
  <div class="card-body">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouveau dossier .</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" id="id_cli" onchange="xajax_selectionnerLicencePourClientModele(this.value, <?php echo $_GET['id_mod_trac'];?>),xajax_afficherRefDos(this.value, <?php echo $_GET['id_mod_trans'];?>, <?php echo $_GET['id_march'];?>), xajax_afficherFobMaxLicence(num_lic.value),xajax_selectionnerAVPourLicence(num_lic.value),xajax_afficherMaskAV(av.value)" class="form-control cc-exp" required>
                <option value="<?php echo $_GET['id_cli'];?>"><?php echo $maClasse-> getNomClient($_GET['id_cli']);?></option>
                <?php
                    //$maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MCA FILE NUMBER</label>
            <input type="text" name="ref_dos" value="<?php echo $maClasse-> getMcaFile($_GET['id_cli'], $_GET['id_mod_trans']);?>" class="form-control cc-exp" required>
          </div>
    
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
            <input type="text" name="ref_fact" class="form-control cc-exp" required>
          </div>

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
            <input type="date"  onchange="is_weekend(this.value);" name="date_fact" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>-->

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">LICENCE </label>
            <input type="text" id="txtCountry" name="num_lic" autocomplete="off" class="form-control cc-exp" required>
            <!--<select name="num_lic" id="num_lic" class="form-control cc-exp" onchange="xajax_afficherFobMaxLicence(this.value),xajax_selectionnerAVPourLicence(this.value),xajax_afficherMaskAV(av.value)" required>
              <option></option>
              <option value="UNDER VALUE">UNDER VALUE</option>
                <?php
                  $maClasse->selectionnerLicenceEnCoursModeleClient($_GET['id_mod_trac'], $_GET['id_cli']);
                ?>
            </select>-->
          </div>

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BALANCE LICENCE</label>
            <span id="balance_fob"></span>
          </div>-->
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
            <!--<span id="fob"></span>-->
            <input type="text" name="supplier" class="form-control cc-exp">
          </div>
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB DECLAREE</label>
            <!--<span id="fob"></span>-->
            <input type="number" min="0" step="0.001" name="fob" class="form-control cc-exp">
          </div>
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FRET</label>
            <!--<span id="fret"></span>-->
            <input type="number" min="0" step="0.001" name="fret" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
            <!--<span id="assurance"></span>-->
            <input type="number" min="0" step="0.001" name="assurance" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AUTRE FRAIS</label>
            <!--<span id="autre_frais"></span>-->
            <input type="number" min="0" step="0.001" name="autre_frais" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">WEIGHT</label>
            <input type="number" min="0" step="0.001" name="poids" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">PO REF</label>
            <input type="text" name="po_ref" class="form-control cc-exp">
          </div>

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AV LICENCE</label>
            <select name="ref_av" id="av" class="form-control cc-exp" onchange="xajax_afficherMaskAV(this.value)" >
              <option value=""></option>
                <?php
                  //$maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_trac']);
                ?>
            </select>
          </div>-->

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AV AVEC MASK</label>
            <span id="cod_dos_1"></span>
          </div>-->
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CRF REF</label>
            <input type="text" name="cod" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CRF RECEIVED DATE</label>
            <input type="date"  onchange="is_weekend(this.value);" name="date_crf" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">PRE-ALERT DATE</label>
            <input type="date" id="date_new" onchange="is_weekend(this.value);" name="date_preal" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">T1</label>
            <input type="text" name="t1" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <input type="text" name="commodity" class="form-control cc-exp">
          </div>
          <?php
          if($_GET['id_mod_trans'] == '1'){
            ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ROAD MANIF</label>
            <input type="text" name="road_manif" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">HORSE</label>
            <input type="text" name="horse" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TRAILER 1</label>
            <input type="text" name="trailer_1" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TRAILER 2/CONTAINER</label>
            <input type="text" name="trailer_2" class="form-control cc-exp">
          </div>

            <?php
          }else{
            ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AWB NUM.</label>
            <input type="text" name="horse" class="form-control cc-exp">
          </div>
          <input type="hidden" name="trailer_1" value="N/A">
          <input type="hidden" name="trailer_2" value="N/A">
          <input type="hidden" name="road_manif" value="N/A">
            <?php
          }
          ?>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerDossier" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
