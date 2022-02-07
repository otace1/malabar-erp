
<div class="">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_dos" value="<?php echo $_GET['id_dos'];?>">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit File <input type="text" value="<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>" disabled="disabled" style="width: 25em; color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.replace('dossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?><?php echo $page;?>','pop1','width=80,height=80');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MCA FILE REF.</label>
            <input type="text" name="ref_dos" value="<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>" class="form-control cc-exp" required>
          </div>

          <?php

          /*if (($_GET['id_cli']!=869) && ($_GET['id_mod_trac']==2)) {
            ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FOB</label>
              <input type="number" name="fob" step="0.0001" class="form-control cc-exp" value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['fob'];?>" required>
            </div>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FRET</label>
              <input type="number" name="fret" step="0.0001" class="form-control cc-exp" value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['fret'];?>" required>
            </div>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
              <input type="number" name="assurance" step="0.0001" class="form-control cc-exp" value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['assurance'];?>" required>
            </div>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">AUTRES FRAIS</label>
              <input type="number" name="autre_frais" step="0.0001" class="form-control cc-exp" value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['autre_frais'];?>" required>
            </div>
            <?php
          }*/
          ?>

          <?php
            if ($maClasse-> verifierSouscriptionLicence($_GET['id_cli'], $_GET['id_mod_trac'])==true && (($_GET['id_cli']!=869) && ($_GET['id_mod_trac']==2))) {
              ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">LICENCE </label>
            <!-- <input type="text" id="txtCountry" name="num_lic" autocomplete="off" class="form-control cc-exp" required> -->
            <select name="num_lic" id="num_lic" class="form-control cc-exp" onchange="xajax_afficherFobMaxLicence(this.value),xajax_selectionnerAVPourLicence(this.value),xajax_afficherMaskAV(av.value)" required>
              <option value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['num_lic'];?>"><?php echo $maClasse-> getDataDossier($_GET['id_dos'])['num_lic'];?></option>
              <option value="UNDER VALUE">UNDER VALUE</option>
                <?php
                  $maClasse->selectionnerLicenceEnCoursModeleClient($_GET['id_mod_trac'], $_GET['id_cli']);
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BALANCE LICENCE</label>
            <span id="balance_fob"></span>
          </div>
 
          <input type="hidden" name="supplier" value="" class="form-control cc-exp">
          <!-- <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
            
            <input type="text" name="supplier" class="form-control cc-exp">
          </div> -->
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB DECLAREE</label>
            <span id="fob"></span>
            <!-- <input type="number" min="0" step="0.001" name="fob" class="form-control cc-exp"> -->
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
            <label for="x_card_code" class="control-label mb-1">BALANCE WEIGHT</label>
            <span id="balance_poids"></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">WEIGHT</label>
            <span id="poids"></span>
          </div>

              <?php
            }else{
              ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">LICENCE </label>
            <input type="text" id="txtCountry" name="num_lic" autocomplete="off" class="form-control cc-exp" required>
            <!-- <select name="num_lic" id="num_lic" class="form-control cc-exp" onchange="xajax_afficherFobMaxLicence(this.value),xajax_selectionnerAVPourLicence(this.value),xajax_afficherMaskAV(av.value)" required>
              <option></option>
              <option value="UNDER VALUE">UNDER VALUE</option>
                <?php
                  //$maClasse->selectionnerLicenceEnCoursModeleClient($_GET['id_mod_trac'], $_GET['id_cli']);
                ?>
            </select> -->
          </div>

          <!-- <input type="hidden" name="supplier" value="" class="form-control cc-exp"> -->
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
            
            <input type="text" name="supplier" class="form-control cc-exp">
          </div>
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB DECLAREE</label>
            <!-- <span id="fob"></span> -->
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

              <?php
            }
          ?>

          <?php
            $maClasse-> afficherRowDossierUpdate($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_dos']);
          ?>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" name="updateDossier" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
