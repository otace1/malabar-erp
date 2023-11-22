<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='apurementLicence.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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

  /*if( isset($_POST['appurement']) ){
    ?>
    <script type="text/javascript">
      window.open('appurement.php?num_lic=<?php echo $_POST['num_lic']; ?>','pop1','width=800,height=800');
    </script>
    <?php
  }*/

  if (isset($_POST['modifierTransmissionApurement'])) {
    
    if (isset($_FILES['fichier_trans_ap']['name'])) {

      $fichier_trans_ap = $_FILES['fichier_trans_ap']['name'];
      $tmp = $_FILES['fichier_trans_ap']['tmp_name'];

      $maClasse-> uploadAccuseeRecpetionTransmissionApurement($_POST['id_trans_ap'], $fichier_trans_ap, $tmp);

    }else{
      $fichier_trans_ap = NULL;
      $tmp = NULL;
    }

  }

  if(isset($_POST['update'])){

    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
      $licence = $_POST['debut'];
      $num_lic = $_POST['num_lic_'.$licence];

      //echo $_POST['id_dos_'.$num_lic.'_'.$i].' - '.$_POST['cod_'.$num_lic.'_'.$i];

        $maClasse-> MAJ_cod($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['cod_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_fxi($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fxi_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_montant_av($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['montant_av_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_fob($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fob_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_fret($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fret_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_assurance($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['assurance_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_autre_frais($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['autre_frais_'.$num_lic.'_'.$i]);

      /*if (isset($_POST['fret_dos_'.$i]) && ($_POST['fret_dos_'.$i] != '')) {
        $maClasse-> MAJ_fret_dos($_POST['id_dos_'.$i], $_POST['fret_dos_'.$i]);
      }

      if (isset($_POST['assurance_dos_'.$i]) && ($_POST['assurance_dos_'.$i] != '')) {
        $maClasse-> MAJ_assurance_dos($_POST['id_dos_'.$i], $_POST['assurance_dos_'.$i]);
      }

      if (isset($_POST['autre_frais_dos_'.$i]) && ($_POST['autre_frais_dos_'.$i] != '')) {
        $maClasse-> MAJ_autre_frais_dos($_POST['id_dos_'.$i], $_POST['autre_frais_dos_'.$i]);
      }*/
    }

  }


  if (isset($_POST['appurement'])) {
    
    //Creation Transmission Apurement
    $maClasse-> creerTransmissionApurement(NULL, $_POST['ref_trans_ap'], 
                                  $_SESSION['id_util'], NULL, $_POST['banque'], $_POST['date_trans_ap']);

    $id_trans_ap = $maClasse-> verifierTransmissionApurement($_POST['ref_trans_ap'], $_POST['date_trans_ap'], $_POST['banque']);

    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
      
      if (isset($_POST['id_dos_'.$i]) && ($_POST['id_dos_'.$i]!='')) {
        
        $maClasse-> creerDetailApurement($id_trans_ap, $_POST['id_dos_'.$i]);
        // echo $id_trans_ap.' '.$_POST['id_dos_'.$i].'<br>';

      }

    }
    /*?>
    <script type="text/javascript">
      alert('Transmission Apurement <?php echo $_POST['ref_trans_ap'];?> créée avec succès.')
    </script>
    <?php*/
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
          <h3><i class="fa fa-check nav-icon"></i> APUREMENT LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?>

          <div class="float-right">
           


                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-dark btn-xs dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-table"></i> Advanced Report
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#" onclick="window.open('popRapportAdvanceTransmitLicence.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','Advanced Report License','width=800,height=500');">Licenses</a>
                      <a class="dropdown-item" href="#" onclick="window.open('masterDataTransmissionApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','Advanced Report License','width=1000,height=500');">Master Data</a>
                    </div>
                  </div>

          </div>
        </h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="clignote">
                  <?php echo $maClasse-> getNombreDossierPretAEtreApuresLicenceClient($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Dossiers en attente apurement</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDossierEnAttenteApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-olive">
              <div class="inner">
                <h3 id="DivClignotante" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreTransmissionApurement($_GET['id_mod_lic'], $_GET['id_cli']);
                  ?>
                </h3>

                <p>Transmission(s) Apurement</p>
              </div>
              <div class="icon" id="DivClignotante2" style="visibility:visible;">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpTransmissionApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

              <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="clignote">
                  <?php echo $maClasse-> getNombreTransmissionApurementSansFichier($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Transmission(s) Apurement sans Accusée de reception</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpTransmissionApurementNotificationSansFichier.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="">
                  <?php echo $maClasse-> getNombreDossierApures($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Dossiers Apurés</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDossiersApuresNotification.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

            <!-- /.card -->
          
            <!-- /.card -->
          
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

                    if(isset($_POST['modifierLicence'])){
                      $maClasse-> modifierLicence($_POST['num_lic'], $_POST['date_val'], $_POST['date_exp'], 
                                                  $_POST['fournisseur'], $_POST['commodity'], $_POST['fob'], 
                                                  $_POST['fret'], $_POST['assurance'], $_POST['autre_frais'], 
                                                  $_POST['num_lic_old'], $_POST['id_mon'], $_POST['id_mod_paie'], 
                                                  $_POST['id_type_lic'], $_POST['id_sous_type_paie']);
                      echo '<script>alert("Opération reussie!! Licence '.$_POST['num_lic_old'].' modifiée avec succès.");</script>';
                    }

                    if(isset($_POST['creerLicence'])){

                      if($_GET['id_mod_lic']){

                        if(!isset($_POST['num_lic']) || ($_POST['num_lic'] == '')){
                          $_POST['num_lic'] = 'INVOICE '.$_POST['ref_fact'];
                        }

                        if (isset($_FILES['fichier_lic']['name'])) {

                          $fichier_lic = $_FILES['fichier_lic']['name'];
                          $tmp = $_FILES['fichier_lic']['tmp_name'];

                        }else{
                          $fichier_lic = NULL;
                          $tmp = NULL;
                        }

                        if (isset($_FILES['fichier_fact']['name'])) {

                          $fichier_fact = $_FILES['fichier_fact']['name'];
                          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

                        }else{
                          $fichier_fact = NULL;
                          $tmp_fact = NULL;
                        }
                        if ( $maClasse-> getLicenceFacture($_POST['ref_fact']) != null ){

                          echo '<script>alert("Erreur!! Impossible de créer cette licence avec la facture '.$_POST['ref_fact'].' car il existe déjà une licence ayant cette facture.");</script>';

                        }else{

                          if ( $maClasse-> getLicence($_POST['num_lic']) == null ){
                            $maClasse-> creerLicenceIB2($_POST['id_banq'], $_POST['num_lic'], $_POST['id_cli'], 
                                                      $_POST['id_post'], $_POST['id_mon'], $_POST['fob'], 
                                                      $_POST['assurance'], $_POST['fret'], $_POST['autre_frais'], 
                                                      $_POST['fsi'], $_POST['aur'], 
                                                      $_POST['id_mod_trans'], $_POST['ref_fact'], $_POST['date_fact'], 
                                                      $_POST['fournisseur'], $_POST['date_val'], $_POST['date_exp'], 
                                                      NULL, $_GET['id_mod_lic'], $_SESSION['id_util'], 
                                                      $fichier_lic, $tmp, $fichier_fact, $tmp_fact, 
                                                      $_POST['id_type_lic'], $_POST['id_mod_paie'], 
                                                      $_POST['id_sous_type_paie'], $_POST['provenance'],
                                                      $_POST['commodity'], $_POST['tonnage'], 
                                                      $_POST['poids'], $_POST['unit_mes']);
                            }else{

                              echo '<script>alert("Erreur!! Impossible de créer la licence '.$_POST['num_lic'].' car il existe déjà une licence ayant ce numéro.");</script>';

                            }
                        }

                      }

                    }


                    if(isset($_POST['nouvelleLicenceExport'])){

                      if($_GET['id_mod_lic']){

                        if(!isset($_POST['num_lic']) || ($_POST['num_lic'] == '')){
                          $_POST['num_lic'] = 'INVOICE '.$_POST['ref_fact'];
                        }

                        if (isset($_FILES['fichier_lic']['name'])) {

                          $fichier_lic = $_FILES['fichier_lic']['name'];
                          $tmp = $_FILES['fichier_lic']['tmp_name'];

                        }else{
                          $fichier_lic = NULL;
                          $tmp = NULL;
                        }

                        if (isset($_FILES['fichier_fact']['name'])) {

                          $fichier_fact = $_FILES['fichier_fact']['name'];
                          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

                        }else{
                          $fichier_fact = NULL;
                          $tmp_fact = NULL;
                        }
                        if ( $maClasse-> getLicenceFacture($_POST['ref_fact']) != null ){

                          echo '<script>alert("Erreur!! Impossible de créer cette licence avec la facture '.$_POST['ref_fact'].' car il existe déjà une licence ayant cette facture.");</script>';

                        }else{

                          if ( $maClasse-> getLicence($_POST['num_lic']) == null ){

    
                            $maClasse-> creerEBTracking($_POST['num_lic'], $_POST['date_val'], $_POST['poids'], 
                                                        $_POST['unit_mes'], $_GET['id_cli'], $_POST['id_march'], 
                                                        $_POST['date_exp'], $_SESSION['id_util'], $_POST['destination'], 
                                                        $_POST['acheteur'], $_POST['id_mod_trans'], 
                                                        $_POST['ref_fact'], $fichier_lic, $tmp);


                            }else{

                              echo '<script>alert("Erreur!! Impossible de créer la licence '.$_POST['num_lic'].' car il existe déjà une licence ayant ce numéro.");</script>';

                            }
                        }

                      }

                    }
                  ?>
                  <?php
                  if( (isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) ){
                    ?>
                <!--<button class="btn btn-primary square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicenceExport">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>-->
                  <?php
                  }
                  ?>
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                    <i class="fa fa-filter"></i> Filtrage Client
                </button>
                <!--<button class="btn btn-success square-btn-adjust" data-toggle="modal" data-target=".appurement">
                    <i class="fa fa-check"></i> Appurement
                </button>-->
                <!--<button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierLicence">
                    <i class="fa fa-upload"></i> Uploade Fichier
                </button>-->

                </h3>
                  <div class="card-tools">
                    <div class="pull-right">

                <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".creerTransmisionApurement">
                    <i class="fa fa-plus"></i> Nouvelle Transmission Apurement
                </button>

                <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportTramissionApurementAll.php?id_cli=<?php echo $_GET['id_cli']; ?>','pop1','width=80,height=80');">
                  <i class="fas fa-file-excel"></i> Export
                </button>

                <!--<form method="POST" action="">
                        <div class="input-group input-group-sm">
                          <input type="text" name="num_lic" class="form-control float-right" placeholder="Entrez le numéro">

                          <div class="input-group-append">
                            <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                    <hr>
                    <span class="badge badge-success">Apurée</span>
                    <span class="badge badge-dark">Cloturée</span>
                    <span class="badge badge-info">Partiellement</span>
                    <span class="badge badge-danger">Expirée</span>

                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>-->

                    </div>

                  </div>
              </div>                
              <?php
              if (isset($_POST['appurement'])) {
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Opération reussie!</strong> Transmission Apurement <b><?php echo $_POST['ref_trans_ap'];?></b> créée avec succès.
                </div>
              <?php
              }
              ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="afficherApurementAjax" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm small text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Client</th>
                      <th>Reference</th>
                      <th>Date Creation</th>
                      <th>Date Depot</th>
                      <th>Banque</th>
                      <th>Nbre. Licences</th>
                      <th>Nbre. Dossiers</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
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
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage CLIENT <?php echo $modele['sigle_mod_lic'];?>.</h4>
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
/*if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade creerTransmisionApurement" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Transmission Apurement <?php echo $modele['sigle_mod_lic'].$client;?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">BANQUE</label>
            <select name="banque" onchange="" class="form-control cc-exp" required>
              <option></option>
                <?php
                  $maClasse->selectionnerNomBanque();
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">REF.</label>
            <input name="ref_trans_ap" type="text" value="<?php echo $maClasse-> buildReferenceTransmissionApurementModeleLicence($_GET['id_mod_lic']);?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE</label>
            <input name="date_trans_ap" type="date" value="" class="form-control cc-exp" required>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12">
            <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-bordered table-hover table-dark table-head-fixed">
              <thead>
                <tr class="" style="text-align: center;">
                  <th>#</th>
                  <th width="20%">MCA REF</th>
                  <th width="25%">LICENCE</th>
                  <th width="15%">MONTANT DECL.</th>
                  <th>REF. DECL.</th>
                  <th>REF. LIQ.</th>
                  <th>REF. QUIT.</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  for ($i=1; $i <= 50 ; $i++) { 
                  ?>
                  <tr>
                    <td class="" style="text-align: center;">
                      <?php echo $i;?>
                    </td>
                    <td class="">
                      <select name="id_dos_<?php echo $i;?>" id="id_dos_<?php echo $i;?>" onchange="xajax_afficherDetailsDossierMutliple(this.value, <?php echo $i;?>);" class="form-control cc-exp">
                        <option></option>
                          <?php
                            $maClasse->selectionnerDossierEnAttenteApurement($_GET['id_cli'], $_GET['id_mod_lic']);
                          ?>
                      </select>
                    </td>
                    <td style="text-align: center;">
                      <span id="num_lic<?php echo $i;?>"></span>
                    </td>
                    <td style="text-align: center;">
                      <span id="montant_decl<?php echo $i;?>"></span>
                    </td>
                    <td style="text-align: center;">
                      <span id="ref_decl<?php echo $i;?>"></span>
                    </td>
                    <td style="text-align: center;">
                      <span id="ref_liq<?php echo $i;?>"></span>
                    </td>
                    <td style="text-align: center;">
                      <span id="ref_quit<?php echo $i;?>"></span>
                    </td>
                  </tr>
                  <?php
                  }
                ?>
                <tr>
                  <td sty></td>
                </tr>
              </tbody>
            </table>
            </div>
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
}*/
?>

<div class="modal fade creerTransmisionApurement" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Transmission Apurement <?php echo $modele['sigle_mod_lic'].$client;?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Banque</label>
            <select name="banque" onchange="" class="form-control cc-exp" required>
              <option></option>
                <?php
                  $maClasse->selectionnerNomBanque();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Reference</label>
            <input name="ref_trans_ap" type="text" value="<?php echo $maClasse-> buildReferenceTransmissionApurementModeleLicence($_GET['id_mod_lic']);?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date</label>
            <input name="date_trans_ap" type="date" value="" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Licence</label>
            <select onchange="getDossierEnAttenteApurementLicenceAjax(this.value);" class="form-control cc-exp" required>
              <option></option>
                <?php
                  $maClasse->selectionnerLicenceDossierEnAttenteApurement($_GET['id_cli'], $_GET['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12">
            <table class="table table-dark table-bordered table-striped table-sm small text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>MCA Ref.</th>
                  <th>Licence</th>
                  <th>Montant Decl.</th>
                  <th>Ref. Decl.</th>
                  <th>Ref. Liq.</th>
                  <th>Ref. Quit.</th>
                </tr>
              </thead>
              <tbody id="tableau_dossier">
                
              </tbody>
            </table>
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

?>
<div class="modal fade" id="modal_upload_ar_transmit">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_trans_ap" id="id_trans_ap_ar">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-upload"></i>Transmission Apurement <input type="text" id="label_ref_trans_ap_ar" disabled="disabled" style="color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">ACCUSEE DE RECEPTION</label>
            <input type="file" name="fichier_trans_ap" class="form-control cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="modifierTransmissionApurement" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_edit_transmit">
  <div class="modal-dialog modal-md">
    <form id="form_edit_transmit" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_trans_ap" id="id_trans_ap_edit">
      <input type="hidden" name="operation" value="edit_transmit">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit <input type="text" id="label_ref_trans_ap_edit" disabled="disabled" style="color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Reference</label>
          <input type="text" name="ref_trans_ap" id="ref_trans_ap_edit" class="form-control cc-exp form-control-sm">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Date Depot</label>
          <input type="date" name="date_depot" id="date_depot" class="form-control cc-exp form-control-sm">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('#form_edit_transmit').submit(function(e){

      e.preventDefault();
      
      if(confirm('Do really you want to submit ?')) {

        var fd = new FormData(this);
        $('#spinner-div').show();
        $('#modal_nouvelle_licence_import').modal('hide');


        $.ajax({
          type: 'post',
          url: 'ajax.php',
          processData: false,
          contentType: false,
          data: fd,
          dataType: 'json',
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else if(data.message){
              $( '#form_edit_transmit' ).each(function(){
                  this.reset();
              });
              $('#afficherApurementAjax').DataTable().ajax.reload();
              $('#spinner-div').hide();//Request is complete so hide spinner
              $('#modal_edit_transmit').modal('hide');
              // alert(data.message);
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

      }


    });
    
  });

  function modal_edit_transmit(id_trans_ap) {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_trans_ap: id_trans_ap, operation: 'getTransmissionApurement'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_ref_trans_ap_edit').val(data.ref_trans_ap);
          $('#id_trans_ap_edit').val(data.id_trans_ap);
          $('#ref_trans_ap_edit').val(data.ref_trans_ap);
          $('#date_depot').val(data.date_depot);
          $('#modal_edit_transmit').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function modal_upload_ar_transmit(id_trans_ap) {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_trans_ap: id_trans_ap, operation: 'getTransmissionApurement'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_ref_trans_ap_ar').val(data.ref_trans_ap);
          $('#id_trans_ap_ar').val(data.id_trans_ap);
          $('#modal_upload_ar_transmit').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  $('#afficherApurementAjax').DataTable({
     lengthMenu: [
        [10, 20, 30, 50, 100, 500, -1],
        [10, 20, 30, 50, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
        // fixedColumns: {
        //   left: 3
        // },
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      }
      // ,
      // {
      //   text: '<i class="fa fa-check"></i>',
      //   className: 'btn btn-info bt',
      //   action: function ( e, dt, node, config ) {
      //       modal_edit_dossier();
      //   }
      // }
  ],
  
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "operation": "afficherApurementAjax"
      }
    },
    // rowGroup: {
    //     dataSrc: "num_lic",

    // },
    "columns":[
      {"data":"compteur"},
      {"data":"nom_cli"},
      {"data":"ref_trans_ap",
        className: 'dt-body-center'
      },
      {"data":"date_trans_ap",
        className: 'dt-body-center'
      },
      {"data":"date_depot",
        className: 'dt-body-center'
      },
      {"data":"banque",
        className: 'dt-body-center'
      },
      {"data":"nbre_lic",
        className: 'dt-body-center'
      },
      {"data":"nbre_dos",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ],
      "createdRow": function( row, data, dataIndex ) {
        if ( data['statut_fichier'] == "0") {
          $(row).addClass('text text-danger');
        }
      }  
  });

  function getDossierEnAttenteApurementLicenceAjax(num_lic) {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {num_lic: num_lic, operation: 'getDossierEnAttenteApurementLicenceAjax'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#tableau_dossier').html(data.tableau_dossier);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

</script>
