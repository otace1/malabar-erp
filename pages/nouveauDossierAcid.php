
<?php
if($_GET['id_cli'] == 869 && $_GET['id_mod_trac'] == 2){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
?>

<div class="modal fade nouveauDossierAcid" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Import Acid File(s).</h4>
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
                      <th style="border: 1px solid white;">T1 Ref.</th>
                      <th style="border: 1px solid white;">Weight</th>
                      <th style="border: 1px solid white;">Invoice</th>
                      <th style="border: 1px solid white;">Horse</th>
                      <th style="border: 1px solid white;">Trailer 1</th>
                      <th style="border: 1px solid white;">Trailer 2</th>
                      <th style="border: 1px solid white;">Arrival Date K'lesa</th>
                      <th style="border: 1px solid white;">Crossing Date</th>
                      <th style="border: 1px solid white;">Arrival Date Wiski</th>
                      <th style="border: 1px solid white;">Departure Wiski</th>
                      <th style="border: 1px solid white;">CRF Reference</th>
                      <th style="border: 1px solid white;">CRF Received Date</th>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                      $maClasse-> afficherCelluleTableauNewImportAcid($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_march'], $_GET['num_lic']);
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
?>
