<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include('dossierExcel.php');

  $client = $maClasse-> getElementClient($_GET['id_cli']);
  //$client = '';
  


  if(isset($_POST['archiver'])){

    for ($i=1; $i <= $_POST['nbre']; $i++) { 
      
      if(isset($_FILES['fichier_'.$i]['name']) && $_FILES['fichier_'.$i]['name'] != ''){
        $fichier=$_FILES['fichier_'.$i]['name'];
        $tmp=$_FILES['fichier_'.$i]['tmp_name'];
        $ref_dos = $_POST['ref_dos'];

        $maClasse-> archiver($_POST['id_dos'], $_POST['id_doc_'.$i], $fichier, $tmp, $ref_dos, $_SESSION['id_util']);
      }

    }

  }

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

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="far fa-folder-open nav-icon"></i>DOCUMENTS DOSSIER <?php echo '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$client['nom_cli'].'</span>'.$marchandise.$mode_transport.$commodity.$licence.$statut.$cleared;?></h5>
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
                <h5 class="card-title" style="font-weight: bold;">
                  <button class="btn-xs btn-danger square-btn-adjust" onclick="window.location.replace('dossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?>&page=<?php echo $_GET['page'];?>','pop1','width=80,height=80');">
                      <i class="fas fa-angle-double-left"></i> RETOUR
                  </button>
                
                </h5>
                  <div class="card-tools">

                  </div>
              </div>
              <!-- /.card-header -->

    <div id="alert_message"></div>

              <div class="card-body table-responsive p-0">
                <?php
                  include('../classes/modalDocumentsDossier.php');
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