<div class="row  small">

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-dark">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDossierModeleLicence($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
        </h3>

        <p> TOTAL FILES </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('../pages/popUpDossierDashboard.php?etat=TOTAL FILES&id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-success">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDossierCleared($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
        </h3>

        <p> CLEARING COMPLETED </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('../pages/popUpDossierDashboard.php?etat=CLEARING COMPLETED&id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-info">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDossierProcess($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
        </h3>

        <p> FILES IN PROCESS </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('../pages/popUpDossierDashboard.php?etat=FILES IN PROCESS&id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-danger">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDossierCanceled($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
        </h3>

        <p> CANCELLED </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('../pages/popUpDossierDashboard.php?etat=CANCELLED&id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-12 col-sm-6 col-12">
    <hr>
  </div>

  <?php
    // $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
    //                             $_GET['id_mod_trans'], $_GET['commodity'], 'AWAITING CRF/AD/INSURANCE');

    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'AWAITING CRF/AD/INSURANCE');

    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'AWAITING CRF');

    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'AWAITING AD');

    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'AWAITING INSURANCE');

    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'UNDER PREPARATION');

    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'AWAITING LIQUIDATION');
    
    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'AWAITING QUITTANCE');
    
    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'AWAITING BAE/BS');

    $maClasse-> getSummaryStatus($_GET['id_mod_trac'], $_GET['id_cli'], 
                                $_GET['id_mod_trans'], $_GET['commodity'], 'CLEARING COMPLETED');
  ?>

  <div class="col-md-12 col-sm-6 col-12">
    <?php //include('graphiques/dashboardLicence.php');?>
  </div>
</div>