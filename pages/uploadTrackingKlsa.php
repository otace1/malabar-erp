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
                      $maClasse-> deleteDossierUpload($_GET['id_mod_trac'], $_SESSION['id_util']);
                    }
                    if(isset($_POST['uploadeFichierDossier'])){

                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel/Classes/PHPExcel.php');
                      require_once('../PHPExcel/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=2; $row <= $highestRow ; $row++) { 
                          
                          $client = $_GET['id_cli'];
                          $num_lic = $_POST['num_lic'];
                          if (isset($num_lic)) {

                            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            if (!isset($ref_dos) || ($ref_dos=='')) {
                              $ref_dos = 'TBA-'.rand(1, 300).'-'.rand(301, 500);
                            }

                            $ref_dos = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $t1 = $worsheet-> getCellByColumnAndRow(2, $row)-> getValue();
                            //$ = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $poids = $worsheet-> getCellByColumnAndRow(3, $row)-> getValue();

                            $ref_fact = $worsheet-> getCellByColumnAndRow(4, $row)-> getFormattedValue();

                            $horse = $worsheet-> getCellByColumnAndRow(5, $row)-> getValue();
                            $trailer_1 = $worsheet-> getCellByColumnAndRow(6, $row)-> getValue();
                            $trailer_2 = $worsheet-> getCellByColumnAndRow(7, $row)-> getValue();
                            $transporteur = $worsheet-> getCellByColumnAndRow(8, $row)-> getValue();
                            $destination = $worsheet-> getCellByColumnAndRow(9, $row)-> getValue();
                            $arrival_date = $worsheet-> getCellByColumnAndRow(10, $row)-> getFormattedValue();
                            $crossing_date = $worsheet-> getCellByColumnAndRow(11, $row)-> getFormattedValue();
                            $wiski_arriv = $worsheet-> getCellByColumnAndRow(12, $row)-> getFormattedValue();
                            $wiski_dep = $worsheet-> getCellByColumnAndRow(13, $row)-> getFormattedValue();
                            $remarque = $worsheet-> getCellByColumnAndRow(14, $row)-> getValue();
                            /*$ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();*/

                            /*echo $client.' - '.$ref_dos.' - '.$num_lic.' - '.$cod.' - '.$fxi.' - '.$montant_av.' - '.$date_fact.' - '.$ref_fact.' - '.$fob.' - '.$fret.' - '.$assurance.' - '.$autre_frais.' - '.$ref_decl.' - '.$montant_decl.' - '.$ref_lic.' - '.$ref_quit.' - '.$date_quit.'<br>';*/
                            //echo ($row).' - '.$num_lic.'<br>';

                            $maClasse-> creerDossierIBUploadTrackingKlsa($client, $ref_dos, $num_lic, $t1, $poids, 
                                                              $ref_fact, $horse, $trailer_1, $trailer_2, $transporteur,$destination, $arrival_date, $crossing_date, 
                                                              $wiski_arriv, $wiski_dep, $remarque, 
                                                              $_SESSION['id_util'], $_GET['id_mod_trac'], 
                                                              $_POST['id_mod_trans']);

                            /*$maClasse-> creerLicenceIBUpload($client, $ref_dos, $num_lic, $cod, $fxi, 
                                                            $montant_av, $date_fact, $ref_fact, $fob, 
                                                            $fret, $assurance, $autre_frais, $ref_decl, 
                                                            $montant_decl, $_SESSION['id_util'], $_GET['id_mod_lic'], $ref_lic);*/

                          }

                          //$periode_agent = $maClasse-> getElementPeriodeAgent($_POST['id_per'], $id_ag);

                          //$maClasse-> MAJPeriodeAgent($_POST['id_per'], $periode_agent['id_ag_bar'], $jour, $nuit, $maladie, $cc, $a_mp, $h_sup_130, $h_sup_160, $jour_f, $nuit_f);

                        }
                      }

                      /*$maClasse-> uploadeFichierPointage($_POST['id_per'], $_POST['id_ag_bar'], $_POST['jour'], $_POST['nuit'], $_POST['maladie'], $_POST['cc'], $_POST['a_mp'], $_POST['h_sup_130'], $_POST['h_sup_160'], $_POST['jour_f'], $_POST['nuit_f']);*/
                    }


                    if(isset($_POST['creerDossierIBFromUploade'])){

                      if($_GET['id_mod_trac']){
                            $maClasse-> creerDossierIBFromUploadeTrackingKlsa($_SESSION['id_util'], $_GET['id_mod_trac']);
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
                    <th>T1</th>
                    <th>WEIGHT</th>
                    <th>INVOICE</th>
                    <th>HORSE</th>
                    <th>TRAILER 1</th>
                    <th>TRAILER 2</th>
                    <th>TRANSPORTER</th>
                    <th>DESTINATION</th>
                    <th>Arrival date K'lesa</th>
                    <th>CROSSING DATE</th>
                    <th>WISKI ARRIVAL DATE</th>
                    <th>WISKI DEPARTURE</th>
                    <th>COMMENT</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php
                      $maClasse-> afficherDossierUploadTrackingKlsa($_GET['id_mod_trac'], $_SESSION['id_util']);
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                <form method="POST" action="">
                  <button class="btn btn-success" name="creerDossierIBFromUploade">
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
              <label for="x_card_code" class="control-label mb-1">MODE TRANSPORT</label>
              <select name="id_mod_trans" onchange="" class="form-control cc-exp"required>
                <option></option>
                  <?php
                    $maClasse->selectionnerModeTransport();
                  ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="x_card_code" class="control-label mb-1">LICENCE</label>
              <select name="num_lic" onchange="" class="form-control cc-exp" required>
                <option></option>
                  <?php
                    $maClasse->selectionnerLicenceModeleClient($_GET['id_mod_trac'], $_GET['id_cli']);
                  ?>
              </select>
            </div>

            <div class="col-md-12">
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
