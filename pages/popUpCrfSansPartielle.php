<?php
  include("tete.php");
  // $licence = $maClasse-> getLicence($_GET['num_lic']);

  if (isset($_POST['creerPartielle'])) {

    $maClasse-> creerPartielle($_POST['num_part'], $_POST['fob'], $_POST['poids'], $_GET['cod']);

  }

  if (isset($_POST['editPartielle'])) {

    $maClasse-> editPartielle($_POST['id_part'], $_POST['fob'], $_POST['poids'], $_SESSION['id_util']);
    echo '<script>alert("Partielle modifiee avec succes!");</script>';

  }

 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <!-- /.card-header -->
                  <div class="card ">
                    <div class="card-header">
                      <h3 class="card-title">
                        <?php //echo $_GET['etat'];?>
                        <!-- <button class="btn btn-success" onclick="window.location.replace('exportPopPartielleLicence.php?num_lic=<?php echo $_GET['num_lic']; ?>','pop1','width=80,height=80');">
                          <i class="fa fa-file-excel"></i>
                        </button> -->
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0" style="height: 600px;">
                              <!-- <button class="btn btn-xs btn-primary square-btn-adjust" data-toggle="modal" data-target=".creerPartielle">
                                  <i class="fa fa-plus"></i> Nouvelle Partielle
                              </button> -->
                              <table class="table  table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm small">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th style="text-align: left; ">CRF</th>
                                    <th style="text-align: center; " colspan="2">Dossiers</th>
                                    <th style="text-align: left; ">Licence</th>
                                    <th style="text-align: center; ">Type</th>
                                    <th style="text-align: center; ">COD</th>
                                    <th style="text-align: left; ">Client</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherCRFSansPartielle($_GET['id_cli'], $_GET['consommable']);
                                  ?>
                                </tbody>
                              </table>
                              <hr>
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
  include 'pied.php';
  ?>