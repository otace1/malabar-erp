<?php
  include("tete.php");
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
                  <div class="card card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0" style="">
                              <table class="table  table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm small">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th style="text-align: center; ">Ref.Dossier</th>
                                    <th style="text-align: center; ">COD</th>
                                    <th style="text-align: center; ">Ref.Decl.</th>
                                    <th style="text-align: center; ">Date Decl.</th>
                                    <th style="text-align: center; ">Ref.Liq.</th>
                                    <th style="text-align: center; ">Date Liq.</th>
                                    <th style="text-align: center; ">Ref.Quit.</th>
                                    <th style="text-align: center; ">Date Quit.</th>
                                    <th style="text-align: center; ">FOB</th>
                                    <th style="text-align: center; ">Poids</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherDossierCOD($_GET['cod_dos']);
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