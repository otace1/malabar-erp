<?php
  include("tete.php");
  //include("popUpDashboardLicenceExcel.php");
  $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getClient($_GET['id_cli'])['nom_cli'].'</span>';
  $modeleLicence = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']).'</span>';
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
                        <i class="fa fa-folder-open nav-icon"></i> TRANSMISSION APUREMENT <?php echo $client.$modeleLicence;?>
                        <button class="btn btn-default" onclick="tableToExcel('exportationExcel', 'Trackings')">
                          <img src="../images/xls.png" width="30px">
                        </button>
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
                                    $maClasse-> afficherApurement($_GET['id_cli'], $_GET['id_mod_lic'], 0, 100000);
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