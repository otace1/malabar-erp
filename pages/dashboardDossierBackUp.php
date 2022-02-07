<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  $client = '';

  if(isset($_POST['rechercheClient'])){
    $id_mod_trac = $_GET['id_mod_trac'];
    $id_mod_trans = $_GET['id_mod_trans'];
    $id_cli = $_POST['id_cli'];
    $commodity = $_POST['commodity'];
    echo "<script>window.location='dashboardDossier.php?id_mod_trac=$id_mod_trac&id_cli=$id_cli&commodity=$commodity&id_mod_trans=$id_mod_trans';</script>";
    if( $id_cli > 0){
      $client = ' | '.$maClasse-> getNomClient($id_cli);
    }else{
      $client = '';
    }

    if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
      $mode_transport = ' | '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']);
    }else{
      $mode_transport = '';
    }

    if( isset($_GET['commodity']) && ($_GET['commodity'] != '')){
      $commodity = ' | '.$_GET['commodity'];
    }else{
      $commodity = '';
    }

  }

  if( isset($_GET['commodity']) && ($_GET['commodity'] != '')){
    $commodity = ' | '.$_GET['commodity'];
  }else{
    $commodity = '';
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

  if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
    $mode_transport = ' | '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']);
  }else{
    $mode_transport = '';
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
          <h3><i class="nav-icon fas fa-tachometer-alt"></i> DASHBOARD DOSSIERS <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$mode_transport.$client.$type_licence.$commodity;?></h3>
          <div class="pull-right">
            <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                <i class="fa fa-filter"></i> Filtrage
            </button>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
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
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=TOTAL FILES&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
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
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=CLEARING COMPLETED&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
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
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=FILES IN PROCESS&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
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
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=CANCELLED&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-12 col-sm-6 col-12">
            <hr>
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreDossierKlsaToDay($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> KASUMBALESA </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=KASUMBALESA&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreWiskiArrived($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> WISKI ARRIVAL </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=WISKI ARRIVAL&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-teal">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreUnderWiski($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> UNDER PROCESS AT WISKI </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=UNDER PROCESS AT WISKI&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreWiskiDeparture($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> WISKI DEPARTURE </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=WISKI DEPARTURE&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
   
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-teal">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreAwaitCRF($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> AWAIT CRF </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=AWAIT CRF&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreDgdaIn($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> DGDA IN </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=DGDA IN&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
   
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-teal">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreUnderDgda($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> UNDER PROCESS AT DGDA </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=UNDER PROCESS AT DGDA&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-teal">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreDossierLiquidation($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> LIQUIDATED / AWAIT QUITTANCE </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=LIQUIDATED / AWAIT QUITTANCE&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-teal">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreDossierQuittance($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> QUITTANCE </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=QUITTANCE&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-teal">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreDgdaOut($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> DGDA OUT </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=DGDA OUT&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> nbreDossierClearedWaitFacture($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>
                </h3>

                <p> FILES CLEARED WAITING INVOICE </p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossier.php?type=FILES CLEARED WAITING INVOICE&id_mod_lic=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
   


          <div class="col-md-12 col-sm-6 col-12">
            <?php //include('graphiques/dashboardLicence.php');?>
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

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
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
?>
