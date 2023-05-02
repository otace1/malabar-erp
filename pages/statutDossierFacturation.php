<?php
  include("tetePopCDN.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic_fact = $_GET['id_mod_lic_fact'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='listerFactureDossier.php?id_mod_lic_fact=$id_mod_lic_fact&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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
    $_GET['id_cli'] = NULL;
  }

  if( isset($_POST['facturerDossier']) ){
    // echo '<br>------------------------------------------id_cli = '.$_GET['id_cli'];
    // echo '<br>------------------------------------------id_mod_lic_fact = '.$_GET['id_mod_lic_fact'];
    // echo '<br>------------------------------------------id_dos = '.$_POST['id_dos'];
    // echo '<br>------------------------------------------ref_fact = '.$_POST['ref_fact'];
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>';
    </script>
    <?php
  }

  if( isset($_POST['facturerSousDossier']) ){
    // echo '<br>------------------------------------------id_cli = '.$_GET['id_cli'];
    // echo '<br>------------------------------------------id_mod_lic_fact = '.$_GET['id_mod_lic_fact'];
    // echo '<br>------------------------------------------id_dos = '.$_POST['id_dos'];
    // echo '<br>------------------------------------------ref_fact = '.$_POST['ref_fact'];
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>&note_debit=1';
    </script>
    <?php
  }

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="fa fa-folder-open nav-icon"></i> <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?> FILES</h5>
        </div>

      </div><!-- /.container-fluid -->

                  <!-- <div class="card-tools">
                    <div class="pull-right">
                      <button class="btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                          <i class="fa fa-filter"></i> Filtrage Client
                      </button>
                    </div>
                  </div> -->
    </section>
    <?php

    if( isset($_POST['validerFacture']) ){
     $maClasse-> MAJ_validation_facture_dossier($_POST['ref_fact'], '1');
    }

    if( isset($_POST['transmissionFacture']) ){
     $maClasse-> MAJ_transmission_facture_dossier($_POST['ref_fact'], '1', $_SESSION['id_util']);
    }

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  <!--MASTER DATA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FACTURE:&nbsp;&nbsp;<input style="background-color: black; color: white; font-size: 16px;" disabled type="text" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>">
                    <button class="btn-xs btn-success square-btn-adjust" onclick="window.location.replace('exportFacturationDossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']; ?>&type=EN ATTENTE FACTURES','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>-->
                </h5>


                <div class="card-tools">
                  <!-- <button class="btn-success square-btn-adjust btn-xs" onclick="window.location.replace('exportExcelKccImport.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_mod_trac=<?php echo $_GET['id_mod_lic_fact']; ?>&commodity=<?php echo $_GET['commodity'];?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?>','pop1','width=80,height=80');">
                    <i class="fas fa-file-excel"></i> Exporter Daily en Excel
                  </button> -->
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="file_data" cellspacing="0" width="100%" class="table text-center hover display compact table-bordered table-striped table-dark table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th style="">File Ref.</th>
                      <th style="">Status</th>
                      <th style="">Invoice Ref.</th>
                      <th style="">Invoice Date</th>
                      <th style="">License</th>
                      <th style="">Comm. Inv. / Lot Num.</th>
                      <th style="">Commodity</th>
                      <th style="">Decl. Ref.</th>
                      <th style="">Decl. Date</th>
                      <th style="">Liq. Ref.</th>
                      <th style="">Liq. Date</th>
                      <th style="">Quit. Ref.</th>
                      <th style="">Quit. Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // $maClasse-> afficherStatutDossierFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
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
    <!-- /.content -->
  </div>


<div class="modal fade " id="modal_edit_statut_dossier_facturation">
  <div class="modal-dialog modal-md">
    <form id="form_edit_statut_dossier_facturation" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_dos" id="id_dos">
      <input type="hidden" name="operation" id="operation" value="edit_statut_dossier_facturation">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">File Ref.</label>
            <input name="ref_dos" id="ref_dos" class="form-control form-control-sm cc-exp" disabled>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Invoicing</label>
            <select name="not_fact" id="not_fact" class="form-control form-control-sm cc-exp" required>
              <option></option>
              <option value="0">YES</option>
              <option value="1">NO</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Declaration Ref.</label>
            <input type="text" name="ref_decl" id="ref_decl" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Declaration Date</label>
            <input type="date" name="date_decl" id="date_decl" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Liquidation Ref.</label>
            <input type="text" name="ref_liq" id="ref_liq" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Liquidation Date</label>
            <input type="date" name="date_liq" id="date_liq" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Quittance Ref.</label>
            <input type="text" name="ref_quit" id="ref_quit" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Quittance Date</label>
            <input type="date" name="date_quit" id="date_quit" class="form-control form-control-sm cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" name="" class="btn btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<script type="text/javascript">

  function modal_edit_statut_dossier_facturation(id_dos){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, operation: 'modal_edit_statut_dossier_facturation'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_dos').val(data.id_dos);
          $('#ref_dos').val(data.ref_dos);
          $('#not_fact').val(data.not_fact);
          $('#ref_decl').val(data.ref_decl);
          $('#date_decl').val(data.date_decl);
          $('#ref_liq').val(data.ref_liq);
          $('#date_liq').val(data.date_liq);
          $('#ref_quit').val(data.ref_quit);
          $('#date_quit').val(data.date_quit);
          $('#modal_edit_statut_dossier_facturation').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

      $('#form_edit_statut_dossier_facturation').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

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
              }else if(data.message){
                $('#modal_edit_statut_dossier_facturation').modal('hide');
                $( '#form_edit_statut_dossier_facturation' ).each(function(){
                    this.reset();
                });
                $('#file_data').DataTable().ajax.reload();
                alert(data.message);
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  var today   = new Date();
  document.title = "Files_<?php echo $maClasse-> getNomClient($_GET['id_cli']);?>_" + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
  $('#file_data').DataTable({
     lengthMenu: [
        [10, 100, 500, -1],
        [10, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
        'excel',
        'pageLength'
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
          "id_cli": "<?php echo $_GET['id_cli']?>"
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli']?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic_fact']?>",
          "operation": "statutDossier"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos"},
      {"data":"statut"},
      {"data":"ref_fact"},
      {"data":"date_fact"},
      {"data":"num_lic"},
      {"data":"ref_fact_dos"},
      {"data":"commodity"},
      {"data":"ref_decl"},
      {"data":"date_decl"},
      {"data":"ref_liq"},
      {"data":"date_liq"},
      {"data":"ref_quit"},
      {"data":"date_quit"}
    ] 
  });
</script>
