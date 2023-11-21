<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='apurementLicence.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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

  if( isset($_POST['appurement']) ){
    ?>
    <script type="text/javascript">
      window.open('appurement.php?num_lic=<?php echo $_POST['num_lic']; ?>','pop1','width=800,height=800');
    </script>
    <?php
  }

  if (isset($_POST['modifierTransmissionApurement'])) {
    
    if (isset($_FILES['fichier_trans_ap']['name'])) {

      $fichier_trans_ap = $_FILES['fichier_trans_ap']['name'];
      $tmp = $_FILES['fichier_trans_ap']['tmp_name'];

      $maClasse-> uploadAccuseeRecpetionTransmissionApurement($_POST['id_trans_ap'], $fichier_trans_ap, $tmp);

    }else{
      $fichier_trans_ap = NULL;
      $tmp = NULL;
    }

  }

  if(isset($_POST['update'])){

    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
      $licence = $_POST['debut'];
      $num_lic = $_POST['num_lic_'.$licence];

      //echo $_POST['id_dos_'.$num_lic.'_'.$i].' - '.$_POST['cod_'.$num_lic.'_'.$i];

        $maClasse-> MAJ_cod($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['cod_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_fxi($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fxi_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_montant_av($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['montant_av_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_fob($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fob_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_fret($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fret_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_assurance($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['assurance_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_autre_frais($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['autre_frais_'.$num_lic.'_'.$i]);

      /*if (isset($_POST['fret_dos_'.$i]) && ($_POST['fret_dos_'.$i] != '')) {
        $maClasse-> MAJ_fret_dos($_POST['id_dos_'.$i], $_POST['fret_dos_'.$i]);
      }

      if (isset($_POST['assurance_dos_'.$i]) && ($_POST['assurance_dos_'.$i] != '')) {
        $maClasse-> MAJ_assurance_dos($_POST['id_dos_'.$i], $_POST['assurance_dos_'.$i]);
      }

      if (isset($_POST['autre_frais_dos_'.$i]) && ($_POST['autre_frais_dos_'.$i] != '')) {
        $maClasse-> MAJ_autre_frais_dos($_POST['id_dos_'.$i], $_POST['autre_frais_dos_'.$i]);
      }*/
    }

  }


  if (isset($_POST['appurement'])) {
    
    //Creation Transmission Apurement
    $maClasse-> creerTransmissionApurement(NULL, $_POST['ref_trans_ap'], 
                                  $_SESSION['id_util'], NULL, $_POST['banque'], $_POST['date_trans_ap']);

    $id_trans_ap = $maClasse-> verifierTransmissionApurement($_POST['ref_trans_ap'], $_POST['date_trans_ap'], $_POST['banque']);

    for ($i=1; $i <= 50 ; $i++) { 
      
      if (isset($_POST['id_dos_'.$i]) && ($_POST['id_dos_'.$i]!='')) {
        
        $maClasse-> creerDetailApurement($id_trans_ap, $_POST['id_dos_'.$i]);

      }

    }
    /*?>
    <script type="text/javascript">
      alert('Transmission Apurement <?php echo $_POST['ref_trans_ap'];?> créée avec succès.')
    </script>
    <?php*/
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
          <h3><i class="fa fa-check nav-icon"></i> APUREMENT LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="clignote">
                  <?php echo $maClasse-> getNombreDossierPretAEtreApuresLicenceClient($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Dossiers en attente apurement</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDossierEnAttenteApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-olive">
              <div class="inner">
                <h3 id="DivClignotante" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreTransmissionApurement($_GET['id_mod_lic'], $_GET['id_cli']);
                  ?>
                </h3>

                <p>Transmission(s) Apurement</p>
              </div>
              <div class="icon" id="DivClignotante2" style="visibility:visible;">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpTransmissionApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

              <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="clignote">
                  <?php echo $maClasse-> getNombreTransmissionApurementSansFichier($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Transmission(s) Apurement sans Accusée de reception</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpTransmissionApurementNotificationSansFichier.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="">
                  <?php echo $maClasse-> getNombreDossierApures($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Dossiers Apurés</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDossiersApuresNotification.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
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

                    if(isset($_POST['modifierLicence'])){
                      $maClasse-> modifierLicence($_POST['num_lic'], $_POST['date_val'], $_POST['date_exp'], 
                                                  $_POST['fournisseur'], $_POST['commodity'], $_POST['fob'], 
                                                  $_POST['fret'], $_POST['assurance'], $_POST['autre_frais'], 
                                                  $_POST['num_lic_old'], $_POST['id_mon'], $_POST['id_mod_paie'], 
                                                  $_POST['id_type_lic'], $_POST['id_sous_type_paie']);
                      echo '<script>alert("Opération reussie!! Licence '.$_POST['num_lic_old'].' modifiée avec succès.");</script>';
                    }

                    if(isset($_POST['creerLicence'])){

                      if($_GET['id_mod_lic']){

                        if(!isset($_POST['num_lic']) || ($_POST['num_lic'] == '')){
                          $_POST['num_lic'] = 'INVOICE '.$_POST['ref_fact'];
                        }

                        if (isset($_FILES['fichier_lic']['name'])) {

                          $fichier_lic = $_FILES['fichier_lic']['name'];
                          $tmp = $_FILES['fichier_lic']['tmp_name'];

                        }else{
                          $fichier_lic = NULL;
                          $tmp = NULL;
                        }

                        if (isset($_FILES['fichier_fact']['name'])) {

                          $fichier_fact = $_FILES['fichier_fact']['name'];
                          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

                        }else{
                          $fichier_fact = NULL;
                          $tmp_fact = NULL;
                        }
                        if ( $maClasse-> getLicenceFacture($_POST['ref_fact']) != null ){

                          echo '<script>alert("Erreur!! Impossible de créer cette licence avec la facture '.$_POST['ref_fact'].' car il existe déjà une licence ayant cette facture.");</script>';

                        }else{

                          if ( $maClasse-> getLicence($_POST['num_lic']) == null ){
                            $maClasse-> creerLicenceIB2($_POST['id_banq'], $_POST['num_lic'], $_POST['id_cli'], 
                                                      $_POST['id_post'], $_POST['id_mon'], $_POST['fob'], 
                                                      $_POST['assurance'], $_POST['fret'], $_POST['autre_frais'], 
                                                      $_POST['fsi'], $_POST['aur'], 
                                                      $_POST['id_mod_trans'], $_POST['ref_fact'], $_POST['date_fact'], 
                                                      $_POST['fournisseur'], $_POST['date_val'], $_POST['date_exp'], 
                                                      NULL, $_GET['id_mod_lic'], $_SESSION['id_util'], 
                                                      $fichier_lic, $tmp, $fichier_fact, $tmp_fact, 
                                                      $_POST['id_type_lic'], $_POST['id_mod_paie'], 
                                                      $_POST['id_sous_type_paie'], $_POST['provenance'],
                                                      $_POST['commodity'], $_POST['tonnage'], 
                                                      $_POST['poids'], $_POST['unit_mes']);
                            }else{

                              echo '<script>alert("Erreur!! Impossible de créer la licence '.$_POST['num_lic'].' car il existe déjà une licence ayant ce numéro.");</script>';

                            }
                        }

                      }

                    }


                    if(isset($_POST['nouvelleLicenceExport'])){

                      if($_GET['id_mod_lic']){

                        if(!isset($_POST['num_lic']) || ($_POST['num_lic'] == '')){
                          $_POST['num_lic'] = 'INVOICE '.$_POST['ref_fact'];
                        }

                        if (isset($_FILES['fichier_lic']['name'])) {

                          $fichier_lic = $_FILES['fichier_lic']['name'];
                          $tmp = $_FILES['fichier_lic']['tmp_name'];

                        }else{
                          $fichier_lic = NULL;
                          $tmp = NULL;
                        }

                        if (isset($_FILES['fichier_fact']['name'])) {

                          $fichier_fact = $_FILES['fichier_fact']['name'];
                          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

                        }else{
                          $fichier_fact = NULL;
                          $tmp_fact = NULL;
                        }
                        if ( $maClasse-> getLicenceFacture($_POST['ref_fact']) != null ){

                          echo '<script>alert("Erreur!! Impossible de créer cette licence avec la facture '.$_POST['ref_fact'].' car il existe déjà une licence ayant cette facture.");</script>';

                        }else{

                          if ( $maClasse-> getLicence($_POST['num_lic']) == null ){

    
                            $maClasse-> creerEBTracking($_POST['num_lic'], $_POST['date_val'], $_POST['poids'], 
                                                        $_POST['unit_mes'], $_GET['id_cli'], $_POST['id_march'], 
                                                        $_POST['date_exp'], $_SESSION['id_util'], $_POST['destination'], 
                                                        $_POST['acheteur'], $_POST['id_mod_trans'], 
                                                        $_POST['ref_fact'], $fichier_lic, $tmp);


                            }else{

                              echo '<script>alert("Erreur!! Impossible de créer la licence '.$_POST['num_lic'].' car il existe déjà une licence ayant ce numéro.");</script>';

                            }
                        }

                      }

                    }
                  ?>
                  <?php
                  if( (isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) ){
                    ?>
                <!--<button class="btn btn-primary square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicenceExport">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>-->
                  <?php
                  }
                  ?>
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                    <i class="fa fa-filter"></i> Filtrage Client
                </button>
                <!--<button class="btn btn-success square-btn-adjust" data-toggle="modal" data-target=".appurement">
                    <i class="fa fa-check"></i> Appurement
                </button>-->
                <!--<button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierLicence">
                    <i class="fa fa-upload"></i> Uploade Fichier
                </button>-->

                </h3>
                  <div class="card-tools">
                    <div class="pull-right">

                <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".creerTransmisionApurement">
                    <i class="fa fa-plus"></i> Nouvelle Transmission Apurement
                </button>

                <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportTramissionApurementAll.php?id_cli=<?php echo $_GET['id_cli']; ?>','pop1','width=80,height=80');">
                  <i class="fas fa-file-excel"></i> Export
                </button>

                <!--<form method="POST" action="">
                        <div class="input-group input-group-sm">
                          <input type="text" name="num_lic" class="form-control float-right" placeholder="Entrez le numéro">

                          <div class="input-group-append">
                            <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                    <hr>
                    <span class="badge badge-success">Apurée</span>
                    <span class="badge badge-dark">Cloturée</span>
                    <span class="badge badge-info">Partiellement</span>
                    <span class="badge badge-danger">Expirée</span>

                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>-->

                    </div>

                  </div>
              </div>                
              <?php
              if (isset($_POST['appurement'])) {
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Opération reussie!</strong> Transmission Apurement <b><?php echo $_POST['ref_trans_ap'];?></b> créée avec succès.
                </div>
              <?php
              }
              ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <div class="row">
                  <div class="col-md-6">
                    <form method="POST" action="">
                        <div class="input-group input-group-sm">
                          <input type="text" name="num_lic" class="form-control float-right" placeholder="Récherche Licence / Dossier">

                          <div class="input-group-append">
                            <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                  </div>
                  <div class="col-md-6">
                    <form method="POST" action="">
                        <div class="input-group input-group-sm">
                          <input type="text" name="num_lic" class="form-control float-right" placeholder="Récherche par Licence">

                          <div class="input-group-append">
                            <button type="submit" name="rech2" class="btn btn-info"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
                </table>
                <hr>
                <table class=" table  table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="text-align: center;">#</th>
                      <th style="text-align: center;">CLIENT</th>
                      <th style="border: 1px solid white; text-align: center;">N<sup>o</sup></th>
                      <th style="border: 1px solid white; text-align: center;">DATE</th>
                      <th style="border: 1px solid white; text-align: center;">BANQUE</th>
                      <th style="border: 1px solid white; text-align: center;">Nbre. LICENCES</th>
                      <th style="border: 1px solid white; text-align: center;">Nbre. DOSSIERS</th>
                      <th style="border: 1px solid white; text-align: center;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if( isset($_GET['id_cli']) && isset($_GET['id_type_lic']) ){
                        //$_GET['id_cli'] = null;


                        if (isset($_POST['rech'])) {

                          $maClasse-> afficherApurementLicenceDossier($_GET['id_cli'], $_GET['id_mod_lic'], $_POST['num_lic']);

                        }

                        /*if(isset($_POST['rech'])){
                          $maClasse-> afficherLicenceRecherche($_GET['id_mod_lic'], $_GET['id_cli'], 
                                                      $_GET['id_type_lic'], $_POST['num_lic']);
                        }*/

                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;

                        $nombre_total_dossier = $maClasse-> getNombreDocumentApurement($_GET['id_cli'], $_GET['id_mod_lic']);

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
                        
                        $maClasse-> afficherApurement($_GET['id_cli'], $_GET['id_mod_lic'], $premiere_entree, $nombre_dossier_par_page);
                        
                      }else{
                        $page_actuelle = 1;
                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;
                        $nombre_total_dossier = 1;
                        $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                      }
                      
                    ?>
                  </tbody>
                </table>
              </div>
              <ul class="pagination pull-right card-tools">
                  <?php
                  if ($page_actuelle > 1)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="apurementLicence.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>&page=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
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
                      <a class="page-link" href="apurementLicence.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>

                  <?php
                   }
                  }

                  if ($page_actuelle < $nombre_de_pages)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="apurementLicence.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>&page=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
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
  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<?php
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage CLIENT <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">TYPE</label>
            <select name="id_type_lic" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerTypeLicence();
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn btn-primary">Valider</button>
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
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade creerTransmisionApurement" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Transmission Apurement <?php echo $modele['sigle_mod_lic'].$client;?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">BANQUE</label>
            <select name="banque" onchange="" class="form-control cc-exp" required>
              <option></option>
                <?php
                  $maClasse->selectionnerNomBanque();
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">REF.</label>
            <input name="ref_trans_ap" type="text" value="<?php echo $maClasse-> buildReferenceTransmissionApurementModeleLicence($_GET['id_mod_lic']);?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE</label>
            <input name="date_trans_ap" type="date" value="" class="form-control cc-exp" required>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12">
            <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-bordered table-hover table-dark table-head-fixed">
              <thead>
                <tr class="" style="text-align: center;">
                  <th>#</th>
                  <th width="20%">MCA REF</th>
                  <th width="25%">LICENCE</th>
                  <th width="15%">MONTANT DECL.</th>
                  <th>REF. DECL.</th>
                  <th>REF. LIQ.</th>
                  <th>REF. QUIT.</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  for ($i=1; $i <= 50 ; $i++) { 
                  ?>
                  <tr>
                    <td class="" style="text-align: center;">
                      <?php echo $i;?>
                    </td>
                    <td class="">
                      <select name="id_dos_<?php echo $i;?>" id="id_dos_<?php echo $i;?>" onchange="xajax_afficherDetailsDossierMutliple(this.value, <?php echo $i;?>);" class="form-control cc-exp">
                        <option></option>
                          <?php
                            $maClasse->selectionnerDossierEnAttenteApurement($_GET['id_cli'], $_GET['id_mod_lic']);
                          ?>
                      </select>
                    </td>
                    <td style="text-align: center;">
                      <span id="num_lic<?php echo $i;?>"></span>
                    </td>
                    <td style="text-align: center;">
                      <span id="montant_decl<?php echo $i;?>"></span>
                    </td>
                    <td style="text-align: center;">
                      <span id="ref_decl<?php echo $i;?>"></span>
                    </td>
                    <td style="text-align: center;">
                      <span id="ref_liq<?php echo $i;?>"></span>
                    </td>
                    <td style="text-align: center;">
                      <span id="ref_quit<?php echo $i;?>"></span>
                    </td>
                  </tr>
                  <?php
                  }
                ?>
                <tr>
                  <td sty></td>
                </tr>
              </tbody>
            </table>
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="appurement" class="btn btn-primary">Valider</button>
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
