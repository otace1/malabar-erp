<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='apurementLicence.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
    if( $id_cli > 0){
      $client = ' | '.$maClasse-> getNomClient($id_cli);
    }else{
      $client = '';
    }
  }
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | '.$maClasse-> getNomClient($_GET['id_cli']);
  }else{
    $client = '';
  }

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="fa fa-check nav-icon"></i> Apurement Licences <?php echo $modele['sigle_mod_lic'].' '.$client;?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid" style="">
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>
                  <i class="fa fa-folder-open nav-icon"></i>  Transmission Documents DGDA

                  <div class="float-right">
                    <div class="input-group-prepend">
                      <button type="button" class="btn btn-dark btn-xs dropdown-toggle" data-toggle="dropdown">
                       <i class="fa fa-table"></i> Advanced Report
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="window.open('popRapportAdvanceTransmitLicence.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','Advanced Report License','width=800,height=500');">Licenses</a>
                        <a class="dropdown-item" href="#" onclick="window.open('masterDataTransmissionApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','Advanced Report License','width=1000,height=500');">Master Data</a>
                      </div>
                    </div>
                  </div>
                </h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">

                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box" onMouseOver="this.style.cursor='pointer'" onclick="window.open('popUpDossierEnAttenteApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_trans_ap=dgda','pop1','width=1500,height=900');">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-bell"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Dossiers en Attente</span>
                        <span class="info-box-number">
                          <span id="nbre_dossier_no_apurement_dgda"></span>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box" onMouseOver="this.style.cursor='pointer'" onclick="window.open('popUpTransmissionApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_trans_ap=dgda','pop1','width=1500,height=900');">
                      <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-folder-open"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Transmit Sans A/R</span>
                        <span class="info-box-number">
                          <span id="nbre_transmis_no_ar_dgda"></span>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                  <div class="col-md-12 table-responsive p-0">
                    <table id="afficherApurementAjaxDGDA" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm small text-nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Client</th>
                          <th>Reference</th>
                          <th>Date Creation</th>
                          <th>Date Depot</th>
                          <th>Banque</th>
                          <th>Nbre. Licences</th>
                          <th>Nbre. Dossiers</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>
                  <i class="fa fa-folder-open nav-icon"></i>  Transmission Documents OCC

                  <div class="float-right">
                    <div class="input-group-prepend">
                      <button type="button" class="btn btn-dark btn-xs dropdown-toggle" data-toggle="dropdown">
                       <i class="fa fa-table"></i> Advanced Report
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="window.open('popRapportAdvanceTransmitLicence.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','Advanced Report License','width=800,height=500');">Licenses</a>
                        <a class="dropdown-item" href="#" onclick="window.open('masterDataTransmissionApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','Advanced Report License','width=1000,height=500');">Master Data</a>
                      </div>
                    </div>
                  </div>
                </h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">

                  <div class="col-12 col-sm-6 col-md-3">
                    <!-- <div class="info-box" onMouseOver="this.style.cursor='pointer'" onclick="window.open('popUpDossierSansFOBApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_trans_ap=dgda','pop1','width=1500,height=900');"> -->
                    <div class="info-box" onMouseOver="this.style.cursor='pointer'" onclick="$('#modal_dossier_sans_FOB').modal('show');">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-dollar-sign"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Dossiers Sans Valeur FOB</span>
                        <span class="info-box-number">
                          <span id="nbre_dossier_sans_fob_apurement"></span>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                  <div class="col-12 col-sm-6 col-md-3">
                    <!-- <div class="info-box" onMouseOver="this.style.cursor='pointer'" onclick="window.open('popUpDossierSansFOBApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_trans_ap=dgda','pop1','width=1500,height=900');"> -->
                    <div class="info-box" onMouseOver="this.style.cursor='pointer'" onclick="$('#modal_dossier_sans_road_manifest').modal('show');">
                      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-file"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Dossiers Sans Manifestes</span>
                        <span class="info-box-number">
                          <span id="nbre_dossier_sans_manifeste_apurement"></span>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                  <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box" onMouseOver="this.style.cursor='pointer'" onclick="window.open('popUpTransmissionApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>&type_trans_ap=dgda','pop1','width=1500,height=900');">
                      <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-folder-open"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Transmit Sans A/R</span>
                        <span class="info-box-number">
                          <span id="nbre_transmis_no_ar_dgda"></span>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                  <div class="col-md-12 table-responsive p-0">
                    <table id="afficherApurementAjaxDGDA" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm small text-nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Client</th>
                          <th>Reference</th>
                          <th>Date Creation</th>
                          <th>Date Depot</th>
                          <th>Banque</th>
                          <th>Nbre. Licences</th>
                          <th>Nbre. Dossiers</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php 

  include("pied.php");
  ?>

<div class="modal fade" id="modal_new_transmit_ap_dgda">
  <div class="modal-dialog modal-lg">
    <form id="form_new_transmit_ap_dgda" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="new_transmit_ap_dgda">
      <input type="hidden" name="type_trans_ap" value="dgda">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i>Nouvelle Transmission Apurement </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Banque</label>
            <select name="banque" onchange="" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerNomBanque();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Reference</label>
            <input id="ref_trans_ap_dgda" name="ref_trans_ap" type="text" class="form-control cc-exp form-control-sm" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date</label>
            <input name="date_trans_ap" type="date" value="" class="form-control cc-exp form-control-sm" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Licence</label>
            <select onchange="getDossierEnAttenteApurementLicenceAjaxDGDA(this.value);" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerLicenceDossierEnAttenteApurementDGDA($_GET['id_cli'], $_GET['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12">
            <table class="table table-dark table-bordered table-striped table-sm small text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>MCA Ref.</th>
                  <th>Licence</th>
                  <th>Montant Decl.</th>
                  <th>Ref. Decl.</th>
                  <th>Ref. Liq.</th>
                  <th>Ref. Quit.</th>
                </tr>
              </thead>
              <tbody id="tableau_dossier">
                
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annuler</button>
        <button type="submit" name="modifierTransmissionApurement" class="btn btn-primary btn-sm">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_upload_ar_transmit">
  <div class="modal-dialog modal-sm">
    <form id="form_upload_ar_transmit" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_trans_ap" id="id_trans_ap_ar">
      <input type="hidden" name="operation" value="upload_ar_transmit">
    <div class="modal-content">
      <div class="modal-header bg bg-purple">
        <h4 class="modal-title"><i class="fa fa-upload"></i> <span id="label_ref_trans_ap_ar"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">ACCUSEE DE RECEPTION</label>
            <input type="file" name="fichier_trans_ap" class="form-control cc-exp form-control-sm">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary btn-sm">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_edit_transmit">
  <div class="modal-dialog modal-md">
    <form id="form_edit_transmit" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_trans_ap" id="id_trans_ap_edit">
      <input type="hidden" name="operation" value="edit_transmit">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit <input type="text" id="label_ref_trans_ap_edit" disabled="disabled" style="color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Reference</label>
          <input type="text" name="ref_trans_ap" id="ref_trans_ap_edit" class="form-control cc-exp form-control-sm">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Date Depot</label>
          <input type="date" name="date_depot" id="date_depot" class="form-control cc-exp form-control-sm">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary btn-sm">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_dossier_sans_FOB">
  <div class="modal-dialog modal-lg">
    <!-- <form id="form_edit_transmit" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Dossier Sans Valeur FOB</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary btn-sm">Valider</button> -->
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_edit_dossier">
  <div class="modal-dialog modal-sm small">
    <form id="form_edit_dossier" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="edit_dossier">
      <input type="hidden" name="id_dos" id="id_dos">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">MCA Ref.</label>
            <input id="ref_dos" class="form-control form-control-sm cc-exp bg-dark" disabled>
        </div>
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Ref. CVEE</label>
            <input id="ref_cvee" name="ref_cvee" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">FOB CVEE</label>
            <input id="fob_cvee" name="fob_cvee" type="number" step="0.001" min="0" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">FOB Declaré</label>
            <input id="fob" name="fob" type="number" step="0.001" min="0" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Type</label>
            <select id="type_apurement" name="type_apurement" class="form-control form-control-sm cc-exp">
              <option value=""></option>
              <option value="Partiel">Partiel</option>
              <option value="Total">Total</option>
            </select>
        </div>
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Remarque</label>
            <select id="remarque_apurement" name="remarque_apurement" class="form-control form-control-sm cc-exp">
              <option></option>
              <option value="Provision AV">Provision AV</option>
              <option value="Provision Licence">Provision Licence</option>
            </select>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancelled</button>
        <button type="submit" name="ok" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  $(document).ready(function(){

      $('#form_edit_dossier').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

          var fd = new FormData(this);
          $('#modal_edit_dossier').modal('hide');
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

              }
            },
            complete: function () {
                $('#afficherDossiersSansFOBApuresAjax').DataTable().ajax.reload();
                getNombreNotificationApurement();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  function modal_edit_dossier(id_dos){

    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_dos: id_dos, operation: 'getDossier'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#ref_dos').val(data.ref_dos);
          $('#id_dos').val(data.id_dos);
          $('#ref_cvee').val(data.ref_cvee);
          $('#fob_cvee').val(data.fob_cvee);
          $('#fob').val(data.fob);
          $('#type_apurement').val(data.type_apurement);
          $('#remarque_apurement').val(data.remarque_apurement);
          $('#modal_edit_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $('#afficherDossiersSansFOBApuresAjax').DataTable({
     lengthMenu: [
        [10, -1],
        [10, 'All'],
    ],
    dom: 'Bfrtip',
        // fixedColumns: {
        //   left: 3
        // },
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        className: 'btn btn-success'
      }
      // ,
      // {
      //   extend: 'pageLength',
      //   text: '<i class="fa fa-list"></i>',
      //   className: 'btn btn-dark'
      // }
      // ,
      // {
      //   text: '<i class="fa fa-check"></i>',
      //   className: 'btn btn-info bt',
      //   action: function ( e, dt, node, config ) {
      //       modal_edit_dossier();
      //   }
      // }
  ],
  
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "operation": "afficherDossiersSansFOBApuresAjax"
      }
    },
    // rowGroup: {
    //     dataSrc: "num_lic",

    // },
    "columns":[
      {"data":"compteur"},
      {"data":"num_lic",
        className: 'dt-body-left'
      },
      {"data":"ref_dos"},
      {"data":"ref_cvee"},
      {"data":"fob_cvee",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"fob",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"ref_decl",
        className: 'dt-body-center'
      },
      {"data":"date_decl",
        className: 'dt-body-center'
      },
      {"data":"ref_liq",
        className: 'dt-body-center'
      },
      {"data":"date_liq",
        className: 'dt-body-center'
      },
      {"data":"ref_quit",
        className: 'dt-body-center'
      },
      {"data":"date_quit",
        className: 'dt-body-center'
      },
      {"data":"type_apurement",
        className: 'dt-body-center'
      },
      {"data":"remarque_apurement",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

  $(document).ready(function(){
    getNombreNotificationApurement();
    buildReferenceTransmissionApurementModeleLicence();
  });

  function buildReferenceTransmissionApurementModeleLicence() {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_mod_lic: <?php echo $_GET['id_mod_lic'];?>, operation: 'buildReferenceTransmissionApurementModeleLicence'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          
          $('#ref_trans_ap_dgda').val(data.ref_trans_ap);
          $('#ref_trans_ap_occ').val(data.ref_trans_ap);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

    $('#form_upload_ar_transmit').submit(function(e){

      e.preventDefault();
      
      if(confirm('Do really you want to submit ?')) {

        var fd = new FormData(this);
        $('#modal_upload_ar_transmit').modal('hide');
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
            }else if(data.message){
              $( '#form_upload_ar_transmit' ).each(function(){
                  this.reset();
              });
              $('#afficherApurementAjaxDGDA').DataTable().ajax.reload();
              getNombreNotificationApurement();
              $('#spinner-div').hide();//Request is complete so hide spinner
              // alert(data.message);
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

    $('#form_new_transmit_ap_dgda').submit(function(e){

      e.preventDefault();
      
      if(confirm('Do really you want to submit ?')) {

        var fd = new FormData(this);
        $('#modal_new_transmit_ap_dgda').modal('hide');
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
            }else if(data.message){
              $( '#form_new_transmit_ap_dgda' ).each(function(){
                  this.reset();
              });
              $('#afficherApurementAjaxDGDA').DataTable().ajax.reload();
              getNombreNotificationApurement();
              buildReferenceTransmissionApurementModeleLicence();
              $('#spinner-div').hide();//Request is complete so hide spinner
              // alert(data.message);
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

      }


    });
    
  });

  function getNombreNotificationApurement() {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_cli: <?php echo $_GET['id_cli'];?>, id_mod_lic: <?php echo $_GET['id_mod_lic'];?>, operation: 'getNombreNotificationApurement'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          //dgda
          $('#nbre_dossier_no_apurement_dgda').html(data.nbre_dossier_no_apurement_dgda);
          $('#nbre_transmis_no_ar_dgda').html(data.nbre_transmis_no_ar_dgda);
          //occ
          $('#nbre_dossier_no_apurement_occ').html(data.nbre_dossier_no_apurement_occ);
          $('#nbre_transmis_no_ar_occ').html(data.nbre_transmis_no_ar_occ);

          $('#nbre_dossier_sans_fob_apurement').html(data.nbre_dossier_sans_fob_apurement);
          $('#nbre_dossier_sans_manifeste_apurement').html(data.nbre_dossier_sans_manifeste_apurement);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

    $('#form_edit_transmit').submit(function(e){

      e.preventDefault();
      
      if(confirm('Do really you want to submit ?')) {

        var fd = new FormData(this);
        $('#spinner-div').show();
        $('#modal_nouvelle_licence_import').modal('hide');


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
            }else if(data.message){
              $( '#form_edit_transmit' ).each(function(){
                  this.reset();
              });
              $('#afficherApurementAjaxDGDA').DataTable().ajax.reload();
              $('#spinner-div').hide();//Request is complete so hide spinner
              $('#modal_edit_transmit').modal('hide');
              // alert(data.message);
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

      }


    });
    
  });

  function modal_edit_transmit(id_trans_ap) {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_trans_ap: id_trans_ap, operation: 'getTransmissionApurement'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_ref_trans_ap_edit').val(data.ref_trans_ap);
          $('#id_trans_ap_edit').val(data.id_trans_ap);
          $('#ref_trans_ap_edit').val(data.ref_trans_ap);
          $('#date_depot').val(data.date_depot);
          $('#modal_edit_transmit').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function modal_upload_ar_transmit(id_trans_ap) {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_trans_ap: id_trans_ap, operation: 'getTransmissionApurement'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_ref_trans_ap_ar').html(data.ref_trans_ap);
          $('#id_trans_ap_ar').val(data.id_trans_ap);
          $('#modal_upload_ar_transmit').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  $('#afficherApurementAjaxDGDA').DataTable({
     lengthMenu: [
        [10, 20, 30, 50, 100, 500, -1],
        [10, 20, 30, 50, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
        // fixedColumns: {
        //   left: 3
        // },
  buttons: [
      {
        text: '<i class="fa fa-plus"></i> Nouveau Transmit',
        className: 'btn btn-info bt',
        action: function ( e, dt, node, config ) {
            $('#modal_new_transmit_ap_dgda').modal('show');
        }
      },
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      }
  ],
  
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "type_trans_ap":"dgda",
          "operation": "afficherApurementAjaxDGDA"
      }
    },
    // rowGroup: {
    //     dataSrc: "num_lic",

    // },
    "columns":[
      {"data":"compteur"},
      {"data":"nom_cli"},
      {"data":"ref_trans_ap",
        className: 'dt-body-center'
      },
      {"data":"date_trans_ap",
        className: 'dt-body-center'
      },
      {"data":"date_depot",
        className: 'dt-body-center'
      },
      {"data":"banque",
        className: 'dt-body-center'
      },
      {"data":"nbre_lic",
        className: 'dt-body-center'
      },
      {"data":"nbre_dos",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ],
      "createdRow": function( row, data, dataIndex ) {
        if ( data['statut_fichier'] == "0") {
          $(row).addClass('text text-danger');
        }
      }  
  });

  function getDossierEnAttenteApurementLicenceAjaxDGDA(num_lic) {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {num_lic: num_lic, operation: 'getDossierEnAttenteApurementLicenceAjaxDGDA'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#tableau_dossier').html(data.tableau_dossier);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function getDossierEnAttenteApurementLicenceAjaxOCC(num_lic) {
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {num_lic: num_lic, operation: 'getDossierEnAttenteApurementLicenceAjaxOCC'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#tableau_dossier').html(data.tableau_dossier);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

</script>
