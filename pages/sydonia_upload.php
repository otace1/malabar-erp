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
          <h3><i class="fa fa-upload nav-icon"></i> UPLOAD DATA SYDONIA <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h3>
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


                    if(isset($_POST['uploadeEnregistrement'])){
                      
                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel-1.8/Classes/PHPExcel.php');
                      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=1; $row <= $highestRow ; $row++) { 
                          

                            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            $ref_decl = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $dgda_in = $worsheet-> getCellByColumnAndRow(2, $row)-> getFormattedValue();

                            $id_dos = $maClasse-> getDossierRefDos($ref_dos)['id_dos'];
                            //echo '<br> id_dos  = '.$id_dos;
                            if (isset($id_dos)) {
                              
                              if ($dgda_in != $maClasse->getDossier($id_dos)['dgda_in']) {
                                
                                $maClasse-> MAJ_dgda_in($id_dos, $dgda_in);
                                $maClasse-> MAJ_statut($id_dos, 'UNDER PROCESS AT CUSTOMS');

                              }

                              if ($dgda_in != $maClasse->getDossier($id_dos)['date_decl']) {
                                
                                $maClasse-> MAJ_date_decl($id_dos, $dgda_in);

                              }

                              if ($ref_decl != $maClasse->getDossier($id_dos)['ref_decl']) {
                                
                                $maClasse-> MAJ_ref_decl($id_dos, $ref_decl);

                              }

                            }


                        }
                      }

                    }

                    if(isset($_POST['uploadeLiquidation'])){
                      
                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel-1.8/Classes/PHPExcel.php');
                      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=1; $row <= $highestRow ; $row++) { 
                          

                            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            $ref_decl = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $dgda_in = $worsheet-> getCellByColumnAndRow(2, $row)-> getFormattedValue();
                            $ref_liq = $worsheet-> getCellByColumnAndRow(3, $row)-> getValue();
                            $date_liq = $worsheet-> getCellByColumnAndRow(4, $row)-> getFormattedValue();

                            $id_dos = $maClasse-> getDossierRefDos($ref_dos)['id_dos'];
                            //echo '<br> id_dos  = '.$id_dos;
                            if (isset($id_dos)) {
                               
                              if ($dgda_in != $maClasse->getDossier($id_dos)['dgda_in']) {
                                
                                $maClasse-> MAJ_dgda_in($id_dos, $dgda_in);

                              }

                              if ($dgda_in != $maClasse->getDossier($id_dos)['date_decl']) {
                                
                                $maClasse-> MAJ_date_decl($id_dos, $dgda_in);

                              }

                              if ($ref_decl != $maClasse->getDossier($id_dos)['ref_decl']) {
                                
                                $maClasse-> MAJ_ref_decl($id_dos, $ref_decl);

                              }

                              if ($ref_liq != $maClasse->getDossier($id_dos)['ref_liq']) {
                                
                                $maClasse-> MAJ_ref_liq($id_dos, $ref_liq);

                              }

                              if ($date_liq != $maClasse->getDossier($id_dos)['date_liq']) {
                                
                                $maClasse-> MAJ_date_liq($id_dos, $date_liq);
                                $maClasse-> MAJ_statut($id_dos, 'LIQUIDATED');

                              }

                            }


                        }
                      }

                    }


                    if(isset($_POST['uploadeQuittance'])){
                      
                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel-1.8/Classes/PHPExcel.php');
                      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=1; $row <= $highestRow ; $row++) { 
                          

                            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            $ref_decl = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $dgda_in = $worsheet-> getCellByColumnAndRow(2, $row)-> getFormattedValue();
                            $ref_liq = $worsheet-> getCellByColumnAndRow(3, $row)-> getValue();
                            $date_liq = $worsheet-> getCellByColumnAndRow(4, $row)-> getFormattedValue();
                            $ref_quit = $worsheet-> getCellByColumnAndRow(5, $row)-> getValue();
                            $date_quit = $worsheet-> getCellByColumnAndRow(6, $row)-> getFormattedValue();
                            $montant_liq = $worsheet-> getCellByColumnAndRow(7, $row)-> getValue();

                            $id_dos = $maClasse-> getDossierRefDos($ref_dos)['id_dos'];
                            //echo '<br> id_dos  = '.$id_dos;
                            if (isset($id_dos)) {
                               
                              if ($dgda_in != $maClasse->getDossier($id_dos)['dgda_in']) {
                                
                                $maClasse-> MAJ_dgda_in($id_dos, $dgda_in);
                                
                                if($maClasse->getDossier($id_dos)['id_mod_lic'] == '1'){
                                  $maClasse-> MAJ_statut($id_dos, 'AT DGDA');
                                }else if($maClasse->getDossier($id_dos)['id_mod_lic'] == '2'){
                                  $maClasse-> MAJ_statut($id_dos, 'UNDER PROCESS AT CUSTOMS');
                                }
                                

                              }

                              if ($dgda_in != $maClasse->getDossier($id_dos)['date_decl']) {
                                
                                $maClasse-> MAJ_date_decl($id_dos, $dgda_in);

                                if($maClasse->getDossier($id_dos)['id_mod_lic'] == '1'){
                                  $maClasse-> MAJ_statut($id_dos, 'AT DGDA');
                                }else if($maClasse->getDossier($id_dos)['id_mod_lic'] == '2'){
                                  $maClasse-> MAJ_statut($id_dos, 'UNDER PROCESS AT CUSTOMS');
                                }
                                

                              }

                              if ($ref_decl != $maClasse->getDossier($id_dos)['ref_decl']) {
                                
                                $maClasse-> MAJ_ref_decl($id_dos, $ref_decl);

                                if($maClasse->getDossier($id_dos)['id_mod_lic'] == '1'){
                                  $maClasse-> MAJ_statut($id_dos, 'AT DGDA');
                                }else if($maClasse->getDossier($id_dos)['id_mod_lic'] == '2'){
                                  $maClasse-> MAJ_statut($id_dos, 'UNDER PROCESS AT CUSTOMS');
                                }
                                

                              }

                              if ($ref_liq != $maClasse->getDossier($id_dos)['ref_liq']) {
                                
                                $maClasse-> MAJ_ref_liq($id_dos, $ref_liq);

                              }

                              if ($date_liq != $maClasse->getDossier($id_dos)['date_liq']) {
                                
                                $maClasse-> MAJ_date_liq($id_dos, $date_liq);
                                $maClasse-> MAJ_statut($id_dos, 'LIQUIDATED');

                              }

                              if ($ref_quit != $maClasse->getDossier($id_dos)['ref_quit']) {
                                
                                $maClasse-> MAJ_ref_quit($id_dos, $ref_quit);

                              }

                              if ($date_quit != $maClasse->getDossier($id_dos)['date_quit']) {
                                
                                $maClasse-> MAJ_date_quit($id_dos, $date_quit);

                                if ( ($maClasse->getDossier($id_dos)['id_mod_lic'] == 1) ) {
                                  $maClasse-> MAJ_dgda_out($id_dos, $date_quit);
                                }

                                if (($maClasse->getDossier($id_dos)['id_mod_lic'] == 1)) {

                                  if ($maClasse->getDossier($id_dos)['statut'] != 'GOVERNOR\'S OFFICE OUT') {
                                    $maClasse-> MAJ_statut($id_dos, 'DGDA OUT');
                                  }

                                  $maClasse-> MAJ_dgda_out($id_dos, $date_quit);
                                }else if (($maClasse->getDossier($id_dos)['id_mod_lic'] == 2)) {
                                  $maClasse-> MAJ_statut($id_dos, 'AWAITING BAE/BS');
                                }

                              }

                              if ($montant_liq > 1 && $montant_liq != $maClasse->getDossier($id_dos)['montant_liq']) {
                                
                                $maClasse-> MAJ_montant_liq($id_dos, $montant_liq);

                              }


                            }


                        }
                      }

                    }

                    if(isset($_POST['uploadeT1'])){
                      
                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel-1.8/Classes/PHPExcel.php');
                      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=1; $row <= $highestRow ; $row++) { 
                          

                            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            $t1 = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $t1_date = $worsheet-> getCellByColumnAndRow(2, $row)-> getFormattedValue();

                            $id_dos = $maClasse-> getDossierRefDos($ref_dos)['id_dos'];
                            //echo '<br> id_dos  = '.$id_dos;
                            if (isset($id_dos)) {
                               
                              if ($t1 != '' && $t1 != $maClasse->getDossier($id_dos)['t1']) {
                                
                                $maClasse-> MAJ_t1($id_dos, $t1);

                              }

                              if ($t1_date != '' && $t1_date != $maClasse->getDossier($id_dos)['t1_date']) {
                                
                                $maClasse-> MAJ_t1_date($id_dos, $t1_date);

                              }


                            }


                        }
                      }

                    }

                    
                    if(isset($_POST['debugDate'])){
                      
                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel-1.8/Classes/PHPExcel.php');
                      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=2; $row <= $highestRow ; $row++) { 
                          

                            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            $dgda_in = $worsheet-> getCellByColumnAndRow(1, $row)-> getFormattedValue();
                            $date_liq = $worsheet-> getCellByColumnAndRow(2, $row)-> getFormattedValue();
                            $date_quit = $worsheet-> getCellByColumnAndRow(3, $row)-> getFormattedValue();
                            $dgda_out = $worsheet-> getCellByColumnAndRow(4, $row)-> getFormattedValue();

                            $id_dos = $maClasse-> getDossierRefDos($ref_dos)['id_dos'];
                            echo '<br><br><br> ref_dos  = '.$ref_dos;
                            echo '<br> id_dos  = '.$id_dos;
                            echo '<br> dgda_in  = '.$dgda_in;
                            echo '<br> date_liq  = '.$date_liq;
                            echo '<br> date_quit  = '.$date_quit;
                            echo '<br> dgda_out  = '.$dgda_out;
                            if (isset($id_dos)) {
                               
                              $maClasse-> MAJ_dgda_in($id_dos, $dgda_in);
                              $maClasse-> MAJ_date_liq($id_dos, $date_liq);
                              $maClasse-> MAJ_date_quit($id_dos, $date_quit);
                              $maClasse-> MAJ_dgda_out($id_dos, $dgda_out);


                            }


                        }
                      }

                    }

                    
                  ?>
                <!-- <button class="btn bg-info square-btn-adjust" data-toggle="modal" data-target=".uploadeEnregistrement">
                    <i class="fa fa-upload"></i> Upload Enregistrement
                </button>
                <button class="btn bg-success square-btn-adjust" data-toggle="modal" data-target=".uploadeLiquidation">
                    <i class="fa fa-upload"></i> Upload Liquidation
                </button> -->
                <button class="btn bg-olive square-btn-adjust" data-toggle="modal" data-target=".uploadeQuittance">
                    <i class="fa fa-upload"></i> Upload IM4/EX1, Liquidation, Quittance File
                </button>
                <button class="btn bg-info square-btn-adjust" data-toggle="modal" data-target=".uploadeT1">
                    <i class="fa fa-upload"></i> Upload T1 File
                </button>
                <!-- <button class="btn bg-danger square-btn-adjust" data-toggle="modal" data-target=".debugDate">
                    <i class="fa fa-upload"></i> DEBUG DATE
                </button> -->
                </h3>
                  <div class="card-tools">

                  </div>
              </div>

            </div>
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

  <div class="modal fade uploadeEnregistrement" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">UPLOAD ENREGISTREMENT</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">FILE</label>
              <input type="file" name="fichier_dossier" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="uploadeEnregistrement" class="btn btn-primary">Valider</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade uploadeLiquidation" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">UPLOAD LIQUIDATION</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">FILE</label>
              <input type="file" name="fichier_dossier" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="uploadeLiquidation" class="btn btn-primary">Valider</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade uploadeQuittance" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">UPLOAD IM4/EX1, L, Q FILE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">FILE</label>
              <input type="file" name="fichier_dossier" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="uploadeQuittance" class="btn btn-primary">Valider</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade uploadeT1" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">UPLOAD T1 FILE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">FILE</label>
              <input type="file" name="fichier_dossier" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="uploadeT1" class="btn btn-primary">Valider</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade debugDate" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">DEBUG DATE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">FILE</label>
              <input type="file" name="fichier_dossier" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="debugDate" class="btn btn-primary">Valider</button>
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
