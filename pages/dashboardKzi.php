<div class="row">

  <div class="col-md-12 col-sm-6 col-12">
    <h4>
      KOLWEZI
    </h4>
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-primary">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDispacthDeliverKzi();?>
        </h3>

        <p> DISPATCH-DELIVERY </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKzi.php?type=DISPATCH-DELIVER','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-success">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDelaiDateWiski();?>
        </h3>

        <p> TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKzi.php?type=TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-primary">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreDepartedFromWiski();?>
        </h3>

        <p> DEPARTED FROM WISKI </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKzi.php?type=DEPARTED FROM WISKI','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">

    <div class="small-box bg-danger">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreErreurDateKzi();?>
        </h3>

        <p> DATES ERROR </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierKzi.php?type=DATES ERROR KZI','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>

    <!-- /.info-box -->
  </div>

  <div class="col-md-12 col-sm-6 col-12">
    <?php //include('graphiques/dashboardLicence.php');?>
  </div>
</div>