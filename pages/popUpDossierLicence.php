<?php
  include("tete.php");
  $licence = $maClasse-> getLicence($_GET['num_lic']);
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
                  <div class="card card-<?php echo $_GET['couleur'];?>">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-folder-open nav-icon"></i> DETAIL LICENCE <?php echo $_GET['num_lic'];?>
                        <button class="btn btn-success" onclick="window.location.replace('exportPopUpDossiersLicence.php?num_lic=<?php echo $_GET['num_lic']; ?>','pop1','width=80,height=80');">
                          <i class="fa fa-file-excel"></i>
                        </button>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0" style="">
                              <table class="table table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th>NUMERO</th>
                                    <th>SOUSCRIPTEUR</th>
                                    <th>FOB</th>
                                    <th>POIDS</th>
                                    <th>BALANCE FOB</th>
                                    <th>BALANCE POIDS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <?php echo $licence['num_lic'];?>
                                    </td>
                                    <td>
                                      <?php echo $licence['nom_cli'];?>
                                    </td>
                                    <td style="text-align: right;">
                                      <?php echo number_format($licence['fob'], 2, ',', ' ');?>
                                    </td>
                                    <td style="text-align: right;">
                                      <?php echo number_format($licence['poids_lic'], 2, ',', ' ');?>
                                    </td>
                                    <td style="text-align: right;">
                                      <?php echo number_format($licence['fob']-$maClasse->getSommeFobLicence($licence['num_lic']), 2, ',', ' ');?>
                                    </td>
                                    <td style="text-align: right;">
                                      <?php echo number_format($licence['poids_lic']-$maClasse->getSommePoidsLicence($licence['num_lic']), 2, ',', ' ');?>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <br>
                              <table class="table  table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th>Nbre DOSSIERS</th>
                                    <th>FOB DOSSIERS</th>
                                    <th>POIDS DOSSIERS</th>
                                    <th>DOSSIERS TRANS. BANQUE</th>
                                    <th>FOB DOSSIERS TRANSMIS</th>
                                    <th>BALANCE FOB DOSSIERS NON-TRANSMIS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td style="text-align: center;">
                                      <?php echo number_format($maClasse->getNbreDossierLicence($licence['num_lic']), 0, ',', ' ');?>
                                    </td>
                                    <td style="text-align: right;">
                                      <?php echo number_format($maClasse->getSommeFobLicence($licence['num_lic']), 2, ',', ' ');?>
                                    </td>
                                    <td style="text-align: right;">
                                      <?php echo number_format($maClasse->getSommePoidsLicence($licence['num_lic']), 2, ',', ' ');?>
                                    </td>
                                    <td style="text-align: center;">
                                      <?php echo number_format($maClasse->getNbreDossierTransmisBanqueLicence($licence['num_lic']), 0, ',', ' ');?>
                                    </td>
                                    <td style="text-align: center;">
                                      <?php echo number_format($maClasse->getSommeFobTransmisBanqueLicence($licence['num_lic']), 2, ',', ' ');?>
                                    </td>
                                    <td style="text-align: center;">
                                      <?php echo number_format($licence['fob']-$maClasse->getSommeFobTransmisBanqueLicence($licence['num_lic']), 2, ',', ' ');?>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <hr>
                              <table class="table  table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th style="text-align: center; ">MCA FILE REF</th>
                                    <?php
                                      if ($maClasse-> getLicence($_GET['num_lic'])['id_mod_lic']=='1') {
                                    ?>
                                    <th style="text-align: center; ">REF CVEE</th>
                                    <th style="text-align: center; ">MONTANT CVEE</th>
                                    <?php
                                      }else{
                                    ?>
                                    <th style="text-align: center; ">REF AV</th>
                                    <th style="text-align: center; ">MONTANT AV</th>
                                    <?php
                                      }
                                    ?>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> E</th>
                                    <th style="text-align: center; ">Date E</th>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> L</th>
                                    <th style="text-align: center; ">Date L</th>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> Q</th>
                                    <th style="text-align: center; ">Date Q</th>
                                    <th style="text-align: center; ">FOB</th>
                                    <th style="text-align: center; ">POIDS</th>
                                    <th style="text-align: center; ">TRANSMIS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherDossierLicence($_GET['num_lic']);
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