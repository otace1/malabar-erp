<?php
if(isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic'])
?>

<div class="modal fade nouvelleLicence" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Licence <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')';?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BANQUE</label>
            <select name="id_banq" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerBanque();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">NUMERO</label>
            <input type="text" name="num_lic" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUSCRIPTEUR</label>
            <select name="id_cli" id="id_cli_1" onchange="xajax_selectionnerFacturePourClientModele(this.value, <?php echo $_GET['id_mod_lic'];?>), xajax_afficherDetailFacture(ref_fact_systeme.value)" class="form-control cc-exp" required>
                <option></option>
                <?php
                    $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">POSTE D'ENTREE</label>
            <select name="id_post" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerPoste();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MONNAIE</label>
            <select name="id_mon" onchange="" class="form-control cc-exp" required>
                <?php
                  $maClasse->selectionnerMonnaie();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB DECLAREE</label>
            <input type="number" step="0.01" name="fob" class="form-control cc-exp" required>
          </div>

          <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
                
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
              <input type="number" min="0" step="0.01" name="assurance" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FRET</label>
              <input type="number" min="0" step="0.01" name="fret" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">AUTRES FRAIS</label>
              <input type="number" min="0" step="0.01" name="autre_frais" class="form-control cc-exp" required>
            </div>
            <?php
                }
              ?>

          <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FSI</label>
              <input type="text" name="fsi" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">AUR</label>
              <input type="text" name="aur" class="form-control cc-exp" required>
            </div>
            <?php
                }
              ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MODE TRANSPORT</label>
            <select name="id_mod_trans" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerModeTransport();
                ?>
            </select>
          </div>

          <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
                
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE SYSTEME</label>
              <select id="ref_fact_systeme" class="form-control cc-exp" onchange="xajax_afficherDetailFacture(this.value)">
                <option value=""></option>
                  <?php
                    //$maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_trac']);
                  ?>
              </select>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
              <span id="ref_fact"></span>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
              <span id="date_fact"></span>
            </div>

            <div class="col-md-3">
              <span id="lfichier_facture"></span>
              <span id="fichier_facture"></span>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
              <span id="fournisseur"></span>
            </div>
            <?php
                }
              ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE VALIDATION</label>
              <span id="date_val"></span>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE EXTREME VALIDATION</label>
            <input type="date" name="date_exp" min="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>
          
          <?php
            if(($modele['id_mod_lic'] == '1' || $modele['id_mod_lic'] == '2') && isset($modele)){
              ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MARCHANDISE</label>
            <select name="id_march" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerMarchandiseModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <input type="text" value="N/A" name="commodity">
          </div>
          <?php
              }
            ?>
          <?php
            if($modele['id_mod_lic'] == '1' && isset($modele)){
              ?>
              
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ACHETEUR</label>
            <input type="text" name="acheteur" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">QUANTITE DECLAREE (Kg)</label>
            <input type="number" step="0.01" name="qte_decl" class="form-control cc-exp" required>
          </div>
            <?php
                }
              ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FICHIER LICENCE</label>
            <input type="file" name="fichier_lic" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TYPE</label>
            <select name="id_type_lic" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerTypeLicence();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MODALITE PAIEMENT</label>
            <select name="id_mod_paie" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerModalitePaiement();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUS-TYPE PAIEMENT</label>
            <select name="id_sous_type_paie" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerSousTypePaiement($modele['id_mod_lic']);
                ?>
            </select>
          </div>

            <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
                
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">PROVENANCE</label>
              <input type="text" name="provenance" class="form-control cc-exp" required>
            </div>
            <?php
                }
              ?>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerLicence" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic'])
?>

<div class="modal fade creerFacture" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Facture <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')';?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUSCRIPTEUR</label>
            <select name="id_cli" onchange="" class="form-control cc-exp" required>
                <option></option>
                <?php
                    $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

          <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
                
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
              <input type="text" name="ref_fact" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
              <input type="date" name="date_fact" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">DATE RECEPTION FACTURE</label>
              <input type="date" name="date_fact_rec" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FICHIER FACTURE</label>
              <input type="file" name="fichier_fact" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
              <input type="text" name="fournisseur" class="form-control cc-exp" required>
            </div>
            <?php
                }
              ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE VALIDATION LICENCE</label>
            <input type="date" name="date_val" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>
          
          <?php
            if(($modele['id_mod_lic'] == '1' || $modele['id_mod_lic'] == '2') && isset($modele)){
              ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MARCHANDISE</label>
            <select name="id_march" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerMarchandiseModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>
          <?php
              }
            ?>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerFacture" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic'])
?>

<div class="modal fade creerAV" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle AV.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">LICENCE </label>
            <select name="num_lic" id="" class="form-control cc-exp" onchange="" required>
              <option value=""></option>
              <option value="UNDER VALUE">UNDER VALUE</option>
                <?php
                  $maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">COD BIV REF</label>
            <input type="text" name="cod" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE COD</label>
            <input type="date" name="date_av" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">MONTANT AV</label>
            <input type="number" step="0.01" min="0" name="montant_av" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">MONNAIE</label>
            <select name="id_mon" onchange="" class="form-control cc-exp" required>
                <?php
                  $maClasse->selectionnerMonnaie();
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">FXI REF</label>
            <input type="text" name="fix" class="form-control cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">FICHIER AV</label>
            <input type="file" name="fichier_av" class="form-control cc-exp">
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

<?php
}
?>



<?php
if(isset($_GET['id_mod_trac']) && isset($_GET['id_march'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  $marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade nouveauDossier" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouveau dossier <?php echo $marchandise['nom_march'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" id="id_cli" onchange="xajax_selectionnerLicencePourClientModele(this.value, <?php echo $_GET['id_mod_trac'];?>),xajax_afficherRefDos(this.value, <?php echo $_GET['id_mod_trans'];?>, <?php echo $_GET['id_march'];?>), xajax_afficherFobMaxLicence(num_lic.value),xajax_selectionnerAVPourLicence(num_lic.value),xajax_afficherMaskAV(av.value)" class="form-control cc-exp" required>
                <option></option>
                <?php
                    $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MCA FILE NUMBER</label>
            <span id="ref_dos"></span>
          </div>
    
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
            <input type="text" name="ref_fact" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
            <input type="date" name="date_fact" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">LICENCE </label>
            <select name="num_lic" id="num_lic" class="form-control cc-exp" onchange="xajax_afficherFobMaxLicence(this.value),xajax_selectionnerAVPourLicence(this.value),xajax_afficherMaskAV(av.value)" required>
              <option value=""></option>
                <?php
                  //$maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_trac']);
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BALANCE LICENCE</label>
            <span id="balance_fob"></span>
          </div>
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB DECLAREE</label>
            <span id="fob"></span>
          </div>
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AV LICENCE</label>
            <select name="ref_av" id="av" class="form-control cc-exp" onchange="xajax_afficherMaskAV(this.value)" required>
              <option value=""></option>
                <?php
                  //$maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_trac']);
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AV AVEC MASK</label>
            <span id="cod_dos_1"></span>
          </div>
 
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

<?php
}
?>

<?php
if(isset($_GET['id_mod_trac']) && isset($_GET['id_march'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  $marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient1" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage <?php echo $marchandise['nom_march'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient1" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_trac']) && isset($_GET['id_cli'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  $client = $maClasse-> getElementClient($_GET['id_cli']);
?>

<div class="modal fade rechercheClientLicence" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage <?php echo $client['nom_cli'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">LICENCE</label>
            <input type="text" id="txtCountry" name="num_lic" autocomplete="off" class="form-control cc-exp" required>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClientLicence" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">TYPE</label>
            <select name="id_type_lic" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerTypeLicence();
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade appurement" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Appurement Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">LICENCE</label>
            <select name="num_lic" onchange="" class="form-control cc-exp">
              <option value=''></option>
                <?php
                  if(!isset($_GET['id_cli']) || ($_GET['id_cli'] == '')){
                    $_GET['id_cli'] = null;
                  }
                  if(!isset($_GET['id_type_lic']) || ($_GET['id_type_lic'] == '')){
                    $_GET['id_type_lic'] = null;
                  }
                  
                  $maClasse->selectionnerLicenceModele2($modele['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
                  
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="appurement" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade creerManipulationAv" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Appurement Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">LICENCE</label>
            <select name="num_lic" onchange="" class="form-control cc-exp">
              <option value=''></option>
                <?php
                  if(!isset($_GET['id_cli']) || ($_GET['id_cli'] == '')){
                    $_GET['id_cli'] = null;
                  }
                  if(!isset($_GET['id_type_lic']) || ($_GET['id_type_lic'] == '')){
                    $_GET['id_type_lic'] = null;
                  }
                  
                  $maClasse->selectionnerLicenceModele2($modele['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
                  
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerManipulationAv" class="btn btn-primary">Valider</button>
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


<?php
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

  <div class="modal fade uploadeFichierLicence" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="licence_upload.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">UPLOADE LICENCE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">CLIENT SYSTEME</label>
              <select name="id_cli" onchange="" class="form-control cc-exp">
                <option></option>
                  <?php
                    $maClasse->selectionnerClient();
                  ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">NOUVEAU CLIENT</label>
              <input type="text" name="new_client" class="form-control cc-exp">
            </div>

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">FICHIER</label>
              <input type="file" name="fichier_licence" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="uploadeFichierLicence" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_trac']) && isset($_GET['id_mod_trac'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

  <div class="modal fade uploadeFichierDossier" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="dossier_upload.php?id_mod_trac=<?php echo $_GET['id_mod_trac'];?>" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">UPLOADE DOSSIER</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">CLIENT SYSTEME</label>
              <select name="id_cli" onchange="" class="form-control cc-exp">
                <option></option>
                  <?php
                    $maClasse->selectionnerClient();
                  ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">FICHIER</label>
              <input type="file" name="fichier_dossier" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="uploadeFichierDossier" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_trac']) && isset($_GET['id_mod_trac'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

  <div class="modal fade uploadeFichierDossier2" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="dossier_upload2.php?id_mod_trac=<?php echo $_GET['id_mod_trac'];?>" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">UPLOADE DOSSIER</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">CLIENT SYSTEME</label>
              <select name="id_cli" onchange="" class="form-control cc-exp">
                <option></option>
                  <?php
                    $maClasse->selectionnerClient();
                  ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">FICHIER</label>
              <input type="file" name="fichier_dossier" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="uploadeFichierDossier2" class="btn btn-primary">Valider</button>
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
