<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='licence.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
    if( $id_cli > 0){
      $client = ' | '.$maClasse-> getNomClient($id_cli);
    }else{
      $client = '';
    }
  }
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | '.$maClasse-> getNomClient($_GET['id_cli']);
  }else{
    $client = '';
  }

  if( isset($_POST['appurement']) ){
    ?>
    <script type="text/javascript">
      window.open('appurement.php?num_lic=<?php echo $_POST['num_lic']; ?>','pop1','width=800,height=800');
    </script>
    <?php
  }

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="far fa-eye nav-icon"></i> UPLOAD DOSSIERS <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                  <?php


                    if(isset($_POST['deleteDossierIBFromUploade'])){
                      $maClasse-> deleteDossierEBUpload($_SESSION['id_util']);
                    }
                    if(isset($_POST['uploadeFichierDossier'])){

                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel/Classes/PHPExcel.php');
                      require_once('../PHPExcel/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=2; $row <= $highestRow ; $row++) { 
                          
                          $client = $_POST['id_cli'];
                          $id_mod_trans = $_POST['id_mod_trans'];

                            $item = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            $ref_dos = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $num_lic = $worsheet-> getCellByColumnAndRow(2, $row)-> getValue();
                            $date_exp = $worsheet-> getCellByColumnAndRow(3, $row)-> getFormattedValue();
                            $tonnage = $worsheet-> getCellByColumnAndRow(4, $row)-> getValue();
                            $ship_num = $worsheet-> getCellByColumnAndRow(5, $row)-> getValue();
                            $barge = $worsheet-> getCellByColumnAndRow(6, $row)-> getValue();
                            $horse = $worsheet-> getCellByColumnAndRow(7, $row)-> getValue();
                            $trailer_1 = $worsheet-> getCellByColumnAndRow(8, $row)-> getValue();
                            $trailer_2 = $worsheet-> getCellByColumnAndRow(9, $row)-> getValue();
                            $num_lot = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $nbr_bags = $worsheet-> getCellByColumnAndRow(11, $row)-> getValue();
                            $poids = $worsheet-> getCellByColumnAndRow(12, $row)-> getValue();
                            $kapulo_load = $worsheet-> getCellByColumnAndRow(13, $row)-> getFormattedValue();
                            $dispatch_pweto = $worsheet-> getCellByColumnAndRow(14, $row)-> getFormattedValue();
                            $arrival_pweto = $worsheet-> getCellByColumnAndRow(15, $row)-> getFormattedValue();
                            $barge_load = $worsheet-> getCellByColumnAndRow(16, $row)-> getFormattedValue();
                            $barge_dispatch_date = $worsheet-> getCellByColumnAndRow(17, $row)-> getFormattedValue();
                            $doc_receiv = $worsheet-> getCellByColumnAndRow(18, $row)-> getFormattedValue();
                            $nbre_seal = $worsheet-> getCellByColumnAndRow(19, $row)-> getValue();
                            $dgda_seal = $worsheet-> getCellByColumnAndRow(20, $row)-> getValue();
                            $remarque = $worsheet-> getCellByColumnAndRow(21, $row)-> getValue();
                            $transporter = $worsheet-> getCellByColumnAndRow(22, $row)-> getValue();
                            $load_date = $worsheet-> getCellByColumnAndRow(23, $row)-> getFormattedValue();
                            $pv_mine = $worsheet-> getCellByColumnAndRow(24, $row)-> getFormattedValue();
                            $demande_attestation = $worsheet-> getCellByColumnAndRow(25, $row)-> getFormattedValue();
                            $assay_date = $worsheet-> getCellByColumnAndRow(26, $row)-> getFormattedValue();
                            $ceec_in = $worsheet-> getCellByColumnAndRow(27, $row)-> getFormattedValue();
                            $ceec_out = $worsheet-> getCellByColumnAndRow(28, $row)-> getFormattedValue();
                            $min_div_in = $worsheet-> getCellByColumnAndRow(29, $row)-> getFormattedValue();
                            $min_div_out = $worsheet-> getCellByColumnAndRow(30, $row)-> getFormattedValue();
                            $date_decl = $worsheet-> getCellByColumnAndRow(31, $row)-> getFormattedValue();
                            $dgda_in = $worsheet-> getCellByColumnAndRow(32, $row)-> getFormattedValue();
                            $date_liq = $worsheet-> getCellByColumnAndRow(33, $row)-> getFormattedValue();
                            $date_quit = $worsheet-> getCellByColumnAndRow(34, $row)-> getFormattedValue();
                            $dgda_out = $worsheet-> getCellByColumnAndRow(35, $row)-> getFormattedValue();
                            $gov_in = $worsheet-> getCellByColumnAndRow(36, $row)-> getFormattedValue();
                            $gov_out = $worsheet-> getCellByColumnAndRow(37, $row)-> getFormattedValue();
                            $dispatch_date = $worsheet-> getCellByColumnAndRow(38, $row)-> getFormattedValue();
                            $klsa_arriv = $worsheet-> getCellByColumnAndRow(39, $row)-> getFormattedValue();
                            $end_form = $worsheet-> getCellByColumnAndRow(40, $row)-> getFormattedValue();
                            $exit_drc = $worsheet-> getCellByColumnAndRow(41, $row)-> getFormattedValue();
                            $cleared = $worsheet-> getCellByColumnAndRow(42, $row)-> getValue();
                            $statut = $worsheet-> getCellByColumnAndRow(43, $row)-> getValue();
                            $site_load = $worsheet-> getCellByColumnAndRow(44, $row)-> getValue();
                            $destination = $worsheet-> getCellByColumnAndRow(45, $row)-> getValue();
                            $ref_decl = $worsheet-> getCellByColumnAndRow(46, $row)-> getValue();
                            $ref_liq = $worsheet-> getCellByColumnAndRow(47, $row)-> getValue();
                            $ref_quit = $worsheet-> getCellByColumnAndRow(48, $row)-> getValue();
                            $impala_sncc = $worsheet-> getCellByColumnAndRow(49, $row)-> getFormattedValue();
                            $docs_sncc = $worsheet-> getCellByColumnAndRow(50, $row)-> getFormattedValue();
                            $sncc_sakania = $worsheet-> getCellByColumnAndRow(51, $row)-> getFormattedValue();
                            $sakania_date = $worsheet-> getCellByColumnAndRow(52, $row)-> getFormattedValue();

                            //echo 'Site '.$site_load.' - Destination '.$destination.'<br>------<br>';
                            /*echo $ref_dos.' - '.$num_lic.' - '.$date_exp.' - '.$tonnage.' - '.$ship_num.' - '.$barge.' - '.$horse.' - '.$trailer_1.' - '.$trailer_2.' - '.$num_lot.' - '.$nbr_bags.' - '.$poids.' - '.$kapulo_load.' - '.$dispatch_pweto.' - '.$arrival_pweto.' - '.$barge_load.' - '.$barge_dispatch_date.' - '.$doc_receiv.' - '.$nbre_seal.' - '.$dgda_seal.' - '.$remarque.' - '.$transporter.' - '.$load_date.' - '.$pv_mine.' - '.$demande_attestation.' - '.$assay_date.' - '.$ceec_in.' - '.$ceec_out.' - '.$min_div_in.' - '.$min_div_out.' - '.$date_decl.' - '.$dgda_in.' - '.$date_liq.' - '.$date_quit.' - '.$dgda_out.' - '.$gov_in.' - '.$gov_out.' - '.$dispatch_date.' - '.$klsa_arriv.' - '.$end_form.' - '.$exit_drc.' - '.$cleared.' - '.$statut.' - '.$site_load.' - '.$destination.' - '.$ref_decl.' - '.$ref_liq.' - '.$ref_quit.' - '.$impala_sncc.' - '.$docs_sncc.' - '.$sncc_sakania.' - '.$sakania_date.' - '.$client.'<br>---------------<br>';*/

                            $maClasse-> creerDossierIBUploadExport($ref_dos, $num_lic, $date_exp, $tonnage, $ship_num, $barge, $horse, $trailer_1, $trailer_2, $num_lot, $nbr_bags, $poids, $kapulo_load, $dispatch_pweto, $arrival_pweto, $barge_load, $barge_dispatch_date, $doc_receiv, $nbre_seal, $dgda_seal, $remarque, $transporter, $load_date, $pv_mine, $demande_attestation, $assay_date, $ceec_in, $ceec_out, $min_div_in, $min_div_out, $date_decl, $dgda_in, $date_liq, $date_quit, $dgda_out, $gov_in, $gov_out, $dispatch_date, $klsa_arriv, $end_form, $exit_drc, $cleared, $statut, $site_load, $destination, $ref_decl, $ref_liq, $ref_quit, $impala_sncc, $docs_sncc, $sncc_sakania, $sakania_date, $client, $_SESSION['id_util'], $id_mod_trans);

                            /*$maClasse-> creerLicenceIBUpload($client, $ref_dos, $num_lic, $cod, $fxi, 
                                                            $montant_av, $date_fact, $ref_fact, $fob, 
                                                            $fret, $assurance, $autre_frais, $ref_decl, 
                                                            $montant_decl, $_SESSION['id_util'], $_GET['id_mod_lic'], $ref_lic);*/

                          

                          //$periode_agent = $maClasse-> getElementPeriodeAgent($_POST['id_per'], $id_ag);

                          //$maClasse-> MAJPeriodeAgent($_POST['id_per'], $periode_agent['id_ag_bar'], $jour, $nuit, $maladie, $cc, $a_mp, $h_sup_130, $h_sup_160, $jour_f, $nuit_f);

                        }
                      }

                      /*$maClasse-> uploadeFichierPointage($_POST['id_per'], $_POST['id_ag_bar'], $_POST['jour'], $_POST['nuit'], $_POST['maladie'], $_POST['cc'], $_POST['a_mp'], $_POST['h_sup_130'], $_POST['h_sup_160'], $_POST['jour_f'], $_POST['nuit_f']);*/
                    }


                    if(isset($_POST['creerDossierEBFromUploade'])){

                      if($_GET['id_mod_trac']){
                            $maClasse-> creerDossierEBFromUploade($_SESSION['id_util']);
                        }

                      }

                    
                  ?>
                <button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierDossier">
                    <i class="fa fa-upload"></i> Uploade Fichier
                </button>
                </h3>
                  <div class="card-tools">

                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed table-dark table-bordered table-hover text-nowrap table-sm">

                  <thead>
                    <th>N.</th>
                    <th>MCA REF</th>
                    <th>LICENCE</th>
                    <th>EXPIRATION</th>
                    <th>Nb Tons Authorized</th>
                    <th>Shipment No</th>
                    <th>Barge</th>
                    <th>Horse</th>
                    <th>Trailer 1</th>
                    <th>Trailer 2</th>
                    <th>Lot Num</th>
                    <th>Nbre Bags</th>
                    <th>Weight</th>
                    <th>Kapulo Loading Date</th>
                    <th>Dispatch Pweto Date </th>
                    <th>Arrival Pweto Date </th>
                    <th>Barge/truck Loading Date</th>
                    <th>Barge/truck Dispatch Date</th>
                    <th>Docs Received Date</th>
                    <th>Nbr of Seals</th>
                    <th>DGDA Seals No</th>
                    <th>Remarks</th>
                    <th>Transporter</th>
                    <th>Loading Date</th>
                    <th>PV div Mines</th>
                    <th>Demande d'Attestation</th>
                    <th>Assay Date</th>
                    <th>CEEC In </th>
                    <th>CEEC Out</th>
                    <th>Mine Div In</th>
                    <th>Mine Div Out</th>
                    <th>Declaration date</th>
                    <th>DGDA In Date</th>
                    <th>date Liquidation</th>
                    <th>Date quittance</th>
                    <th>DGDA Out date</th>
                    <th>Gov Doc In </th>
                    <th>Gov Doc Out</th>
                    <th>Dispatch date</th>
                    <th>Klesa Arrival date</th>
                    <th>End of formalities</th>
                    <th>Exit DRC Date</th>
                    <th>Clearing Status</th>
                    <th>File Status</th>
                    <th>Site Of Loading</th>
                    <th>Destination</th>
                    <th>N°E</th>
                    <th>N°L</th>
                    <th>N°Q</th>
                    <th>Dispatch date IMPALA-SNCC</th>
                    <th>Docs Transmitted to SNCC</th>
                    <th>Dispatch Date SNCC-SAKANIA</th>
                    <th>Sakania Arrival Date</th>
                  </thead>
                  <tbody>
                    <?php
                      $maClasse-> afficherDossierUploadExport($_SESSION['id_util']);
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                <form method="POST" action="">
                  <button class="btn btn-success" name="creerDossierEBFromUploade">
                    Valider Tout
                  </button>
                  <button class="btn btn-danger" name="deleteDossierIBFromUploade">
                    Supprimer Tout
                  </button>
                </form>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>

<?php
if(isset($_GET['id_mod_trac']) && isset($_GET['id_mod_trac'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

  <div class="modal fade uploadeFichierDossier" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
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
              <label for="x_card_code" class="control-label mb-1">CLIENT</label>
              <select name="id_cli" onchange="" class="form-control cc-exp"required>
                <option></option>
                  <?php
                    $maClasse->selectionnerClientModeleLicence($_GET['id_mod_trac']);
                  ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">MODE TRANSPORT</label>
              <select name="id_mod_trans" onchange="" class="form-control cc-exp"required>
                <option></option>
                  <?php
                    $maClasse->selectionnerModeTransport();
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
