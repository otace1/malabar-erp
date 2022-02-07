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
          <h3><i class="fa fa-upload nav-icon"></i> UPLOAD DOSSIERS MMG <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h3>
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
                      $maClasse-> deleteDossierUploadTracking($_GET['id_mod_trac'], $_SESSION['id_util']);
                    }
                    if(isset($_POST['uploadeFichierDossier2'])){
                      
                      $fichier_pointage = $_FILES['fichier_dossier']['tmp_name'];

                      require('../PHPExcel-1.8/Classes/PHPExcel.php');
                      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=2; $row <= $highestRow ; $row++) { 
                          

                            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                            $t1 = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $poids = $worsheet-> getCellByColumnAndRow(2, $row)-> getValue();
                            $ref_fact = $worsheet-> getCellByColumnAndRow(3, $row)-> getValue();
                            $horse = $worsheet-> getCellByColumnAndRow(4, $row)-> getValue();
                            $trailer_1 = $worsheet-> getCellByColumnAndRow(5, $row)-> getValue();
                            $trailer_2 = $worsheet-> getCellByColumnAndRow(6, $row)-> getValue();
                            $num_lic = $worsheet-> getCellByColumnAndRow(7, $row)-> getValue();
                            $num_exo = $worsheet-> getCellByColumnAndRow(8, $row)-> getValue();
                            $klsa_arriv = $worsheet-> getCellByColumnAndRow(9, $row)-> getFormattedValue();
                            $crossing_date = $worsheet-> getCellByColumnAndRow(10, $row)-> getFormattedValue();
                            $wiski_arriv = $worsheet-> getCellByColumnAndRow(11, $row)-> getFormattedValue();
                            $wiski_dep = $worsheet-> getCellByColumnAndRow(12, $row)-> getFormattedValue();
                            $insp_report = $worsheet-> getCellByColumnAndRow(13, $row)-> getFormattedValue();
                            $ir = $worsheet-> getCellByColumnAndRow(14, $row)-> getValue();
                            $ref_crf = $worsheet-> getCellByColumnAndRow(15, $row)-> getValue();
                            $date_crf = $worsheet-> getCellByColumnAndRow(16, $row)-> getFormattedValue();
                            $ref_decl = $worsheet-> getCellByColumnAndRow(17, $row)-> getFormattedValue();
                            $dgda_in = $worsheet-> getCellByColumnAndRow(18, $row)-> getFormattedValue();
                            $ref_liq = $worsheet-> getCellByColumnAndRow(19, $row)-> getValue();
                            $date_liq = $worsheet-> getCellByColumnAndRow(20, $row)-> getFormattedValue();
                            $ref_quit = $worsheet-> getCellByColumnAndRow(21, $row)-> getValue();
                            $date_quit = $worsheet-> getCellByColumnAndRow(22, $row)-> getFormattedValue();
                            $dgda_out = $worsheet-> getCellByColumnAndRow(23, $row)-> getFormattedValue();
                            $regul_ir = $worsheet-> getCellByColumnAndRow(24, $row)-> getFormattedValue();
                            $cleared = $worsheet-> getCellByColumnAndRow(25, $row)-> getValue();

                            if ( $cleared == 'CLEARED' ) {
                              $cleared = '1';
                            }elseif ( $cleared == 'PROCESS' ) {
                              $cleared = '0';
                            }elseif ( $cleared == 'CANCELLED' ) {
                              $cleared = '2';
                            }

                            $statut = $worsheet-> getCellByColumnAndRow(26, $row)-> getValue();
                            $remarque = $worsheet-> getCellByColumnAndRow(27, $row)-> getValue();

                            $maClasse-> creerDossierMMG($_POST['id_cli'], $ref_dos, $t1, $poids, 
                                      $ref_fact, $horse, $trailer_1, $trailer_2, 
                                      $num_lic, $num_exo, $klsa_arriv, $crossing_date, 
                                      $wiski_arriv, $wiski_dep, $insp_report, $ir, 
                                      $ref_crf, $date_crf, $ref_decl, $dgda_in, 
                                      $ref_liq, $date_liq, $ref_quit, $date_quit, 
                                      $dgda_out, $regul_ir, $cleared, $statut, $remarque, 2, 1);

                          //$periode_agent = $maClasse-> getElementPeriodeAgent($_POST['id_per'], $id_ag);

                          //$maClasse-> MAJPeriodeAgent($_POST['id_per'], $periode_agent['id_ag_bar'], $jour, $nuit, $maladie, $cc, $a_mp, $h_sup_130, $h_sup_160, $jour_f, $nuit_f);

                        }
                      }

                      /*$maClasse-> uploadeFichierPointage($_POST['id_per'], $_POST['id_ag_bar'], $_POST['jour'], $_POST['nuit'], $_POST['maladie'], $_POST['cc'], $_POST['a_mp'], $_POST['h_sup_130'], $_POST['h_sup_160'], $_POST['jour_f'], $_POST['nuit_f']);*/
                    }


                    if(isset($_POST['creerDossierIBFromUploade'])){

                      if($_GET['id_mod_trac']){
                            $maClasse-> creerDossierIBFromUploadeMMG($_SESSION['id_util'], $_GET['id_mod_trac']);
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
                      <th>MCA B/REF</th>
                      <th>ROAD MANIF</th>
                      <th>PRE-ALERTE DATE</th>
                      <th>T1 Number</th>
                      <th>Poids</th>
                      <th>FOB</th>
                      <th>FRET</th>
                      <th>ASSURANCE</th>
                      <th>AUTRES FRAIS</th>
                      <th>Invoice</th>
                      <th>SUPPLIER</th>
                      <th>PO Ref</th>
                      <th>COMMODITY</th>
                      <th>Camion</th>
                      <th>Remorque 1</th>
                      <th>Remorque 2</th>
                      <th>Numéro&nbsp;Licence</th>
                      <th>Numéro&nbsp;arreté&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th>Crossing Date</th>
                      <th>Arrival Date</th>
                      <th>Arrivé&nbsp;wiski</th>
                      <th>Depart&nbsp;wiski</th>
                      <th>AMICONGO&nbsp;ARRIVAL DATE</th>
                      <th>INSP REPORT RECEIVED DATE</th>
                      <th>CLEARED BASED ON IR</th>
                      <th>Reference&nbsp;CRF</th>
                      <th>Reception&nbsp;CRF</th>
                      <th>Reference&nbsp;declaration</th>
                      <th>Entrée&nbsp;à&nbsp;la&nbsp;DGDA</th>
                      <th>Reference&nbsp;liquidation</th>
                      <th>Date&nbsp;liquidation</th>
                      <th>Reference&nbsp;quittance</th>
                      <th>Date&nbsp;quittance</th>
                      <th>Sortie&nbsp;de&nbsp;la&nbsp;DGDA</th>
                      <th>Customer Deliver</th>
                      <th>Dispach / Deliver Date</th>
                      <th>File Status</th>
                      <th>Remarque</th>
                  </thead>
                  <tbody>
                    <?php
                      $maClasse-> afficherDossierUpload2($_GET['id_mod_trac'], $_SESSION['id_util']);
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
