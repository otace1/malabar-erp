<?php
if(isset($_GET['id_mod_trac']) && $_GET['id_mod_trac'] == 1){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  if ($_GET['id_cli'] == '874') {
    ?>

<div class="modal fade nouveauDossierExport" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Export File(s).</h4>
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

          <div class="col-md-12"><hr></div>
          <div class="col-md-12">
            
            <div class="card-body table-responsive p-0">
                <table id="user_data_2" cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_1">
                        #
                      </th>
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_6">
                        MCA File REF
                      </th>
                      <th style="border: 1px solid white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Licence Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th style="border: 1px solid white;">Loading Date</th>
                      <th style="border: 1px solid white;">Site Of Loading</th>
                      <th style="border: 1px solid white;">Destination</th>
                      <th style="border: 1px solid white;">Horse</th>
                      <th style="border: 1px solid white;">Trailer 1</th>
                      <th style="border: 1px solid white;">Trailer 2</th>
                      <th style="border: 1px solid white;">Nbre Bags</th>
                      <th style="border: 1px solid white;">Weight</th>
                      <th style="border: 1px solid white;">Lot Num</th>
                      <th style="border: 1px solid white;">Shipment Num.</th>
                      <th style="border: 1px solid white;">Barge</th>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                      $maClasse-> afficherCelluleTableauNewExportAMC($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_march'], $_GET['num_lic']);
                    ?>
                    </form>
                  </tbody>
                </table>
              </div>

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
  }else{
?>

<div class="modal fade nouveauDossierExport" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Export File(s).</h4>
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

          <div class="col-md-12"><hr></div>
          <div class="col-md-12">
            
            <div class="card-body table-responsive p-0">
                <table id="user_data_2" cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_1">
                        #
                      </th>
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_6">
                        MCA File REF
                      </th>
                      <th style="border: 1px solid white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Licence Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th style="border: 1px solid white;">Loading Date</th>
                      <th style="border: 1px solid white;">Site Of Loading</th>
                      <th style="border: 1px solid white;">Destination</th>
                      <?php
                      if($_GET['id_mod_trans'] == '4'){
                        ?>
                      <th style="border: 1px solid white;">WAGON</th>
                        <?php
                      }else{
                        ?>
                      <th style="border: 1px solid white;">Horse</th>
                      <th style="border: 1px solid white;">Trailer 1</th>
                      <th style="border: 1px solid white;">Trailer 2</th>
                        <?php
                      }
                      ?>
                      <th style="border: 1px solid white;">Nbre Bags</th>
                      <th style="border: 1px solid white;">Weight</th>
                      <th style="border: 1px solid white;">Lot Num</th>
                      <th style="border: 1px solid white;">Seal DGDA</th>
                      <?php
                      if($_GET['id_mod_trans'] != '4'){
                        ?>
                      <th style="border: 1px solid white;">Transporter</th>
                        <?php
                      }
                      ?>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                      $maClasse-> afficherCelluleTableauNewExport($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_march'], $_GET['num_lic']);
                    ?>
                    </form>
                  </tbody>
                </table>
              </div>

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
}
?>
