<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
  $client = '';
  if(isset($_POST['rechercheClient1'])){
    $id_mod_trac = $_GET['id_mod_trac'];
    $id_march = $_GET['id_march'];
    $id_cli = $_POST['id_cli'];
    $id_mod_trans = $_GET['id_mod_trans'];
    echo "<script>window.location='dossier.php?id_march=$id_march&id_mod_trac=$id_mod_trac&id_cli=$id_cli&id_mod_trans=$id_mod_trans';</script>";
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
  }
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | '.$maClasse-> getNomClient($_GET['id_cli']);
  }else{
    $client = '';
  }
  if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
    $mode_transport = ' | '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']);
  }else{
    $mode_transport = '';
  }

  if(isset($_POST['update'])){

    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

      if (isset($_POST['mca_b_ref_'.$i]) && ($_POST['mca_b_ref_'.$i] != '')) {
        $maClasse-> MAJ_mca_b_ref($_POST['id_dos_'.$i], $_POST['mca_b_ref_'.$i]);
      }

      if (isset($_POST['ref_decl_'.$i]) && ($_POST['ref_decl_'.$i] != '')) {
        $maClasse-> MAJ_ref_decl($_POST['id_dos_'.$i], $_POST['ref_decl_'.$i]);
      }

      if (isset($_POST['date_decl_'.$i]) && ($_POST['date_decl_'.$i] != '')) {
        $maClasse-> MAJ_date_decl($_POST['id_dos_'.$i], $_POST['date_decl_'.$i]);
      }

      if (isset($_POST['ref_liq_'.$i]) && ($_POST['ref_liq_'.$i] != '')) {
        $maClasse-> MAJ_ref_liq($_POST['id_dos_'.$i], $_POST['ref_liq_'.$i]);
      }

      if (isset($_POST['date_liq_'.$i]) && ($_POST['date_liq_'.$i] != '')) {
        $maClasse-> MAJ_date_liq($_POST['id_dos_'.$i], $_POST['date_liq_'.$i]);
      }

      if (isset($_POST['ref_quit_'.$i]) && ($_POST['ref_quit_'.$i] != '')) {
        $maClasse-> MAJ_ref_quit($_POST['id_dos_'.$i], $_POST['ref_quit_'.$i]);
      }

      if (isset($_POST['date_quit_'.$i]) && ($_POST['date_quit_'.$i] != '')) {
        $maClasse-> MAJ_date_quit($_POST['id_dos_'.$i], $_POST['date_quit_'.$i]);
      }

      if (isset($_POST['montant_decl_'.$i]) && ($_POST['montant_decl_'.$i] != '')) {
        $maClasse-> MAJ_montant_decl($_POST['id_dos_'.$i], $_POST['montant_decl_'.$i]);
      }

      if (isset($_POST['fret_dos_'.$i]) && ($_POST['fret_dos_'.$i] != '')) {
        $maClasse-> MAJ_fret_dos($_POST['id_dos_'.$i], $_POST['fret_dos_'.$i]);
      }

      if (isset($_POST['assurance_dos_'.$i]) && ($_POST['assurance_dos_'.$i] != '')) {
        $maClasse-> MAJ_assurance_dos($_POST['id_dos_'.$i], $_POST['assurance_dos_'.$i]);
      }

      if (isset($_POST['autre_frais_dos_'.$i]) && ($_POST['autre_frais_dos_'.$i] != '')) {
        $maClasse-> MAJ_autre_frais_dos($_POST['id_dos_'.$i], $_POST['autre_frais_dos_'.$i]);
      }
      //----
      if (isset($_POST['t1_'.$i]) && ($_POST['t1_'.$i] != '')) {
        $maClasse-> MAJ_t1($_POST['id_dos_'.$i], $_POST['t1_'.$i]);
      }

      if (isset($_POST['poids_'.$i]) && ($_POST['poids_'.$i] != '')) {
        $maClasse-> MAJ_poids($_POST['id_dos_'.$i], $_POST['poids_'.$i]);
      }
      
      if (isset($_POST['horse_'.$i]) && ($_POST['horse_'.$i] != '')) {
        $maClasse-> MAJ_horse($_POST['id_dos_'.$i], $_POST['horse_'.$i]);
      }
      
      if (isset($_POST['trailer_1_'.$i]) && ($_POST['trailer_1_'.$i] != '')) {
        $maClasse-> MAJ_trailer_1($_POST['id_dos_'.$i], $_POST['trailer_1_'.$i]);
      }
      
      if (isset($_POST['trailer_2_'.$i]) && ($_POST['trailer_2_'.$i] != '')) {
        $maClasse-> MAJ_trailer_2($_POST['id_dos_'.$i], $_POST['trailer_2_'.$i]);
      }
      
      if (isset($_POST['klsa_arriv_'.$i]) && ($_POST['klsa_arriv_'.$i] != '')) {
        $maClasse-> MAJ_klsa_arriv($_POST['id_dos_'.$i], $_POST['klsa_arriv_'.$i]);
      }
      
      if (isset($_POST['crossing_date_'.$i]) && ($_POST['crossing_date_'.$i] != '')) {
        $maClasse-> MAJ_crossing_date($_POST['id_dos_'.$i], $_POST['crossing_date_'.$i]);
      }
      
      if (isset($_POST['wiski_arriv_'.$i]) && ($_POST['wiski_arriv_'.$i] != '')) {
        $maClasse-> MAJ_wiski_arriv($_POST['id_dos_'.$i], $_POST['wiski_arriv_'.$i]);
      }
      
      if (isset($_POST['wiski_dep_'.$i]) && ($_POST['wiski_dep_'.$i] != '')) {
        $maClasse-> MAJ_wiski_dep($_POST['id_dos_'.$i], $_POST['wiski_dep_'.$i]);
      }
      
      if (isset($_POST['ref_crf_'.$i]) && ($_POST['ref_crf_'.$i] != '')) {
        $maClasse-> MAJ_ref_crf($_POST['id_dos_'.$i], $_POST['ref_crf_'.$i]);
      }
      
      if (isset($_POST['date_crf_'.$i]) && ($_POST['date_crf_'.$i] != '')) {
        $maClasse-> MAJ_date_crf($_POST['id_dos_'.$i], $_POST['date_crf_'.$i]);
      }
      
      if (isset($_POST['dgda_in_'.$i]) && ($_POST['dgda_in_'.$i] != '')) {
        $maClasse-> MAJ_dgda_in($_POST['id_dos_'.$i], $_POST['dgda_in_'.$i]);
      }
      
      if (isset($_POST['dgda_out_'.$i]) && ($_POST['dgda_out_'.$i] != '')) {
        $maClasse-> MAJ_dgda_out($_POST['id_dos_'.$i], $_POST['dgda_out_'.$i]);
      }

      if (isset($_POST['date_preal_'.$i]) && ($_POST['date_preal_'.$i] != '')) {
        $maClasse-> MAJ_date_preal($_POST['id_dos_'.$i], $_POST['date_preal_'.$i]);
      }

      if (isset($_POST['po_ref_'.$i]) && ($_POST['po_ref_'.$i] != '')) {
        $maClasse-> MAJ_po_ref($_POST['id_dos_'.$i], $_POST['po_ref_'.$i]);
      }
      
      if (isset($_POST['road_manif_'.$i]) && ($_POST['road_manif_'.$i] != '')) {
        $maClasse-> MAJ_road_manif($_POST['id_dos_'.$i], $_POST['road_manif_'.$i]);
      }
      
      if (isset($_POST['arr_bond_'.$i]) && ($_POST['arr_bond_'.$i] != '')) {
        $maClasse-> MAJ_arr_bond($_POST['id_dos_'.$i], $_POST['arr_bond_'.$i]);
      }
      
      if (isset($_POST['custom_deliv_'.$i]) && ($_POST['custom_deliv_'.$i] != '')) {
        $maClasse-> MAJ_custom_deliv($_POST['id_dos_'.$i], $_POST['custom_deliv_'.$i]);
      }
      
      if (isset($_POST['lshi_arriv_'.$i]) && ($_POST['lshi_arriv_'.$i] != '')) {
        $maClasse-> MAJ_lshi_arriv($_POST['id_dos_'.$i], $_POST['lshi_arriv_'.$i]);
      }
      
      if (isset($_POST['dispatch_klsa_'.$i]) && ($_POST['dispatch_klsa_'.$i] != '')) {
        $maClasse-> MAJ_dispatch_klsa($_POST['id_dos_'.$i], $_POST['dispatch_klsa_'.$i]);
      }
      
      if (isset($_POST['dispatch_deliv_'.$i]) && ($_POST['dispatch_deliv_'.$i] != '')) {
        $maClasse-> MAJ_dispatch_deliv($_POST['id_dos_'.$i], $_POST['dispatch_deliv_'.$i]);
      }
      
      if (isset($_POST['arrival_date_'.$i]) && ($_POST['arrival_date_'.$i] != '')) {
        $maClasse-> MAJ_arrival_date($_POST['id_dos_'.$i], $_POST['arrival_date_'.$i]);
      }
      
      if (isset($_POST['cleared_'.$i]) && ($_POST['cleared_'.$i] != '')) {
        $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], $_POST['cleared_'.$i]);
      }
      
      /*if (isset($_POST['_'.$i]) && ($_POST['_'.$i] != '')) {
        $maClasse-> MAJ_($_POST['id_dos_'.$i], $_POST['_'.$i]);
      }*/

    }

    ?>
    <script type="text/javascript">
      alert('Mises à jour éffectuées avec succès!')
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
          <h3><i class="far fa-folder-open nav-icon"></i> DOSSIERS <?php echo $marchandise['nom_march'].$client.$mode_transport;?></h3>
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
                  <?php
                    if(isset($_POST['creerDossier'])){
                        if($_GET['id_mod_trac'] == '2'){
                          $maClasse-> creerDossierIB($_POST['ref_dos'], $_POST['id_cli'], $_POST['ref_fact'], 
                                                      $_POST['fob'], NULL, NULL, 
                                                      NULL, $_POST['num_lic'], $_GET['id_mod_trac'], 
                                                      $_GET['id_march'], $_GET['id_mod_trans'],
                                                      $_POST['ref_av'], $_POST['cod']);
                        }
                        /*
                        ?>
                        <script type="text/javascript">
                            alert('Agent <?php echo $_POST['nom_ag'].' '.$_POST['postnom_ag'].' '.$_POST['prenom_ag'];?> créé avec succes!');
                        </script>
                        <?php
                        */
                    }
                  ?>
                <button class="btn btn-primary square-btn-adjust" data-toggle="modal" data-target=".nouveauDossier">
                    <i class="fa fa-plus"></i> Nouveau Dossier
                </button>
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient1">
                    <i class="fa fa-filter"></i> Recherche
                </button>
                </h3>
                  <div class="card-tools">
                <form method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input type="text" name="" class="form-control float-right" placeholder="Entrez le numéro">

                      <div class="input-group-append">
                        <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                </form>
                    <div class="pull-right">
                      <!--<i class="fa fa-circle text-success"></i>--> <span class="badge badge-success">Appurée</span>
                      <!--<i class="fa fa-circle text-info"></i>--> <span class="badge badge-info">Partiellement</span>
                      <!--<i class="fa fa-circle text-danger"></i>--> <span class="badge badge-danger">Expiree</span>
                    </div>

                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                  <thead>
                    <?php
                      if ($maClasse-> getStructureTracking($_GET['id_march']) == '1') {
                        include("enTeteAcid.php");
                      }else if ($maClasse-> getStructureTracking($_GET['id_march']) == '2') {
                        include("enTeteDivers.php");
                      }else{
                        include("enTeteDossier.php");
                      }
                    ?>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                      if(!isset($_GET['id_cli'])){
                        $_GET['id_cli'] = null;
                      }
                      if(!isset($_GET['id_mod_trans'])){
                        $_GET['id_mod_trans'] = null;
                      }
                      $maClasse-> afficherDossier($_GET['id_march'], $_GET['id_cli'], $_GET['id_mod_trans']);
                    ?>
                    </form>
                  </tbody>
                </table>
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