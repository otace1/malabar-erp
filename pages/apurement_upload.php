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
          <h3><i class="fa fa-upload nav-icon"></i> UPLOAD APUREMENT</h3>
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

                    if(isset($_POST['uploadeFichierDossier2'])){
                      
                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel-1.8/Classes/PHPExcel.php');
                      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

                      $tmp_ref_apure = '';
                      $tmp_date_apure = '';
                      $tmp_banque = '';

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);
                      $compteur = 0;
                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=1; $row <= $highestRow ; $row++) { 
                          
                            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            $fob = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $type_paie = $worsheet-> getCellByColumnAndRow(2, $row)-> getValue();
                            $montant_av = $worsheet-> getCellByColumnAndRow(3, $row)-> getValue();
                            $ref_av = $worsheet-> getCellByColumnAndRow(4, $row)-> getValue();
                            $ref_decl = $worsheet-> getCellByColumnAndRow(5, $row)-> getValue();
                            $road_manif = $worsheet-> getCellByColumnAndRow(6, $row)-> getValue();
                            $ref_apure = $worsheet-> getCellByColumnAndRow(7, $row)-> getValue();
                            $date_apure = $worsheet-> getCellByColumnAndRow(8, $row)-> getFormattedValue();
                            $banque = $worsheet-> getCellByColumnAndRow(9, $row)-> getValue();

                            if (!isset($banque) || ($banque=='')) {
                              $banque = 'OTHER';
                            }

                            //Traitement Declaration
                            $maClasse-> MAJ_ref_decl($maClasse-> getDossierRefDos($ref_dos)['id_dos'], $ref_decl);
                            $maClasse-> MAJ_montant_decl($maClasse-> getDossierRefDos($ref_dos)['id_dos'], $fob);

                            //Traitement FOB
                            $maClasse-> MAJ_fob($maClasse-> getDossierRefDos($ref_dos)['id_dos'], $fob);

                            //Traitement AV
                            $maClasse-> MAJ_ref_av($maClasse-> getDossierRefDos($ref_dos)['id_dos'], $ref_av);
                            $maClasse-> MAJ_montant_av($maClasse-> getDossierRefDos($ref_dos)['id_dos'], $montant_av);

                            //Traitement Road Manifest/BL/LTA
                            $maClasse-> MAJ_road_manif($maClasse-> getDossierRefDos($ref_dos)['id_dos'], $road_manif);
                            $maClasse-> MAJ_bl($maClasse-> getDossierRefDos($ref_dos)['id_dos'], $road_manif);

                            //if(  ){}


                            if ( ($maClasse-> verifierTransmissionApurement($ref_apure, $date_apure, $banque) == '') && ($maClasse-> getDossierRefDos($ref_dos)['id_dos'] != '') ) {
                              
                              $maClasse-> creerTransmissionApurement(NULL, $ref_apure, $_SESSION['id_util'], NULL, $banque, $date_apure);
                              //echo '<br>ID = '.$maClasse-> verifierTransmissionApurement($ref_apure, $date_apure, $banque);

                            }


                            if ( ($maClasse-> getDossierRefDos($ref_dos)['id_dos'] != '') && ($maClasse-> getDossierRefDos($ref_dos)['id_dos'] != NULL) ) {
                              
                              $id_trans_ap = $maClasse-> verifierTransmissionApurement($ref_apure, $date_apure, $banque);

                              //Traitement apurement
                              $maClasse-> creerDetailApurement($id_trans_ap, $maClasse-> getDossierRefDos($ref_dos)['id_dos']);

                              //Traietement Licence
                              if ( (trim($type_paie) == 'TOTAL') || (trim($type_paie) == 'FINAL') || (trim($type_paie) == 'FINALE') ) {
                                
                                $maClasse-> MAJ_apurement_lic($maClasse-> getDossierRefDos($ref_dos)['num_lic'], '1');

                              }

                            }

                        }
                      }

                    }

                    
                  ?>
                <button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierDossier2">
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
                      <th style="">#</th>
                      <th style="">MCA File REF</th>
                      <th>FOB</th>
                      <th>FRET</th>
                      <th>ASSURANCE</th>
                      <th>AUTRES FRAIS</th>
                      <th>MONTANT DECLARATION</th>
                  </thead>
                  <tbody>
                    <?php
                      //$maClasse-> afficherDossierUpload2($_GET['id_mod_lic'], $_SESSION['id_util']);
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
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

  <div class="modal fade uploadeFichierDossier2" id="modal-default">
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

            <div class="col-md-12">
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
