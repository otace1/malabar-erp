<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['filtrageFactureClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    $etat = $_GET['etat'];
    echo "<script>window.location='facture.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&etat=$etat';</script>";
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
  
  if( isset($_GET['etat']) && ($_GET['etat'] != '')){
    $etat = ' | '.$_GET['etat'];
  }else{
    $etat = '';
  }

  if( isset($_POST['appurement']) ){
    ?>
    <script type="text/javascript">
      window.open('appurement.php?num_lic=<?php echo $_POST['num_lic']; ?>','pop1','width=800,height=800');
    </script>
    <?php
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
          <h3><i class="fa fa-tachometer-alt nav-icon"></i> Dashboard AV/Partielle <?php echo $client;?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-12 col-sm-6 col-12">
            <h5>Consommables</h5>
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                    $etat = 'Partial Without FOB';
                    echo $maClasse-> getNombrePartielleEtat($_GET['id_cli'], '1', $etat);
                  ?>
                </h3>

                <p class="text-sm"><?php echo $etat;?></p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpPartielleDashboard.php?id_cli=<?php echo $_GET['id_cli'];?>&etat=<?php echo $etat;?>&consommable=1','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                  $etat = 'Partial Without Weight';
                    echo $maClasse-> getNombrePartielleEtat($_GET['id_cli'], '1', $etat);
                  ?>
                </h3>

                <p class="text-sm"><?php echo $etat;?></p>
              </div>
              <div class="icon">
                <!-- <i class="fa fa-weight-scale"></i> -->
                <i class="fa-sharp fa-solid fa-weight-scale"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpPartielleDashboard.php?id_cli=<?php echo $_GET['id_cli'];?>&etat=<?php echo $etat;?>&consommable=1','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                  $etat = 'Partial Having Negative FOB Balance';
                    echo $maClasse-> getNombrePartielleEtat($_GET['id_cli'], '1', $etat);
                  ?>
                </h3>

                <p class="text-sm"><?php echo $etat;?></p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-check"></i> -->
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpPartielleDashboard.php?id_cli=<?php echo $_GET['id_cli'];?>&etat=<?php echo $etat;?>&consommable=1','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                  $etat = 'Partial Having Negative Weight Balance';
                    echo $maClasse-> getNombrePartielleEtat($_GET['id_cli'], '1', $etat);
                  ?>
                </h3>

                <p class="text-sm"><?php echo $etat;?></p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-check"></i> -->
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpPartielleDashboard.php?id_cli=<?php echo $_GET['id_cli'];?>&etat=<?php echo $etat;?>&consommable=1','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                  
                  echo $maClasse-> getNombreCRFSansPartielle($_GET['id_cli'], '1');
                  ?>
                </h3>

                <p class="text-sm">Partial Missing</p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-check"></i> -->
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpCrfSansPartielle.php?id_cli=<?php echo $_GET['id_cli'];?>&consommable=1','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-12 col-sm-6 col-12">
            <h5>Divers</h5>
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                    $etat = 'Partial Without FOB';
                    echo $maClasse-> getNombrePartielleEtat($_GET['id_cli'], '0', $etat);
                  ?>
                </h3>

                <p class="text-sm"><?php echo $etat;?></p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-check"></i> -->
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpPartielleDashboard.php?id_cli=<?php echo $_GET['id_cli'];?>&etat=<?php echo $etat;?>&consommable=0','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                  $etat = 'Partial Without Weight';
                    echo $maClasse-> getNombrePartielleEtat($_GET['id_cli'], '0', $etat);
                  ?>
                </h3>

                <p class="text-sm"><?php echo $etat;?></p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-check"></i> -->
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpPartielleDashboard.php?id_cli=<?php echo $_GET['id_cli'];?>&etat=<?php echo $etat;?>&consommable=0','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                  $etat = 'Partial Having Negative FOB Balance';
                    echo $maClasse-> getNombrePartielleEtat($_GET['id_cli'], '0', $etat);
                  ?>
                </h3>

                <p class="text-sm"><?php echo $etat;?></p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-check"></i> -->
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpPartielleDashboard.php?id_cli=<?php echo $_GET['id_cli'];?>&etat=<?php echo $etat;?>&consommable=0','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                  $etat = 'Partial Having Negative Weight Balance';
                    echo $maClasse-> getNombrePartielleEtat($_GET['id_cli'], '0', $etat);
                  ?>
                </h3>

                <p class="text-sm"><?php echo $etat;?></p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-check"></i> -->
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpPartielleDashboard.php?id_cli=<?php echo $_GET['id_cli'];?>&etat=<?php echo $etat;?>&consommable=0','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-dark">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php 
                  
                  echo $maClasse-> getNombreCRFSansPartielle($_GET['id_cli'], '0');
                  ?>
                </h3>

                <p class="text-sm">Partial Missing</p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-check"></i> -->
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpCrfSansPartielle.php?id_cli=<?php echo $_GET['id_cli'];?>&consommable=1','pop1','width=1300,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

            <!-- /.card -->
          
            <!-- /.card -->
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>
  
<?php
if(isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
?>

<div class="modal fade creerFacture" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Facture <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')';?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUSCRIPTEUR</label>
            <select name="id_cli" onchange="" class="form-control cc-exp" required>
                <option></option>
                <?php
                    $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
              <input type="text" name="ref_fact" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
              <input type="date" name="date_fact" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">DATE RECEPTION FACTURE</label>
              <input type="date" name="date_fact_rec" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
            </div>

          <?php
              if($modele['id_mod_lic'] == '1' && isset($modele)){
                ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">CLIENT</label>
              <input type="text" name="fournisseur" class="form-control cc-exp" required>
            </div>
            <?php
                }else if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
              <input type="text" name="fournisseur" class="form-control cc-exp" required>
            </div>
            <?php
                }
              ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE SOUSCRIPTION LICENCE</label>
            <input type="date" name="date_val" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>
          
          <?php
            if(($modele['id_mod_lic'] == '1' || $modele['id_mod_lic'] == '2') && isset($modele)){
              ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <input type="text" name="commodity" value="N/A" class="form-control cc-exp" required>
          </div>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MONNAIE</label>
            <select name="id_mon" class="form-control cc-exp" required>
              <option></option>
              <?php
                $maClasse-> selectionnerMonnaie();
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB</label>
            <input type="number" name="montant_fact" min="0" value="0" step="0.01" class="form-control cc-exp">
          </div>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FRET</label>
            <input type="number" name="fret_fact" min="0" value="0" step="0.01" class="form-control cc-exp">
          </div>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
            <input type="number" name="assurance_fact" value="0" min="0" step="0.01" class="form-control cc-exp">
          </div>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AUTRE FRAIS</label>
            <input type="number" name="autre_frais_fact" value="0" min="0" step="0.01" class="form-control cc-exp">
          </div>
          <?php
              }
            ?>
            <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FSI</label>
              <input type="text" name="fsi" class="form-control cc-exp">
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">AUR</label>
              <input type="text" name="aur" class="form-control cc-exp">
            </div>
            <?php
                }
              ?>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FICHIER FACTURE</label>
              <input type="file" name="fichier_fact" class="form-control cc-exp" required>
            </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerFacture" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade filtrageFactureClient" id="modal-default">
  <div class="modal-dialog">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Filtrage Client.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp" required>
                <option></option>
                <?php
                    $maClasse->selectionnerClientPourFactureModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="filtrageFactureClient" class="btn btn-primary">Valider</button>
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
