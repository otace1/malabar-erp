<?php
  include("tetePopCDN.php");
  //include("popUpDashboardLicenceExcel.php");
  if (!isset($_GET['type_trans_ap'])) {
    $_GET['type_trans_ap'] = 'dgda';
  }
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
                        <i class="fa fa-folder-open nav-icon"></i> DOSSIERS PRETS A ETRE APURES SANS FOB <?php echo $client.$modeleLicence;?>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body">
                              <table id="afficherDossiersSansFOBApuresAjax" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm small text-nowrap table-responsive p-0">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Numero Licence</th>
                                    <th>Ref.Dossier</th>
                                    <th>Num.CVEE</th>
                                    <th>FOB CVEE</th>
                                    <th>FOB Declaré</th>
                                    <th>Ref. Decl.</th>
                                    <th>Date Decl.</th>
                                    <th>Ref. Liq.</th>
                                    <th>Date Liq.</th>
                                    <th>Ref. Quit.</th>
                                    <th>Date Quit.</th>
                                    <th>Type</th>
                                    <th>Remarque</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                 
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

  <?php
  include('pied.php');
  ?>

  <script type="text/javascript">
    
  </script>