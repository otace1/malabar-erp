<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include('dossierExcel.php');

  $client = $maClasse-> getElementClient($_GET['id_cli']);
  //$client = '';
  $_GET['id_march'] = 1;

  if( isset($_POST['rechercheMarchandise']) ){
    ?>
    <script type="text/javascript">
      window.location = 'dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_POST['commodity'];?>';
    </script>
    <?php
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

  if(isset($_POST['rechercheClientLicence'])){
    $licence = ' | '.$_POST['num_lic'];
  }else{
    $licence = '';
  }

  if(isset($_POST['updateMultipleFiles'])){
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

      if (isset($_POST['supplier_'.$i]) && ($_POST['supplier_'.$i] != '')) {
        $maClasse-> MAJ_supplier($_POST['id_dos_'.$i], $_POST['supplier_'.$i]);
      }
/*
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
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="far fa-folder-open nav-icon"></i> DOSSIERS <?php echo $client['nom_cli'].$mode_transport.$commodity.$licence?></h3>
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
                                                      $_POST['ref_av'], $_POST['cod'], $_SESSION['id_util'],
                                                      $_POST['road_manif'], $_POST['date_preal'], $_POST['t1'], 
                                                      $_POST['poids'], $_POST['po_ref'], $_POST['commodity'], 
                                                      $_POST['horse'], $_POST['trailer_1'], $_POST['trailer_2']);
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
                <!--<button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient1">-->
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClientLicence">
                    <i class="fa fa-filter"></i> Filtrage Licence
                </button>
                <button class="btn btn-secondary square-btn-adjust" data-toggle="modal" data-target=".rechercheMarchandise">
                    <i class="fa fa-filter"></i> Filtrage Marchandise
                </button>
                </h3>
                  <div class="card-tools">
                    <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".update">
                        <i class="fa fa-edit"></i> Update Multiple Files
                    </button>
                    <!--<button class="btn btn-success square-btn-adjust" onclick="tableToExcel('exportationExcel', 'Trackings')">
                      <i class="fas fa-file-excel"></i> Export
                  </button>-->
                    <button class="btn btn-success square-btn-adjust" onclick="window.open('popUpExportDossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table cellspacing="0" width="100%" id="table_item" class="tableau1  table table-hover text-nowrap table-sm">
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
                  <tbody id="tbody">
                    <form method="POST" id="insert_form" action="">
                      <tr>
                        <td class="col_1">
                          <button type="button" class="btn btn-success" name="add" id="add" onclick="addItem();">
                            <i class="fa fa-plus"></i>
                          </button>
                        </td>
                        <td class="col_6"></td>
                        <td><input type="text" name="" disabled=""></td>
                      </tr>
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
                        

                        /*$maClasse-> afficherRowDossierClientModeTransportModeLicence2($_GET['id_cli'], 
                                                $_GET['id_mod_trans'], $_GET['id_mod_trac'], $_GET['commodity'], 
                                                $premiere_entree, $nombre_dossier_par_page);*/

                        /*$maClasse-> afficherDossierClientModeTransportModeLicence2($_GET['id_cli'], 
                                                $_GET['id_mod_trans'], $_GET['id_mod_trac'], $_GET['commodity'], 
                                                $premiere_entree, $nombre_dossier_par_page);*/

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
                      <a class="page-link" href="dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>&page=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
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
                      <a class="page-link" href="dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>

                  <?php
                   }
                  }

                  if ($page_actuelle < $nombre_de_pages)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="dossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_trac=<?php echo $_GET['id_mod_trac'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&commodity=<?php echo $_GET['commodity'];?>&page=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
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
  <script type="text/javascript">
    var items = 0;
    function addItem(){
      items++;
      var html = "<tr>";
          html += "<td class='col_1'><input type='text'></td>";
          html += "<td class='col_6'><input type='text'></td>"
          html += "</tr>"; 

      document.getElementById("tbody").insertRow().innertHTML = html;
    }
  </script>

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

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
            <input type="date" name="date_fact" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">LICENCE </label>
            <select name="num_lic" id="num_lic" class="form-control cc-exp" onchange="xajax_afficherFobMaxLicence(this.value),xajax_selectionnerAVPourLicence(this.value),xajax_afficherMaskAV(av.value)" required>
              <option></option>
              <option value="UNDER VALUE">UNDER VALUE</option>
                <?php
                  $maClasse->selectionnerLicenceEnCoursModeleClient($_GET['id_mod_trac'], $_GET['id_cli']);
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BALANCE LICENCE</label>
            <span id="balance_fob"></span>
          </div>
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB DECLAREE</label>
            <span id="fob"></span>
          </div>
 
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FRET</label>
            <span id="fret"></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
            <span id="assurance"></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AUTRE FRAIS</label>
            <span id="autre_frais"></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">WEIGHT</label>
            <input type="number" min="0" step="0.01" name="poids" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">PO REF</label>
            <input type="text" name="po_ref" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AV LICENCE</label>
            <select name="ref_av" id="av" class="form-control cc-exp" onchange="xajax_afficherMaskAV(this.value)" >
              <option value=""></option>
                <?php
                  //$maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_trac']);
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AV AVEC MASK</label>
            <span id="cod_dos_1"></span>
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
