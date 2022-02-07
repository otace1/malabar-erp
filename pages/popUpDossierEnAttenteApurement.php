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
                        <i class="fa fa-folder-open nav-icon"></i> DOSSIERS PRETS A ETRE APURES <?php echo $client.$modeleLicence;?>
                        <button class="btn btn-default" onclick="window.location.replace('exportExcelDossierEnAttenteApurement.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>','pop1','width=80,height=80');">
                          <img src="../images/xls.png" width="30px">
                        </button>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0 cadre-tableau-de-donnees">
                              <table class="tableau-de-donnees table table-dark table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th>MCA REF</th>
                                    <th>FOB</th>
                                    <th>FRET</th>
                                    <th>ASSURANCE</th>
                                    <th>AUTRES FRETS</th>
                                    <th>CIF</th>
                                    <th>REF. DECL.</th>
                                    <th>DATE DECL.</th>
                                    <th>REF. LIQUID.</th>
                                    <th>DATE LIQUID.</th>
                                    <th>REF. QUIT.</th>
                                    <th>DATE QUIT.</th>
                                    <th>NUM. LICENCE</th>
                                    <th>MONNAIE</th>
                                    <th>DATE VAL.</th>
                                    <th>DATE ECH.</th>
                                    <th>CIF</th>
                                    <th>NUM. AV</th>
                                    <th>MONTANT AV</th>
                                    <th>FACTURE</th>
                                    <th>BL/LTA</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherDossiersPretAEtreApures($_GET['id_mod_lic'], $_GET['id_cli']);
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