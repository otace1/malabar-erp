<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $_GET['id_tres'] = 1;

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><img src="../images/poignee-de-main.png" width="25px">
            Clients
          </h5>
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

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">

        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas  fa-balance-scale"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Solde</span>
                <span class="info-box-number" id="balance">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas  fa-arrow-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payments</span>
                <span class="info-box-number" id="paiement">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas  fa-arrow-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Invoices</span>
                <span class="info-box-number" id="invoice_amount">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <!-- /.col -->
        </div>

        <div class="row">

          <div class="col-12 col-sm-12">

            <div class="card  card-body table-responsive p-0">
              <table id="client_finance" cellspacing="0" width="100%" class="table table-dark table-bordered table-striped  table-sm text-nowrap">
                <thead>
                  <tr>
                    <th style="" width="10px">#</th>
                    <th style="">Client Name</th>
                    <th style="">Debit</th>
                    <th style="">Credit</th>
                    <th style="">Solde</th>
                    <th style=""></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // $maClasse-> afficherStatutDossierFacture(844, $_GET['id_mod_lic_fact']);
                  ?>
                </tbody>
              </table>
            </div>
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

<div class="modal fade " id="modal_new_mouvement">
  <div class="modal-dialog modal-md">
    <form method="POST" action="" id="form_new_mouvement" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_tres" id="id_tres" value="<?php echo $_GET['id_tres'];?>">
      <input type="hidden" name="operation" id="operation" value="new_mouvement">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Mouvement.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Date<sup class="text-danger">*</sup></label>
            <input type="date" name="date_mvt" id="date_mvt" max="<?php echo date('Y-m-d');?>" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Reference<sup class="text-danger">*</sup></label>
            <input maxlength="50" type="text" name="reference" id="reference" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Receipt</label>
            <input type="number" step="0.05" name="paiement" id="paiement" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Payment</label>
            <input type="number" step="0.05" name="invoice_amount" id="invoice_amount" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Naration<sup class="text-danger">*</sup></label>
            <textarea maxlength="50" name="libelle" id="libelle" class="form-control form-control-sm cc-exp" required></textarea>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade " id="modal_edit_mouvement">
  <div class="modal-dialog modal-md">
    <form method="POST" action="" id="form_edit_mouvement" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_mvt" id="id_mvt_edit">
      <input type="hidden" name="operation" id="operation" value="edit_mouvement">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Mouvement.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Date<sup class="text-danger">*</sup></label>
            <input type="date" name="date_mvt" id="date_mvt_edit" max="<?php echo date('Y-m-d');?>" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Reference<sup class="text-danger">*</sup></label>
            <input maxlength="50" type="text" name="reference" id="reference_edit" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Receipt</label>
            <input type="number" step="0.05" name="paiement" id="paiement_edit" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Payment</label>
            <input type="number" step="0.05" name="invoice_amount" id="invoice_amount_edit" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Naration<sup class="text-danger">*</sup></label>
            <textarea maxlength="50" name="libelle" id="libelle_edit" class="form-control form-control-sm cc-exp" required></textarea>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

    <script type="text/javascript">
      
      $(document).ready(function(){
        getMontantClientFinance();
      });

      function getMontantClientFinance(){
        $('#spinner-div').show();
        $.ajax({

            url: 'ajax.php',
            type: 'post',
            data: {operation: "getMontantClientFinance"},
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                $('#balance').html(new Intl.NumberFormat().format(data.balance));
                $('#paiement').html(new Intl.NumberFormat().format(data.montant_paie));

                $('#invoice_amount').html(new Intl.NumberFormat().format(data.montant_facture));
              }
            },
            complete: function () {
                // loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });
      }

        $('#client_finance').DataTable({
           lengthMenu: [
              [15, 25, 50, 100, 500, -1],
              [15, 25, 50, 100, 500, 1000, 'All'],
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
                  "id_cli": "844"
              },
              "data": {
                  "operation": "client_finance"
              }
            },
            "columns":[
              {"data":"compteur"},
              {"data":"nom_cli"},
              {"data":"montant_facture",
                render: DataTable.render.number( null, null, 2, null ),
                className: 'dt-body-right'
              },
              {"data":"montant_paie",
                render: DataTable.render.number( null, null, 2, null ),
                className: 'dt-body-right'
              },
              {"data":"solde",
                render: DataTable.render.number( null, null, 2, null ),
                className: 'dt-body-right'
              },
              {"data":"btn_action",
                className: 'dt-body-center'
              }
            ] 
          });
    </script>