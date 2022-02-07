<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  
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


?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="fa fa-bell nav-icon"></i> Rapports d'Inspection Sans AV <?php echo $client;?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <?php

              if(isset($_POST['creerAV'])){
                
                if (($maClasse-> getLicence($_POST['num_lic'])['num_lic'])!=null) {
                  if (isset($_FILES['fichier_av']['name'])) {

                    $fichier_av = $_FILES['fichier_av']['name'];
                    $tmp_av = $_FILES['fichier_av']['tmp_name'];

                  }else{
                    $fichier_av = NULL;
                    $tmp_av = NULL;
                  }

                  $maClasse-> creerAV($_POST['cod'], $_POST['date_av'], $_POST['montant_av'], 
                                            $_POST['fxi'], $_POST['num_lic'], $fichier_av, $tmp_av,
                                            $_SESSION['id_util'], $_POST['id_mon']);
                  $maClasse-> MAJ_codAllDossier($_POST['ref_crf'], $_POST['cod']);
                ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Opération reussie!</strong> Attestation de vérification <b><?php echo $_POST['cod'];?></b> créée avec succès.
                  </div>
                <?php
                }else{
                  ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Opération Erronée!</strong> La licence <b><?php echo $_POST['num_lic'];?></b> n'existe pas dans le système, veuillez contacter le service des licences.
                  </div>
                <?php
                }
                  
              }
              ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">

                <table class=" table table-dark table-bordered table-head-fixed table-hover text-nowrap table-sm">
                  <thead>
                    <tr>
                      <th>N.</th>
                      <th>REF</th>
                      <th>DATE</th>
                      <th colspan="2">DOSSIERS</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     
                        /*if(isset($_POST['rech'])){
                          $maClasse-> afficherLicenceRecherche($_GET['id_mod_lic'], $_GET['id_cli'], 
                                                      $_GET['id_type_lic'], $_POST['num_lic']);
                        }*/

                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;

                        $nombre_total_dossier = $maClasse-> getNombreIrSansAVClient($_GET['id_cli']);

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
                        
                        $maClasse-> afficherIrSansAv($_GET['id_cli'], $premiere_entree, $nombre_dossier_par_page);
                        
                    ?>
                  </tbody>
                </table>
              </div>
              <div>
                <hr>
                <hr>
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

