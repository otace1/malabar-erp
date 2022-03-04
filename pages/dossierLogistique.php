<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include('dossierExcel.php');

  $client = $maClasse-> getElementClient($_GET['id_cli']);
  //$client = '';
  

  if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
    $mode_transport = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).'</span>';
  }else{
    $mode_transport = '';
  }

for ($i=1; $i <= 15 ; $i++) { 

  if(isset($_POST['updateDossier__'.$i]) && ($_POST['updateDossier__'.$i]!='')){

      $maClasse-> MAJ_ref_dos($_POST['id_dos__'.$i], $_POST['ref_dos_'.$i]);
      $maClasse-> updateFile($_POST['id_dos__'.$i], $_GET['id_cli'], $_GET['id_mod_trans'], 
                                      $_GET['id_trans'], $i);
  }
}


//FIN Delete Dossier

  if(isset($_POST['update'])){

    for ($i=1; $i <= $_POST['nbre'] ; $i++) {
      if (isset($_POST['ref_mca_'.$i]) && ($_POST['ref_mca_'.$i]!='')) {
        $maClasse-> MAJ_ref_mca_logistic($_POST['ref_dos_'.$i], $_POST['ref_mca_'.$i]);
      }

      if (isset($_POST['road_manif_'.$i]) && ($_POST['road_manif_'.$i]!='')) {
        $maClasse-> MAJ_road_manif_logistic($_POST['ref_dos_'.$i], $_POST['road_manif_'.$i]);
      }

      if (isset($_POST['ref_fact_'.$i]) && ($_POST['ref_fact_'.$i]!='')) {
        $maClasse-> MAJ_ref_fact_logistic($_POST['ref_dos_'.$i], $_POST['ref_fact_'.$i]);
      }
      
      if (isset($_POST['ref_batch_'.$i]) && ($_POST['ref_batch_'.$i]!='')) {
        $maClasse-> MAJ_ref_batch_logistic($_POST['ref_dos_'.$i], $_POST['ref_batch_'.$i]);
      }
      
      if (isset($_POST['poids_'.$i]) && ($_POST['poids_'.$i]!='')) {
        $maClasse-> MAJ_poids_logistic($_POST['ref_dos_'.$i], $_POST['poids_'.$i]);
      }
      
      if (isset($_POST['ref_po_'.$i]) && ($_POST['ref_po_'.$i]!='')) {
        $maClasse-> MAJ_ref_po_logistic($_POST['ref_dos_'.$i], $_POST['ref_po_'.$i]);
      }
      
      if (isset($_POST['montant_po_'.$i]) && ($_POST['montant_po_'.$i]!='')) {
        $maClasse-> MAJ_montant_po_logistic($_POST['ref_dos_'.$i], $_POST['montant_po_'.$i]);
      }
      
      if (isset($_POST['origine_'.$i]) && ($_POST['origine_'.$i]!='')) {
        $maClasse-> MAJ_origine_logistic($_POST['ref_dos_'.$i], $_POST['origine_'.$i]);
      }
      
      if (isset($_POST['destination_'.$i]) && ($_POST['destination_'.$i]!='')) {
        $maClasse-> MAJ_destination_logistic($_POST['ref_dos_'.$i], $_POST['destination_'.$i]);
      }
      
      if (isset($_POST['date_dep_fbm_'.$i]) && ($_POST['date_dep_fbm_'.$i]!='')) {
        $maClasse-> MAJ_date_dep_fbm_logistic($_POST['ref_dos_'.$i], $_POST['date_dep_fbm_'.$i]);
      }
      
      if (isset($_POST['transit_'.$i]) && ($_POST['transit_'.$i]!='')) {
        $maClasse-> MAJ_transit_logistic($_POST['ref_dos_'.$i], $_POST['transit_'.$i]);
      }
      
      if (isset($_POST['date_transit_'.$i]) && ($_POST['date_transit_'.$i]!='')) {
        $maClasse-> MAJ_date_transit_logistic($_POST['ref_dos_'.$i], $_POST['date_transit_'.$i]);
      }
      
      if (isset($_POST['date_fd_'.$i]) && ($_POST['date_fd_'.$i]!='')) {
        $maClasse-> MAJ_date_fd_logistic($_POST['ref_dos_'.$i], $_POST['date_fd_'.$i]);
      }
      
      if (isset($_POST['deliv_date_'.$i]) && ($_POST['deliv_date_'.$i]!='')) {
        $maClasse-> MAJ_deliv_date_logistic($_POST['ref_dos_'.$i], $_POST['deliv_date_'.$i]);
      }
      
      if (isset($_POST['ref_pod_'.$i]) && ($_POST['ref_pod_'.$i]!='')) {
        $maClasse-> MAJ_ref_pod_logistic($_POST['ref_dos_'.$i], $_POST['ref_pod_'.$i]);
      }
      
      if (isset($_POST['statut_'.$i]) && ($_POST['statut_'.$i]!='')) {
        $maClasse-> MAJ_statut_logistic($_POST['ref_dos_'.$i], $_POST['statut_'.$i]);
      }
      
      if (isset($_POST['remarque_'.$i]) && ($_POST['remarque_'.$i]!='')) {
        $maClasse-> MAJ_remarque_logistic($_POST['ref_dos_'.$i], $_POST['remarque_'.$i]);
      }
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
          <h3>
            <?php
            if ($_GET['id_mod_trans']=='1') {
              ?>
              <i class="fa fa-truck nav-icon"></i> 
              <?php
            }else if ($_GET['id_mod_trans']=='3') {
              ?>
              <i class="fa fa-plane nav-icon"></i> 
              <?php
            }
            ?>
            LOGISTIC FILE <?php echo '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$client['nom_cli'].'</span>'.$mode_transport;?>
          </h3>
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
                    if(isset($_POST['creerDossierLogistique'])){
                        $maClasse-> creerDossierLogistique($_POST['ref_dos'], $_POST['ref_mca'], $_POST['road_manif'], 
                                                          $_POST['ref_fact'], $_POST['ref_batch'], $_POST['poids'], 
                                                          $_POST['ref_po'], 
                                                          $_POST['montant_po'], $_POST['origine'], $_POST['destination'], 
                                                          $_POST['transit'], $_GET['id_cli'], $_GET['id_mod_trans'], 
                                                          $_GET['id_trans'], $_SESSION['id_util']);
                    }
                  ?>
                <!--<button class="btn btn-primary square-btn-adjust" id="add">
                    <i class="fa fa-plus"></i>
                </button>-->
                <button class="btn btn-xs btn-info square-btn-adjust" data-toggle="modal" data-target=".nouveauDossierLogistique" <?php echo $maClasse-> getDataUtilisateur($_SESSION['id_util'])['tracking_enab']?>>
                      <i class="fa fa-plus"></i> Create New File
                  </button>

                  </h3>
                    <div class="card-tools">
                      <div class="row">
                        <div class="col-md-6">
                          <button class="btn btn-xs btn-success" onclick="window.location.replace('exportDossierLogistique.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_trans=<?php echo $_GET['id_trans']; ?>','pop1','width=80,height=80');">
                            <i class="fa fa-file-excel"></i> Export to Excel
                          </button>
                        </div>
                        <div class="col-md-6">
                          <form method="POST" action="">
                              <div class="input-group input-group-sm">
                                <input type="text" name="ref_dos" class="form-control float-right" placeholder="Enter File Number">

                                <div class="input-group-append">
                                  <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                                </div>
                              </div>
                          </form>
                        </div>
                      </div>
                        <!-- <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <i class="fas fa-file-excel"></i> Export
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item"onclick="window.location.replace('exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_trans=<?php echo $_GET['id_trans']; ?>','pop1','width=80,height=80');">
                              Export All Files
                            </a>
                            <a class="dropdown-item" href="#"><hr></a>
                            <a class="dropdown-item"onclick="window.location.replace('exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_trans=<?php echo $_GET['id_trans']; ?>&annee=2022','pop1','width=80,height=80');">
                              Export 2022 Files
                            </a>
                            <a class="dropdown-item" href="#"><hr></a>
                            <a class="dropdown-item"onclick="window.location.replace('exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_trans=<?php echo $_GET['id_trans']; ?>&annee=2021','pop1','width=80,height=80');">
                              Export 2021 Files
                            </a>
                            <a class="dropdown-item" href="#"><hr></a>
                            <a class="dropdown-item"onclick="window.location.replace('exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_trans=<?php echo $_GET['id_trans']; ?>&annee=2020','pop1','width=80,height=80');">
                              Export 2020 Files
                            </a>
                            <a class="dropdown-item" href="#"><hr></a>
                          </div>
                        </button> -->
                    </div>
                  </div>
              <!-- /.card-header -->

                <?php
                  
                        $nombre_dossier_par_page = $maClasse-> getUtilisateur($_SESSION['id_util'])['ligne'];
                        $debut_affichage_pagination = 1;

                        $nombre_total_dossier = $maClasse-> getNombreDossierLogistiqueClientModeTransport($_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_trans']);

                        $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                        if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
                        {
                           $page_actuelle=intval($_GET['page']);

                           if($page_actuelle>$nombre_de_pages) // Si la valeur de $page_actuelle (le numéro de la page) est plus grande que $nombreDePages...
                           {
                              $page_actuelle = $nombre_de_pages ;
                           }

                           $page = $_GET['page'];
                        }
                        else
                        {
                           $page_actuelle=1; // La page actuelle est la n°1
                           $page = 1;
                        }
                        $premiere_entree=($page_actuelle-1)*$nombre_dossier_par_page; // On calcul la première entrée à lire
                        

                ?>
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-xs btn-success" name="update" <?php echo $maClasse-> getDataUtilisateur($_SESSION['id_util'])['tracking_enab'];?>>
                        Mettre à jour
                      </button>
                    </div>
                  </div>
                  
              <div class="card-body table-responsive p-0 cadre-tableau-de-donnees">
    <div id="alert_message"></div>

                <table id="user_data_2" cellspacing="0" width="100%" class="tableau-de-donnees  table table-hover text-nowrap table-sm">
                  <thead>
                  <tr class="bg bg-dark">
                    <th>#</th>
                    <th>FILE REF</th>
                    <th>MCA FILE</th>
                    <th>MODE OF DELIVERY</th>
                    <th>MANIFEST / AWB</th>
                    <th>INVOICE NO.</th>
                    <th>BATCH Num.</th>
                    <th>POIDS/KG</th>
                    <th>PO/ QUOTE REF</th>
                    <th>AMOUNT</th>
                    <th>ORIGIN</th>
                    <th>FINAL DESTINATION</th>
                    <th>DEPART FBM</th>
                    <th>TRANSIT</th>
                    <th>TRANSIT DATE</th>
                    <th>ARRIVAL FD</th>
                    <th>DELIVERY DATE</th>
                    <th>POD REF</th>
                    <th>STATUS</th>
                    <th>REMARK</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        

                        if (isset($_POST['rech'])) {
                          
                          $maClasse-> afficherDossierLogistiqueClientModeTransportRecherche($_POST['ref_dos'], 
                            $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_trans'], $premiere_entree, $nombre_dossier_par_page);
                          ?>
                          <tr>
                            <td class="col_1 bg-teal"><hr></td>
                            <td class="col_6 bg-teal"><hr></td>
                            <td><hr></td>
                          </tr>
                          <?php
                          $premiere_entree=(($page_actuelle-1)*$nombre_dossier_par_page)+1; // On calcul la première entrée à lire
                        }


                        $maClasse-> afficherDossierLogistiqueClientModeTransport($_GET['id_cli'], 
                                                $_GET['id_mod_trans'], $_GET['id_trans'], $premiere_entree, $nombre_dossier_par_page);

                    ?>
                      </tbody>
                    </table>
                  </div>
                  <input type="hidden" name="nbre" value="<?php echo ($premiere_entree+$maClasse-> getUtilisateur($_SESSION['id_util'])['ligne']);?>">
                  <div class="row">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-xs btn-success" name="update" <?php echo $maClasse-> getDataUtilisateur($_SESSION['id_util'])['tracking_enab'];?>>
                        Mettre à jour
                      </button>
                    </div>
                  </div>
                  
                    
        
                    </form>
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
                      <a class="page-link" href="dossierLogistique.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_trans=<?php echo $_GET['id_trans'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&statut=<?php echo $_GET['statut'];?>&commodity=<?php echo $_GET['commodity'];?>&cleared=<?php echo $_GET['cleared'];?>&page=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
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

                  if(($page_actuelle+18) <= $nombre_de_pages)
                  {
                    $pagination_limite = $page_actuelle+18;
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
                      <a class="page-link" href="dossierLogistique.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_trans=<?php echo $_GET['id_trans'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&statut=<?php echo $_GET['statut'];?>&commodity=<?php echo $_GET['commodity'];?>&cleared=<?php echo $_GET['cleared'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>

                  <?php
                   }
                  }

                  if ($page_actuelle < $nombre_de_pages)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="dossierLogistique.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&num_lic=<?php echo $_GET['num_lic'];?>&id_trans=<?php echo $_GET['id_trans'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&statut=<?php echo $_GET['statut'];?>&commodity=<?php echo $_GET['commodity'];?>&cleared=<?php echo $_GET['cleared'];?>&page=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
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


<div class="modal fade nouveauDossierLogistique" id="modal-default">
  <div class="modal-dialog modal-lg">
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
            <label for="x_card_code" class="control-label mb-1">FILE NUMBER</label>
            <input type="text" name="ref_dos" value="<?php echo $maClasse-> getMcaFileLogistique($_GET['id_cli'], $_GET['id_trans']);?>" class="form-control cc-exp" required>
          </div>
    
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MCA FILE Num.</label>
            <input type="text" name="ref_mca" class="form-control cc-exp" >
          </div>
          <?php
          if ($_GET['id_mod_trans']=='1') {
          ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ROAD MANIFEST</label>
            <input type="text" name="road_manif" class="form-control cc-exp" required>
          </div>
          <?php
          }else if ($_GET['id_mod_trans']=='3') {
          ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AWB</label>
            <input type="text" name="road_manif" class="form-control cc-exp" required>
          </div>
          <?php
          }
          ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">INVOICE NO.</label>
            <input type="text" name="ref_fact" class="form-control cc-exp" >
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BATCH NUM.</label>
            <input type="text" name="ref_batch" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">POIDS</label>
            <input type="number" min="0" step="0.01" name="poids" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">PO REF.</label>
            <input type="text" name="ref_po" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">AMOUNT</label>
            <input type="number" min="0" step="0.01" name="montant_po" class="form-control cc-exp" >
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ORIGINE</label>
            <input type="text" name="origine" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FINAL DESTINATION</label>
            <input type="text" name="destination" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TRANSIT</label>
            <input type="text" name="transit" class="form-control cc-exp" required>
          </div>

      </div>
    </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerDossierLogistique" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>


  <?php include("pied.php");?>
  <?php include("script.php");?>
