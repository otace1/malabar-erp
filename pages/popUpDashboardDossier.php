<?php
  include("tete.php");
  $modele_licence = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);

  $couleur = '';
  
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomClient($_GET['id_cli']).'</span>';
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

  if ($_GET['id_mod_lic'] == '1') {
    
    if ($_GET['id_cli'] == '') {
      $_GET['id_cli'] = NULL;
    }

  }else if ($_GET['id_mod_lic'] == '2') {
    
    if ($_GET['id_cli'] == '') {
      $_GET['id_cli'] = NULL;
    }

  }
//UPDATES

  
  if(isset($_POST['update'])){

    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 


      if (isset($_POST['statut_'.$i]) && ($_POST['statut_'.$i] != '')) {
        $maClasse-> MAJ_statut($_POST['id_dos_'.$i], $_POST['statut_'.$i]);
        if ($_GET['id_cli']==857 && $_GET['id_mod_trac']==2 && $_GET['id_mod_trans']==3 && ($_POST['statut_'.$i]=='Delivered') ||  ($_POST['statut_'.$i]=='DELIVERED') ) {
          $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
        }
      }

      if (isset($_POST['mca_b_ref_'.$i]) && ($_POST['mca_b_ref_'.$i] != '')) {
        $maClasse-> MAJ_mca_b_ref($_POST['id_dos_'.$i], $_POST['mca_b_ref_'.$i]);
      }

      if (isset($_POST['ref_quit_'.$i]) && ($_POST['ref_quit_'.$i] != '')) {
        $maClasse-> MAJ_ref_quit($_POST['id_dos_'.$i], $_POST['ref_quit_'.$i]);
        if ($_GET['id_mod_trac'] == '2') {
          //$maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
        }
      }

      if (isset($_POST['date_quit_'.$i]) && ($_POST['date_quit_'.$i] != '')) {
        $maClasse-> MAJ_date_quit($_POST['id_dos_'.$i], $_POST['date_quit_'.$i]);
        if ( ($_GET['id_mod_trac'] == '2') && ($maClasse-> getDossier($_POST['id_dos_'.$i])['cleared'] != '1') && ($_POST['cleared_'.$i] != '1') ) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'AWAITING BAE/BS');
          //$maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
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
        if (isset($_POST['dispatch_deliv_'.$i]) && ($_POST['dispatch_deliv_'.$i] != '') && isset($_POST['dgda_out_'.$i]) && ($_POST['dgda_out_'.$i] != '')) {
          $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], '1');
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'CLEARING COMPLETED');
        }
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
        echo '<br>FOB = '.$_POST['fob_'.$i];
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
        //echo '<br>----------------------------------- IR = '.$_POST['ir_'.$i];
      }

      if (isset($_POST['regul_ir_'.$i]) && ($_POST['regul_ir_'.$i] != '')) {
        $maClasse-> MAJ_regul_ir($_POST['id_dos_'.$i], $_POST['regul_ir_'.$i]);
        //echo '<br>----------------------------------- IR = '.$_POST['ir_'.$i];
      }

      if (isset($_POST['supplier_'.$i]) && ($_POST['supplier_'.$i] != '')) {
        $maClasse-> MAJ_supplier($_POST['id_dos_'.$i], $_POST['supplier_'.$i]);
      }

      if (isset($_POST['bl_'.$i]) && ($_POST['bl_'.$i] != '')) {
        $maClasse-> MAJ_bl($_POST['id_dos_'.$i], $_POST['bl_'.$i]);
      }

      if (isset($_POST['bond_warehouse_'.$i]) && ($_POST['bond_warehouse_'.$i] != '')) {
        $maClasse-> MAJ_bond_warehouse($_POST['id_dos_'.$i], $_POST['bond_warehouse_'.$i]);
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

      if (isset($_POST['load_date_'.$i]) && ($_POST['load_date_'.$i] != '')) {
        $maClasse-> MAJ_load_date($_POST['id_dos_'.$i], $_POST['load_date_'.$i]);

        if (!isset($_POST['ceec_in_'.$i]) || ($_POST['ceec_in_'.$i]=='')) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'LOADED');
        }

      }

      if (isset($_POST['ceec_in_'.$i]) && ($_POST['ceec_in_'.$i] != '')) {
        $maClasse-> MAJ_ceec_in($_POST['id_dos_'.$i], $_POST['ceec_in_'.$i]);

        if (!isset($_POST['ceec_out_'.$i]) || ($_POST['ceec_out_'.$i]=='')) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'AT CEEC');
        }

      }

      if (isset($_POST['ceec_out_'.$i]) && ($_POST['ceec_out_'.$i] != '')) {
        $maClasse-> MAJ_ceec_out($_POST['id_dos_'.$i], $_POST['ceec_out_'.$i]);
        //if (!isset($_POST['ceec_out_'.$i]) || ($_POST['ceec_out_'.$i]=='')) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'CEEC OUT');
        //}
      }

      if (isset($_POST['min_div_in_'.$i]) && ($_POST['min_div_in_'.$i] != '')) {
        $maClasse-> MAJ_min_div_in($_POST['id_dos_'.$i], $_POST['min_div_in_'.$i]);

        if (!isset($_POST['min_div_out_'.$i]) || ($_POST['min_div_out_'.$i]=='')) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'AT MINE DIVISION');
        }

      }

      if (isset($_POST['min_div_out_'.$i]) && ($_POST['min_div_out_'.$i] != '')) {
        $maClasse-> MAJ_min_div_out($_POST['id_dos_'.$i], $_POST['min_div_out_'.$i]);
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'MINE DIVISION OUT');
      }

      if (isset($_POST['ref_decl_'.$i]) && ($_POST['ref_decl_'.$i] != '')) {
        $maClasse-> MAJ_ref_decl($_POST['id_dos_'.$i], $_POST['ref_decl_'.$i]);

        if ( ((!isset($_POST['ref_liq_'.$i])) || ($_POST['ref_liq_'.$i] == '') ) && ((!isset($_POST['date_liq_'.$i])) || ($_POST['date_liq_'.$i] == '')) ) {
          
          if ( ((!isset($_POST['ref_quit_'.$i])) || ($_POST['ref_quit_'.$i] == '') ) && ((!isset($_POST['date_quit_'.$i])) || ($_POST['date_quit_'.$i] == '')) && ($_GET['id_mod_trac'] == '1') ) {
            
            $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'DECLARATION');
            
          }
        }


      }

      if (isset($_POST['date_decl_'.$i]) && ($_POST['date_decl_'.$i] != '')) {
        $maClasse-> MAJ_date_decl($_POST['id_dos_'.$i], $_POST['date_decl_'.$i]);

        if ( ((!isset($_POST['ref_liq_'.$i])) || ($_POST['ref_liq_'.$i] == '') ) && ((!isset($_POST['date_liq_'.$i])) || ($_POST['date_liq_'.$i] == '')) ) {
          
          if ( ((!isset($_POST['ref_quit_'.$i])) || ($_POST['ref_quit_'.$i] == '') ) && ((!isset($_POST['date_quit_'.$i])) || ($_POST['date_quit_'.$i] == '')) && ($_GET['id_mod_trac'] == '1') ) {
            
            $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'DECLARATION');
            
          }
        }

      }

      if (isset($_POST['dgda_in_'.$i]) && ($_POST['dgda_in_'.$i] != '')) {
        $maClasse-> MAJ_dgda_in($_POST['id_dos_'.$i], $_POST['dgda_in_'.$i]);

        if ((!isset($_POST['dgda_out_'.$i]) || ($_POST['dgda_out_'.$i]=='')) && ($_GET['id_mod_trac'] == '1') ) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'AT DGDA');
        }

      }
      
      if (isset($_POST['ref_liq_'.$i]) && ($_POST['ref_liq_'.$i] != '')) {
        $maClasse-> MAJ_ref_liq($_POST['id_dos_'.$i], $_POST['ref_liq_'.$i]);

        if ((!isset($_POST['dgda_out_'.$i]) || ($_POST['dgda_out_'.$i]=='')) && ($_GET['id_mod_trac']=='1')) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'LIQUIDATED');
        }

      }

      if (isset($_POST['date_liq_'.$i]) && ($_POST['date_liq_'.$i] != '')) {
        $maClasse-> MAJ_date_liq($_POST['id_dos_'.$i], $_POST['date_liq_'.$i]);
        
        if ((!isset($_POST['dgda_out_'.$i]) || ($_POST['dgda_out_'.$i]=='')) && ($_GET['id_mod_trac']=='1')) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'LIQUIDATED');
        }

      }
      
      if (isset($_POST['dgda_out_'.$i]) && ($_POST['dgda_out_'.$i] != '')) {
        $maClasse-> MAJ_dgda_out($_POST['id_dos_'.$i], $_POST['dgda_out_'.$i]);
        if ( ($_GET['id_mod_trac'] == '2') && ($_GET['id_cli'] == '869') ) {
          $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'CLEARING COMPLETED');
        }elseif ( ($_GET['id_mod_trac'] == '2') && ($_GET['id_cli'] == '857') ) {
          $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'CLEARING COMPLETED');
        }else if (  ($_GET['id_mod_trac'] == '2') && ( ($_POST['custom_deliv_'.$i] != '') && isset($_POST['custom_deliv_'.$i]) ) && (($_POST['dispatch_deliv_'.$i] != '') && isset($_POST['dispatch_deliv_'.$i]))) {
          $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'CLEARING COMPLETED');
        }else{

          if ((!isset($_POST['gov_in_'.$i]) || ($_POST['gov_in_'.$i]=='')) && ($_GET['id_mod_trac']=='1')) {
            $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'DGDA OUT');
          }

        }
      }

      if (isset($_POST['gov_in_'.$i]) && ($_POST['gov_in_'.$i] != '')) {
        $maClasse-> MAJ_gov_in($_POST['id_dos_'.$i], $_POST['gov_in_'.$i]);

        if (!isset($_POST['gov_out_'.$i]) || ($_POST['gov_out_'.$i]=='')) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'AT GOVERNOR\'S OFFICE');
        }

      }

      if (isset($_POST['gov_out_'.$i]) && ($_POST['gov_out_'.$i] != '')) {
        $maClasse-> MAJ_gov_out($_POST['id_dos_'.$i], $_POST['gov_out_'.$i]);

        if ( (!isset($_POST['dispatch_date_'.$i]) || ($_POST['dispatch_date_'.$i]=='')) && ($_GET['id_mod_trac'] == '1') ) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'GOVERNOR\'S OFFICE OUT');
        }

      }

      if (isset($_POST['dispatch_date_'.$i]) && ($_POST['dispatch_date_'.$i] != '')) {
        $maClasse-> MAJ_dispatch_date($_POST['id_dos_'.$i], $_POST['dispatch_date_'.$i]);

        if ( (!isset($_POST['klsa_arriv_'.$i]) || ($_POST['klsa_arriv_'.$i]=='')) && ($_GET['id_mod_trac'] == '1') ) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'DISPATCHED');
        }

      }

      if (isset($_POST['klsa_arriv_'.$i]) && ($_POST['klsa_arriv_'.$i] != '')) {
        $maClasse-> MAJ_klsa_arriv($_POST['id_dos_'.$i], $_POST['klsa_arriv_'.$i]);

        if ( (!isset($_POST['exit_drc_'.$i]) || ($_POST['exit_drc_'.$i]=='')) && (!isset($_POST['end_form_'.$i]) || ($_POST['end_form_'.$i]=='')) && ($_GET['id_mod_trac'] == '1') ) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'AT KLSA');
        }

      }
      
      if (isset($_POST['end_form_'.$i]) && ($_POST['end_form_'.$i] != '')) {
        $maClasse-> MAJ_end_form($_POST['id_dos_'.$i], $_POST['end_form_'.$i]);
        //$maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);

        if ( (!isset($_POST['exit_drc_'.$i]) || ($_POST['exit_drc_'.$i]=='')) && ($_GET['id_mod_trac'] == '1') ) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'BORDER FORMALITIES');
        }

      }

      if (isset($_POST['exit_drc_'.$i]) && ($_POST['exit_drc_'.$i] != '')) {
        $maClasse-> MAJ_exit_drc($_POST['id_dos_'.$i], $_POST['exit_drc_'.$i]);
        $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
        $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'EXIT DRC');
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

      if (isset($_POST['nbr_bags_'.$i]) && ($_POST['nbr_bags_'.$i] != '')) {
        $maClasse-> MAJ_nbr_bags($_POST['id_dos_'.$i], $_POST['nbr_bags_'.$i]);
      }

      if (isset($_POST['docs_sncc_'.$i]) && ($_POST['docs_sncc_'.$i] != '')) {
        $maClasse-> MAJ_docs_sncc($_POST['id_dos_'.$i], $_POST['docs_sncc_'.$i]);
      }

      if (isset($_POST['sncc_sakania_'.$i]) && ($_POST['sncc_sakania_'.$i] != '')) {
        $maClasse-> MAJ_sncc_sakania($_POST['id_dos_'.$i], $_POST['sncc_sakania_'.$i]);
        if (($_GET['id_mod_trac'] == '1') && ($_POST['sakania_date_'.$i]=='' || !isset($_POST['sakania_date_'.$i])) ) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'DISPATCHED');
        }
      }

      if (isset($_POST['sakania_date_'.$i]) && ($_POST['sakania_date_'.$i] != '')) {
        $maClasse-> MAJ_sakania_date($_POST['id_dos_'.$i], $_POST['sakania_date_'.$i]);
      }

 
      if (isset($_POST['destination_'.$i]) && ($_POST['destination_'.$i] != '')) {
        $maClasse-> MAJ_destination($_POST['id_dos_'.$i], $_POST['destination_'.$i]);
      }else{

        if ($_GET['id_cli'] == '878' && $_GET['id_mod_trac'] == '1' && $_GET['id_mod_trans'] == '4' && $_GET['id_march'] == '15') {
          $maClasse-> MAJ_destination($_POST['id_dos_'.$i], 'AFRIQUE DU SUD');
        }

      }

      if (isset($_POST['transporter_'.$i]) && ($_POST['transporter_'.$i] != '')) {
        $maClasse-> MAJ_transporter($_POST['id_dos_'.$i], $_POST['transporter_'.$i]);
      }


      if (isset($_POST['impala_sncc_'.$i]) && ($_POST['impala_sncc_'.$i] != '')) {
        $maClasse-> MAJ_impala_sncc($_POST['id_dos_'.$i], $_POST['impala_sncc_'.$i]);
      }

      if (isset($_POST['barge_'.$i]) && ($_POST['barge_'.$i] != '')) {
        $maClasse-> MAJ_barge($_POST['id_dos_'.$i], $_POST['barge_'.$i]);
      }

      if (isset($_POST['ship_num_'.$i]) && ($_POST['ship_num_'.$i] != '')) {
        $maClasse-> MAJ_ship_num($_POST['id_dos_'.$i], $_POST['ship_num_'.$i]);
      }

      if (isset($_POST['kapulo_load_'.$i]) && ($_POST['kapulo_load_'.$i] != '')) {
        $maClasse-> MAJ_kapulo_load($_POST['id_dos_'.$i], $_POST['kapulo_load_'.$i]);
      }

      if (isset($_POST['warehouse_arriv_'.$i]) && ($_POST['warehouse_arriv_'.$i] != '')) {
        $maClasse-> MAJ_warehouse_arriv($_POST['id_dos_'.$i], $_POST['warehouse_arriv_'.$i]);
      }

      if (isset($_POST['cleared_'.$i]) && ($_POST['cleared_'.$i] != '')) {
        $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], $_POST['cleared_'.$i]);

        if ( ($_POST['cleared_'.$i] == '1') ) {
          $maClasse-> MAJ_statut($_POST['id_dos_'.$i], 'CLEARING COMPLETED');
        }

      }

      if (isset($_POST['statut_'.$i]) && ($_POST['statut_'.$i] == 'CLEARING COMPLETED')) {
        $maClasse-> MAJ_cleared($_POST['id_dos_'.$i], 1);
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

//FIN UPDATES

  //include('excel/popUpDossier.php');

 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                </h3>
              </div>
              <!-- /.card-header -->
                  <div class="card card-<?php echo $couleur;?>">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-folder-open nav-icon"></i>
                          <?php echo  '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.number_format($maClasse-> nbreSummary($_GET['statut'], $_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ').'</span> | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['statut'].'</span>'.$client.$type_licence;?>
                        <!--<button class="btn btn-default" onclick="exportToExcel('popUpDossier')">
                          <img src="../images/xls.png" width="30px">
                        </button>-->

                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportExcelPopUp.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_lic']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>

                      </h3>

                  <!--<div class="card-tools">
                    <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".update">
                        <i class="fa fa-edit"></i> Update Multiple Files
                    </button>
                  </div>-->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                                  <form method="POST" action="">
                              <input type="hidden" name="nbre" value="<?php echo $maClasse-> nbreSummary($_GET['statut'], $_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>">
                              <td class="col_1">
                                <button type="submit" class="btn btn-success btn-xs" name="update" <?php echo $maClasse-> getDataUtilisateur($_SESSION['id_util'])['tracking_enab'];?>>
                                  Mettre à jour
                                </button>
                              </td>
                            <div class="card-body table-responsive p-0  cadre-tableau-de-donnees" style="">
                              <table id="user_data_2" cellspacing="0" width="100%" class="tableau-de-donnees table-dark table table-hover text-nowrap table-sm">
                                <thead>
                                    <?php

                                    $maClasse-> afficherEnTeteTableauPopUp($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans']);
                                    ?>
                                </thead>
                                <tbody>
                                    <?php
                                        /*$maClasse-> afficherDossierPopUp($_GET['id_cli'], $_GET['id_mod_trans'], 
                                                                      $_GET['id_mod_lic'], $_GET['commodity'], 
                                                                      $_GET['statut']);  */

                                        $maClasse-> afficherRowDossierClientModeTransportModeLicence3($_GET['id_cli'], 
                                                $_GET['id_mod_trans'], $_GET['id_mod_lic'], $_GET['commodity'], NULL, 
                                                $_GET['statut'], NULL, NULL); 
                                    ?>
                                </tbody>
                              </table>
                            </div>
                            <tr>
                              <input type="hidden" name="nbre" value="<?php echo $maClasse-> nbreSummary($_GET['statut'], $_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']);?>">
                              <td class="col_1">
                                <button type="submit" class="btn btn-success btn-xs" name="update" <?php echo $maClasse-> getDataUtilisateur($_SESSION['id_util'])['tracking_enab'];?>>
                                  Mettre à jour
                                </button>
                              </td>
                            </tr>
                                  </form>
                        </div>
                    </div>
                        <!-- input states -->
                    <!-- /.card-body -->
                  </div>
            <!-- /.card -->
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>
</div>
</section>
</div>





<?php
include('pied.php');
?>

</body>
</script>
</html>
