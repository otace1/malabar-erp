<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5>
            <!-- <img src="../images/calculator.png" width="25px" /> -->
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo $maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']).' INVOICES DASHBOARD ';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'TABLEAU DE BORD FACTURE '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']);
              }
            ?>
            | <span id="label_monitoring"></span>
            <span class="float-right">
              <!-- <button class="btn btn-xs btn-info" ></button> -->
              <button class="btn btn-primary btn-xs" onclick="$('#modal_search').modal('show');"><i class="fa fa-search"></i> Search</button>

              <button class="btn bg-olive btn-xs" onclick="$('#tracking_report').modal('show');"><i class="fa fa-search"></i> Tracking Report</button>
              
              <div class="btn-group">
                <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-list"></i> View Other Report
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#" onclick="window.open('popFilesOgefrem.php?debut='+$('#debut').val()+'&fin='+$('#fin').val()+'&id_cli='+$('#id_cli').val(),'pop1','width=1200,height=700');">OGEFREM</a>
                  <a class="dropdown-item" href="#" onclick="window.open('popFilesLMC.php?debut='+$('#debut').val()+'&fin='+$('#fin').val()+'&id_cli='+$('#id_cli').val(),'pop1','width=1200,height=700');">LMC</a>
                  <a class="dropdown-item" href="#" onclick="window.open('popFilesLoading.php?debut='+$('#debut').val()+'&fin='+$('#fin').val()+'&id_cli='+$('#id_cli').val(),'pop1','width=1200,height=700');">Loading</a>
                  <a class="dropdown-item" href="#" onclick="window.open('popFilesDispatch.php?debut='+$('#debut').val()+'&fin='+$('#fin').val()+'&id_cli='+$('#id_cli').val(),'pop1','width=1200,height=700');">Dispatch</a>
                  <a class="dropdown-item" href="#" onclick="window.open('popFilesNotDispatch.php?debut='+$('#debut').val()+'&fin='+$('#fin').val()+'&id_cli='+$('#id_cli').val(),'pop1','width=1200,height=700');">Not Dispatched</a>
                  <a class="dropdown-item" href="#" onclick="window.open('popFilesQuittance.php?debut='+$('#debut').val()+'&fin='+$('#fin').val()+'&id_cli='+$('#id_cli').val()+'&id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>','pop1','width=1200,height=700');">Based on Quittance Date</a>
                </div>
              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-list"></i> View all files
                </button>
                <div class="dropdown-menu">
                  <?php
                    for ($i=date('Y'); $i >= 2020 ; $i--) { 
                  ?><a class="dropdown-item" href="#" onclick="window.open('popFilesInvoicingStatus.php?statut=Factures&amp;id_mod_lic=<?php echo $_GET['id_mod_lic_fact']?>&annee=<?php echo $i;?>','pop1','width=1200,height=700');"><?php echo $i;?> Files</a><?php
                    }
                  ?>
                </div>
              </div>
            </span>
          </h5>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-primary">
              <div class="inner">
                <h5>
                  <span id="nbre_facture"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Invoices';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Factures';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-copy"></i>
              </div>
              <a href="#" class="small-box-footer" id="btn_info_factures"></a>
              
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h5>
                  <span id="nbre_dossier_facture"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Invoiced Files';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Dossiers Facturés';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" id="btn_info_dossiers_factures"></a>
              <!-- <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFacturation.php?statut=Dossiers Facturés&amp;id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>','pop1','width=1200,height=700');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h5>
                  <span id="nbre_dossier_non_facture"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Pending Files';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Dossiers Non Facturés';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFacturation.php?statut=Dossiers Non Facturés&amp;id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&amp;id_cli='+id_cli.value,'pop1','width=1200,height=700');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <div class="inner">
                <h5>
                  <span id="nbre_dossier_facture_excel"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Files invoiced In Excel';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Dossiers Factures en Excel';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-exclamation"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFacturation.php?statut=Excel Invoice&amp;id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&amp;id_cli='+id_cli.value,'pop1','width=1200,height=700');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-6 col-sm-6 col-12">
             <section class="content">
              <div class="container-fluid" style="">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        Users Report
                      </div>    
                      <!-- /.card-header -->

                      <div class="card-body table-responsive p-0">
                        
                        <table class=" table table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                          <thead>
                            <tr class="bg bg-dark">
                              <th style="border: 1px solid white;">#</th>
                              <th style="border: 1px solid white;">Users</th>
                              <th style="border: 1px solid white; text-align: center;" colspan="2">Invoices Created</th>
                              <th style="border: 1px solid white; text-align: center;" colspan="2">Files Invoiced</th>
                            </tr>
                          </thead>
                          <tbody id="afficherMonitoringFacturation">
                            <?php
                            // $maClasse-> afficherDossierEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                </div>
              </div><!-- /.container-fluid -->
            </section>
          </div>

          <div class="col-md-6 col-sm-6 col-12">
             <section class="content">
              <div class="container-fluid" style="">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title" style="font-weight: bold;">
                          Bank Rate of exchange management
                        </h5>
                        <div class="float-right">
                          <button class="btn btn-success btn-xs"onclick="window.location.replace('exportTaux.php','pop1','width=80,height=80');"><i class="fa fa-file-excel"></i> Export to Excel File</button>
                          <button class="btn btn-primary btn-xs" onclick="modal_creation_taux_banque();"><i class="fa fa-plus"></i> New Rate</button>
                        </div>
                      </div>    
                      <!-- /.card-header -->

                      <div class="card-body table-responsive p-0">
                        <span id="label_monitoring"></span>
                        <table class=" table table-head-fixed table-bordered table-hover text-nowrap table-sm">
                          <thead>
                            <tr class="">
                              <th style="" rowspan="2">#</th>
                              <th style="" rowspan="2">Date</th>
                              <th style="" rowspan="2">BCC</th>
                              <th style=" text-align: center;" colspan="2">RAWBANK</th>
                              <th style=" text-align: center;" colspan="2">EQUITY BCDC</th>
                              <th style=" text-align: center;" colspan="2">ECOBANK</th>
                              <th style=" text-align: center;" colspan="2">ACCESS BANK</th>
                            </tr>
                            <tr class="">
                              <th style=" text-align: center;">Amt</th>
                              <th style=" text-align: center;">Diff</th>
                              <th style=" text-align: center;">Amt</th>
                              <th style=" text-align: center;">Diff</th>
                              <th style=" text-align: center;">Amt</th>
                              <th style=" text-align: center;">Diff</th>
                              <th style=" text-align: center;">Amt</th>
                              <th style=" text-align: center;">Diff</th>
                            </tr>
                          </thead>
                          <tbody id="afficherMonitoringTaux">
                            <?php
                            // $maClasse-> afficherDossierEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title" style="font-weight: bold;">
                         Declaration Rate of exchange management
                        </h5>
                      </div>    
                      <!-- /.card-header -->

                      <div class="card-body table-responsive p-0">
                        <table id="monitoring_roe_decl" class="table table-bordered table-hover">
                          <thead>
                            <tr class="">
                              <th width="5%">#</th>
                              <th>Date</th>
                              <th>Amount</th>
                              <th>Nbr.Files</th>
                            </tr>
                          </thead>
                          <tbody class="">
                           
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                </div>
              </div><!-- /.container-fluid -->
            </section>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
             <section class="content">
              <div class="container-fluid" style="">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title" style="font-weight: bold;">
                          <i class="fa fa-tachometer-alt"></i> Files Status Monitoring
                        </h5>
                        <div class="float-right">
                          
                        </div>
                      </div>    
                      <!-- /.card-header -->

                      <div class="card-body table-responsive p-0">
                        <span id="label_monitoring"></span>
                        <table class=" table table-head-fixed table-bordered table-hover table-sm">
                          <thead>
                            <tr class="">
                              <th>Status</th>
                              <th width="20%">Nbre</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation2.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Missing E, L or Q','Missing E, L or Q','width=1000,height=800');">
                              <td>Missing E, L or Q</td>
                              <td style="text-align: right;"><span class="badge badge-warning text-sm" id="nbre_awaiting_elq"></span></td>
                            </tr>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation2.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Waiting to be invoiced','Waiting to be invoiced','width=1000,height=800');">
                              <td>Waiting to be invoiced</td>
                              <td style="text-align: right;"><span class="badge badge-info text-sm" id="nbre_awaiting_invoice"></span></td>
                            </tr>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation2.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Invoiced','Invoiced','width=1000,height=800');">
                              <td>Invoiced</td>
                              <td style="text-align: right;"><span class="badge badge-success text-sm" id="nbre_invoiced"></span></td>
                            </tr>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation2.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Disabled','Disabled','width=1000,height=800');">
                              <td>Disabled</td>
                              <td style="text-align: right;"><span class="badge badge-danger text-sm" id="nbre_disabled"></span></td>
                            </tr>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation3.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Liquidation paid not invoiced','Liquidation paid not invoiced','width=1000,height=800');">
                              <td>Liquidation paid not invoiced</td>
                              <td style="text-align: right;"><span class="badge badge-secondary text-sm" id="nbre_liq_not_invoice"></span></td>
                            </tr>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation3.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Dispatched not invoiced','Dispatched not invoiced','width=1000,height=800');">
                              <td>Dispatched not invoiced</td>
                              <td style="text-align: right;"><span class="badge badge-secondary text-sm" id="nbre_dispatched_not_invoice"></span></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                </div>
              </div><!-- /.container-fluid -->
            </section>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
             <section class="content">
              <div class="container-fluid" style="">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title" style="font-weight: bold;">
                          <i class="fa fa-exclamation-triangle"></i> Pending By Category
                        </h5>
                        <div class="float-right">
                          
                        </div>
                      </div>    
                      <!-- /.card-header -->

                      <div class="card-body table-responsive p-0">
                        <span id="label_monitoring"></span>
                        <table class=" table table-head-fixed table-bordered table-hover text-nowrap table-sm">
                          <thead>
                            <tr class="">
                              <th>Commodity</th>
                              <th width="20%">Nbre</th>
                            </tr>
                          </thead>
                          <tbody id="getReportPendingInvoiceCommodityCategory">
                            
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                </div>
              </div><!-- /.container-fluid -->
            </section>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>

<?php
if(isset($_GET['id_mod_lic_fact']) && isset($_GET['id_mod_lic_fact'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php
}
?>

<div class="modal fade " id="modal_search">
  <div class="modal-dialog modal-md">
    <!-- <form id="form_edit_statut_dossier_facturation" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-search"></i> Search </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Client</label>
            <select id="id_cli" class="form-control form-control-sm cc-exp">
              <option></option>
              <?php
                $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
              ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Starting</label>
            <input id="debut" type="date" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">End</label>
            <input id="fin" type="date" class="form-control form-control-sm cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button name="" class="btn btn-xs btn-primary" onclick="afficherMonitoringFacturation(<?php echo $_GET['id_mod_lic_fact'];?>, debut.value, fin.value);">Submit</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="tracking_report">
  <div class="modal-dialog modal-lg">
    <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-tachometer-alt"></i> 

          Tracking Report

        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" id="id_cli_1" onchange="" class="form-control cc-exp form-control-sm">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($_GET['id_mod_lic_fact']);
                ?>
            </select>
          </div>

          <div class="col-md-12"></div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Filed</label>
            <select name="id_col" id="id_col_1" onchange="" class="form-control cc-exp form-control-sm">
              <option></option>
              <option value="137">Date Creation</option>
                <?php
                  $maClasse->selectionnerColonne($_GET['id_mod_lic_fact']);
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">BEGIN</label>
            <input id="debut_1" name="debut" type="date" class="form-control cc-exp form-control-sm" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">END</label>
            <input name="fin" id="fin_1" type="date" class="form-control cc-exp form-control-sm" required>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        <button type="submit" onclick="window.open('popUpRapportDossier.php?id_cli='+id_cli_1.value+'&id_col='+id_col_1.value+'&id_mod_lic=<?php echo $_GET['id_mod_lic_fact']?>&id_mod_trans=&debut='+debut_1.value+'&fin='+fin_1.value+'','pop1','width=1500,height=900');" class="btn btn-primary btn-sm">Submit</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_creation_taux_banque">
  <div class="modal-dialog modal-sm">
    <form id="form_creation_taux_banque" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="creation_taux_banque">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Rate</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Date</label>
          <input name="date_taux" type="date" class="form-control form-control-sm cc-exp" required>
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">BCC</label>
          <input name="bcc" type="number" min="0" step="0.000001" class="form-control form-control-sm cc-exp" required>
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">RAWBANK</label>
          <input name="rawbank" type="number" min="0" step="0.000001" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">EQUITY BCDC</label>
          <input name="equity" type="number" min="0" step="0.000001" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">ECOBANK</label>
          <input name="ecobank" type="number" min="0" step="0.000001" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">ACCESS BANK</label>
          <input name="access" type="number" min="0" step="0.000001" class="form-control form-control-sm cc-exp">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-xs">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_new_roe_decl">
  <div class="modal-dialog modal-sm">
    <form id="form_new_roe_decl" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="new_roe_decl">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Rate</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Date</label>
          <input name="date_decl" type="date" class="form-control form-control-sm cc-exp" required>
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Amount</label>
          <input name="roe_decl" type="number" min="0" step="0.000001" class="form-control form-control-sm cc-exp" required>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-xs">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('#form_new_roe_decl').submit(function(e){

            e.preventDefault();

      if(confirm('Do really you want to submit ?')) {

          $('#modal_new_roe_decl').modal('hide');
          // alert('Hello');

          var fd = new FormData(this);
          $('#spinner-div').show();

          $.ajax({
            type: 'post',
            url: 'ajax.php',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                $( '#form_new_roe_decl' ).each(function(){
                    this.reset();
                });
                $('#monitoring_roe_decl').DataTable().ajax.reload();
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });


      }

    });
  
  });


  $(document).ready(function(){
    $('#spinner-div').show();
    afficherMonitoringFile();
    getReportPendingInvoiceCommodityCategory();
    $('#spinner-div').hide();
  });
$('#monitoring_roe_decl').DataTable({
       lengthMenu: [
          [10, 20, 50, -1],
          [10, 20, 50, 500, 'All'],
      ],
      dom: 'Bfrtip',
      buttons: [,
        'pageLength',
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel"></i>',
          title: 'Declaration Rate Monitoring',
          className: 'btn btn-success'
        },
        {
          text: '<i class="fa fa-plus"></i> New',
          className: 'btn btn-info',
          action: function ( e, dt, node, config ) {
              $('#modal_new_roe_decl').modal('show');
          }
        }
      ],
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    // "responsive": true,
      "ajax":{
        "type": "GET",
        "url":"ajax.php",
        "method":"post",
        "dataSrc":{
            "id_cli": ""
        },
        "data": {
            "operation": "monitoring_roe_decl"
        }
      },
      "columns":[
        {"data":"compteur"},
        {"data":"date_decl",
          className: 'dt-body-center'
        },
        {"data":"roe_decl",
          render: DataTable.render.number( null, null, 4, null ),
          className: 'dt-body-center'
        },
        {"data":"nbre_dos",
          className: 'dt-body-center'
        }
      // ,
      //   {"data":"lmc_id",
      //     className: 'dt-body-center'
      //   }
      ] 
    });
  function getReportPendingInvoiceCommodityCategory(){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getReportPendingInvoiceCommodityCategory', id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#getReportPendingInvoiceCommodityCategory').html(data.getReportPendingInvoiceCommodityCategory);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function afficherMonitoringFile(){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'afficherMonitoringFile', id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>, id_cli: $('#id_cli').val()},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#nbre_awaiting_elq').html(new Intl.NumberFormat('en-US').format(data.nbre_awaiting_elq));
          $('#nbre_awaiting_invoice').html(new Intl.NumberFormat('en-US').format(data.nbre_awaiting_invoice));
          $('#nbre_liq_not_invoice').html(new Intl.NumberFormat('en-US').format(data.nbre_liq_not_invoice));
          $('#nbre_dispatched_not_invoice').html(new Intl.NumberFormat('en-US').format(data.nbre_dispatched_not_invoice));
          $('#nbre_dossier_facture_excel').html(new Intl.NumberFormat('en-US').format(data.nbre_dossier_facture_excel));
          $('#nbre_invoiced').html(new Intl.NumberFormat('en-US').format(data.nbre_invoiced));
          $('#nbre_disabled').html(new Intl.NumberFormat('en-US').format(data.nbre_disabled));
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function appliquer_taux(id){
    if(confirm('Do really you want to update the files rates regarding this rates ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'appliquer_taux', id: id},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            afficherMonitoringTaux();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }

  function MAJ_id_bank_liq(id_dos, id_bank_liq, id_mod_lic){
    if(confirm('Do really you want to update ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'maj_id_bank_liq2', id_dos: id_dos, id_bank_liq: id_bank_liq, id_mod_lic: id_mod_lic},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#files_awaiting_rate').html(data.files_awaiting_rate);
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }

  function modal_awaiting_rate(id_mod_lic){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'files_awaiting_rate', id_mod_lic: id_mod_lic},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#files_awaiting_rate').html(data.files_awaiting_rate);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
    $('#modal_awaiting_rate').modal('show');
  }

  function delete_taux_banque(id){
    if(confirm('Do really you want to delete this rates ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'delete_taux_banque', id: id},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            afficherMonitoringTaux();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }


  $(document).ready(function(){

    $('#form_creation_taux_banque').submit(function(e){

            e.preventDefault();

      if(confirm('Do really you want to submit ?')) {

          $('#modal_creation_taux_banque').modal('hide');
          // alert('Hello');

          var fd = new FormData(this);
          $('#spinner-div').show();

          $.ajax({
            type: 'post',
            url: 'ajax.php',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                $( '#form_creation_taux_banque' ).each(function(){
                    this.reset();
                });
                afficherMonitoringTaux();
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });


      }

    });
  
  });

  function modal_creation_taux_banque(){
    $('#modal_creation_taux_banque').modal('show');
  }
  
  $(document).ready(function(){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'rapportFacturation', id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#nbre_facture').html(data.nbre_facture);
          $('#nbre_dossier_facture').html(data.nbre_dossier_facture);
          $('#nbre_dossier_non_facture').html(data.nbre_dossier_non_facture);
          $('#nbre_dossier_facture_excel').html(data.nbre_dossier_facture_excel);
          $('#btn_info_factures').html(data.btn_info_factures);
          $('#btn_info_dossiers_factures').html(data.btn_info_dossiers_factures);
          afficherMonitoringFacturation(<?php echo $_GET['id_mod_lic_fact'];?>);
          afficherMonitoringTaux();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  });

  function afficherMonitoringFacturation(id_mod_lic, debut=null, fin=null){
    $('#spinner-div').show();
    $('#modal_search').modal('hide');
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'afficherMonitoringFacturation', id_mod_lic: id_mod_lic, debut: debut, fin: fin, id_cli: $('#id_cli').val()},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_monitoring').html('Report between '+debut+' and '+fin);
          $('#nbre_facture').html(data.nbre_facture);
          $('#nbre_dossier_facture').html(data.nbre_dossier_facture);
          $('#nbre_dossier_non_facture').html(data.nbre_dossier_non_facture);
          $('#nbre_dossier_facture_excel').html(data.nbre_dossier_facture_excel);
          $('#btn_info_factures').html(data.btn_info_factures);
          $('#btn_info_dossiers_factures').html(data.btn_info_dossiers_factures);
          $('#afficherMonitoringFacturation').html(data.afficherMonitoringFacturation);
          afficherMonitoringFile();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function afficherMonitoringTaux(){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'afficherMonitoringTaux'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#afficherMonitoringTaux').html(data.afficherMonitoringTaux);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }


</script>
