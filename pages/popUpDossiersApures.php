<?php
  include("tete.php");
  //include("popUpDashboardLicenceExcel.php");
  $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getClient($_GET['id_cli'])['nom_cli'].'</span>';
  $ref_trans_ap = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['ref_trans_ap'].'</span>';
  $date_trans_ap = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;"> DU '.$maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['date_trans_ap'].'</span>';
  $banque = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['banque'].'</span>';
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
                        <i class="fa fa-folder-open nav-icon"></i> DETAIL TRANSMISSION APUREMENT <?php echo $client.$ref_trans_ap.$date_trans_ap.$banque;?>
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
                                    <th style="text-align: center; ">#</th>
                                    <th>MCA REF</th>
                                    <th>NUM. LICENCE</th>
                                    <th>MONNAIE</th>
                                    <th>DATE VAL.</th>
                                    <th>DATE ECH.</th>
                                    <th>CIF</th>
                                    <th>MONTANT APURE</th>
                                    <th>NUM. AV</th>
                                    <th>MONTANT AV</th>
                                    <th>FACTURE</th>
                                    <th>ID</th>
                                    <th>BL/LTA</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherDossiersApuresTransmission($_GET['id_trans_ap']);
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