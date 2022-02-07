<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include('dossierExcel.php');


  //$client = '';
  
  $client = $maClasse-> getElementClient($_GET['id_cli']);


  if( isset($_GET['id_march']) && ($_GET['id_march'] != '')){
    $marchandise = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getMarchandise($_GET['id_march']).'</span>';
  }else{
    $marchandise = '';
    $_GET['id_march'] = NULL;
  }

  if( isset($_GET['num_lic']) && ($_GET['num_lic'] != '')){
    $licence = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['num_lic'].'</span>';
  }else{
    $licence = '';
    $_GET['num_lic'] = NULL;
  }


  if( isset($_GET['statut']) && ($_GET['statut'] != '')){
    $statut = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['statut'].'</span>';
  }else{
    $statut = '';
    $_GET['statut'] = NULL;
  }

  if( isset($_GET['cleared']) && ($_GET['cleared'] != '')){
    if ($_GET['cleared'] == '0') {
      $cleared = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">TRANSIT</span>';
    }else if ($_GET['cleared'] == '1') {
      $cleared = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">CLEARED</span>';
    }if ($_GET['cleared'] == '2') {
      $cleared = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">CANCELLED</span>';
    }
  }else{
    $cleared = '';
    $_GET['cleared'] = NULL;
  }


  if( isset($_POST['rechercheMarchandise']) ){
    ?>
    <script type="text/javascript">
      window.location = 'dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_POST['commodity'];?>&statut=<?php echo $_GET['statut'];?>&cleared=<?php echo $_GET['cleared'];?>';
    </script>
    <?php
  }

  if( isset($_POST['rechercheStatus']) ){
    ?>
    <script type="text/javascript">
      window.location = 'dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>&statut=<?php echo $_POST['statut'];?>&cleared=<?php echo $_GET['cleared'];?>';
    </script>
    <?php
  }

  if( isset($_POST['rechercheClearingStatus']) ){
    ?>
    <script type="text/javascript">
      window.location = 'dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>&statut=<?php echo $_GET['statut'];?>&cleared=<?php echo $_POST['cleared'];?>';
    </script>
    <?php
  }

  if( isset($_POST['rechercheClientLicence']) ){
    ?>
    <script type="text/javascript">
      window.location = 'dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_POST['num_lic'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>&statut=<?php echo $_GET['statut'];?>&cleared=<?php echo $_GET['cleared'];?>';
    </script>
    <?php
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


  if(isset($_POST['updateDossier'])){

      $maClasse-> MAJ_ref_dos($_POST['id_dos'], $_POST['ref_dos']);
      $maClasse-> MAJ_fob($_POST['id_dos'], $_POST['fob']);
      $maClasse-> MAJ_fret($_POST['id_dos'], $_POST['fret']);
      $maClasse-> MAJ_assurance($_POST['id_dos'], $_POST['assurance']);
      $maClasse-> MAJ_autre_frais($_POST['id_dos'], $_POST['autre_frais']);
      $maClasse-> updateFile($_POST['id_dos'], $_GET['id_cli'], $_GET['id_mod_trans'], 
                                      $_GET['id_mod_trac']);

    $id_cli = $_GET['id_cli'];
    $id_mod_trans = $_GET['id_mod_trans'];
    $id_mod_trac = $_GET['id_mod_trac'];
    $commodity = $_GET['commodity'];
    $statut = $_GET['statut'];
    $id_march = $_GET['id_march'];
    //header("Location: dossier.php?id_cli=$id_cli&id_mod_trans=$id_mod_trans&id_mod_trac=$id_mod_trac&commodity=$commodity&statut=$statut&id_march=$id_march");
    
    ?>
    <script type="text/javascript">
      // Simulate a mouse click:
      alert('Mises à jour éffectuées avec succès!');
      window.location.href = "dossier.php?id_cli=<?php echo $id_cli; ?>&id_mod_trans=<?php echo $id_mod_trans; ?>&id_mod_trac=<?php echo $id_mod_trac; ?>&commodity=<?php echo $commodity; ?>&statut=<?php echo $statut; ?>&id_march=<?php echo $id_march; ?>";

      /*window.location.replace('dossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?>&id_dos=<?php echo $reponse['id_dos'];?>');*/
    </script>
    <?php
  }


  if(isset($_POST['creerDossier'])){
    if($_GET['id_mod_trac'] == '2'){

      if ($_GET['id_cli'] == 869 && $_GET['id_march'] == 6 && $_GET['id_mod_trac'] == 2) {

        for ($i=1; $i <= $_POST['nbre'] ; $i++) {

          if ( isset($_POST['ref_dos_'.$i]) && ($_POST['ref_dos_'.$i]!='') && isset($_POST['num_lic_'.$i]) && ($_POST['num_lic_'.$i]!='') && isset($_POST['poids_'.$i]) && ($_POST['poids_'.$i] != '') ) {

            $maClasse-> creerDossierIBAcid($_POST['ref_dos_'.$i], $_GET['id_cli'], 
                                    $_POST['ref_fact_'.$i], $_POST['t1_'.$i], 
                                    $_POST['poids_'.$i], $_POST['num_lic_'.$i], 
                                    $_GET['id_mod_trac'], $_GET['id_march'], 
                                    $_GET['id_mod_trans'], $_SESSION['id_util'], 
                                    $_POST['horse_'.$i], $_POST['trailer_1_'.$i], 
                                    $_POST['trailer_2_'.$i], $_POST['klsa_arriv_'.$i], 
                                    $_POST['crossing_date_'.$i], 
                                    $_POST['wiski_arriv_'.$i], $_POST['wiski_dep_'.$i],
                                    $_POST['ref_crf_'.$i], $_POST['date_crf_'.$i]);
          }

        }

      }else{

        $maClasse-> creerDossierIB($_POST['ref_dos'], $_GET['id_cli'], $_POST['ref_fact'], 
                                  $_POST['fob'],$_POST['fret'], $_POST['assurance'], 
                                  $_POST['autre_frais'], $_POST['num_lic'], $_GET['id_mod_trac'], 
                                  $_GET['id_march'], $_GET['id_mod_trans'],
                                  NULL, $_POST['cod'], $_SESSION['id_util'],
                                  $_POST['road_manif'], $_POST['date_preal'], $_POST['t1'], 
                                  $_POST['poids'], $_POST['po_ref'], $_POST['commodity'], 
                                  $_POST['horse'], $_POST['trailer_1'], $_POST['trailer_2'], 
                                  $_POST['cod'], $_POST['date_crf'], NULL, $_POST['supplier']);

      }

    }
    else if($_GET['id_mod_trac'] == '1'){

      for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
        /*
      ?>
      <script type="text/javascript">
        alert("Hello");
      </script>
      <?php
      */
        if ( isset($_POST['ref_dos_'.$i]) && ($_POST['ref_dos_'.$i]!='') && isset($_POST['num_lic_'.$i]) && ($_POST['num_lic_'.$i]!='') && isset($_POST['num_lot_'.$i]) && ($_POST['num_lot_'.$i] != '') ) {

          $maClasse-> creerDossierEB($_POST['ref_dos_'.$i], $_GET['id_cli'], 
                                $_POST['num_lic_'.$i], $_GET['id_march'], 
                                1, $_GET['id_mod_trans'], 
                                $_SESSION['id_util'], $_POST['num_lot_'.$i], 
                                $_POST['horse_'.$i], $_POST['trailer_1_'.$i], 
                                $_POST['trailer_2_'.$i], $_POST['site_load_'.$i], 
                                $_POST['destination_'.$i], $_POST['transporter_'.$i], 
                                $_POST['nbr_bags_'.$i], $_POST['poids_'.$i], 
                                $_POST['load_date_'.$i], $_POST['dgda_seal_'.$i]);

        }

      }

    }
    
    ?>
    <script type="text/javascript">
      // Simulate a mouse click:
      alert('Dossier créé avec succès!');
      window.location.href = "dossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut']; ?>&id_march=<?php echo $_GET['id_march']; ?>";
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
          <h3><i class="far fa-folder nav-icon"></i> NOUVEAU DOSSIERS <?php echo '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$client['nom_cli'].'</span>'.$marchandise.$mode_transport.$commodity.$licence.$statut.$cleared;?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                  <button class="btn btn-danger square-btn-adjust" onclick="window.location.replace('dossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?>','pop1','width=80,height=80');">
                      <i class="fas fa-angle-double-left"></i> GO BACK
                  </button>
                
                </h3>
                  <div class="card-tools">

                  </div>
              </div>
              <!-- /.card-header -->

    <div id="alert_message"></div>

              <div class="card-body table-responsive p-0">
                <?php
                  include('modalNouveauDossier.php');
                ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>