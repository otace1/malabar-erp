<?php
  include("tete.php");
  //include("popUpDashboardLicenceExcel.php");
  $modele_licence = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);

  $couleur = '';
  if ($_GET['type'] == 'EN COURS') {

    $couleur = 'info';

  }else if ($_GET['type'] == 'EXTREME VALIDATION -40 JOURS') {

    $couleur = 'warning';

  }else if ($_GET['type'] == 'EXPIRES') {

    $couleur = 'danger';
    
  }else if ($_GET['type'] == 'APPUREES TRACKING ATTENTE BANQUE') {

    $couleur = 'dark';
    
  }else if ($_GET['type'] == 'APPUREES PAR BANQUE') {

    $couleur = 'success';
    
  }else if ($_GET['type'] == 'CIF LICENCE DIFFERENT CIF DOSSIER(S)') {

    $couleur = 'teal';
    
  }
  
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | '.$maClasse-> getNomClient($_GET['id_cli']);
  }else{
    $client = '';
  }

  if( isset($_GET['id_type_lic']) && ($_GET['id_type_lic'] != '')){
    $type_licence = ' | '.$maClasse-> getNomTypeLicence($_GET['id_type_lic']);
  }else{
    $type_licence = '';
  }

  if(!isset($_GET['id_cli'])){
    $_GET['id_cli'] = null;
  }
  if(!isset($_GET['id_type_lic'])){
    $_GET['id_type_lic'] = null;
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
                        <i class="fa fa-folder-open nav-icon"></i> DETAIL LICENCE(S) <?php echo $_GET['type'].$client.$type_licence;?>
                        <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportDashboardLicenceStatus.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&type=<?php echo $_GET['type']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>','pop1','width=80,height=80');">
                          <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0" style="height: 800px;">
                              <table class="table  table-head-fixed table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th>NUMERO</th>
                                    <th>SOUSCRIPTEUR</th>
                                    <th>DATE VALIDATION</th>
                                    <th>EXTREME VALIDATION</th>
                                    <?php
                                    if ($_GET['id_mod_lic'] == '1') {
                                    ?>
                                    <th>MEASURE</th>
                                    <th>NB. AUTHORIZED</th>
                                    <?php
                                    }else {
                                    ?>
                                    <th>MONNAIE</th>
                                    <th>FOB</th>
                                    <th>CIF</th>
                                    <?php
                                    }
                                    ?>
                                    <th>Nbre DOSSIERS</th>
                                    <?php
                                    if ($_GET['id_mod_lic'] == '1') {
                                    ?>
                                    <th>NB. USED</th>
                                    <?php
                                    }else {
                                    ?>
                                    <th>FOB USED</th>
                                    <th>CIF USED</th>
                                    <?php
                                    }
                                    ?>
                                    <th>BALANCE</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherLicencePopUp($_GET['id_mod_lic'], $_GET['type'], $_GET['id_cli'], $_GET['id_type_lic']);
                                  ?>
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