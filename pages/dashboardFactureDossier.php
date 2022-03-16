<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  $client = '';

  if(isset($_POST['rechercheClient'])){
    $id_mod_lic_fact = $_GET['id_mod_lic_fact'];
    $id_mod_trans = $_GET['id_mod_trans'];
    $id_cli = $_POST['id_cli'];
    $commodity = $_POST['commodity'];
    echo "<script>window.location='dashboardFactureDossier.php?id_mod_lic_fact=$id_mod_lic_fact&id_cli=$id_cli&commodity=$commodity&id_mod_trans=$id_mod_trans';</script>";
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="nav-icon fas fa-tachometer-alt"></i> DASHBOARD FACTURES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$mode_transport.$client.$type_licence.$commodity;?></h5>
          <div class="pull-right">
            <button class="btn btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
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
                <h5>
                  <?php echo $maClasse-> nbreFactureModeleLicence($_GET['id_mod_lic_fact'], $_GET['id_cli'], 'globale');?>
                </h5>

                <p> Factures Globales </p>
              </div>
              <div class="icon">
                <i class="fas fa-copy"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFactureDossier.php?type_fact=globale&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-teal">
              <div class="inner">
                <h5>
                  <?php echo '$ '.number_format($maClasse-> getMontantTotalTypeFacture($_GET['id_mod_lic_fact'], $_GET['id_cli'], 'globale'), 2, ',', ' ');?>
                </h5>

                <p> Valeurs Factures Globales </p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill"></i>
              </div>
              <!-- <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFactureDossier.php?type_fact=partielle&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-primary">
              <div class="inner">
                <h5>
                  <?php echo $maClasse-> nbreFactureModeleLicence($_GET['id_mod_lic_fact'], $_GET['id_cli'], 'partielle');?>
                </h5>

                <p> Factures Partielles </p>
              </div>
              <div class="icon">
                <i class="fas fa-copy"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFactureDossier.php?type_fact=partielle&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-info">
              <div class="inner">
                <h5>
                  <?php echo '$ '.number_format($maClasse-> getMontantTotalTypeFacture($_GET['id_mod_lic_fact'], $_GET['id_cli'], 'partielle'), 2, ',', ' ');?>
                </h5>

                <p> Valeurs Factures Partielle </p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill"></i>
              </div>
              <!-- <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFactureDossier.php?type_fact=partielle&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <div class="inner">
                <h5>
                  <?php echo $maClasse-> nbreDossierFacturesModeleLicence($_GET['id_mod_lic_fact'], $_GET['id_cli'], 'globale');?>
                </h5>

                <p> Dossiers Facturés </p>
              </div>
              <div class="icon">
                <i class="fas fa-calculator"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardDossierFactureDossier.php?id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h5>
                  <?php echo $maClasse-> nbreDossierNonFacturesModeleLicence($_GET['id_mod_lic_fact'], $_GET['id_cli']);?>
                </h5>

                <p> Dossiers Non Facturés </p>
              </div>
              <div class="icon">
                <i class="fas fa-times"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popDashboardDossierNonFacture.php?id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
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
if(isset($_GET['id_mod_lic_fact']) && isset($_GET['id_mod_lic_fact'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog">
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

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
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
