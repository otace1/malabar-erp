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
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='listerFactureDossier.php?id_mod_lic_fact=$id_mod_lic_fact&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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
    $_GET['id_cli'] = NULL;
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
          <h5><i class="fa fa-copy nav-icon"></i> FACTURES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h5>
        </div>

      </div><!-- /.container-fluid -->

                  <!-- <div class="card-tools">
                    <div class="pull-right">
                      <button class="btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                          <i class="fa fa-filter"></i> Filtrage Client
                      </button>
                    </div>
                  </div> -->
    </section>
    <?php

    if( isset($_POST['validerFacture']) ){
     $maClasse-> MAJ_validation_facture_dossier($_POST['ref_fact'], '1');
      ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Op??ration reussie!</strong> Facture <b><?php echo $_POST['ref_fact'];?></b> valid??e avec succ??s.
        </div>
      <?php
    }

    if( isset($_POST['transmissionFacture']) ){
     $maClasse-> MAJ_transmission_facture_dossier($_POST['ref_fact'], '1', $_SESSION['id_util']);
      ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Op??ration reussie!</strong> Facture <b><?php echo $_POST['ref_fact'];?></b> transmis avec succ??s.
        </div>
      <?php
    }

    if( isset($_POST['supprimerFacture']) ){
     $maClasse-> supprimerFactureDossier($_POST['ref_fact']);
      ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Op??ration reussie!</strong> Facture <b><?php echo $_POST['ref_fact'];?></b> supprimer avec succ??s.
        </div>
      <?php
    }

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                 <span style="color: #CCCC00;" class="badge badge-dark"><?php echo $maClasse-> getNombreFactureDossierEnAttenteValidation($_GET['id_cli'], $_GET['id_mod_lic_fact']);?></span> EN ATTENTE VALIDATION
                </h5>

                <div class="card-tools">
                  <form class="form-inline ml-3" method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" name="ref_fact" type="search" placeholder="Entrez num??ro Facture" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn bg-primary btn-navbar" type="submit" name="search1">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table class=" table table-dark table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white;">#</th>
                      <th style="border: 1px solid white;">REFERENCE</th>
                      <th style="border: 1px solid white; text-align: center;">DATE</th>
                      <th style="border: 1px solid white; text-align: center;">MARCHANDISE</th>
                      <th style="border: 1px solid white; text-align: center;">MONTANT</th>
                      <th style="border: 1px solid white; text-align: center;">EDITEUR</th>
                      <th style="border: 1px solid white; text-align: center;">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    if (isset($_POST['search1'])) {
                      $maClasse-> afficherFactureDossierRecherche($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_POST['ref_fact'], '0');
                      echo '<tr><td><hr></td></tr>';
                    }

                      $nombre_dossier_par_page = 5;//$maClasse-> getUtilisateur($_SESSION['id_util'])['ligne'];
                      $debut_affichage_pagination = 1;

                      $nombre_total_dossier = $maClasse-> getNombreFactureDossierEnAttenteValidation($_GET['id_cli'], $_GET['id_mod_lic_fact']);

                      $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                      if(isset($_GET['page1']) && ($_GET['page1']!='')) // Si la variable $_GET['page1'] existe...
                      {
                         $page_actuelle=intval($_GET['page1']);

                         if($page_actuelle>$nombre_de_pages) // Si la valeur de $page_actuelle (le num??ro de la page) est plus grande que $nombreDePages...
                         {
                            $page_actuelle = $nombre_de_pages ;
                         }

                      }
                      else
                      {
                         $page_actuelle=1; // La page actuelle est la n??1
                      }
                      $premiere_entree=($page_actuelle-1)*$nombre_dossier_par_page; // On calcul la premi??re entr??e ?? lire

                    $maClasse-> afficherFactureDossierEnAttenteValidation($_GET['id_cli'], $_GET['id_mod_lic_fact'], $premiere_entree, $nombre_dossier_par_page);
                    ?>
                  </tbody>
                </table>
                <br>
                 <ul class="pagination pull-right card-tools">
                    <?php
                    if ($page_actuelle > 1)
                    {
                    ?>
                      <li class="page-item">
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&debut=<?php echo $_GET['debut'];?>&fin=<?php echo $_GET['fin'];?>&page1=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
                      </li>
                    <?php
                    }

                    //D??but calcul affichage boucle de pagination
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

                    if(($page_actuelle+5) <= $nombre_de_pages)
                    {
                      $pagination_limite = $page_actuelle+5;
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
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&page1=<?php echo $i; ?>"><?php echo $i; ?></a>
                      </li>

                    <?php
                     }
                    }

                    if ($page_actuelle < $nombre_de_pages)
                    {
                    ?>
                      <li class="page-item">
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&page1=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
                      </li>
                    <?php
                    }

                    ?>
              </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  <span style="color: rgb(0, 255, 128);" class="badge badge-dark"><?php echo $maClasse-> getNombreFactureDossierValideesEnAttenteTransmission($_GET['id_cli'], $_GET['id_mod_lic_fact']);?></span> VALIDEES NON TRANSMISES
                </h5>

                <div class="card-tools">
                  <form class="form-inline ml-3" method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" name="ref_fact" type="search" placeholder="Entrez num??ro Facture" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn bg-primary btn-navbar" type="submit" name="search2">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>


              </div>   
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class=" table table-dark table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white;">#</th>
                      <th style="border: 1px solid white;">REFERENCE</th>
                      <th style="border: 1px solid white; text-align: center;">DATE</th>
                      <th style="border: 1px solid white; text-align: center;">MARCHANDISE</th>
                      <th style="border: 1px solid white; text-align: center;">MONTANT</th>
                      <th style="border: 1px solid white; text-align: center;">EDITEUR</th>
                      <th style="border: 1px solid white; text-align: center;">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    if (isset($_POST['search2'])) {
                      $maClasse-> afficherFactureDossierRecherche($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_POST['ref_fact'], '1');
                      echo '<tr><td><hr></td></tr>';
                    }

                      $nombre_dossier_par_page = 5;//$maClasse-> getUtilisateur($_SESSION['id_util'])['ligne'];
                      $debut_affichage_pagination = 1;

                      $nombre_total_dossier = $maClasse-> getNombreFactureDossierValideesEnAttenteTransmission($_GET['id_cli'], $_GET['id_mod_lic_fact']);

                      $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                      if(isset($_GET['page2']) && ($_GET['page2']!='')) // Si la variable $_GET['page2'] existe...
                      {
                         $page_actuelle=intval($_GET['page2']);

                         if($page_actuelle>$nombre_de_pages) // Si la valeur de $page_actuelle (le num??ro de la page) est plus grande que $nombreDePages...
                         {
                            $page_actuelle = $nombre_de_pages ;
                         }

                      }
                      else
                      {
                         $page_actuelle=1; // La page actuelle est la n??1
                      }
                      $premiere_entree=($page_actuelle-1)*$nombre_dossier_par_page; // On calcul la premi??re entr??e ?? lire

                    $maClasse-> afficherFactureDossierValiseesEnAttenteTransmission($_GET['id_cli'], $_GET['id_mod_lic_fact'], $premiere_entree, $nombre_dossier_par_page);
                    ?>
                  </tbody>
                </table>
                <br>
                 <ul class="pagination pull-right card-tools">
                    <?php
                    if ($page_actuelle > 1)
                    {
                    ?>
                      <li class="page-item">
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&debut=<?php echo $_GET['debut'];?>&fin=<?php echo $_GET['fin'];?>&page2=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
                      </li>
                    <?php
                    }

                    //D??but calcul affichage boucle de pagination
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

                    if(($page_actuelle+5) <= $nombre_de_pages)
                    {
                      $pagination_limite = $page_actuelle+5;
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
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&page2=<?php echo $i; ?>"><?php echo $i; ?></a>
                      </li>

                    <?php
                     }
                    }

                    if ($page_actuelle < $nombre_de_pages)
                    {
                    ?>
                      <li class="page-item">
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&page2=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
                      </li>
                    <?php
                    }

                    ?>
              </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  <span style="" class="badge badge-dark"><?php echo $maClasse-> getNombreFactureDossierValideesTransmise($_GET['id_cli'], $_GET['id_mod_lic_fact']);?></span> VALIDEES TRANSMISES
                </h5>

                <div class="card-tools">
                  <form class="form-inline ml-3" method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" name="ref_fact" type="search" placeholder="Entrez num??ro Facture" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn bg-primary btn-navbar" type="submit" name="search3">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>


              </div>                
              <?php
              
              
              ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class=" table table-dark table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white;">#</th>
                      <th style="border: 1px solid white;">REFERENCE</th>
                      <th style="border: 1px solid white; text-align: center;">DATE</th>
                      <th style="border: 1px solid white; text-align: center;">MARCHANDISE</th>
                      <th style="border: 1px solid white; text-align: center;">MONTANT</th>
                      <th style="border: 1px solid white; text-align: center;">EDITEUR</th>
                      <th style="border: 1px solid white; text-align: center;">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    if (isset($_POST['search3'])) {
                      $maClasse-> afficherFactureDossierRecherche($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_POST['ref_fact'], '1');
                      echo '<tr><td><hr></td></tr>';
                    }

                      $nombre_dossier_par_page = 5;//$maClasse-> getUtilisateur($_SESSION['id_util'])['ligne'];
                      $debut_affichage_pagination = 1;

                      $nombre_total_dossier = $maClasse-> getNombreFactureDossierValideesTransmise($_GET['id_cli'], $_GET['id_mod_lic_fact']);

                      $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                      if(isset($_GET['page3']) && ($_GET['page3']!='')) // Si la variable $_GET['page3'] existe...
                      {
                         $page_actuelle=intval($_GET['page3']);

                         if($page_actuelle>$nombre_de_pages) // Si la valeur de $page_actuelle (le num??ro de la page) est plus grande que $nombreDePages...
                         {
                            $page_actuelle = $nombre_de_pages ;
                         }

                      }
                      else
                      {
                         $page_actuelle=1; // La page actuelle est la n??1
                      }
                      $premiere_entree=($page_actuelle-1)*$nombre_dossier_par_page; // On calcul la premi??re entr??e ?? lire

                    $maClasse-> afficherFactureDossierValideesTransmises($_GET['id_cli'], $_GET['id_mod_lic_fact'], $premiere_entree, $nombre_dossier_par_page);
                    ?>
                  </tbody>
                </table>
                <br>
                 <ul class="pagination pull-right card-tools">
                    <?php
                    if ($page_actuelle > 1)
                    {
                    ?>
                      <li class="page-item">
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&debut=<?php echo $_GET['debut'];?>&fin=<?php echo $_GET['fin'];?>&page3=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
                      </li>
                    <?php
                    }

                    //D??but calcul affichage boucle de pagination
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

                    if(($page_actuelle+5) <= $nombre_de_pages)
                    {
                      $pagination_limite = $page_actuelle+5;
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
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&page3=<?php echo $i; ?>"><?php echo $i; ?></a>
                      </li>

                    <?php
                     }
                    }

                    if ($page_actuelle < $nombre_de_pages)
                    {
                    ?>
                      <li class="page-item">
                        <a class="page-link" href="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&page3=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
                      </li>
                    <?php
                    }

                    ?>
              </ul>
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
if(isset($_GET['id_mod_lic_fact']) && isset($_GET['id_mod_lic_fact'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
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
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn-xs btn-primary">Valider</button>
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
