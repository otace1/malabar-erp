<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $client = '';

  if(isset($_POST['rechercheClient'])){
    $id_mod_trac = $_GET['id_mod_trac'];
    $id_mod_trans = $_GET['id_mod_trans'];
    $id_cli = $_POST['id_cli'];
    $commodity = $_POST['commodity'];
    echo "<script>window.location='dashboardDossier.php?id_mod_trac=$id_mod_trac&id_cli=$id_cli&commodity=$commodity&id_mod_trans=$id_mod_trans';</script>";
    if( $id_cli > 0){
      $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomClient($id_cli).'</span>';
    }else{
      $client = '';
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

  }

  if(isset($_POST['rechercheDossier'])){
    $id_mod_lic = $_GET['id_mod_trac'];
    $mot_cle = $_POST['mot_cle'];
    echo "<script>window.open('popUpRechercheDossier.php?id_mod_lic=$id_mod_lic&mot_cle=$mot_cle','pop1','width=1500,height=900');</script>";
  }

  if(isset($_POST['rechercheKBP'])){
    $id_mod_lic = $_GET['id_mod_trac'];
    $debut = $_POST['debut'];
    $fin = $_POST['fin'];
    echo "<script>window.open('popUprechercheKBP.php?id_mod_lic=$id_mod_lic&debut=$debut&fin=$fin','pop1','width=1500,height=900');</script>";
  }

  if(isset($_POST['kpi'])){
    $id_mod_lic = $_GET['id_mod_trac'];
    $debut = $_POST['debut'];
    $fin = $_POST['fin'];
    $id_mod_trans = $_GET['id_mod_trans'];
    $id_cli = $_POST['id_cli'];
    echo "<script>window.open('popUpKPIDossier.php?id_cli=$id_cli&id_mod_lic=$id_mod_lic&id_mod_trans=$id_mod_trans&debut=$debut&fin=$fin','pop1','width=1500,height=900');</script>";
  }

  if( isset($_GET['commodity']) && ($_GET['commodity'] != '')){
    $commodity = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['commodity'].'</span>';
  }else{
    $commodity = '';
  }

  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomClient($_GET['id_cli']).'</span>';
  }else{
    $client = '';
  }

  if( isset($_GET['id_type_lic']) && ($_GET['id_type_lic'] != '')){
    $type_licence = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomTypeLicence($_GET['id_type_lic']).'</span>';
  }else{
    $type_licence = '';
  }

  if(!isset($_GET['id_cli'])){
    $_GET['id_cli'] = null;
  }
  if(!isset($_GET['id_type_lic'])){
    $_GET['id_type_lic'] = null;
  }

  if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
    $mode_transport = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).'</span>';
  }else{
    $mode_transport = '';
  }

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper small">
    <!-- Content Header (Page header) -->
    <?php
      if( $maClasse-> getClientModeleLicenceModeTransport($_GET['id_cli'], /*id_mod_lic*/ 2, /*id_mod_trans*/ 1) != false){


          $modele = $maClasse-> getElementModeleLicence(2);

          $_GET['id_mod_trans']=1;
          if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
            $mode_transport = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).'</span>';
          }else{
            $mode_transport = '';
          }

    ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="nav-icon fas fa-tachometer-alt"></i> DASHBOARD <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$mode_transport.$client.$type_licence.$commodity;?></h5>
          
        </div>

      </div><!-- /.container-fluid -->
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row  small">
        <?php
          if ($_GET['id_mod_trac']=='2' && $_GET['id_mod_trans']=='1') {

            //include("dashboardTrackingAutomatique.php");
            ?>

            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING CRF/AD/INSURANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING CRF';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING AD';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING INSURANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'UNDER PREPARATION';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING LIQUIDATION';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING QUITTANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING BAE/BS';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'CLEARING COMPLETED';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=700');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <?php

          }
          // else {

          //   //include("dashboardTracking.php");
          //   $maClasse-> getSummaryClient($_GET['id_mod_trac'], $_GET['id_cli'], 
          //                       $_GET['id_mod_trans'], $_GET['commodity']);

          // }

        ?>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <?php
      }
    if( $maClasse-> getClientModeleLicenceModeTransport($_GET['id_cli'], /*id_mod_lic*/ 2, /*id_mod_trans*/ 3) != false){

          $modele = $maClasse-> getElementModeleLicence(2);

          $_GET['id_mod_trans']=3;
          if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
            $mode_transport = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).'</span>';
          }else{
            $mode_transport = '';
          }

    ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="nav-icon fas fa-tachometer-alt"></i> DASHBOARD <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$mode_transport.$client.$type_licence.$commodity;?></h5>
          
        </div>

      </div><!-- /.container-fluid -->
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row  small">
        <?php
          if ($_GET['id_mod_trac']=='2' && $_GET['id_mod_trans']=='1') {

            //include("dashboardTrackingAutomatique.php");
            ?>

            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING CRF/AD/INSURANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING CRF';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING AD';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING INSURANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'UNDER PREPARATION';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING LIQUIDATION';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING QUITTANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING BAE/BS';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'CLEARING COMPLETED';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=700');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <?php

          }else {

            //include("dashboardTracking.php");
            $maClasse-> getSummaryClient($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity']);

          }

        ?>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <?php
      }
    
    if( $maClasse-> getClientModeleLicenceModeTransport($_GET['id_cli'], /*id_mod_lic*/ 1, /*id_mod_trans*/ 4) != false){

          $modele = $maClasse-> getElementModeleLicence(2);

          $_GET['id_mod_trans']=4;
          if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
            $mode_transport = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).'</span>';
          }else{
            $mode_transport = '';
          }

    ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="nav-icon fas fa-tachometer-alt"></i> DASHBOARD <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$mode_transport.$client.$type_licence.$commodity;?></h5>
          
        </div>

      </div><!-- /.container-fluid -->
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row  small">
        <?php
          if ($_GET['id_mod_trac']=='2' && $_GET['id_mod_trans']=='1') {

            //include("dashboardTrackingAutomatique.php");
            ?>

            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING CRF/AD/INSURANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING CRF';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING AD';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING INSURANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'UNDER PREPARATION';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING LIQUIDATION';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING QUITTANCE';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'AWAITING BAE/BS';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=600');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <div class="col-md-3 col-sm-6 col-12">
              <?php
                $status = 'CLEARING COMPLETED';
              ?>
              <div class="small-box bg-dark">
                <div class="inner">
                  <h5>
                    <?php echo number_format($maClasse-> nbreSummaryStatus($status, 2, $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ');?>
                  </h5>

                  <p> <?php echo strtoupper($status);?> </p>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo str_replace('/', '_', $status);?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=800,height=700');">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

              <!-- /.info-box -->
            </div>
          
            <?php

          }else {

            //include("dashboardTracking.php");
            $maClasse-> getSummaryClient($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity']);

          }

        ?>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <?php
      }
    
    ?>
  </div>
  <?php include("pied.php");?>

<?php
if(isset($_GET['id_mod_trac']) && isset($_GET['id_mod_trac'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage.</h4>
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
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <select name="commodity" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  /*if (isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) {
                    $maClasse->selectionnerMarchandiseClientModeleLicence($_GET['id_cli'], $_GET['id_mod_trac']);
                  }else{*/
                    $maClasse->selectionnerMarchandiseModeleLicence($_GET['id_mod_trac']);
                  //}
                  
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

if(isset($_GET['id_mod_trac']) && isset($_GET['id_mod_trac'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheDossier" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-search"></i> Search File.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">File Ref. | Invoice Ref. | CRF Ref. | Truck | Num Lot</label>
            <input name="mot_cle" class="form-control cc-exp" required>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheDossier" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade rechercheKBP" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-search"></i> KBP Report. Between Prealert dates</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Begin</label>
            <input name="debut" type="date" class="form-control cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">End</label>
            <input name="fin" type="date" class="form-control cc-exp" required>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheKBP" class="btn btn-primary">Valider</button>
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



<div class="modal fade kpi" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-tachometer-alt"></i> 

          <?php
          if ($_GET['id_mod_trac'] == '1') {
            echo 'EXPORT KIPs | Filter By Loading Date ';
          }else if ($_GET['id_mod_trac'] == '2') {
            echo 'IMPORT KIPs | Filter By Wiski Arrival Date ';
          }
          ?>

        </h4>
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
                  $maClasse->selectionnerClientModeleLicence($_GET['id_mod_trac']);
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BEGIN</label>
            <input name="debut" type="date" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">END</label>
            <input name="fin" type="date" class="form-control cc-exp" required>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="kpi" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
