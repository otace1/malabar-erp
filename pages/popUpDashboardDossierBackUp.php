<?php
  include("tete.php");
  $modele_licence = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);

  $couleur = '';
  if ($_GET['type'] == 'EN ATTENTE FACTURATION') {

    $couleur = 'success';

  }

  if( isset($_GET['type']) && ($_GET['type'] != '')){
    $type = $_GET['id_cli'];
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

  //include('excel/popUpDossier.php');

  if(isset($_POST['updateMultipleFiles'])){
    $maClasse-> updateMultipleFilesPopUp($_POST['debut'], $_POST['fin'], $_POST['klsa_arriv'], 
                                  $_POST['crossing_date'], $_POST['wiski_arriv'], $_POST['wiski_dep'], 
                                  $_POST['amicong_arriv'], $_POST['insp_receiv'], $_POST['ir'], 
                                  $_POST['ref_crf'], $_POST['date_crf'], $_POST['dgda_in'], $_POST['ref_decl'], 
                                  $_POST['ref_liq'], $_POST['date_liq'], $_POST['ref_quit'], 
                                  $_POST['date_quit'], $_POST['dgda_out'], $_POST['custom_deliv'], $_POST['cleared'], 
                                  $_POST['dispatch_deliv'], $_POST['statut'], $_POST['remarque'], 
                                  $_POST['nbre'], $_GET['id_cli'], $_GET['id_mod_trans'], 
                                  $_GET['id_mod_lic'], $_GET['commodity'], $_GET['type']);
    ?>
    <script type="text/javascript">
      alert('Mises à jour éffectuées avec succès!')
    </script>
    <?php
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
/*
      if (isset($_POST['_'.$i]) && ($_POST['_'.$i] != '')) {
        $maClasse-> MAJ_($_POST['id_dos_'.$i], $_POST['_'.$i]);
      }

      if (isset($_POST['_'.$i]) && ($_POST['_'.$i] != '')) {
        $maClasse-> MAJ_($_POST['id_dos_'.$i], $_POST['_'.$i]);
      }*/
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
                        <i class="fa fa-folder-open nav-icon"></i><?php echo $_GET['type'].$client.$type_licence;?>
                        <!--<button class="btn btn-default" onclick="exportToExcel('popUpDossier')">
                          <img src="../images/xls.png" width="30px">
                        </button>-->
                      </h3>

                  <div class="card-tools">
                    <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".update">
                        <i class="fa fa-edit"></i> Update Multiple Files
                    </button>
                  </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0">
                              <table cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                                <thead>

                                  <?php
                                    if (isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) {
                                      $maClasse-> afficherEnTeteTableau($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans']);
                                    }else{
                                      if ($_GET['id_mod_trans'] == '1') {
                                        //include("enTeteAcid.php");
                                        include("enTeteImportRoute.php");

                                      }else if ($_GET['id_mod_trans'] == '3') {
                                        //include("enTeteAcid.php");
                                        include("enTeteImportAir.php");

                                      }
                                    }
                                    
                                  ?>
                                  <!--<tr>
                                    <th style="text-align: center; ">#</th>
                                    <th>MCA FILE REF</th>
                                    <th>MCA B/REF</th>
                                    <th>CLIENT</th>
                                    <th>MARCHANDISE</th>
                                    <th>N. E</th>
                                    <th>N. L</th>
                                    <th>N. Q</th>
                                    <th>FOB</th>
                                  </tr>-->
                                </thead>
                                <tbody>
                                  <form method="POST" action="">
                                    <?php

                                    $nombre_dossier_par_page = 20;
                                    $debut_affichage_pagination = 1;

                                    $nombre_total_dossier = 500;

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
                                    
                                    if (isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) {
                                      $maClasse-> afficherRowDossierClientModeTransportModeLicenceDashboard($_GET['id_cli'], 
                                                $_GET['id_mod_trans'], $_GET['id_mod_lic'], $_GET['commodity'], 
                                                $premiere_entree, $nombre_dossier_par_page, $_GET['type']);
                                    }else{
                                      $maClasse-> afficherDossierPopUp($_GET['id_cli'], $_GET['id_mod_trans'], 
                                                                      $_GET['id_mod_lic'], $_GET['commodity'], 
                                                                      $_GET['type'], $premiere_entree, 
                                                                      $nombre_dossier_par_page);
                                    }
                                      
                                    ?>
                                  </form>
                                </tbody>
                              </table>
                            </div>
                            <ul class="pagination pull-right card-tools">
                                <?php
                                if ($page_actuelle > 1)
                                {
                                ?>
                                  <li class="page-item">
                                    <a class="page-link" href="popUpDashboardDossier.php?type=<?php echo $_GET['type'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>&page=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
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
                                    <a class="page-link" href="popUpDashboardDossier.php?type=<?php echo $_GET['type'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                  </li>

                                <?php
                                 }
                                }

                                if ($page_actuelle < $nombre_de_pages)
                                {
                                ?>
                                  <li class="page-item">
                                    <a class="page-link" href="popUpDashboardDossier.php?type=<?php echo $_GET['type'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_cli=<?php echo $_GET['id_cli'];?>&commodity=<?php echo $_GET['commodity'];?>&page=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
                                  </li>
                                <?php
                                }

                                ?>
                          </ul>
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
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade update" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="nbre" value="<?php echo $maClasse-> getNombreDossierClientModeTransportModeLicence3($_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_mod_lic'], $_GET['commodity']);?>">
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
                  $maClasse-> selectionnerDossierClientModeTransportModeLicence3($_GET['id_cli'], $_GET['id_mod_trans']
                                                                    , $_GET['id_mod_lic'], $_GET['commodity'], $_GET['type']);
                  //$maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">END</label>
            <select name="fin" onchange="" class="form-control cc-exp">
                <?php
                  $maClasse-> selectionnerDossierClientModeTransportModeLicence3($_GET['id_cli'], $_GET['id_mod_trans']
                                                                    , $_GET['id_mod_lic'], $_GET['commodity'], $_GET['type']);
                  //$maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
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

include('pied.php');
?>

</body>
</script>
</html>
