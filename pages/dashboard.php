<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='dashboard.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="nav-icon fas fa-tachometer-alt"></i> DASHBOARD LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client.$type_licence;?></h3>
          <div class="pull-right">
            <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                <i class="fa fa-filter"></i> Filtrage
            </button>
<!-- 
            <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportDashboardLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>','pop1','width=80,height=80');">
              <i class="fas fa-file-excel"></i> Export Excel
            </button> -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php echo $maClasse-> getNombreLicenceEnCoursModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);?>
                </h3>

                <p>Licence(s) En Cours</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardLicence.php?type=EN COURS&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <script type="text/javascript"> 
                  <?php
                  if($maClasse-> getNombreLicenceExpiration40JoursModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0){ ?>
                     var clignotement = function(){ 
                       if (document.getElementById('DivClignotante').style.visibility=='visible'){ 
                          document.getElementById('DivClignotante').style.visibility='hidden'; 
                          document.getElementById('DivClignotante2').style.visibility='hidden'; 
                       } 
                       else{ 
                       document.getElementById('DivClignotante').style.visibility='visible'; 
                       document.getElementById('DivClignotante2').style.visibility='visible'; 
                       } 
                    }; 
                  <?php } ?>
                 

                  // mise en place de l appel de la fonction toutes les 0.8 secondes 
                  // Pour arrêter le clignotement : clearInterval(periode); 
                  periode = setInterval(clignotement, 800); 
                </script>
              <div class="inner">
                <h3 id="DivClignotante" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreLicenceExpiration40JoursModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
                  ?>
                </h3>

                <p>Echéance - 40 jours</p>
              </div>
              <div class="icon" id="DivClignotante2" style="visibility:visible;">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardLicence.php?type=EXTREME VALIDATION -40 JOURS&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

              <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <script type="text/javascript"> 
                  <?php
                  if($maClasse-> getNombreLicenceExpireModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0){ ?>
                     var clignotement = function(){ 
                       if (document.getElementById('DivClignotante3').style.visibility=='visible'){ 
                          document.getElementById('DivClignotante3').style.visibility='hidden'; 
                          document.getElementById('DivClignotante4').style.visibility='hidden'; 
                       } 
                       else{ 
                       document.getElementById('DivClignotante3').style.visibility='visible'; 
                       document.getElementById('DivClignotante4').style.visibility='visible'; 
                       } 
                    }; 
                  <?php } ?>
                 

                  // mise en place de l appel de la fonction toutes les 0.8 secondes 
                  // Pour arrêter le clignotement : clearInterval(periode); 
                  periode = setInterval(clignotement, 800); 
                </script>
              <div class="inner">
                <h3 id="DivClignotante3" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreLicenceExpireModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
                  ?>
                </h3>

                <p>Licence(s) Expirées</p>
              </div>
              <div class="icon" id="DivClignotante4" style="visibility:visible;">
                <i class="fas fa-times"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardLicence.php?type=EXPIRES&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

              <!-- /.info-box -->
          </div>
            <!-- /.card -->
          
          <?php
          if ($_GET['id_mod_lic'] != '1') {
          ?>
          
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-teal">
              <div class="inner">
                <h3 id="DivClignotante3a" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreLicenceCIFLicenceDifferentCIFDossier($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
                  ?>
                </h3>

                <p>CIF licence &#8800; CIF dossier(s)</p>
              </div>
              <div class="icon" id="DivClignotante4a" style="visibility:visible;">
                <i class="fas fa-not-equal"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardLicence.php?type=CIF LICENCE DIFFERENT CIF DOSSIER(S)&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

              <!-- /.info-box -->
          </div>
          <?php
          }
          ?>
            <!-- /.card -->
          
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 id="" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreLicenceClotureeAppureeModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
                  ?>
                </h3>

                <p>Licence(s) Cloturées Tracking Attente Apurement</p>
              </div>
              <div class="icon" id="" style="visibility:visible;">
                <i class="fas fa-exclamation"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardLicence.php?type=APPUREES TRACKING ATTENTE BANQUE&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

              <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-success">
              <script type="text/javascript"> 
                  /*<?php
                  if($maClasse-> getNombreLicenceClotureeAppureeModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0){ ?>
                     var clignotement = function(){ 
                       if (document.getElementById('DivClignotante5').style.visibility=='visible'){ 
                          document.getElementById('DivClignotante5').style.visibility='hidden'; 
                          document.getElementById('DivClignotante6').style.visibility='hidden'; 
                       } 
                       else{ 
                       document.getElementById('DivClignotante5').style.visibility='visible'; 
                       document.getElementById('DivClignotante6').style.visibility='visible'; 
                       } 
                    }; 
                  <?php } ?>
                 

                  // mise en place de l appel de la fonction toutes les 0.8 secondes 
                  // Pour arrêter le clignotement : clearInterval(periode); 
                  periode = setInterval(clignotement, 800); */
                </script>
              <div class="inner">
                <h3 id="" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreLicenceClotureeTrackingAttenteBanqueAppureeModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
                  ?>
                </h3>

                <p>Licence(s) Appurées Paritiel / Total</p>
              </div>
              <div class="icon" id="" style="visibility:visible;">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardLicence.php?type=APPUREES PAR BANQUE&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>','pop1','width=1500,height=900');">
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
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
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
