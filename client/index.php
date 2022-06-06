<?php
  include("teteIndex.php");
  include("menuHaut.php");
  //include("menuGauche.php");

  if( isset($_POST['rechercheImport']) ){
    ?>
    <script type="text/javascript">
      window.open('popUpSearchFile.php?id_mod_lic=2&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&champs_1=<?php echo $_POST['champs_1'];?>&valeur=<?php echo $_POST['valeur'];?>&champs_2=<?php echo $_POST['champs_2'];?>&debut=<?php echo $_POST['debut'];?>&fin=<?php echo $_POST['fin'];?>','pop1','width=900,height=800');
    </script>
    <?php
  }
  if( isset($_POST['rechercheExport']) ){
    ?>
    <script type="text/javascript">
      window.open('popUpSearchFile.php?id_mod_lic=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&champs_1=<?php echo $_POST['champs_1'];?>&valeur=<?php echo $_POST['valeur'];?>&champs_2=<?php echo $_POST['champs_2'];?>&debut=<?php echo $_POST['debut'];?>&fin=<?php echo $_POST['fin'];?>','pop1','width=900,height=800');
    </script>
    <?php
  }

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12 text-center">
            <h3 class="m-0 text-dark"> Welcome To Your Customer Portal</h3>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="row mb-2">

              <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box"  data-toggle="modal" data-target=".rechercheImport">
                  <span class="info-box-icon bg-light">
                    <img src="../images/import.png" width="30px">
                  </span>

                  <div class="info-box-content">
                    <span class="info-box-text">Import Files</span>
                    <span class="info-box-number">
                      <?php echo number_format($maClasse-> nbreDossierModeleLicence(2, $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], NULL, NULL), 0, ',', ' ');?>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box" data-toggle="modal" data-target=".rechercheExport">
                  <span class="info-box-icon bg-light">
                    <img src="../images/export.png" width="30px">
                  </span>

                  <div class="info-box-content">
                    <span class="info-box-text">Export Files</span>
                    <span class="info-box-number">
                      <?php echo number_format($maClasse-> nbreDossierModeleLicence(1, $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], NULL, NULL), 0, ',', ' ');?>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-danger" onclick="window.location='../deconnexion.php';">
                  <span class="info-box-icon bg-light">
                    <img src="../images/logout.png" width="30px">
                  </span>

                  <div class="info-box-content">
                    <span class="info-box-text">Logout</span>
                    <span class="info-box-number">
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

                <!-- /.info-box -->
              </div>

            </div>
          </div>
          <div class="col-sm-12">
            <div class="row mb-2">
              <div class="col-sm-12">
                <h5 class="m-0 text-dark text-center"><img src="../images/import.png" width="30px"> IMPORT FILES</h5>
                <hr>
              </div>
              <div class="col-sm-4">
                <div class="card bg-dark">
                  <div class="card-header">
                    <h3 class="card-title"><img src="../images/truck.png" width="30px"> Import Road Files</h3>
                  </div>
                  <div class="card-body p-0 table-responsive" style="height: 250px;">
                    <table class="table-dark table table-head-fixed table-sm ">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Status</th>
                          <th>Nbr</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        <tr>
                          <?php 
                            $statut = 'AWAITING CRF/AD/INSURANCE';
                          ?>
                          <td>1</td>
                          <td><?php echo $statut;?></td>
                          <td>
                            <span class="">
                            <?php echo number_format($maClasse-> nbreSummaryStatusClient($statut, 2, $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], 1, NULL), 0, ',', ' ');?>
                            </span>
                          </td>
                          <td style="text-align: center;">
                            <button class="btn btn-xs bg-purple" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo $statut;?>&id_mod_lic=2&id_mod_trans=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&commodity=NULL','pop1','width=800,height=600');">
                              <i class="fa fa-eye"></i>
                            </button>
                          </td>
                        </tr>
                      
                        <tr>
                          <?php $statut = 'UNDER PREPARATION';?>
                          <td>8</td>
                          <td><?php echo $statut;?></td>
                          <td>
                            <span class="">
                            <?php echo number_format($maClasse-> nbreSummaryStatusClient($statut, 2, $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], 1, NULL), 0, ',', ' ');?>
                            </span>
                          </td>
                          <td style="text-align: center;">
                            <button class="btn btn-xs bg-purple" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo $statut;?>&id_mod_lic=2&id_mod_trans=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&commodity=NULL','pop1','width=800,height=600');">
                              <i class="fa fa-eye"></i>
                            </button>
                          </td>
                        </tr>
                      
                        <tr>
                          <?php $statut = 'AWAITING LIQUIDATION';?>
                          <td>9</td>
                          <td><?php echo $statut;?></td>
                          <td>
                            <span class="">
                            <?php echo number_format($maClasse-> nbreSummaryStatusClient($statut, 2, $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], 1, NULL), 0, ',', ' ');?>
                            </span>
                          </td>
                          <td style="text-align: center;">
                            <button class="btn btn-xs bg-purple" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo $statut;?>&id_mod_lic=2&id_mod_trans=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&commodity=NULL','pop1','width=800,height=600');">
                              <i class="fa fa-eye"></i>
                            </button>
                          </td>
                        </tr>
                      
                        <tr>
                          <?php $statut = 'AWAITING QUITTANCE';?>
                          <td>10</td>
                          <td><?php echo $statut;?></td>
                          <td>
                            <span class="">
                            <?php echo number_format($maClasse-> nbreSummaryStatusClient($statut, 2, $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], 1, NULL), 0, ',', ' ');?>
                            </span>
                          </td>
                          <td style="text-align: center;">
                            <button class="btn btn-xs bg-purple" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo $statut;?>&id_mod_lic=2&id_mod_trans=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&commodity=NULL','pop1','width=800,height=600');">
                              <i class="fa fa-eye"></i>
                            </button>
                          </td>
                        </tr>
                      
                        <tr>
                          <?php $statut = 'AWAITING BAE/BS';?>
                          <td>11</td>
                          <td><?php echo $statut;?></td>
                          <td>
                            <span class="">
                            <?php echo number_format($maClasse-> nbreSummaryStatusClient($statut, 2, $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], 1, NULL), 0, ',', ' ');?>
                            </span>
                          </td>
                          <td style="text-align: center;">
                            <button class="btn btn-xs bg-purple" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo $statut;?>&id_mod_lic=2&id_mod_trans=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&commodity=NULL','pop1','width=800,height=600');">
                              <i class="fa fa-eye"></i>
                            </button>
                          </td>
                        </tr>
                      
                        <tr>
                          <?php $statut = 'CLEARING COMPLETED';?>
                          <td>12</td>
                          <td><?php echo $statut;?></td>
                          <td>
                            <span class="">
                            <?php echo number_format($maClasse-> nbreSummaryStatusClient($statut, 2, $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], 1, NULL), 0, ',', ' ');?>
                            </span>
                          </td>
                          <td style="text-align: center;">
                            <button class="btn btn-xs bg-purple" onclick="window.open('popUpDashboardAutomatique.php?statut=<?php echo $statut;?>&id_mod_lic=2&id_mod_trans=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&commodity=NULL','pop1','width=800,height=600');">
                              <i class="fa fa-eye"></i>
                            </button>
                          </td>
                        </tr>
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="card bg-dark">
                  <div class="card-header">
                    <h3 class="card-title"><img src="../images/airplane.png" width="30px"> Import Air Files</h3>
                  </div>
                  <div class="card-body p-0 table-responsive" style="height: 250px;">
                    <table class="table-dark table table-head-fixed table-sm ">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Status</th>
                          <th>Nbr</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $maClasse-> getSummaryClientAIR('2', $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], 3, NULL);
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="card bg-dark">
                  <div class="card-header">
                    <h3 class="card-title"><img src="../images/train.png" width="30px"> Import Rail Files</h3>
                  </div>
                  <div class="card-body p-0 table-responsive" style="height: 250px;">
                    <table class="table-dark table table-head-fixed table-sm ">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Status</th>
                          <th>Nbr</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $maClasse-> getSummaryClientAIR('2', $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'], 4, NULL);
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>

          </div>
          <div class="col-sm-12">
            <div class="row mb-2">
              <div class="col-sm-12">
                <h5 class="m-0 text-dark text-center"><img src="../images/export.png" width="30px"> EXPORT FILES</h5>
                <hr>
              </div>

              <div class="col-sm-4">
                <div class="card bg-dark">
                  <div class="card-header">
                    <h3 class="card-title"><img src="../images/truck.png" width="30px"> Export Road Files</h3>
                  </div>
                  <div class="card-body p-0 table-responsive" style="height: 250px;">
                    <table class="table-dark table table-head-fixed table-sm ">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Status</th>
                          <th>Nbr</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $maClasse-> getSummaryClient2('1', $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '1')['id_cli'], 1, NULL);
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="card bg-dark">
                  <div class="card-header">
                    <h3 class="card-title"><img src="../images/airplane.png" width="30px"> Export Air Files</h3>
                  </div>
                  <div class="card-body p-0 table-responsive" style="height: 250px;">
                    <table class="table-dark table table-head-fixed table-sm ">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Status</th>
                          <th>Nbr</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $maClasse-> getSummaryClientAIR('1', $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '1')['id_cli'], 3, NULL);
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="card bg-dark">
                  <div class="card-header">
                    <h3 class="card-title"><img src="../images/train.png" width="30px"> Export Rail Files</h3>
                  </div>
                  <div class="card-body p-0 table-responsive" style="height: 250px;">
                    <table class="table-dark table table-head-fixed table-sm ">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Status</th>
                          <th>Nbr</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $maClasse-> getSummaryClientAIR('1', $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '1')['id_cli'], 4, NULL);
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<div class="modal fade rechercheImport small" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-eye"></i> Import Files. <small>Please select criterias</small></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            Char Criteria
          </div>
          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Files</label>
            <select name="champs_1" onchange="" class="form-control cc-exp">
                <option></option>
                <option value="ref_dos">MCA File Ref</option>
                <option value="ref_fact">Invoice</option>
                <option value="commodity">Commodity</option>
                <option value="supplier">Supplier</option>
                <option value="po_ref">PO Ref.</option>
                <option value="road_manif">Road or Rail Manifest / LTA</option>
                <option value="horse">Horse</option>
                <option value="num_lic">Licence</option>
                <option value="ref_crf">CRF Ref.</option>
                <option value="decl_ref">Declaration Ref.</option>
                <option value="liquid_ref">Liquidation Ref.</option>
                <option value="quit_ref">Quittance Ref.</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Value</label>
            <input type="text" name="valeur" class="form-control cc-exp">
          </div>

          <div class="col-md-12">
            Date Criteria
          </div>
          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Field</label>
            <select name="champs_2" onchange="" class="form-control cc-exp">
                <option></option>
                <option value="date_preal">Prealert Date</option>
                <option value="klsa_arriv">Klsa Arrival</option>
                <option value="wiski_arriv">Wiski Arrival</option>
                <option value="decl_date">Declaration Date</option>
                <option value="liquid_date">Liquidation Date</option>
                <option value="quit_date">Quittance Date</option>
                <option value="dispatch_klsa">Dispatch From Klsa</option>
                <option value="warehouse_arriv">Warehouse Arrival</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Begin</label>
            <input type="date" name="debut" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">End</label>
            <input type="date" name="fin" class="form-control cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" name="rechercheImport" class="btn btn-primary">Search</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade rechercheExport small" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-eye"></i> Export Files. <small>Please select criterias</small></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            Char Criteria
          </div>
          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Files</label>
            <select name="champs_1" onchange="" class="form-control cc-exp">
                <option></option>
                <option value="ref_dos">MCA File Ref</option>
                <option value="num_lot">Lot Number</option>
                <option value="num_lic">License Number</option>
                <option value="horse">Horse</option>
                <option value="transporter">Transporter</option>
                <option value="decl_ref">Declaration Ref.</option>
                <option value="liquid_ref">Liquidation Ref.</option>
                <option value="quit_ref">Quittance Ref.</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Value</label>
            <input type="text" name="valeur" class="form-control cc-exp">
          </div>

          <div class="col-md-12">
            Date Criteria
          </div>
          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Field</label>
            <select name="champs_2" onchange="" class="form-control cc-exp">
                <option></option>
                <option value="load_date">Loading Date</option>
                <option value="pv_mine">PV Mine Date</option>
                <option value="ceec_in">CEEC In Date</option>
                <option value="ceec_out">CEEC Out Date</option>
                <option value="min_div_in">Min Div In Date</option>
                <option value="min_div_out">Min Div Out Date</option>
                <option value="decl_date">Declaration Date</option>
                <option value="liquid_date">Liquidation Date</option>
                <option value="quit_date">Quittance Date</option>
                <option value="klsa_arriv">Klsa Arrival Date</option>
                <option value="end_formal">End Formalities Date</option>
                <option value="drc_exit">DRC Exit Date</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Begin</label>
            <input type="date" name="debut" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">End</label>
            <input type="date" name="fin" class="form-control cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" name="rechercheExport" class="btn btn-primary">Search</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


  <?php include("pied.php");?>