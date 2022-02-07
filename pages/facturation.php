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
    echo "<script>window.location='facturation.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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

  if (isset($_POST['facturerDossier'])) {

    $maClasse-> MAJ_facture($_POST['id_dos'], '1');

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
          <h3><i class="fa fa-calculator nav-icon"></i> FACTURATION <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h3>
        </div>

      </div><!-- /.container-fluid -->

                  <div class="card-tools">
                    <div class="pull-right">
                      <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                          <i class="fa fa-filter"></i> Filtrage Client
                      </button>
                    </div>
                  </div>
    </section>

    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-4 col-sm-6 col-12">

            <?php
              if ($maClasse-> getNombreDossierAttenteFacture($_GET['id_mod_lic'], $_GET['id_cli'])>0) {
                $clignote = 'clignote';
              }else{
                $clignote = '';
              }
            ?>

            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="<?php echo $clignote;?>">
                  <?php echo $maClasse-> getNombreDossierAttenteFacture($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Dossiers en attente Facture</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <!--<a href="#" class="small-box-footer" onclick="window.open('popUpDossierEnAttenteApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>-->
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-4 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="<?php //echo $clignote;?>">
                  <?php echo $maClasse-> getNombreDossierFacture($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Dossiers Facturés</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <!--<a href="#" class="small-box-footer" onclick="window.open('popUpDossierEnAttenteApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>-->
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
                  DOSSIERS EN ATTENTE FACTURES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportFacturationDossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&type=EN ATTENTE FACTURES','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>
                </h3>

                <div class="card-tools">
                  <form method="POST" action="">
                  <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="ref_dos" class="form-control float-right" placeholder="Entrez le numéro de dossier">

                    <div class="input-group-append">
                      <button type="submit" name="rechercheDossier" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  </form>
                </div>

              </div>                
              <?php
              if (isset($_POST['facturerDossier'])) {
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Opération reussie!</strong> Dossier <b><?php echo $_POST['ref_dos'];?></b> facturé avec succès.
                </div>
              <?php
              }
              ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class=" table table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="">
                      <th style="text-align: center;" width="2%">#</th>
                      <th style="" class="">MCA FILE</th>
                      <th style="text-align: center;">REF.DECLARATION</th>
                      <th style="text-align: center;">DATE DECLARATION</th>
                      <th style="text-align: center;">REF.LIQUIDATION</th>
                      <th style="text-align: center;">DATE LIQUIDATION</th>
                      <th style="text-align: center;">REF.QUITTANCE</th>
                      <th style="text-align: center;">DATE QUITTANCE</th>
                      <th style="text-align: center;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                      if( isset($_GET['id_cli'])){
                       
                        if (isset($_POST['rechercheDossier'])) {
                          
                          $maClasse-> afficherDossierAttenteFactureRecherche($_GET['id_cli'], $_GET['id_mod_lic'], $_POST['ref_dos']);

                        }

                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;

                        $nombre_total_dossier = $maClasse-> getNombreDossierAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic']);

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
                        
                        $maClasse-> afficherDossierAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic'], $premiere_entree, $nombre_dossier_par_page);
                        
                      }else{
                        $page_actuelle = 1;
                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;
                        $nombre_total_dossier = 1;
                        $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                      }
                      
                    ?>
                    </form>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>



          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                  DOSSIERS FACTURES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportFacturationDossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&type=FACTURES','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>
                </h3>

                <div class="card-tools">
                  <form method="POST" action="">
                  <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="ref_dos" class="form-control float-right" placeholder="Entrez le numéro de dossier">

                    <div class="input-group-append">
                      <button type="submit" name="rechercheDossier2" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  </form>
                </div>

              </div>                
              <?php
              /*if (isset($_POST['facturerDossier'])) {
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Opération reussie!</strong> Dossier <b><?php echo $_POST['ref_dos'];?></b> facturé avec succès.
                </div>
              <?php
              }*/
              ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class=" table table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="">
                      <th style="text-align: center;" width="2%">#</th>
                      <th style="" class="">MCA FILE</th>
                      <th style="text-align: center;">REF.DECLARATION</th>
                      <th style="text-align: center;">DATE DECLARATION</th>
                      <th style="text-align: center;">REF.LIQUIDATION</th>
                      <th style="text-align: center;">DATE LIQUIDATION</th>
                      <th style="text-align: center;">REF.QUITTANCE</th>
                      <th style="text-align: center;">DATE QUITTANCE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                      if( isset($_GET['id_cli'])){
                       
                        if (isset($_POST['rechercheDossier2'])) {
                          
                          $maClasse-> afficherDossierFactureRecherche($_GET['id_cli'], $_GET['id_mod_lic'], $_POST['ref_dos']);

                        }

                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;

                        $nombre_total_dossier = $maClasse-> getNombreDossierAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic']);

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
                        
                        $maClasse-> afficherDossierFacture($_GET['id_cli'], $_GET['id_mod_lic'], $premiere_entree, $nombre_dossier_par_page);
                        
                      }else{
                        $page_actuelle = 1;
                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;
                        $nombre_total_dossier = 1;
                        $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                      }
                      
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
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_type_lic" value="">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage CLIENT <?php echo $modele['sigle_mod_lic'];?>.</h4>
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
