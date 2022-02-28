<?php
$modele = $this-> getElementModeleLicence($_GET['id_mod_lic']);

if ($_GET['id_mod_lic'] == '1') {
?>
<div class="modal fade editLicence_<?php echo str_replace(' ', '_', $reponse['num_lic']);?>" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="num_lic_old" value="<?php echo $reponse['num_lic'];?>">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Modification Licence <input type="text" value="<?php echo $reponse['num_lic'];?>" disabled="disabled" style="width: 25em; color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">NUMERO LICENCE</label>
            <input type="text" name="num_lic" value="<?php echo $reponse['num_lic'];?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE VALIDATION</label>
            <input type="date" name="date_val" value="<?php echo $reponse['date_val2'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE EXTREME VAL.</label>
            <input type="date" name="date_exp" value="<?php echo $this-> getLastEpirationLicence2($reponse['num_lic']);?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ACHETEUR</label>
            <input type="text" name="acheteur" value="<?php echo $reponse['acheteur'];?>" class="form-control cc-exp" required>
          </div>
          <input type="hidden" name="commodity" value="">
          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <input type="text" name="commodity" value="<?php echo $reponse['commodity'];?>" class="form-control cc-exp" required>
          </div>-->
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TONNAGE</label>
            <input type="number" step="0.01" name="fob" value="<?php echo $reponse['fob'];?>" class="form-control cc-exp" required>
          </div>
          
          <input type="hidden" name="fret" value="0">
          <input type="hidden" name="assurance" value="0">
          <input type="hidden" name="autre_frais" value="0">

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FRET</label>
            <input type="number" step="0.01" name="fret" value="<?php echo $reponse['fret'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
            <input type="number" step="0.01" name="assurance" value="<?php echo $reponse['assurance'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AUTRE FRAIS</label>
            <input type="number" step="0.01" name="autre_frais" value="<?php echo $reponse['autre_frais'];?>" class="form-control cc-exp" required>
          </div>-->
          
          <input type="hidden" name="id_mon" value="1">
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">UNITE MEASURE</label>
            <select name="unit_mes" value="<?php echo $reponse['id_mon'];?>" onchange="" class="form-control cc-exp">
              <option value="<?php echo $reponse['id_mon'];?>">
                <?php echo $reponse['sig_mon'];?>
              </option>
              <option></option>
              <option value="Kg">Kg</option>
              <option value="T">T</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TYPE</label>
            <select name="id_type_lic" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $reponse['id_type_lic'];?>">
                <?php echo $reponse['nom_type_lic'];?>
              </option>
              <option></option>
                <?php
                  $this->selectionnerTypeLicence();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MODALITE PAIEMENT</label>
            <select name="id_mod_paie" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $this-> getLicenceModalitePaiement($reponse['num_lic'])['id_mod_paie'];?>">
                <?php echo $this-> getLicenceModalitePaiement($reponse['num_lic'])['nom_mod_paie'];?>
              </option>
              <option></option>
                <?php
                  $this->selectionnerModalitePaiement();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MODE DE TRANSPORT</label>
            <select name="id_mod_trans" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $reponse['id_mod_trans'];?>">
                <?php echo $this-> getNomModeTransport($reponse['id_mod_trans']);?>
              </option>
              <option></option>
                <?php
                  $this->selectionnerModeTransport();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FICHIER</label>
            <input type="file" name="fichier_lic" class="form-control cc-exp">
          </div>
          
          <input type="hidden" name="id_sous_type_paie" value="">
          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUS-TYPE PAIEMENT</label>
            <select name="id_sous_type_paie" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $this-> getLicenceSousTypeModePaiement($reponse['num_lic'])['id_sous_type_paie'];?>">
                <?php echo $this-> getLicenceSousTypeModePaiement($reponse['num_lic'])['nom_sous_type_paie'];?>
              </option>
              <option></option>
                <?php
                  $this->selectionnerSousTypePaiement($modele['id_mod_lic']);
                ?>
            </select>
          </div>-->

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FICHIER LICENCE</label>
            <input type="file" name="fichier_lic" class="form-control cc-exp">
          </div>-->

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="modifierLicence" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php
}if ($_GET['id_mod_lic'] == '2') {
?>
<div class="modal fade editLicence_<?php echo str_replace(' ', '_', $reponse['num_lic']);?>" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="num_lic_old" value="<?php echo $reponse['num_lic'];?>">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Modification Licence <input type="text" value="<?php echo $reponse['num_lic'];?>" disabled="disabled" style="width: 25em; color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">NUMERO LICENCE</label>
            <input type="text" name="num_lic" value="<?php echo $reponse['num_lic'];?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE VALIDATION</label>
            <input type="date" name="date_val" value="<?php echo $reponse['date_val2'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE EXTREME VAL.</label>
            <input type="date" name="date_exp" value="<?php echo $this-> getLastEpirationLicence2($reponse['num_lic']);?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">REF. COD</label>
            <input type="text" name="cod" value="<?php echo $reponse['cod'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
            <input type="text" name="fournisseur" value="<?php echo $reponse['fournisseur'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <input type="text" name="commodity" value="<?php echo $reponse['commodity'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">WEIGHT(KG)</label>
            <input type="number" step="0.01" name="poids" value="<?php echo $reponse['poids'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB</label>
            <input type="number" step="0.01" name="fob" value="<?php echo $reponse['fob'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FRET</label>
            <input type="number" step="0.01" name="fret" value="<?php echo $reponse['fret'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
            <input type="number" step="0.01" name="assurance" value="<?php echo $reponse['assurance'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AUTRE FRAIS</label>
            <input type="number" step="0.01" name="autre_frais" value="<?php echo $reponse['autre_frais'];?>" class="form-control cc-exp" required>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MONNAIE</label>
            <select name="id_mon" value="<?php echo $reponse['id_mon'];?>" onchange="" class="form-control cc-exp">
              <option value="<?php echo $reponse['id_mon'];?>"><?php echo $reponse['sig_mon'];?></option>
              <option></option>
                <?php
                  $this->selectionnerMonnaie();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TYPE</label>
            <select name="id_type_lic" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $reponse['id_type_lic'];?>">
                <?php echo $reponse['nom_type_lic'];?>
              </option>
              <option></option>
                <?php
                  $this->selectionnerTypeLicence();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MODALITE PAIEMENT</label>
            <select name="id_mod_paie" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $this-> getLicenceModalitePaiement($reponse['num_lic'])['id_mod_paie'];?>">
                <?php echo $this-> getLicenceModalitePaiement($reponse['num_lic'])['nom_mod_paie'];?>
              </option>
              <option></option>
                <?php
                  $this->selectionnerModalitePaiement();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUS-TYPE PAIEMENT</label>
            <select name="id_sous_type_paie" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $this-> getLicenceSousTypeModePaiement($reponse['num_lic'])['id_sous_type_paie'];?>">
                <?php echo $this-> getLicenceSousTypeModePaiement($reponse['num_lic'])['nom_sous_type_paie'];?>
              </option>
              <option></option>
                <?php
                  $this->selectionnerSousTypePaiement($modele['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MODE DE TRANSPORT</label>
            <select name="id_mod_trans" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $reponse['id_mod_trans'];?>">
                <?php echo $this-> getNomModeTransport($reponse['id_mod_trans']);?>
              </option>
              <option></option>
                <?php
                  $this->selectionnerModeTransport();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FICHIER</label>
            <input type="file" name="fichier_lic" class="form-control cc-exp">
          </div>
          
          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FICHIER LICENCE</label>
            <input type="file" name="fichier_lic" class="form-control cc-exp">
          </div>-->

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="modifierLicence" class="btn btn-primary">Valider</button>
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