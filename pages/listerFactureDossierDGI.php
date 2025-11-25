<?php
// include("tete.php");
include("tetePopCDN.php");
include("menuHaut.php");
include("menuGauche.php");
//include("licenceExcel.php");

$modele = $maClasse->getElementModeleLicence($_GET['id_mod_lic_fact']);
$client = '';
if (isset($_POST['rechercheClient'])) {
  $id_mod_lic_fact = $_GET['id_mod_lic_fact'];
  $id_cli = $_POST['id_cli'];
  $id_type_lic = $_POST['id_type_lic'];
  echo "<script>window.location='listerFactureDossier.php?id_mod_lic_fact=$id_mod_lic_fact&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
  if ($id_cli > 0) {
    $client = ' | ' . $maClasse->getNomClient($id_cli);
  } else {
    $client = '';
  }
}
if (isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) {
  $client = ' | ' . $maClasse->getNomClient($_GET['id_cli']);
} else {
  $client = '';
  $_GET['id_cli'] = NULL;
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
        <h5><i class="fa fa-copy nav-icon"></i> <?php echo $modele['nom_mod_lic'] . ' INVOICE ' . $client; ?></h5>
        <div class="card-tools">
          <div class="form-inline ml-8">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" name="ref_fact_search" id="ref_fact_search" type="search" placeholder="Search Invoice" aria-label="Search">
              <div class="input-group-append">
                <button class="btn bg-primary btn-navbar" name="search1" onclick="searchInvoice(ref_fact_search.value);">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>
  <?php

  if (isset($_POST['supprimerFacture'])) {
    $maClasse->supprimerFactureDossier($_POST['ref_fact']);
  ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Successful operation!</strong> Invoice <b><?php echo $_POST['ref_fact']; ?></b> deleted successfully.
    </div>
  <?php
  }

  ?>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid" style="">
      <div class="row">

        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title" style="font-weight: bold;">
                <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_invoice_pending_validation"></span> Pending Validation
              </h5>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small">
              <table id="invoice_pending_validation" class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;" width="5px">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">COMMODITY</th>
                    <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title" style="font-weight: bold;">
                <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_invoice_pending_validation"></span> Validated / Awaiting DGI standardization
              </h5>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small">
              <table id="invoice_waiting_to_send" class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;" width="5px">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">COMMODITY</th>
                    <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <!-- <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title" style="font-weight: bold;">
                INVOICES SENDED
              </h5>

            </div>

            <div class="card-body table-responsive p-0 small">
              <table id="invoice_send" class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;" width="5px">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">COMMODITY</th>
                    <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div> -->

        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title" style="font-weight: bold;">
                <i class="fas fa-qrcode"></i> Standardized
              </h5>
            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small">
              <table id="invoice_normalized_dgi" class="table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;" width="5px">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">UID DGI</th>
                    <th style="border: 1px solid white; text-align: center;">DATE DGI</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody>

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
<?php

include("pied.php");
// ------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------
?>

<!-- SweetAlert2 pour les notifications DGI -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="modal fade" id="modal_send_invoice">
  <div class="modal-dialog modal-sm small">
    <form id="modal_send_invoice_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="send_invoice_mail">
      <div class="modal-content">
        <div class="modal-header ">
          <h4 class="modal-title"><i class="fa fa-envelope"></i> Send email</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">Invoice Ref.</label>
              <input id="label_ref_fact" class="form-control form-control-sm cc-exp bg-dark" disabled>
              <input type="hidden" name="ref_fact" id="ref_fact">
            </div>

            <div class="col-md-12">
              <hr>
            </div>

            <div class="col-md-12">
              <table class=" table table-dark table-bordered table-hover text-nowrap table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th>#</th>
                    <th>Email Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="tableau_email">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancelled</button>
          <button type="submit" name="rechercheClient" class="btn-xs btn-primary">Submit</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_dossiers_facture">
  <div class="modal-dialog modal-lg small">

    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-file"></i> File(s) in invoices</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Invoice Ref.</label>
            <input id="label_ref_fact_2" class="form-control form-control-sm cc-exp bg-dark" disabled>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12">
            <table id="dossiers_facture" cellspacing="0" width="100%" class="small table hover display compact table-bordered table-striped table-sm text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>File Ref.</th>
                  <th>Truck(Wagon)</th>
                  <th>Declaration</th>
                  <th>Liquidation</th>
                  <th>Quittance</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_check_multiple">
  <div class="modal-dialog modal-sm small">
    <form id="modal_check_multiple_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="check_multiple">
      <div class="modal-content">
        <div class="modal-header ">
          <h4 class="modal-title"><i class="fa fa-check"></i> Multiple Validation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <div class="card-body table-responsive p-0 small" style="height: 400px;">
                <table class=" table table-dark table-bordered table-hover table-head-fixed  text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th>#</th>
                      <th>Reference</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="table_invoices_check_multiple">
                  </tbody>
                </table>
              </div>
            </div>
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
  $(document).ready(function() {

    $('#modal_check_multiple_form').submit(function(e) {

      e.preventDefault();

      if (confirm('Do really you want to submit ?')) {

        var fd = new FormData(this);
        $('#modal_check_multiple').modal('hide');
        $('#spinner-div').show();

        $.ajax({
          type: 'post',
          url: 'ajax.php',
          processData: false,
          contentType: false,
          data: fd,
          dataType: 'json',
          success: function(data) {
            if (data.logout) {
              alert(data.logout);
              window.location = "../deconnexion.php";
            } else if (data.message) {
              // $('#ref_fact').val(data.ref_fact);
              // $('#id_dos').html(data.ref_dos);
              $('#spinner-div').hide(); //Request is complete so hide spinner
              alert(data.message);
            } else {
              // $('#ref_fact').val(data.ref_fact);
              // $('#id_dos').html(data.ref_dos);
              alert(data.compteur + ' invoices validated!');
              // alert('Done!');
            }
          },
          complete: function() {
            // $('#dossiers_facture').DataTable().ajax.reload();
            $('#invoice_waiting_to_send').DataTable().ajax.reload();
            $('#invoice_pending_validation').DataTable().ajax.reload();
            $('#spinner-div').hide(); //Request is complete so hide spinner
          }
        });

      }

    });

  });

  function modal_check_multiple() {

    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {
        id_cli: <?php echo $_GET['id_cli']; ?>,
        id_mod_lic: <?php echo $_GET['id_mod_lic_fact']; ?>,
        operation: 'modal_check_multiple'
      },
      dataType: "json",
      success: function(data) {
        if (data.logout) {
          alert(data.logout);
          window.location = "../deconnexion.php";
        } else {
          $('#table_invoices_check_multiple').html(data.table_invoices_check_multiple);
          $('#modal_check_multiple').modal('show');
        }
      },
      complete: function() {
        $('#spinner-div').hide(); //Request is complete so hide spinner
      }
    });

  }

  function remove_file_invoice(id_dos) {
    if (confirm('Do really you want to remove this file ?')) {
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
          id_dos: id_dos,
          operation: "remove_file_invoice"
        },
        dataType: 'json',
        success: function(data) {
          if (data.logout) {
            alert(data.logout);
            window.location = "../deconnexion.php";
          } else if (data.message) {

            $('#dossiers_facture').DataTable().ajax.reload();
            $('#invoice_waiting_to_send').DataTable().ajax.reload();
            $('#invoice_pending_validation').DataTable().ajax.reload();
            $('#invoice_send').DataTable().ajax.reload();
            $('#invoice_normalized_dgi').DataTable().ajax.reload();
          }
        }
      });
    }
  }

  function modal_dossiers_facture(ref_fact) {

    $('#spinner-div').show();

    $('#label_ref_fact_2').val(ref_fact);

    if ($.fn.dataTable.isDataTable('#dossiers_facture')) {
      table = $('#dossiers_facture').DataTable();
    } else {
      table = $('#dossiers_facture').DataTable({
        paging: false
      });
    }

    table.destroy();

    $('#dossiers_facture').DataTable({
      lengthMenu: [
        [20, 50, 100, -1],
        [20, 50, 100, 500, 'All'],
      ],
      dom: 'Bfrtip',
      buttons: [{
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        className: 'btn btn-success'
      }],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "ajax": {
        "type": "GET",
        "url": "ajax.php",
        "method": "post",
        "dataSrc": {
          "id_cli": "844"
        },
        "data": {
          "ref_fact": ref_fact,
          "operation": "dossiers_facture"
        }
      },
      "columns": [{
          "data": "compteur"
        },
        {
          "data": "ref_dos"
        },
        {
          "data": "truck"
        },
        {
          "data": "declaration"
        },
        {
          "data": "liquidation"
        },
        {
          "data": "quittance"
        },
        {
          "data": "ttc_usd",
          render: DataTable.render.number(null, null, 2, null),
          className: 'dt-body-right'
        }
      ]
    });
    $('#spinner-div').hide(); //Request is complete so hide spinner

    $('#modal_dossiers_facture').modal('show');

  }
  // $(document).ready(function(){

  //   $('#spinner-div').show();

  //    $.ajax({
  //     type: 'post',
  //     url: 'ajax.php',
  //     data: {operation: 'getAllInvoices', id_cli:<?php echo $_GET['id_cli']; ?>, id_mod_lic:<?php echo $_GET['id_mod_lic_fact']; ?>},
  //     dataType: 'json',
  //     success:function(data){
  //       if (data.logout) {
  //         alert(data.logout);
  //         window.location="../deconnexion.php";
  //       }else{
  //         $('#invoice_pending_validation').html(data.invoice_pending_validation);
  //         $('#nbre_invoice_pending_validation').html(data.nbre_invoice_pending_validation);
  //         $('#invoice_waiting_to_send').html(data.invoice_waiting_to_send);
  //         $('#nbre_invoice_waiting_to_send').html(data.nbre_invoice_waiting_to_send);
  //         $('#invoice_send').html(data.invoice_send);
  //         $('#nbre_invoice_send').html(data.nbre_invoice_send);
  //       }
  //     },
  //     complete: function () {
  //         $('#spinner-div').hide();//Request is complete so hide spinner
  //     }
  //   });

  // });

  $('#invoice_waiting_to_send').DataTable({
    lengthMenu: [
      [10, 100, 500, -1],
      [10, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [{
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
    "ajax": {
      "type": "GET",
      "url": "ajax.php",
      "method": "post",
      "dataSrc": {
        "id_cli": ""
      },
      "data": {
        "id_cli": "<?php echo $_GET['id_cli']; ?>",
        "id_mod_lic": "<?php echo $_GET['id_mod_lic_fact']; ?>",
        "statut": "invoice_waiting_to_send_dgi",
        "operation": "getInvoiceAjax"
      }
    },
    rowGroup: {
      dataSrc: "commodity",

    },
    "columns": [{
        "data": "compteur"
      },
      {
        "data": "ref_fact"
      },
      {
        "data": "date_fact"
      },
      {
        "data": "commodity"
      },
      {
        "data": "montant",
        render: DataTable.render.number(null, null, 2, null),
        className: 'dt-body-right'
      },
      {
        "data": "nom_util"
      },
      {
        "data": "action"
      }
    ]
  });

  $('#invoice_pending_validation').DataTable({
    lengthMenu: [
      [10, 100, 500, -1],
      [10, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [{
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      },
      {
        text: '<i class="fa fa-check"></i>',
        className: 'btn btn-info bt',
        action: function(e, dt, node, config) {
          modal_check_multiple();
        }
      }
    ],
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "responsive": true,
    "ajax": {
      "type": "GET",
      "url": "ajax.php",
      "method": "post",
      "dataSrc": {
        "id_cli": ""
      },
      "data": {
        "id_cli": "<?php echo $_GET['id_cli']; ?>",
        "id_mod_lic": "<?php echo $_GET['id_mod_lic_fact']; ?>",
        "statut": "invoice_pending_validation",
        "operation": "getInvoiceAjax"
      }
    },
    rowGroup: {
      dataSrc: "commodity",

    },
    "columns": [{
        "data": "compteur"
      },
      {
        "data": "ref_fact"
      },
      {
        "data": "date_fact"
      },
      {
        "data": "commodity"
      },
      {
        "data": "montant",
        render: DataTable.render.number(null, null, 2, null),
        className: 'dt-body-right'
      },
      {
        "data": "nom_util"
      },
      {
        "data": "action"
      }
    ]
  });

  $('#invoice_send').DataTable({
    lengthMenu: [
      [10, 100, 500, -1],
      [10, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [{
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
    "ajax": {
      "type": "GET",
      "url": "ajax.php",
      "method": "post",
      "dataSrc": {
        "id_cli": ""
      },
      "data": {
        "id_cli": "<?php echo $_GET['id_cli']; ?>",
        "id_mod_lic": "<?php echo $_GET['id_mod_lic_fact']; ?>",
        "statut": "invoice_send",
        "operation": "getInvoiceAjax"
      }
    },
    rowGroup: {
      dataSrc: "commodity",

    },
    "columns": [{
        "data": "compteur"
      },
      {
        "data": "ref_fact"
      },
      {
        "data": "date_fact"
      },
      {
        "data": "commodity"
      },
      {
        "data": "montant",
        render: DataTable.render.number(null, null, 2, null),
        className: 'dt-body-right'
      },
      {
        "data": "nom_util"
      },
      {
        "data": "action"
      }
    ]
  });

  // DataTable pour les factures normalisées DGI
  $('#invoice_normalized_dgi').DataTable({
    lengthMenu: [
      [10, 100, 500, -1],
      [10, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [{
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
    "ajax": {
      "type": "GET",
      "url": "ajax.php",
      "method": "post",
      "dataSrc": {
        "id_cli": ""
      },
      "data": {
        "id_cli": "<?php echo $_GET['id_cli']; ?>",
        "id_mod_lic": "<?php echo $_GET['id_mod_lic_fact']; ?>",
        "statut": "invoice_normalized_dgi",
        "operation": "getInvoiceAjax"
      }
    },
    "columns": [{
        "data": "compteur"
      },
      {
        "data": "ref_fact"
      },
      {
        "data": "date_fact"
      },
      {
        "data": "code_UID",
        render: function(data, type, row) {
          if (data) {
            return '<small style="font-size:9px;">' + data.substring(0, 20) + '...</small>';
          }
          return '-';
        }
      },
      {
        "data": "date_DGI",
        render: function(data, type, row) {
          if (data) {
            var date = new Date(data);
            return date.toLocaleDateString('fr-FR') + ' ' + date.toLocaleTimeString('fr-FR', {
              hour: '2-digit',
              minute: '2-digit'
            });
          }
          return '-';
        }
      },
      {
        "data": "nom_util"
      },
      {
        "data": "action"
      }
    ]
  });


  function modal_send_invoice(ref_fact) {
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {
        ref_fact: ref_fact,
        operation: 'modal_send_invoice'
      },
      dataType: "json",
      success: function(data) {
        if (data.logout) {
          alert(data.logout);
          window.location = "../deconnexion.php";
        } else {
          // alert('Hello');
          // $("#updateModaliteFss").modal("hide");
          $('#ref_fact').val(ref_fact);
          $('#label_ref_fact').val(ref_fact);
          $('#tableau_email').html(data.tableau_email);
          $('#modal_send_invoice').modal('show');
        }
      },
      complete: function() {
        $('#spinner-div').hide(); //Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function() {

    $('#modal_send_invoice_form').submit(function(e) {

      e.preventDefault();

      if (confirm('Do really you want to submit ?')) {

        var fd = new FormData(this);
        $('#modal_send_invoice').modal('hide');
        $('#spinner-div').show();

        $.ajax({
          type: 'post',
          url: 'ajax.php',
          processData: false,
          contentType: false,
          data: fd,
          dataType: 'json',
          success: function(data) {
            if (data.logout) {
              alert(data.logout);
              window.location = "../deconnexion.php";
            } else if (data.message) {
              // $('#ref_fact').val(data.ref_fact);
              // $('#id_dos').html(data.ref_dos);
              $('#spinner-div').hide(); //Request is complete so hide spinner
              alert(data.message);
            } else {
              // $('#ref_fact').val(data.ref_fact);
              // $('#id_dos').html(data.ref_dos);
              alert('Email has been sended');
            }
          },
          complete: function() {
            $('#invoice_waiting_to_send').DataTable().ajax.reload();
            $('#invoice_pending_validation').DataTable().ajax.reload();
            $('#invoice_send').DataTable().ajax.reload();
            $('#invoice_normalized_dgi').DataTable().ajax.reload();
            alert('Email has been sended');
            $('#spinner-div').hide(); //Request is complete so hide spinner
          }
        });

      }

    });

  });

  //Recuperation des factures

  function getAllInvoices() {
    $('#spinner-div').show();

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {
        operation: 'getAllInvoices',
        id_cli: <?php echo $_GET['id_cli']; ?>,
        id_mod_lic: <?php echo $_GET['id_mod_lic_fact']; ?>
      },
      dataType: 'json',
      success: function(data) {
        if (data.logout) {
          alert(data.logout);
          window.location = "../deconnexion.php";
        } else {
          $('#invoice_pending_validation').html(data.invoice_pending_validation);
          $('#nbre_invoice_pending_validation').html(data.nbre_invoice_pending_validation);
          $('#invoice_waiting_to_send').html(data.invoice_waiting_to_send);
          $('#nbre_invoice_waiting_to_send').html(data.nbre_invoice_waiting_to_send);
          $('#invoice_send').html(data.invoice_send);
          $('#nbre_invoice_send').html(data.nbre_invoice_send);
        }
      },
      complete: function() {
        $('#spinner-div').hide(); //Request is complete so hide spinner
      }
    });

  }

  function validerFacture(ref_fact) {

    if (confirm('Do really you want to validate this invoice ' + ref_fact + '?')) {

      $('#spinner-div').show();

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
          ref_fact: ref_fact,
          id_cli: <?php echo $_GET['id_cli']; ?>,
          id_mod_lic: <?php echo $_GET['id_mod_lic_fact']; ?>,
          operation: 'validerFacture'
        },
        dataType: "json",
        success: function(data) {
          if (data.logout) {
            alert(data.logout);
            window.location = "../deconnexion.php";
          } else {
            $('#invoice_waiting_to_send').DataTable().ajax.reload();
            $('#invoice_pending_validation').DataTable().ajax.reload();
            $('#invoice_send').DataTable().ajax.reload();
            $('#invoice_normalized_dgi').DataTable().ajax.reload();
            alert('Invoice ' + ref_fact + ' has been validated!');
          }
        },
        complete: function() {
          $('#spinner-div').hide(); //Request is complete so hide spinner
        }
      });

    }

  }

  function supprimerFacture(ref_fact) {

    if (confirm('Do really you want to validate this invoice ' + ref_fact + '?')) {

      $('#spinner-div').show();

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
          ref_fact: ref_fact,
          id_cli: <?php echo $_GET['id_cli']; ?>,
          id_mod_lic: <?php echo $_GET['id_mod_lic_fact']; ?>,
          operation: 'supprimerFacture'
        },
        dataType: "json",
        success: function(data) {
          if (data.logout) {
            alert(data.logout);
            window.location = "../deconnexion.php";
          } else {
            $('#invoice_waiting_to_send').DataTable().ajax.reload();
            $('#invoice_pending_validation').DataTable().ajax.reload();
            $('#invoice_send').DataTable().ajax.reload();
            $('#invoice_normalized_dgi').DataTable().ajax.reload();
            alert('Invoice ' + ref_fact + ' has been deleted!');
          }
        },
        complete: function() {
          $('#spinner-div').hide(); //Request is complete so hide spinner
        }
      });

    }

  }

  // Fonction pour normaliser une facture avec l'API DGI
  function normaliserFactureDGI(ref_fact) {
    // Confirmation avant normalisation
    Swal.fire({
      title: 'Normalisation DGI',
      text: 'Voulez-vous normaliser cette facture ' + ref_fact + ' avec la DGI?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, normaliser!',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        // Afficher le loader
        Swal.fire({
          title: 'Normalisation en cours...',
          html: '<i class="fas fa-spinner fa-spin fa-3x"></i><br><br>Communication avec l\'API DGI...',
          allowOutsideClick: false,
          showConfirmButton: false
        });

        // Appel AJAX pour normaliser la facture
        $.ajax({
          type: 'POST',
          url: 'ajax/normaliser_facture_dgi.php',
          data: {
            ref_fact: ref_fact
          },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              // Succès de la normalisation
              Swal.fire({
                title: 'Succès!',
                html: '<div style="text-align: left;">' +
                  '<p><strong>Facture normalisée avec succès!</strong></p>' +
                  '<p><strong>UID DGI:</strong><br><small>' + response.data.uid + '</small></p>' +
                  '<p><strong>Code DEF:</strong><br><small>' + response.data.codeDEFDGI + '</small></p>' +
                  '<p><strong>Date:</strong> ' + response.data.dateTime + '</p>' +
                  '</div>',
                icon: 'success',
                confirmButtonColor: '#28a745'
              }).then(() => {
                // Recharger les tableaux
                $('#invoice_waiting_to_send').DataTable().ajax.reload();
                $('#invoice_pending_validation').DataTable().ajax.reload();
                $('#invoice_send').DataTable().ajax.reload();
                $('#invoice_normalized_dgi').DataTable().ajax.reload();
              });
            } else {
              // Erreur lors de la normalisation
              Swal.fire({
                title: 'Erreur!',
                text: response.error || 'Une erreur est survenue lors de la normalisation',
                icon: 'error',
                confirmButtonColor: '#d33'
              });
            }
          },
          error: function(xhr, status, error) {
            // Erreur de connexion
            Swal.fire({
              title: 'Erreur de connexion!',
              text: 'Impossible de contacter le serveur: ' + error,
              icon: 'error',
              confirmButtonColor: '#d33'
            });
          }
        });
      }
    });
  }

  // Fonction pour créer une facture d'avoir (FA) avec l'API DGI
  function normaliserFactureAvoirDGI(ref_fact) {
    // Confirmation avant création de la facture d'avoir
    Swal.fire({
      title: 'Facture d\'Avoir (FA)',
      html: '<p>Voulez-vous créer une <strong>FACTURE D\'AVOIR</strong> pour cette facture ' + ref_fact + '?</p>' +
        '<p style="color: red; font-size: 12px;">⚠️ ATTENTION: Les informations DGI normales (FV) seront remplacées par la facture d\'avoir (FA)</p>',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Oui, créer la facture d\'avoir!',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        // Afficher le loader
        Swal.fire({
          title: 'Création de la facture d\'avoir...',
          html: '<i class="fas fa-spinner fa-spin fa-3x"></i><br><br>Communication avec l\'API DGI...',
          allowOutsideClick: false,
          showConfirmButton: false
        });

        // Appel AJAX pour créer la facture d'avoir
        $.ajax({
          type: 'POST',
          url: 'ajax/normaliser_facture_avoir_dgi.php',
          data: {
            ref_fact: ref_fact
          },
          dataType: 'json',
          success: function(response) {
            console.log('Réponse complète FA:', response);

            if (response.success) {
              // Vérifier si les données critiques sont présentes
              var hasUID = response.data.uid != null && response.data.uid != '';
              var hasCodeDEF = response.data.codeDEFDGI != null && response.data.codeDEFDGI != '';

              var messageHTML = '<div style="text-align: left;">' +
                '<p><strong>Facture d\'avoir créée!</strong></p>' +
                '<p style="color: red;"><strong>Type: FA (AVOIR)</strong></p>';

              if (!hasUID || !hasCodeDEF) {
                messageHTML += '<div style="background-color: #fff3cd; padding: 10px; border-radius: 5px; margin: 10px 0;">' +
                  '<p style="color: #856404;"><strong>⚠️ ATTENTION:</strong> Certaines données sont manquantes</p>' +
                  '<p><strong>UID FA:</strong> ' + (response.data.uid || '<span style="color: red;">NULL</span>') + '</p>' +
                  '<p><strong>Code DEF FA:</strong> ' + (response.data.codeDEFDGI || '<span style="color: red;">NULL</span>') + '</p>';

                // Afficher les données de débogage
                if (response.debug) {
                  messageHTML += '<hr><p><strong>Debug Info:</strong></p>' +
                    '<pre style="font-size: 10px; max-height: 200px; overflow: auto;">' +
                    JSON.stringify(response.debug.full_result, null, 2) + '</pre>';
                }
                messageHTML += '</div>';
              } else {
                messageHTML += '<p><strong>UID FA:</strong><br><small>' + response.data.uid + '</small></p>' +
                  '<p><strong>Code DEF FA:</strong><br><small>' + response.data.codeDEFDGI + '</small></p>';
              }

              messageHTML += '<p><strong>Date:</strong> ' + response.data.dateTime + '</p>' +
                '<p><strong>Facture Origine:</strong> ' + response.data.factureOrigine + '</p>' +
                '</div>';

              // Succès de la création
              Swal.fire({
                title: hasUID && hasCodeDEF ? 'Succès!' : 'Attention',
                html: messageHTML,
                icon: hasUID && hasCodeDEF ? 'success' : 'warning',
                confirmButtonColor: hasUID && hasCodeDEF ? '#28a745' : '#ffc107',
                width: '700px'
              }).then(() => {
                // Recharger les tableaux
                $('#invoice_waiting_to_send').DataTable().ajax.reload();
                $('#invoice_pending_validation').DataTable().ajax.reload();
                $('#invoice_send').DataTable().ajax.reload();
                $('#invoice_normalized_dgi').DataTable().ajax.reload();
              });
            } else {
              // Erreur lors de la création
              Swal.fire({
                title: 'Erreur!',
                text: response.error || 'Une erreur est survenue lors de la création de la facture d\'avoir',
                icon: 'error',
                confirmButtonColor: '#d33'
              });
            }
          },
          error: function(xhr, status, error) {
            // Erreur de connexion
            Swal.fire({
              title: 'Erreur de connexion!',
              text: 'Impossible de contacter le serveur: ' + error,
              icon: 'error',
              confirmButtonColor: '#d33'
            });
          }
        });
      }
    });
  }

  // Fonction pour afficher les détails d'une facture d'avoir DGI existante
  function afficherDetailsAvoirDGI(ref_fact) {
    // Afficher le loader
    Swal.fire({
      title: 'Chargement...',
      html: '<i class="fas fa-spinner fa-spin fa-3x"></i>',
      allowOutsideClick: false,
      showConfirmButton: false
    });

    // Appel AJAX pour récupérer les détails de la facture d'avoir
    $.ajax({
      type: 'POST',
      url: 'ajax/get_facture_avoir_dgi_details.php',
      data: {
        ref_fact: ref_fact
      },
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          // Afficher les détails de la facture d'avoir
          Swal.fire({
            title: 'Détails Facture d\'Avoir DGI',
            html: '<div style="text-align: left; font-size: 14px;">' +
              '<p style="background-color: #dc3545; color: white; padding: 10px; border-radius: 5px; text-align: center;"><strong>TYPE: FA (FACTURE D\'AVOIR)</strong></p>' +
              '<hr>' +
              '<p><strong>📄 Facture Origine:</strong><br><code>' + (response.data.facture_origine_ref || ref_fact) + '</code></p>' +
              '<p><strong>🔑 UID FA:</strong><br><code style="font-size: 11px; word-break: break-all;">' + response.data.code_UID_FA + '</code></p>' +
              '<p><strong>🏷️ Code DEF FA:</strong><br><code>' + response.data.code_DEF_DGI_FA + '</code></p>' +
              '<p><strong>🏢 NIM:</strong> <code>' + (response.data.nim_DGI_FA || 'N/A') + '</code></p>' +
              '<p><strong>📋 NIF:</strong> <code>' + (response.data.nif_DGI_FA || 'N/A') + '</code></p>' +
              '<p><strong>🔢 Compteur:</strong> <code>' + (response.data.compteur_DGI_FA || 'N/A') + '</code></p>' +
              '<p><strong>📅 Date Normalisation FA:</strong><br>' + (response.data.date_DGI_FA || 'N/A') + '</p>' +
              '<p><strong>👤 Opérateur:</strong> ' + response.data.nom_util + '</p>' +
              '<hr>' +
              '<p style="font-size: 11px; color: #666;">QR Code String: <code>' + (response.data.qrcode_string_DGI_FA || 'N/A') + '</code></p>' +
              '</div>',
            icon: 'info',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Fermer',
            width: '600px'
          });
        } else {
          // Erreur
          Swal.fire({
            title: 'Information',
            text: response.error || 'Cette facture n\'a pas encore de facture d\'avoir normalisée',
            icon: 'info',
            confirmButtonColor: '#6c757d'
          });
        }
      },
      error: function(xhr, status, error) {
        // Erreur de connexion
        Swal.fire({
          title: 'Erreur de connexion!',
          text: 'Impossible de contacter le serveur: ' + error,
          icon: 'error',
          confirmButtonColor: '#d33'
        });
      }
    });
  }

  function searchInvoice(ref_fact) {

    document.getElementById("searchInvoice").style.display = "block";

    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {
        ref_fact: ref_fact,
        id_cli: <?php echo $_GET['id_cli']; ?>,
        id_mod_lic: <?php echo $_GET['id_mod_lic_fact']; ?>,
        operation: 'searchInvoice'
      },
      dataType: "json",
      success: function(data) {
        if (data.logout) {
          alert(data.logout);
          window.location = "../deconnexion.php";
        } else {
          $('#label_searchInvoice').html(ref_fact);
          $('#nbre_searchInvoice').html(data.nbre_searchInvoice);
          $('#results_searchInvoice').html(data.results_searchInvoice);
        }
      },
      complete: function() {
        $('#spinner-div').hide(); //Request is complete so hide spinner
      }
    });

  }

  function editerFacture(ref_fact, edit_page) {
    if (confirm('Do really you want to edit this invoice ' + ref_fact + '?')) {
      window.location = edit_page + '?ref_fact=' + ref_fact;
    }
  }
</script>
