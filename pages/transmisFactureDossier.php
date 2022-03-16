<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic_fact = $_GET['id_mod_lic_fact'];
    $id_cli = $_POST['id_cli'];
    $type_fact = $_GET['type_fact'];
    echo "<script>window.location='transmisFactureDossier.php?id_mod_lic_fact=$id_mod_lic_fact&id_cli=$id_cli&type_fact=$type_fact';</script>";
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

  if (isset($_POST['modifierTransmisFacture'])) {
    
    if (isset($_FILES['fichier_trans_fact']['name'])) {

      $fichier_trans_fact = $_FILES['fichier_trans_fact']['name'];
      $tmp = $_FILES['fichier_trans_fact']['tmp_name'];

      $maClasse-> uploadAccuseeReceptionTransmisFacture($_POST['id_trans_fact'], $fichier_trans_fact, $tmp);

    }else{
      $fichier_trans_fact = NULL;
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
    $maClasse-> creerTransmisFactureDossier(NULL, $_POST['ref_trans_fact'], 
                                  $_SESSION['id_util'], NULL, $_POST['date_trans_fact']);

    $id_trans_fact = $maClasse-> verifierTransmisFactureDossier($_POST['ref_trans_fact'], $_POST['date_trans_fact']);

    for ($i=1; $i <= 50 ; $i++) { 
      
      if (isset($_POST['ref_fact_'.$i]) && ($_POST['ref_fact_'.$i]!='')) {
        
        $maClasse-> creerDetailTransmisFactureDossier($id_trans_fact, $_POST['ref_fact_'.$i]);
        $maClasse-> MAJ_transmission_facture_dossier($_POST['ref_fact_'.$i], '1', $_SESSION['id_util']);

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
          <h5><i class="fa fa-check nav-icon"></i> TRANSMIS FACTURES  <?php echo strtoupper($_GET['type_fact']).' '.$modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h5>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <div class="inner">
                <h4 class="clignote">
                  <?php echo $maClasse-> getNombreFactureAttenteTransmis($_GET['id_mod_lic_fact'], $_GET['id_cli'], $_GET['type_fact']);?>
                </h4>

                <p class="text-sm">Facture(s) en attente transmis</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpFactureEnAttenteTransmis.php?id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_fact=<?php echo $_GET['type_fact'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-olive">
              <div class="inner">
                <h4 id="DivClignotante" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreTransmisFacture2($_GET['id_mod_lic_fact'], $_GET['id_cli'], $_GET['type_fact']);
                  ?>
                </h4>

                <p class="text-sm">Transmission(s) Factures</p>
              </div>
              <div class="icon" id="DivClignotante2" style="visibility:visible;">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpTransmisFacture.php?id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_fact=<?php echo $_GET['type_fact'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

              <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h4 class="clignote">
                  <?php echo $maClasse-> getNombreTransmisFactureSansFichier($_GET['id_mod_lic_fact'], $_GET['id_cli'], $_GET['type_fact']);?>
                </h4>

                <p class="text-sm">Transmis Factures sans Accusée de reception</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpTransmisFactureSansFichier.php?id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_fact=<?php echo $_GET['type_fact'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h4 class="">
                  <?php echo $maClasse-> getNombreFactureTransmis($_GET['id_mod_lic_fact'], $_GET['id_cli'], $_GET['type_fact']);?>
                </h4>

                <p class="text-sm">Factures Transmises</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpFactureTransmis.php?id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_fact=<?php echo $_GET['type_fact'];?>','pop1','width=1500,height=900');">
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
                  
                <!--<button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                    <i class="fa fa-filter"></i> Filtrage Client
                </button>
                <button class="btn btn-success square-btn-adjust" data-toggle="modal" data-target=".appurement">
                    <i class="fa fa-check"></i> Appurement
                </button>-->
                <!--<button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierLicence">
                    <i class="fa fa-upload"></i> Uploade Fichier
                </button>-->

                </h3>
                  <div class="card-tools">
                    <div class="pull-right">

                <button class="btn btn-primary btn-xs square-btn-adjust" data-toggle="modal" data-target=".creerTransmisionApurement">
                    <i class="fa fa-plus"></i> Nouvelle Transmission Factures
                </button>
<!-- 
                <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportTramissionApurementAll.php?id_cli=<?php echo $_GET['id_cli']; ?>','pop1','width=80,height=80');">
                  <i class="fas fa-file-excel"></i> Export
                </button>
 -->
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

                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']; ?>&type_fact=<?php echo $_GET['type_fact']; ?>','pop1','width=80,height=80');">
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
                  <strong>Opération reussie!</strong> Transmission Factures <b><?php echo $_POST['ref_trans_fact'];?></b> créée avec succès.
                </div>
              <?php
              }
              ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                    <!-- <form method="POST" action="">
                        <div class="input-group input-group-sm">
                          <input type="text" name="num_lic" class="form-control float-right" placeholder="Récherche Licence / Dossier">

                          <div class="input-group-append">
                            <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                    </form> -->
                <table class=" table  table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="text-align: center;">#</th>
                      <th style="text-align: center;">CLIENT</th>
                      <th style="border: 1px solid white; text-align: center;">N<sup>o</sup></th>
                      <th style="border: 1px solid white; text-align: center;">DATE</th>
                      <th style="border: 1px solid white; text-align: center;">Nbre. FACTURES</th>
                      <th style="border: 1px solid white; text-align: center;">Nbre. DOSSIERS</th>
                      <th style="border: 1px solid white; text-align: center;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if( isset($_GET['id_cli']) && isset($_GET['type_fact']) ){
                        //$_GET['id_cli'] = null;


                        if (isset($_POST['rech'])) {

                          $maClasse-> afficherApurementLicenceDossier($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_POST['num_lic']);

                        }

                        /*if(isset($_POST['rech'])){
                          $maClasse-> afficherLicenceRecherche($_GET['id_mod_lic_fact'], $_GET['id_cli'], 
                                                      $_GET['id_type_lic'], $_POST['num_lic']);
                        }*/

                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;

                        $nombre_total_dossier = $maClasse-> getNombreTransmisFacture($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['type_fact']);

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
                        
                        $maClasse-> afficherTransmisFacture($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['type_fact'], $premiere_entree, $nombre_dossier_par_page);
                        
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
                      <a class="page-link" href="transmisFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&type_fact=<?php echo $_GET['type_fact'];?>&page=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
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
                      <a class="page-link" href="transmisFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&type_fact=<?php echo $_GET['type_fact'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>

                  <?php
                   }
                  }

                  if ($page_actuelle < $nombre_de_pages)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="transmisFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&type_fact=<?php echo $_GET['type_fact'];?>&page=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
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
if(isset($_GET['id_mod_lic_fact']) && isset($_GET['id_mod_lic_fact'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog modal-sm">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage Client.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
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
if(isset($_GET['id_mod_lic_fact']) && isset($_GET['id_mod_lic_fact'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade creerTransmisionApurement" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title"><i class="fa fa-plus"></i> Transmission Factures <?php echo $modele['sigle_mod_lic'].$client;?>.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">REF.</label>
            <input name="ref_trans_fact" type="text" value="<?php echo $maClasse-> buildReferenceTransmissionFactureClient($_GET['id_cli']);?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">DATE</label>
            <input name="date_trans_fact" type="date" value="" class="form-control cc-exp" required>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12">
            <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-bordered table-hover table-dark table-head-fixed table-sm">
              <thead>
                <tr class="" style="text-align: center;">
                  <th width="20%">#</th>
                  <th>FACTURES</th>
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
                      <select name="ref_fact_<?php echo $i;?>" id="ref_fact_<?php echo $i;?>" onchange="" class="form-control cc-exp">
                        <option></option>
                          <?php
                            $maClasse->selectionnerFactureEnAttenteTransmis($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['type_fact']);
                          ?>
                      </select>
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
