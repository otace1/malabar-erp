<?php
  include("tete.php");
  //include("popUpDashboardLicenceExcel.php");
  $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getClient($_GET['id_cli'])['nom_cli'].'</span>';
  $cod = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['cod'].'</span>';
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
                        <i class="fa fa-folder-open nav-icon"></i> DOSSIERS <?php echo $client?> A.V. <?php echo $cod;?>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0" style="height: 500px;">
                              <table class="table table-dark  table-head-fixed table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th>MCA REF</th>
                                    <th>FOB</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherDossiersAv($_GET['cod'], $_GET['id_cli']);
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