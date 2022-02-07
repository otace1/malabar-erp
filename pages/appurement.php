<?php
  include("tete.php");
  include("pretPourAppurementExcel.php");
  include("apurementBanqueExcel.php");
  $licence = $maClasse-> getLicence($_GET['num_lic']);

 ?>

  <div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="fa fa-check nav-icon"></i> APUREMENT BANQUE LICENCE <?php echo $_GET['num_lic'];?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                  <?php
                    if(isset($_POST['appurer'])){

                      $fichier_doc = $_FILES['fichier_doc']['name'];
                      $tmp = $_FILES['fichier_doc']['tmp_name'];

                      $maClasse-> creerDocumentAppurement($fichier_doc, $_GET['num_lic'], $_SESSION['id_util'], $tmp);

                      $id_doc = $maClasse-> getIdDocumentAppurement($fichier_doc, $_SESSION['id_util']);

                      for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

                        if (isset($_POST['check_'.$i])) {
                          $maClasse-> creerAppurementLicence($_POST['id_dos_'.$i], $id_doc, $_SESSION['id_util']);
                        }

                      }
                      ?>
                      <script type="text/javascript">
                        alert('Appurement effectué avec succèes');
                      </script>
                      <?php
                    }
                  ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table  table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr>
                    	<th>NUMERO</th>
                    	<th>SOUSCRIPTEUR</th>
                    	<th>FOB</th>
                    	<th>BALANCE</th>
                    	<th>Nbre DOSSIERS</th>
                    	<th>FOB DOSSIERS</th>
                    </tr>
                  </thead>
                  <tbody>
                    </tr>
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
                    		<?php echo number_format($licence['fob']-$maClasse->getSommeFobLicence($licence['num_lic']), 2, ',', ' ');?>
                    	</td>
                    	<td style="text-align: center;">
                    		<?php echo number_format($maClasse->getNbreDossierLicence($licence['num_lic']), 0, ',', ' ');?>
                    	</td>
                    	<td style="text-align: right;">
                    		<?php echo number_format($maClasse->getSommeFobLicence($licence['num_lic']), 2, ',', ' ');?>
                    	</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <hr>
              <hr>
		        <div class="header">
		          <h5><i class="fa fa-folder-open nav-icon"></i> DOSSIERS AFFECTES </h5>
		        </div>
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table  table-head-fixed table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr>
                    	<th style="text-align: center; ">#</th>
                    	<th style="text-align: center; ">MCA FILE REF</th>
                      <th style="text-align: center; ">REF AV</th>
                      <th style="text-align: center; ">MONTANT AV</th>
                    	<th style="text-align: center; ">N<sup><u>o</u></sup> E</th>
                    	<th style="text-align: center; ">N<sup><u>o</u></sup> L</th>
                    	<th style="text-align: center; ">N<sup><u>o</u></sup> Q</th>
                    	<th style="text-align: center; ">FOB</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $maClasse-> afficherDossierLicence($_GET['num_lic']);
                    ?>
                  </tbody>
                </table>
              </div>
              <hr>
              <hr>
            <!-- /.card -->


            <div class="row">
                <div class="col-md-12">
                  <!-- general form elements disabled -->
                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-folder-open nav-icon"></i> DOSSIERS PRETS POUR APUREMENT 
                        <button class="btn btn-default" onclick="tableToExcel('exportationExcelPretApurement', 'Trackings')">
                          <img src="../images/xls.png" width="30px">
                        </button>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="" data-parsley-validate enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                              <label>Accusée de reception de la banque</label><br>
                              <input type="file" name="fichier_doc" required>
                              <button type="submit" name="appurer" class="btn btn-info">Valider</button>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table  table-head-fixed table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th style="text-align: center; ">MCA FILE REF</th>
                                    <th style="text-align: center; ">REF AV</th>
                                    <th style="text-align: center; ">MONTANT AV</th>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> E</th>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> L</th>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> Q</th>
                                    <th style="text-align: center; ">FOB</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherDossierLicencePretAppurement($_GET['num_lic']);
                                  ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                        <!-- input states -->
                      </form>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
            </div>

              <hr>
              <hr>
                <div class="col-md-12">
                  <!-- general form elements disabled -->
                  <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-folder-open nav-icon"></i> DOSSIERS APURES PAR BANQUE
                        <button class="btn btn-default">
                          <img src="../images/xls.png" width="30px" onclick="tableToExcel('exportationExcelApurement', 'Trackings')">
                        </button>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="" data-parsley-validate enctype="multipart/form-data">
                        <div class="row">
                          <!--<div class="col-sm-12">
                            <div class="form-group">
                              <label>Accusée de reception de la banque</label><br>
                              <input type="file" name="fichier_doc" required>
                              <button type="submit" name="appurer" class="btn btn-info">Valider</button>
                            </div>
                          </div>-->

                          <div class="col-sm-12">
                            
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table  table-head-fixed table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th style="text-align: center; ">MCA FILE REF</th>
                                    <th style="text-align: center; ">REF AV</th>
                                    <th style="text-align: center; ">MONTANT AV</th>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> E</th>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> L</th>
                                    <th style="text-align: center; ">N<sup><u>o</u></sup> Q</th>
                                    <th style="text-align: center; ">FOB</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherDossierLicenceAppuresBanque($_GET['num_lic']);
                                  ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                        <!-- input states -->
                      </form>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>