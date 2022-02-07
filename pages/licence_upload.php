<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
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
          <h3><i class="far fa-eye nav-icon"></i> UPLOAD FICHIER LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h3>
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


                    if(isset($_POST['deleteLicenceIBFromUploade'])){
                      $maClasse-> deleteLicenceUpload($_GET['id_mod_lic'], $_SESSION['id_util']);
                    }
                    if(isset($_POST['uploadeFichierLicence'])){

                      $fichier_pointage = $_FILES['fichier_licence']['tmp_name'];

                      require('../PHPExcel/Classes/PHPExcel.php');
                      require_once('../PHPExcel/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=2; $row <= $highestRow ; $row++) { 
                          
                          $fournisseur = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                          if (isset($fournisseur)) {

                            if (isset($_POST['id_cli']) && ($_POST['id_cli'] |= '')) {
                              $client = $_POST['id_cli'];
                            }else{
                              $client = $_POST['new_client'];
                              if ( ($maClasse-> verifierClient($client) == false)) {
                                $maClasse-> creerClient($client);
                                $client = $maClasse-> getIdClient($client);
                                $maClasse-> creerAffectationLicenceModeleLicence($client, 2);
                              }else{
                                $client = $maClasse-> getIdClient($client);
                              }
                            }
                            $commodity = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $po = $worsheet-> getCellByColumnAndRow(2, $row)-> getValue();
                            $facture = $worsheet-> getCellByColumnAndRow(3, $row)-> getValue();
                            //$ = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $num_licence = $worsheet-> getCellByColumnAndRow(4, $row)-> getValue();
                            if (!isset($num_licence) || ($num_licence=='')) {
                              $num_licence = 'LIC-'.rand(1, 300).'-'.rand(301, 500);
                            }
                            $monnaie = $worsheet-> getCellByColumnAndRow(5, $row)-> getValue();
                            if ( ($maClasse-> getIdMonnaie($monnaie) == false)) {
                              $maClasse-> creerMonnaie($monnaie);
                              $monnaie = $maClasse-> getIdMonnaie($monnaie);
                            }else{
                              $monnaie = $maClasse-> getIdMonnaie($monnaie);
                            }
                            $fob = $worsheet-> getCellByColumnAndRow(6, $row)-> getValue();
                            $fret = $worsheet-> getCellByColumnAndRow(7, $row)-> getValue();
                            $assurance = $worsheet-> getCellByColumnAndRow(8, $row)-> getValue();
                            $autre_frais = $worsheet-> getCellByColumnAndRow(9, $row)-> getValue();
                            $fsi = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $aur = $worsheet-> getCellByColumnAndRow(11, $row)-> getValue();
                            $validation = $worsheet-> getCellByColumnAndRow(12, $row)-> getFormattedValue();
                            $extreme = $worsheet-> getCellByColumnAndRow(13, $row)-> getFormattedValue();
                            /*$ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();*/

                            /*echo $client.' - '.$fournisseur.' - '.$commodity.' - '.$po.' - '.$facture.' - '.$num_licence.' - '.$monnaie.' - '.$fob.' - '.$fret.' - '.$assurance.' - '.$autre_frais.' - '.$aur.' - '.$validation.' - '.$extreme.'<br>';*/
                            $maClasse-> creerLicenceIBUpload($client, $fournisseur, $commodity, $po, $facture, 
                                                            $num_licence, $monnaie, $fob, $fret, 
                                                            $assurance, $autre_frais, $fsi, $aur, 
                                                            $validation, $_SESSION['id_util'], $_GET['id_mod_lic'], $extreme);

                          }

                          //$periode_agent = $maClasse-> getElementPeriodeAgent($_POST['id_per'], $id_ag);

                          //$maClasse-> MAJPeriodeAgent($_POST['id_per'], $periode_agent['id_ag_bar'], $jour, $nuit, $maladie, $cc, $a_mp, $h_sup_130, $h_sup_160, $jour_f, $nuit_f);

                        }
                      }

                      /*$maClasse-> uploadeFichierPointage($_POST['id_per'], $_POST['id_ag_bar'], $_POST['jour'], $_POST['nuit'], $_POST['maladie'], $_POST['cc'], $_POST['a_mp'], $_POST['h_sup_130'], $_POST['h_sup_160'], $_POST['jour_f'], $_POST['nuit_f']);*/
                    }


                    if(isset($_POST['creerLicenceIBFromUploade'])){

                      if($_GET['id_mod_lic']){
                            $maClasse-> creerLicenceIBFromUploade($_SESSION['id_util'], $_GET['id_mod_lic']);
                        }

                      }

                    
                  ?>
                <button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierLicence">
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
                    <th>FOURNISSEUR</th>
                    <th>COMMODITY</th>
                    <th>N.PO</th>
                    <th>FACTURE</th>
                    <th>LICENCE</th>
                    <th>MONNAIE</th>
                    <th>FOB</th>
                    <th>FRET</th>
                    <th>ASSURANCE</th>
                    <th>AUTRES FRAIS</th>
                    <th>FSI</th>
                    <th>AUR</th>
                    <th>VALIDATION</th>
                    <th>EXTREME VALIDITE</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php
                      $maClasse-> afficherLicenceUpload($_GET['id_mod_lic'], $_SESSION['id_util']);
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                <form method="POST" action="">
                  <button class="btn btn-success" name="creerLicenceIBFromUploade">
                    Valider Tout
                  </button>
                  <button class="btn btn-danger" name="deleteLicenceIBFromUploade">
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
