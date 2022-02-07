<?php
  include("tete.php");
  //include("popUpDashboardLicenceExcel.php");
  $ref_dos = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getDossier($_GET['id_dos'])['ref_dos'].'</span>';
  $utilisateur = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getUtilisateur($maClasse-> getDossier($_GET['id_dos'])['id_util'])['nom_util'].'</span>';
  $date_dos = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getDossier($_GET['id_dos'])['date_creat_dos'].'</span>';
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
                    <i class="fa fa-folder-open nav-icon"></i> DOSSIER <?php echo $ref_dos.$date_dos.$utilisateur;?>
                    <!-- <button class="btn btn-default" onclick="tableToExcel('exportationExcel', 'Trackings')">
                      <img src="../images/xls.png" width="30px">
                    </button> -->
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="card-body table-responsive p-0" style="height: 800px;">
                            <table class="table table-dark  table-head-fixed table-bordered table-hover text-nowrap table-sm">
                              <thead>
                                <tr>
                                  <th style="text-align: center;">DATE</th>
                                  <th style="border: 1px solid white; text-align: center;">COLONNE</th>
                                  <th style="border: 1px solid white; text-align: center;">VALEUR</th>
                                  <th style="border: 1px solid white; text-align: center;">UTILISATEUR</th>
                              </thead>
                              <tbody>
                                <?php
                                  $maClasse-> afficherLogDossier($_GET['id_dos']);
                                ?>
                              </tbody>
                            </table>
                          </div>
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