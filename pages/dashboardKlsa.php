<div class="row">

  <div class="col-md-12 col-sm-6 col-12">
    <h4>
      KASUMBALESA
    </h4>
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-primary">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreArriveKlsa2Jour();?>
        </h3>

        <p> KASUMBALESA TRUCK ARRIVAL </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKlsa.php?type=KASUMBALESA TRUCK ARRIVAL','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-success">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDelaiDateKlsa();?>
        </h3>

        <p> TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKlsa.php?type=TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>


  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-primary">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreArriveWiski2Jour();?>
        </h3>

        <p> WISKI TRUCK ARRIVAL </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKlsa.php?type=WISKI TRUCK ARRIVAL','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-info">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDelaiDateWiski();?>
        </h3>

        <p> TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKlsa.php?type=TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-danger">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreErreurDateKlsa();?>
        </h3>

        <p> DATES ERROR </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKlsa.php?type=DATES ERROR','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-12 col-sm-6 col-12">
    <?php //include('graphiques/dashboardLicence.php');?>
  </div>
</div>