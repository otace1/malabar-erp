<?php
// include("tete.php");
include("tetepopCDN.php");
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

        <div class="col-12" id="searchInvoice" style="display: none;">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title" style="font-weight: bold;">
                <span style="color: #CCCC00;" class="badge badge-dark" id=""></span> Searching: <span class="text-primary" id="label_searchInvoice"></span> | results: <span id="nbre_searchInvoice" class="text-danger"></span>
              </h5>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small">
              <table class=" table table-dark table-bordered table-hover text-nowrap table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">COMMODITY</th>
                    <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">STATUS</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody id="results_searchInvoice">

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
                <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_invoice_pending_validation"></span> PENDING VALIDATION
              </h5>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small" style="height: 400px;">
              <table id="invoice_pending_validation_CDN" class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                <thead>
                  <tr class="">
                    <th style="border: 1px solid white;">#</th>
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
                <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_invoice_pending_validation"></span> PENDING VALIDATION
              </h5>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small" style="height: 400px;">
              <table class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">COMMODITY</th>
                    <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody id="invoice_pending_validation">

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
                <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_invoice_waiting_to_send"></span> AWAITING TO SEND
              </h5>

              <div class="card-tools">
                <!-- <form class="form-inline ml-3" method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" name="ref_fact" type="search" placeholder="Entrez numéro Facture" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn bg-primary btn-navbar" type="submit" name="search1">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form> -->
              </div>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small" style="height: 400px;">
              <table class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">COMMODITY</th>
                    <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody id="invoice_waiting_to_send">

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
                <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_invoice_send"></span> VALIDATED & SENDED
              </h5>

              <div class="card-tools">
                <!-- <form class="form-inline ml-3" method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" name="ref_fact" type="search" placeholder="Entrez numéro Facture" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn bg-primary btn-navbar" type="submit" name="search1">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form> -->
              </div>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small" style="height: 400px;">
              <table class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">COMMODITY</th>
                    <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">SENDING DATE</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody id="invoice_send">

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
                <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_invoice_send"></span> VALIDATED & SENDED
              </h5>

              <div class="card-tools">
                <!-- <form class="form-inline ml-3" method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" name="ref_fact" type="search" placeholder="Entrez numéro Facture" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn bg-primary btn-navbar" type="submit" name="search1">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form> -->
              </div>

            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 small">
              <table id="invoice_pending_validation_CDN" class=" table table-dark table-bordered table-hover text-nowrap table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th style="border: 1px solid white;">#</th>
                    <th style="border: 1px solid white;">REFERENCE</th>
                    <th style="border: 1px solid white; text-align: center;">DATE</th>
                    <th style="border: 1px solid white; text-align: center;">COMMODITY</th>
                    <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                    <th style="border: 1px solid white; text-align: center;">EDITOR</th>
                    <th style="border: 1px solid white; text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody id="">

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

<script type="text/javascript">
  function getInvoicePending() {
    var today = new Date();
    // document.title = "Dossiers En Cours_" + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
    $('#spinner-div').show();
    $('#invoice_pending_validation_CDN').DataTable({
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
          "statut": "Dossiers En Cours",
          "operation": "invoice_pending_validation_CDN"
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
          "data": "commodity"
        },
        {
          "data": "montant"
        },
        {
          "data": "nom_util"
        },
        {
          "data": "action"
        }
      ]
    });
    $('#spinner-div').hide();
  }

  $(document).ready(function() {
    getInvoicePending();
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
            getAllInvoices();
            alert('Email has been sended');
            $('#spinner-div').hide(); //Request is complete so hide spinner
          }
        });

      }

    });

  });

  //Recuperation des factures

  $(document).ready(function() {

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

  });

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
            $('#invoice_pending_validation').html(data.invoice_pending_validation);
            $('#nbre_invoice_pending_validation').html(data.nbre_invoice_pending_validation);
            $('#invoice_waiting_to_send').html(data.invoice_waiting_to_send);
            $('#nbre_invoice_waiting_to_send').html(data.nbre_invoice_waiting_to_send);
            $('#invoice_send').html(data.invoice_send);
            $('#nbre_invoice_send').html(data.nbre_invoice_send);
            getInvoicePending();
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
            $('#invoice_pending_validation').html(data.invoice_pending_validation);
            $('#nbre_invoice_pending_validation').html(data.nbre_invoice_pending_validation);
            $('#invoice_waiting_to_send').html(data.invoice_waiting_to_send);
            $('#nbre_invoice_waiting_to_send').html(data.nbre_invoice_waiting_to_send);
            $('#invoice_send').html(data.invoice_send);
            $('#nbre_invoice_send').html(data.nbre_invoice_send);
            getInvoicePending();
            alert('Invoice ' + ref_fact + ' has been deleted!');
          }
        },
        complete: function() {
          $('#spinner-div').hide(); //Request is complete so hide spinner
        }
      });

    }

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
