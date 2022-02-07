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
          <h3><i class="far fa-file nav-icon"></i> FACTURES LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client.$etat;?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-4 col-sm-6 col-12">

            <div class="small-box bg-primary">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php echo $maClasse-> getNombreFactureClientModeldeLicence($_GET['id_cli'], $_GET['id_mod_lic']);?>
                </h3>

                <p>Factures enregistrées</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.location='facture.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&etat=';">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-4 col-sm-6 col-12">

            <?php
              if ($maClasse-> getNombreFactureAttenteLicence($_GET['id_mod_lic'], $_GET['id_cli'])>0) {
                $clignote = 'clignote';
              }else{
                $clignote = '';
              }
            ?>

            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="<?php echo $clignote;?>">
                  <?php echo $maClasse-> getNombreFactureAttenteLicence($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Factures sans licence</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.location='facture.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&etat=Factures sans licence';">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-4 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php echo $maClasse-> getNombreFactureAvecLicence($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Facture ayant licence</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.location='facture.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&etat=Facture ayant licence';">
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                  <?php
                    if(isset($_POST['creerFacture'])){

                      if($_GET['id_mod_lic']){

                        if (isset($_FILES['fichier_fact']['name'])) {

                          $fichier_fact = $_FILES['fichier_fact']['name'];
                          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

                        }else{
                          $fichier_fact = NULL;
                          $tmp_fact = NULL;
                        }

                        $maClasse-> creerFacture($_POST['ref_fact'], $_POST['date_fact'], $_POST['date_fact_rec'], 
                                                  $_POST['fournisseur'], $_POST['date_val'], $fichier_fact, $tmp_fact,
                                                  $_GET['id_mod_lic'], $_POST['id_cli'], $_POST['commodity'], 
                                                  $_POST['montant_fact'], $_POST['id_mon'], $_POST['fret_fact'], 
                                                  $_POST['assurance_fact'], $_POST['autre_frais_fact'], $_POST['fsi'], 
                                                  $_POST['aur']);

                      }

                    }

                    if(isset($_POST['modifierFacture'])){

                      $maClasse-> modifierFacture($_POST['ref_fact'], $_POST['date_fact'], $_POST['date_fact_rec'], $_POST['fournisseur'], $_POST['date_val'], $_POST['id_cli'], $_POST['commodity'], $_POST['montant_fact'], $_POST['id_mon'], $_POST['fret_fact'], $_POST['assurance_fact'], $_POST['autre_frais_fact'], $_POST['ref_fact_old'], $_POST['fsi'], $_POST['aur']);

                      if (isset($_FILES['fichier_fact']['name']) && ($_FILES['fichier_fact']['name'] != '')) {

                        $fichier_fact = $_FILES['fichier_fact']['name'];
                        $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

                        if ($fichier_fact != $maClasse-> getElementFacture($_POST['ref_fact_old'])['fichier_fact']) {

                           $maClasse-> modifierFichierFacture($_POST['ref_fact'], $fichier_fact, $tmp_fact);

                        }
                        ?>
                        <script type="text/javascript">
                          alert("La facture <?php echo $_POST['ref_fact'];?> modifiée avec succès.");
                        </script>
                        <?php
                      }

                    }
                  ?>
                <button class="btn btn-primary square-btn-adjust" data-toggle="modal" data-target=".creerFacture">
                    <i class="fa fa-plus"></i> Nouvelle Facture
                </button>
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".filtrageFactureClient">
                    <i class="fa fa-filter"></i> Filtrage Client
                </button>
                <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportExcelFactureLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&etat=<?php echo $_GET['etat']; ?>','pop1','width=80,height=80');">
                  <i class="fas fa-file-excel"></i> Exporter en Excel
                </button>

                </h3>
                  <div class="card-tools">
                <form method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input type="text" name="ref_fact" class="form-control float-right" placeholder="Entrez le numéro facture">

                      <div class="input-group-append">
                        <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                </form>
                    <div class="pull-right">
                      <!--<i class="fa fa-circle text-success"></i>--> <span class="badge badge-success">Ayant une licence</span>
                      <!--<i class="fa fa-circle text-danger"></i>--> <span class="badge badge-danger">Ayant depasser 2 jours sans Licence</span>
                    </div>

                  </div>
              </div>
              <!-- /.card-header -->

              <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">


                <?php
                if(isset($_POST['modifier'])){

                  //echo "<script>alert('Hello');</script>";

                  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
                  $facture = $maClasse-> getElementFacture($_POST['ref_fact_old']);
                ?>

                    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
                      <input type="hidden" name="ref_fact_old" value="<?php echo $_POST['ref_fact_old'];?>">
                    <div class="modal-content">
                      <div class="modal-header bg-warning">
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Modification Facture <?php echo $_POST['ref_fact_old'];?>.</h4>
                        <button onclick="window.location = 'facture.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>';" type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">

                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">SOUSCRIPTEUR</label>
                            <select name="id_cli" onchange="" class="form-control cc-exp" required>
                                <option value="<?php echo $facture['id_cli'];?>">
                                  <?php echo $facture['nom_cli'];?>
                                </option>
                                <option></option>
                                <?php
                                    $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                                  
                                ?>
                            </select>
                          </div>

                          <?php
                              if($modele['id_mod_lic'] == '2' && isset($modele)){
                                ?>
                                
                            <div class="col-md-3">
                              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
                              <input type="text" name="ref_fact" value="<?php echo $facture['ref_fact'];?>" class="form-control cc-exp" required>
                            </div>

                            <div class="col-md-3">
                              <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
                              <input type="date" name="date_fact" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" value="<?php echo $facture['date_fact'];?>" required>
                            </div>

                            <div class="col-md-3">
                              <label for="x_card_code" class="control-label mb-1">DATE RECEPTION FACTURE</label>
                              <input type="date" name="date_fact_rec" value="<?php echo $facture['date_fact_rec'];?>" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
                            </div>
                            <div class="col-md-3">
                              <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
                              <input type="text" name="fournisseur" value="<?php echo $facture['fournisseur'];?>" class="form-control cc-exp" required>
                            </div>
                            <?php
                                }
                              ?>

                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">DATE SOUSCRIPTION LICENCE</label>
                            <input type="date" name="date_val" value="<?php echo $facture['date_val'];?>" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
                          </div>
                          
                          <?php
                            if(($modele['id_mod_lic'] == '1' || $modele['id_mod_lic'] == '2') && isset($modele)){
                              ?>
                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
                            <input type="text" name="commodity" value="<?php echo $facture['commodity'];?>" value="N/A" class="form-control cc-exp" required>
                          </div>
                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">MONNAIE</label>
                            <select name="id_mon" class="form-control cc-exp" required>
                              <option value="<?php echo $facture['id_mon'];?>">
                                <?php echo $facture['sig_mon'];?>
                              </option>
                              <option></option>
                              <?php
                                $maClasse-> selectionnerMonnaie();
                              ?>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">FOB</label>
                            <input type="number" name="montant_fact" value="<?php echo $facture['montant_fact'];?>" min="0" step="0.01" class="form-control cc-exp">
                          </div>
                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">FRET</label>
                            <input type="number" name="fret_fact" value="<?php echo $facture['fret_fact'];?>" min="0" step="0.01" class="form-control cc-exp">
                          </div>
                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
                            <input type="number" name="assurance_fact" value="<?php echo $facture['assurance_fact'];?>" min="0" step="0.01" class="form-control cc-exp">
                          </div>
                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">AUTRE FRAIS</label>
                            <input type="number" name="autre_frais_fact" value="<?php echo $facture['autre_frais_fact'];?>" min="0" step="0.01" class="form-control cc-exp">
                          </div>

                            <div class="col-md-3">
                              <label for="x_card_code" class="control-label mb-1">FICHIER FACTURE</label>
                              <input type="file" name="fichier_fact" class="form-control cc-exp">
                            </div>

                          <?php
                              }
                            ?>

                          <?php
                            if(($modele['id_mod_lic'] == '1' || $modele['id_mod_lic'] == '2') && isset($modele)){
                              ?>

                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">FSI</label>
                            <input type="text" name="fsi" value="<?php echo $facture['fsi'];?>" class="form-control cc-exp">
                          </div>
                          <div class="col-md-3">
                            <label for="x_card_code" class="control-label mb-1">AUR</label>
                            <input type="text" name="aur" value="<?php echo $facture['aur'];?>" class="form-control cc-exp">
                          </div>
                              <?php
                            }?>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button onclick="window.location = 'facture.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>';" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" name="modifierFacture" class="btn btn-primary">Valider</button>
                      </div>
                    </div>
                    </form>
                    <!-- /.modal-content -->

                <?php
                }
                ?>

                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-12">
                  <hr>
                </div>

              </div>

              <div class="card-body table-responsive p-0">
                <table class=" table tableau1 table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_1">#</th>
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_6">N<sup><u>o</u></sup> FACTURE</th>
                      <th style="border: 1px solid white;">N<sup><u>o</u></sup> LICENCE</th>
                      <th style="border: 1px solid white;">CLIENT</th>
                      <th style="border: 1px solid white;">DATE FACTURE</th>
                      <th style="border: 1px solid white;">DATE RECEPTION FACTURE</th>
                      <th style="border: 1px solid white;">DELAI DE RECEPTION</th>
                      <?php
                      if ($_GET['id_mod_lic'] == '1') {
                        ?>
                      <th style="border: 1px solid white;">ACHETEUR</th>
                        <?php
                      }else{
                        ?>
                      <th style="border: 1px solid white;">FOURNISSEUR</th>
                        <?php
                      }
                      ?>
                      <th style="border: 1px solid white;">DATE SOUSCRIPTION LICENCE</th>
                      <th style="border: 1px solid white;">MONNAIE</th>
                      <th style="border: 1px solid white;">FOB</th>
                      <th style="border: 1px solid white;">FRET</th>
                      <th style="border: 1px solid white;">ASSURANCE</th>
                      <th style="border: 1px solid white;">AUTRE FRAIS</th>
                      <th style="border: 1px solid white;">TOTAL</th>
                      <?php
                      if ($_GET['id_mod_lic'] == '2') {
                        ?>
                      <th style="border: 1px solid white;">FSI</th>
                      <th style="border: 1px solid white;">AUR</th>
                        <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $nombre_dossier_par_page = 15;
                      $debut_affichage_pagination = 1;

                      $nombre_total_dossier = $maClasse-> getNombreFactureClientModeldeLicence($_GET['id_cli'], $_GET['id_mod_lic']);

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
                      
                      if(!isset($_GET['id_cli'])){
                        $_GET['id_cli'] = null;
                      }
                      if(!isset($_GET['id_type_lic'])){
                        $_GET['id_type_lic'] = null;
                      }

                      if (isset($_POST['rech'])) {
                        $maClasse-> afficherFactureLicenceModeleRecherche($_GET['id_mod_lic'], $_GET['id_cli'], $_POST['ref_fact']);
                      }

                      $maClasse-> afficherFactureLicenceModele($_GET['id_mod_lic'], $_GET['id_cli'], $premiere_entree, $nombre_dossier_par_page, $_GET['etat']);
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
              <ul class="pagination pull-right card-tools">
                  <?php
                  if ($page_actuelle > 1)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="facture.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&page=<?php echo $page_actuelle - 1; ?>&etat=<?php echo $_GET['etat'];?>">Page pr&eacute;c&eacute;dente</a>
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
                      <a class="page-link" href="facture.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&page=<?php echo $i; ?>&etat=<?php echo $_GET['etat'];?>"><?php echo $i; ?></a>
                    </li>

                  <?php
                   }
                  }

                  if ($page_actuelle < $nombre_de_pages)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="facture.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&page=<?php echo $page_actuelle + 1; ?>&etat=<?php echo $_GET['etat'];?>">Page suivante</a>
                    </li>
                  <?php
                  }

                  ?>
            </ul>
            <!-- /.card -->
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
