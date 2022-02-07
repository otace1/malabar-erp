<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include('dossierExcel.php');

  $client = $maClasse-> getElementClient($_GET['id_cli']);
  //$client = '';
  


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

  if(isset($_POST['updateMultipleFiles'])){

    if ($_GET['id_mod_trac'] == 1) {

      $maClasse-> updateMultipleFilesExport($_POST['debut'], $_POST['fin'], $_GET['id_cli'], $_GET['id_mod_trans'], 
                                      $_GET['id_mod_trac']);

      //$increment=0;
      /*foreach ($maClasse->getNameRowUpdate($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans']) as $champCol) {
        echo '<br>----------------------------'.$champCol.' = '.$maClasse-> getRowUpdate($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'])[$increment];
        $increment++;
      }*/

    }elseif ($_GET['id_mod_trac'] == 2) {
      $maClasse-> updateMultipleFiles($_POST['debut'], $_POST['fin'], $_POST['klsa_arriv'], 
                                    $_POST['crossing_date'], $_POST['wiski_arriv'], $_POST['wiski_dep'], 
                                    $_POST['amicong_arriv'], $_POST['insp_receiv'], $_POST['ir'], 
                                    $_POST['ref_crf'], $_POST['date_crf'], $_POST['dgda_in'], $_POST['ref_decl'], 
                                    $_POST['ref_liq'], $_POST['date_liq'], $_POST['ref_quit'], 
                                    $_POST['date_quit'], $_POST['custom_deliv'], $_POST['cleared'], 
                                    $_POST['dispatch_deliv'], $_POST['statut'], $_POST['remarque'], 
                                    $_POST['nbre'], $_GET['id_cli'], $_GET['id_mod_trans'], 
                                    $_GET['id_mod_trac'], $_GET['commodity']);
    }
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
        if ($_GET['id_mod_trac'] == '2') {
          //$maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
        }
      }

      if (isset($_POST['date_quit_'.$i]) && ($_POST['date_quit_'.$i] != '')) {
        $maClasse-> MAJ_date_quit($_POST['id_dos_'.$i], $_POST['date_quit_'.$i]);
        if ($_GET['id_mod_trac'] == '2') {
          $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
        }
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
        if ($_GET['id_mod_trac'] == '2') {
          $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
        }
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

      if (isset($_POST['ref_fact_'.$i]) && ($_POST['ref_fact_'.$i] != '')) {
        $maClasse-> MAJ_ref_fact($_POST['id_dos_'.$i], $_POST['ref_fact_'.$i]);
      }

      if (isset($_POST['commodity_'.$i]) && ($_POST['commodity_'.$i] != '')) {
        $maClasse-> MAJ_commodity($_POST['id_dos_'.$i], $_POST['commodity_'.$i]);
      }

      if (isset($_POST['fob_'.$i]) && ($_POST['fob_'.$i] != '')) {
        $maClasse-> MAJ_fob($_POST['id_dos_'.$i], $_POST['fob_'.$i]);
      }

      if (isset($_POST['fret_'.$i]) && ($_POST['fret_'.$i] != '')) {
        $maClasse-> MAJ_fret($_POST['id_dos_'.$i], $_POST['fret_'.$i]);
      }

      if (isset($_POST['assurance_'.$i]) && ($_POST['assurance_'.$i] != '')) {
        $maClasse-> MAJ_assurance($_POST['id_dos_'.$i], $_POST['assurance_'.$i]);
      }

      if (isset($_POST['autre_frais_'.$i]) && ($_POST['autre_frais_'.$i] != '')) {
        $maClasse-> MAJ_autre_frais($_POST['id_dos_'.$i], $_POST['autre_frais_'.$i]);
      }

      if (isset($_POST['statut_'.$i]) && ($_POST['statut_'.$i] != '')) {
        $maClasse-> MAJ_statut($_POST['id_dos_'.$i], $_POST['statut_'.$i]);
      }

      if (isset($_POST['remarque_'.$i]) && ($_POST['remarque_'.$i] != '')) {
        $maClasse-> MAJ_remarque($_POST['id_dos_'.$i], $_POST['remarque_'.$i]);
      }

      if (isset($_POST['cleared_'.$i]) && ($_POST['cleared_'.$i] != '')) {
        $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], $_POST['cleared_'.$i]);
      }

      
      if (isset($_POST['amicongo_arriv_'.$i]) && ($_POST['amicongo_arriv_'.$i] != '')) {
        $maClasse-> MAJ_amicongo_arriv($_POST['id_dos_'.$i], $_POST['amicongo_arriv_'.$i]);
      }

      if (isset($_POST['insp_receiv_'.$i]) && ($_POST['insp_receiv_'.$i] != '')) {
        $maClasse-> MAJ_insp_receiv($_POST['id_dos_'.$i], $_POST['insp_receiv_'.$i]);
      }

      if (isset($_POST['ir_'.$i]) && ($_POST['ir_'.$i] != '')) {
        $maClasse-> MAJ_ir($_POST['id_dos_'.$i], $_POST['ir_'.$i]);
      }

      if (isset($_POST['supplier_'.$i]) && ($_POST['supplier_'.$i] != '')) {
        $maClasse-> MAJ_supplier($_POST['id_dos_'.$i], $_POST['supplier_'.$i]);
      }


      //------ Ajout Exportation 

      if (isset($_POST['pv_mine_'.$i]) && ($_POST['pv_mine_'.$i] != '')) {
        $maClasse-> MAJ_pv_mine($_POST['id_dos_'.$i], $_POST['pv_mine_'.$i]);
      }

      if (isset($_POST['demande_attestation_'.$i]) && ($_POST['demande_attestation_'.$i] != '')) {
        $maClasse-> MAJ_demande_attestation($_POST['id_dos_'.$i], $_POST['demande_attestation_'.$i]);
      }

      if (isset($_POST['assay_date_'.$i]) && ($_POST['assay_date_'.$i] != '')) {
        $maClasse-> MAJ_assay_date($_POST['id_dos_'.$i], $_POST['assay_date_'.$i]);
      }

      if (isset($_POST['ceec_in_'.$i]) && ($_POST['ceec_in_'.$i] != '')) {
        $maClasse-> MAJ_ceec_in($_POST['id_dos_'.$i], $_POST['ceec_in_'.$i]);
      }

      if (isset($_POST['ceec_out_'.$i]) && ($_POST['ceec_out_'.$i] != '')) {
        $maClasse-> MAJ_ceec_out($_POST['id_dos_'.$i], $_POST['ceec_out_'.$i]);
      }

      if (isset($_POST['min_div_in_'.$i]) && ($_POST['min_div_in_'.$i] != '')) {
        $maClasse-> MAJ_min_div_in($_POST['id_dos_'.$i], $_POST['min_div_in_'.$i]);
      }

      if (isset($_POST['min_div_out_'.$i]) && ($_POST['min_div_out_'.$i] != '')) {
        $maClasse-> MAJ_min_div_out($_POST['id_dos_'.$i], $_POST['min_div_out_'.$i]);
      }

      if (isset($_POST['gov_in_'.$i]) && ($_POST['gov_in_'.$i] != '')) {
        $maClasse-> MAJ_gov_in($_POST['id_dos_'.$i], $_POST['gov_in_'.$i]);
      }

      if (isset($_POST['gov_out_'.$i]) && ($_POST['gov_out_'.$i] != '')) {
        $maClasse-> MAJ_gov_out($_POST['id_dos_'.$i], $_POST['gov_out_'.$i]);
      }

      if (isset($_POST['dispatch_date_'.$i]) && ($_POST['dispatch_date_'.$i] != '')) {
        $maClasse-> MAJ_dispatch_date($_POST['id_dos_'.$i], $_POST['dispatch_date_'.$i]);
      }

      if (isset($_POST['end_form_'.$i]) && ($_POST['end_form_'.$i] != '')) {
        $maClasse-> MAJ_end_form($_POST['id_dos_'.$i], $_POST['end_form_'.$i]);
        //$maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
      }

      if (isset($_POST['exit_drc_'.$i]) && ($_POST['exit_drc_'.$i] != '')) {
        $maClasse-> MAJ_exit_drc($_POST['id_dos_'.$i], $_POST['exit_drc_'.$i]);
        $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
      }

      if (isset($_POST['site_load_'.$i]) && ($_POST['site_load_'.$i] != '')) {
        $maClasse-> MAJ_site_load($_POST['id_dos_'.$i], $_POST['site_load_'.$i]);
      }

      if (isset($_POST['num_lot_'.$i]) && ($_POST['num_lot_'.$i] != '')) {
        $maClasse-> MAJ_num_lot($_POST['id_dos_'.$i], $_POST['num_lot_'.$i]);
      }

      if (isset($_POST['nbre_seal_'.$i]) && ($_POST['nbre_seal_'.$i] != '')) {
        $maClasse-> MAJ_nbre_seal($_POST['id_dos_'.$i], $_POST['nbre_seal_'.$i]);
      }

      if (isset($_POST['dgda_seal_'.$i]) && ($_POST['dgda_seal_'.$i] != '')) {
        $maClasse-> MAJ_dgda_seal($_POST['id_dos_'.$i], $_POST['dgda_seal_'.$i]);
      }

      if (isset($_POST['dispatch_pweto_'.$i]) && ($_POST['dispatch_pweto_'.$i] != '')) {
        $maClasse-> MAJ_dispatch_pweto($_POST['id_dos_'.$i], $_POST['dispatch_pweto_'.$i]);
      }

      if (isset($_POST['arrival_pweto_'.$i]) && ($_POST['arrival_pweto_'.$i] != '')) {
        $maClasse-> MAJ_arrival_pweto($_POST['id_dos_'.$i], $_POST['arrival_pweto_'.$i]);
      }

      if (isset($_POST['barge_load_'.$i]) && ($_POST['barge_load_'.$i] != '')) {
        $maClasse-> MAJ_barge_load($_POST['id_dos_'.$i], $_POST['barge_load_'.$i]);
      }

      if (isset($_POST['barge_dispatch_date_'.$i]) && ($_POST['barge_dispatch_date_'.$i] != '')) {
        $maClasse-> MAJ_barge_dispatch_date($_POST['id_dos_'.$i], $_POST['barge_dispatch_date_'.$i]);
      }

      if (isset($_POST['doc_receiv_'.$i]) && ($_POST['doc_receiv_'.$i] != '')) {
        $maClasse-> MAJ_doc_receiv($_POST['id_dos_'.$i], $_POST['doc_receiv_'.$i]);
      }

      if (isset($_POST['load_date_'.$i]) && ($_POST['load_date_'.$i] != '')) {
        $maClasse-> MAJ_load_date($_POST['id_dos_'.$i], $_POST['load_date_'.$i]);
      }

      if (isset($_POST['nbr_bags_'.$i]) && ($_POST['nbr_bags_'.$i] != '')) {
        $maClasse-> MAJ_nbr_bags($_POST['id_dos_'.$i], $_POST['nbr_bags_'.$i]);
      }

      if (isset($_POST['docs_sncc_'.$i]) && ($_POST['docs_sncc_'.$i] != '')) {
        $maClasse-> MAJ_docs_sncc($_POST['id_dos_'.$i], $_POST['docs_sncc_'.$i]);
      }

      if (isset($_POST['sncc_sakania_'.$i]) && ($_POST['sncc_sakania_'.$i] != '')) {
        $maClasse-> MAJ_sncc_sakania($_POST['id_dos_'.$i], $_POST['sncc_sakania_'.$i]);
      }

      if (isset($_POST['sakania_date_'.$i]) && ($_POST['sakania_date_'.$i] != '')) {
        $maClasse-> MAJ_sakania_date($_POST['id_dos_'.$i], $_POST['sakania_date_'.$i]);
      }

 
      if (isset($_POST['destination_'.$i]) && ($_POST['destination_'.$i] != '')) {
        $maClasse-> MAJ_destination($_POST['id_dos_'.$i], $_POST['destination_'.$i]);
      }

      if (isset($_POST['transporter_'.$i]) && ($_POST['transporter_'.$i] != '')) {
        $maClasse-> MAJ_transporter($_POST['id_dos_'.$i], $_POST['transporter_'.$i]);
      }


      /*
      if (isset($_POST['_'.$i]) && ($_POST['_'.$i] != '')) {
        $maClasse-> MAJ_($_POST['id_dos_'.$i], $_POST['_'.$i]);
      }
      */
    }

    ?>
    <script type="text/javascript">
      alert('Mises à jour éffectuées avec succès!')
    </script>
    <?php

  }

  if (isset($_POST['nouvelleLicence'])) {
    
    $maClasse-> creerEBTracking($_POST['num_lic'], $_POST['date_val'], $_POST['poids'], 
                                $_POST['unit_mes'], $_GET['id_cli'], $_GET['id_march'], 
                                $_POST['date_exp'], $_SESSION['id_util'], $_POST['destination'], 
                                $_POST['acheteur'], $_POST['id_mod_trans']);

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
          <h3><i class="far fa-folder-open nav-icon"></i> DOSSIERS <?php echo '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$client['nom_cli'].'</span>'.$marchandise.$mode_transport.$commodity.$licence.$statut.$cleared;?></h3>
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
                          $maClasse-> creerDossierIB($_POST['ref_dos'], $_GET['id_cli'], $_POST['ref_fact'], 
                                                      $_POST['fob'],$_POST['fret'], $_POST['assurance'], 
                                                      $_POST['autre_frais'], $_POST['num_lic'], $_GET['id_mod_trac'], 
                                                      $_GET['id_march'], $_GET['id_mod_trans'],
                                                      NULL, $_POST['cod'], $_SESSION['id_util'],
                                                      $_POST['road_manif'], $_POST['date_preal'], $_POST['t1'], 
                                                      $_POST['poids'], $_POST['po_ref'], $_POST['commodity'], 
                                                      $_POST['horse'], $_POST['trailer_1'], $_POST['trailer_2'], 
                                                      $_POST['cod'], $_POST['date_crf']);
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
                                                    $_POST['load_date_'.$i]);

                            }

                          }

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
                <!--<button class="btn btn-primary square-btn-adjust" id="add">
                    <i class="fa fa-plus"></i>
                </button>-->
                <?php
                if($_GET['id_mod_trac'] == '1'){
                  ?>
                <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".nouveauDossierExport">
                    <i class="fa fa-plus"></i> Nouveau Dossier
                </button>
                  <?php
                }else if($_GET['id_mod_trac'] == '2'){
                  ?>
                <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".nouveauDossier">
                    <i class="fa fa-plus"></i> Nouveau Dossier
                </button>
                  <?php
                }
                ?>
                <!--<button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient1">-->
                  <?php
                if($_GET['id_mod_trac'] == '1'){
                  ?>
                  <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClientLicence">
                    <i class="fa fa-filter"></i> Filtrage Licence
                </button>
                  <?php
                }else if($_GET['id_mod_trac'] == '2'){
                  ?>
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheMarchandise">
                    <i class="fa fa-filter"></i> Filtrage Marchandise
                </button>
                  <?php
                }
                ?>
                <button class="btn btn-secondary square-btn-adjust" data-toggle="modal" data-target=".rechercheStatus">
                    <i class="fa fa-filter"></i> Filtrage Status
                </button>
                <button class="btn bg-olive square-btn-adjust" data-toggle="modal" data-target=".rechercheClearingStatus">
                    <i class="fa fa-filter"></i> Filtrage Clearing Status
                </button>
                 <?php
                if($_GET['id_mod_trac'] == '1'){
                  ?>
                  <button class="btn bg bg-teal square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicence">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>
                  <?php
                }?>
                </h3>
                  <div class="card-tools">
                    <?php
                      if($_GET['id_mod_trac'] == '1'){
                        ?>  
                    <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".updateExport">
                        <i class="fa fa-edit"></i> Update Multiple Files
                    </button>
                        <?php
                      }else if($_GET['id_mod_trac'] == '2'){
                        ?>  
                    <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".update">
                        <i class="fa fa-edit"></i> Update Multiple Files
                    </button>
                        <?php
                      }
                    ?>
                    
                    <!--<button class="btn btn-success square-btn-adjust" onclick="tableToExcel('exportationExcel', 'Trackings')">
                      <i class="fas fa-file-excel"></i> Export
                  </button>-->
                    <!--<button class="btn btn-success square-btn-adjust" onclick="window.open('popUpExportDossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>-->

                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>

                    <!--<a href="exportExcel.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?>">
                      Export
                    </a>-->
                  </div>
              </div>
              <!-- /.card-header -->

    <div id="alert_message"></div>

              <div class="card-body table-responsive p-0">
                <table id="user_data_2" cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                  <thead>
                    <?php
                      $maClasse-> afficherEnTeteTableau($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans']);
                      /*if ($_GET['id_mod_trans'] == '1') {
                        //include("enTeteAcid.php");
                        include("enTeteImportRoute.php");

                      }else if ($_GET['id_mod_trans'] == '3') {
                        //include("enTeteAcid.php");
                        include("enTeteImportAir.php");

                      }*/
                    ?>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                        


                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;

                        $nombre_total_dossier = $maClasse-> getNombreDossierClientModeTransportModeLicence2($_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_mod_trac']);

                        $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                        if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
                        {
                           $page_actuelle=intval($_GET['page']);

                           if($page_actuelle>$nombre_de_pages) // Si la valeur de $page_actuelle (le numéro de la page) est plus grande que $nombreDePages...
                           {
                              $page_actuelle = $nombre_de_pages ;
                           }

                        }
                        else
                        {
                           $page_actuelle=1; // La page actuelle est la n°1
                        }
                        $premiere_entree=($page_actuelle-1)*$nombre_dossier_par_page; // On calcul la première entrée à lire
                        

                        $maClasse-> afficherRowDossierClientModeTransportModeLicence2($_GET['id_cli'], 
                                                $_GET['id_mod_trans'], $_GET['id_mod_trac'], $_GET['commodity'], 
                                                $premiere_entree, $nombre_dossier_par_page, $_GET['id_march'], 
                                                $_GET['statut'], $_GET['num_lic'], $_GET['cleared']);

                        /*$maClasse-> afficherDossierClientModeTransportModeLicence2($_GET['id_cli'], 
                                                $_GET['id_mod_trans'], $_GET['id_mod_trac'], $_GET['commodity'], 
                                                $premiere_entree, $nombre_dossier_par_page);*/

                    ?>
                    </form>
                  </tbody>
                </table>
              </div>
              <div>
                <hr>
              </div>
              <ul class="pagination pull-right card-tools">
                  <?php
                  if ($page_actuelle > 1)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&statut=<?php echo $_GET['statut'];?>&commodity=<?php echo $_GET['commodity'];?>&cleared=<?php echo $_GET['cleared'];?>&page=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
                    </li>
                  <?php
                  }

                  //Début calcul affichage boucle de pagination
                  if($page_actuelle <= 1)
                  {
                    $debut_affichage_pagination = 1;
                  }
                  else if($page_actuelle == 2)
                  {
                    $debut_affichage_pagination = $page_actuelle - 1;
                  }
                  else if($page_actuelle == 3)
                  {
                    $debut_affichage_pagination = $page_actuelle - 2;
                  }
                  else
                  {
                    $debut_affichage_pagination = $page_actuelle - 3;
                  }
                  //Fin calcul affichage boucle de pagination

                  if(($page_actuelle+6) <= $nombre_de_pages)
                  {
                    $pagination_limite = $page_actuelle+6;
                  }
                  else
                  {
                    $pagination_limite = $nombre_de_pages;
                  }

                  for($i=$debut_affichage_pagination; $i<=$pagination_limite; $i++)
                  {

                   //On va faire notre condition
                   if($i==$page_actuelle) //Si il s'agit de la page actuelle...
                   {
                  ?>
                    <li class="page-item" class="active">
                      <a class="page-link" ><?php echo $i; ?></a>
                    </li>
                  <?php
                   }
                   else
                   {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&statut=<?php echo $_GET['statut'];?>&commodity=<?php echo $_GET['commodity'];?>&cleared=<?php echo $_GET['cleared'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>

                  <?php
                   }
                  }

                  if ($page_actuelle < $nombre_de_pages)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&statut=<?php echo $_GET['statut'];?>&commodity=<?php echo $_GET['commodity'];?>&cleared=<?php echo $_GET['cleared'];?>&page=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
                    </li>
                  <?php
                  }

                  ?>
            </ul>
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
  <?php include("script.php");?>

<?php
if(isset($_GET['id_mod_trac'])){

?>

<div class="modal fade rechercheMarchandise" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage MARCHANDISE.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <select name="commodity" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerMarchandiseClientModeleLicence($_GET['id_cli'], $_GET['id_mod_trac']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheMarchandise" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade rechercheStatus" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage STATUS.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">STATUS</label>
            <select name="statut" onchange="" class="form-control cc-exp">
                <option></option>
                <option value="">ALL</option>
                <?php
                  $maClasse->selectionnerStatusModeleLicence($_GET['id_mod_trac']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheStatus" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade rechercheClearingStatus" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage CLEARING STATUS.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLEARING STATUS</label>
            <select name="cleared" onchange="" class="form-control cc-exp">
                <option></option>
                <option value="">ALL</option>
                <option value="0">TRANSIT/PROCESS</option>
                <option value="1">CLEARED</option>
                <option value="2">CANCELLED</option>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClearingStatus" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_trac'])){

?>

<div class="modal fade rechercheClientLicence" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage LICENCE.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">LICENCE</label>
            <select name="num_lic" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerLicenceModeleClient($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_march']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClientLicence" class="btn btn-primary">Valider</button>
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

<?php
if(isset($_GET['id_mod_trac'])){

?>

<div class="modal fade nouvelleLicence" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Licence.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">NUMERO LICENCE</label>
            <input name="num_lic" type="text" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DESTINATION</label>
            <input name="destination" type="text" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">ACHETEUR</label>
            <input name="acheteur" type="text" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">MODE DE TRANSPORT</label>
            <select name="id_mod_trans" type="text" class="form-control cc-exp" required>
              <option></option>
              <?php $maClasse-> selectionnerModeTransport();?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE VALIDATION</label>
            <input name="date_val" type="date" class="form-control cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE EXTREME VALIDATION</label>
            <input name="date_exp" type="date" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">POIDS/WEIGHT</label>
            <input name="poids" type="number" step="0.001" min="0" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">U.M.</label>
            <select name="unit_mes" onchange="" class="form-control cc-exp">
              <option value='T'>T</option>
              <option value='Kg'>Kg</option>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="nouvelleLicence" class="btn btn-primary">Valider</button>
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


<?php
if(isset($_GET['id_mod_trac'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
?>

<div class="modal fade nouveauDossier" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouveau dossier .</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" id="id_cli" onchange="xajax_selectionnerLicencePourClientModele(this.value, <?php echo $_GET['id_mod_trac'];?>),xajax_afficherRefDos(this.value, <?php echo $_GET['id_mod_trans'];?>, <?php echo $_GET['id_march'];?>), xajax_afficherFobMaxLicence(num_lic.value),xajax_selectionnerAVPourLicence(num_lic.value),xajax_afficherMaskAV(av.value)" class="form-control cc-exp" required>
                <option value="<?php echo $_GET['id_cli'];?>"><?php echo $maClasse-> getNomClient($_GET['id_cli']);?></option>
                <?php
                    //$maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MCA FILE NUMBER</label>
            <input type="text" name="ref_dos" value="<?php echo $maClasse-> getMcaFile($_GET['id_cli'], $_GET['id_mod_trans']);?>" class="form-control cc-exp" required>
          </div>
    
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
            <input type="text" name="ref_fact" class="form-control cc-exp" required>
          </div>

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
            <input type="date" name="date_fact" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>-->

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">LICENCE </label>
            <input type="text" id="txtCountry" name="num_lic" autocomplete="off" class="form-control cc-exp" required>
            <!--<select name="num_lic" id="num_lic" class="form-control cc-exp" onchange="xajax_afficherFobMaxLicence(this.value),xajax_selectionnerAVPourLicence(this.value),xajax_afficherMaskAV(av.value)" required>
              <option></option>
              <option value="UNDER VALUE">UNDER VALUE</option>
                <?php
                  $maClasse->selectionnerLicenceEnCoursModeleClient($_GET['id_mod_trac'], $_GET['id_cli']);
                ?>
            </select>-->
          </div>

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BALANCE LICENCE</label>
            <span id="balance_fob"></span>
          </div>-->
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB DECLAREE</label>
            <!--<span id="fob"></span>-->
            <input type="number" min="0" step="0.01" name="fob" class="form-control cc-exp">
          </div>
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FRET</label>
            <!--<span id="fret"></span>-->
            <input type="number" min="0" step="0.01" name="fret" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
            <!--<span id="assurance"></span>-->
            <input type="number" min="0" step="0.01" name="assurance" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AUTRE FRAIS</label>
            <!--<span id="autre_frais"></span>-->
            <input type="number" min="0" step="0.01" name="autre_frais" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">WEIGHT</label>
            <input type="number" min="0" step="0.01" name="poids" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">PO REF</label>
            <input type="text" name="po_ref" class="form-control cc-exp">
          </div>

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AV LICENCE</label>
            <select name="ref_av" id="av" class="form-control cc-exp" onchange="xajax_afficherMaskAV(this.value)" >
              <option value=""></option>
                <?php
                  //$maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_trac']);
                ?>
            </select>
          </div>-->

          <!--<div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AV AVEC MASK</label>
            <span id="cod_dos_1"></span>
          </div>-->
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CRF REF</label>
            <input type="text" name="cod" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CRF RECEIVED DATE</label>
            <input type="date" name="date_crf" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">PRE-ALERT DATE</label>
            <input type="date" name="date_preal" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">T1</label>
            <input type="text" name="t1" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <input type="text" name="commodity" class="form-control cc-exp">
          </div>
          <?php
          if($_GET['id_mod_trans'] == '1'){
            ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ROAD MANIF</label>
            <input type="text" name="road_manif" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">HORSE</label>
            <input type="text" name="horse" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TRAILER 1</label>
            <input type="text" name="trailer_1" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TRAILER 2/CONTAINER</label>
            <input type="text" name="trailer_2" class="form-control cc-exp">
          </div>

            <?php
          }else{
            ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">LTA NUM</label>
            <input type="text" name="road_manif" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AWB NUM.</label>
            <input type="text" name="horse" class="form-control cc-exp">
          </div>
          <input type="hidden" name="trailer_1" value="N/A">
          <input type="hidden" name="trailer_2" value="N/A">
            <?php
          }
          ?>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerDossier" class="btn btn-primary">Valider</button>
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


<?php

include('nouveauExport.php');
include('updateMutipleExport.php');

if(isset($_GET['id_mod_trac']) && isset($_GET['id_mod_trac'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade update" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="nbre" value="<?php echo $maClasse-> getNombreDossierClientModeTransportModeLicence3($_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_mod_trac'], $_GET['commodity']);?>">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Update Multiple Files.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">BEGIN</label>
            <select name="debut" onchange="" class="form-control cc-exp">
                <?php
                  $maClasse-> selectionnerDossierClientModeTransportModeLicence2($_GET['id_cli'], $_GET['id_mod_trans']
                                                                    , $_GET['id_mod_trac'], $_GET['commodity']);
                  //$maClasse->selectionnerClientModeleLicence($modele['id_mod_trac']);
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">END</label>
            <select name="fin" onchange="" class="form-control cc-exp">
                <?php
                  $maClasse-> selectionnerDossierClientModeTransportModeLicence2($_GET['id_cli'], $_GET['id_mod_trans']
                                                                    , $_GET['id_mod_trac'], $_GET['commodity']);
                  //$maClasse->selectionnerClientModeleLicence($modele['id_mod_trac']);
                ?>
            </select>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">K'lesa arrival date</label>
            <input type="date" name="klsa_arriv" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Crossing Date</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="crossing_date" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Wiski arrival date</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="wiski_arriv" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Departure date Wiski</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="wiski_dep" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AMICONGO ARRIVAL DATE</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="amicong_arriv" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">INSP REPORT RECEIVED DATE</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="insp_receiv" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CLEARED BASED ON IR</label>
            <select name="ir" class="form-control cc-exp">
              <option></option>
              <option value="YES">YES</option>
              <option value="NO">NO</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CRF Reference</label>
            <input type="text" name="ref_crf" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CRF Received Date</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="date_crf" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Declaration Reference</label>
            <input type="text" name="ref_decl" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DGDA In</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="dgda_in" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Liquidation Reference</label>
            <input type="text" name="ref_liq" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date Liquidation</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="date_liq" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Quittance Reference</label>
            <input type="text" name="ref_quit" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date Quittance</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="date_quit" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DGDA Out</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="dgda_out" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CUSTOM DELIVER DATE</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="custom_deliv" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CLEARING STATUS</label>
            <select name="cleared" class="form-control cc-exp">
              <option></option>
              <option value="0">TRANSIT</option>
              <option value="1">CLEARED</option>
              <option value="2">CANCELLED</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DISPACTH/DELIVER DATE</label>
            <input type="date" max="<?php echo date('Y-m-d');?>" name="dispatch_deliv" class="form-control cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">STATUS</label>
            <input type="text" name="statut" class="form-control cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">REMARQUE</label>
            <input type="text" name="remarque" class="form-control cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="updateMultipleFiles" class="btn btn-primary">Valider</button>
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
