<div class="row">

  <div class="col-md-12 col-sm-6 col-12">
    <h4>
      AIRPORT
    </h4>
  </div>

 <div class="col-md-3 col-sm-6 col-12">
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreStatutDossierAir($_GET['id_mod_trac'], $_GET['id_cli'], 'EXPECTED ARRIVAL');?>
        </h3>

        <p style="font-size: 100%;"> EXPECTED ARRIVAL </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popStatutDossierAir.php?statut=EXPECTED ARRIVAL&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
    <!-- /.info-box -->
  </div>

 <div class="col-md-3 col-sm-6 col-12">
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreStatutDossierAir($_GET['id_mod_trac'], $_GET['id_cli'], 'AWAITING ENTRY TO WAREHOUSE');?>
        </h3>

        <p style="font-size: 100%;"> AWAITING ENTRY TO WAREHOUSE </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popStatutDossierAir.php?statut=AWAITING ENTRY TO WAREHOUSE&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
    <!-- /.info-box -->
  </div>

 <div class="col-md-3 col-sm-6 col-12">
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreStatutDossierAir($_GET['id_mod_trac'], $_GET['id_cli'], 'AWAITING TO LEAVE THE WAREHOUSE');?>
        </h3>

        <p style="font-size: 100%;"> AWAITING TO LEAVE THE WAREHOUSE </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popStatutDossierAir.php?statut=AWAITING TO LEAVE THE WAREHOUSE&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
    <!-- /.info-box -->
  </div>

 <div class="col-md-3 col-sm-6 col-12">
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3>
          <?php echo $maClasse-> nbreStatutDossierAir($_GET['id_mod_trac'], $_GET['id_cli'], 'AWAITING DISPATCH FROM THE BORDER');?>
        </h3>

        <p style="font-size: 100%;"> AWAITING DISPATCH FROM THE BORDER </p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="#" class="small-box-footer" onclick="window.open('popStatutDossierAir.php?statut=AWAITING DISPATCH FROM THE BORDER&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
    <!-- /.info-box -->
  </div>

</div>