<?php
  include("tete.php");
  //include("popUpDashboardLicenceExcel.php");
  $client = $maClasse-> getElementClient($_GET['id_cli']);
  if( isset($_GET['id_march']) && ($_GET['id_march'] != '')){
    $marchandise = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getMarchandise($_GET['id_march']).'</span>';
  }else{
    $marchandise = '';
    $_GET['id_march'] = NULL;
  }

  if( isset($_GET['num_lic']) && ($_GET['num_lic'] != '')){
    $licence = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['num_lic'].'</span>';
  }else{
    $licence = '';
    $_GET['num_lic'] = NULL;
  }

  if( isset($_GET['cleared']) && ($_GET['cleared'] != '')){
    if ($_GET['cleared'] == '0') {
      $cleared = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">TRANSIT</span>';
    }else if ($_GET['cleared'] == '1') {
      $cleared = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">CLEARED</span>';
    }if ($_GET['cleared'] == '2') {
      $cleared = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">CANCELLED</span>';
    }
  }else{
    $cleared = '';
    $_GET['cleared'] = NULL;
  }

  if( isset($_GET['statut']) && ($_GET['statut'] != '')){
    $statut = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['statut'].'</span>';
  }else{
    $statut = '';
    $_GET['statut'] = NULL;
  }

  if( isset($_GET['statut']) && ($_GET['statut'] != '')){
    $statut = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['statut'].'</span>';
  }else{
    $statut = '';
    $_GET['statut'] = NULL;
  }

  if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
    $mode_transport = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).'</span>';
  }else{
    $mode_transport = '';
  }

  if( isset($_GET['commodity']) && ($_GET['commodity'] != '')){
    $commodity = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['commodity'].'</span>';
  }else{
    $commodity = '';
  }

  if(isset($_POST['update'])){

    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

      if (isset($_POST['poids_'.$i]) && ($_POST['poids_'.$i] != '')) {
        $maClasse-> MAJ_poids($_POST['id_dos_'.$i], $_POST['poids_'.$i]);
        // echo '<br> Poids = '.$_POST['poids_'.$i];
        // echo '<br> id_dos = '.$_POST['id_dos_'.$i];
      }
    }

  }

 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card card-<?php echo $couleur;?>">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fa fa-folder-open nav-icon"></i> DOSSIERS SANS POIDS <?php echo '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$client['nom_cli'].'</span>'.$marchandise.$mode_transport.$commodity.$licence.$statut.$cleared;?>
                    <!-- <button class="btn btn-default" onclick="tableToExcel('exportationExcel', 'Trackings')">
                      <img src="../images/xls.png" width="30px">
                    </button> -->
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="card-body table-responsive p-0" style="height: 800px;">
                            <table class="table table-dark  table-head-fixed table-bordered table-hover text-nowrap table-sm">
                              <thead>
                                <tr>
                                  <th style="text-align: center;">N.</th>
                                  <th style="border: 1px solid white; text-align: center;">REF. DOSSIER</th>
                                  <th style="border: 1px solid white; text-align: center;">POIDS (Kg)</th>
                              </thead>
                              <tbody>
                                <form method="POST" action="">
                                <?php
                                  $maClasse-> afficherDossierSansPoids($_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_mod_trac']);
                                ?>
                                </form>
                              </tbody>
                            </table>
                          </div>
                      </div>
                  </div>
                      <!-- input states -->
                  <!-- /.card-body -->
                </div>
            <!-- /.card -->
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>