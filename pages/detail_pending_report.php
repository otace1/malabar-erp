<?php
  include("tetePopCDN.php");
 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                  <?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'].' | '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']);?>
                </h3>
              </div>
              <!-- /.card-header -->
                  <div class="">
                    <!-- /.card-header -->
                    
                    <div class="card  card-body table-responsive p-0">
                      <table id="detail_invoice_pending_report" cellspacing="0" width="100%" class="small table hover display compact table-bordered table-striped table-sm text-nowrap">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>MCA File Ref.</th>
                          <th>Lot Num. / Inv.No.</th>
                          <th>PO.No.</th>
                          <th>Commodity</th>
                          <th>Truck / Wagon / AWB</th>
                          <th>E.Ref</th>
                          <th>E.Date</th>
                          <th>L.Ref</th>
                          <th>L.Date</th>
                          <th>L.Amount</th>
                          <th>Delay</th>
                          <th>Q.Ref</th>
                          <th>Q.Date</th>
                          <th>Transit</th>
                          <th>Person Assigned</th>
                          <th>Year</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
            <!-- /.card -->
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>
  <?php
  include('pied.php');
  ?>

  <div class="modal fade " id="modal_paiement_facture">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><img src="../images/terminal-de-point-de-vente.png" width="30px"> Payments <span class="badge badge-dark" id="label_ref_fact"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="form_paiement_facture" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
            <input type="hidden" name="operation" value="paiement_facture">
            <input type="hidden" name="ref_fact" id="ref_fact">
            <div class="row">
              <div class="col-md-6">
                <label for="x_card_code" class="control-label mb-1">Date</label>
                <input type="date" name="date_paie" class="form-control form-control-sm cc-exp" required>
              </div>
              <div class="col-md-6">
                <label for="x_card_code" class="control-label mb-1">Reference</label>
                <input type="text" name="ref_paie" class="form-control form-control-sm cc-exp" required>
              </div>
              <div class="col-md-6">
                <label for="x_card_code" class="control-label mb-1">Account</label>
                <select name="id_tres" class="form-control form-control-sm cc-exp" required>
                  <option></option>
                  <?php
                    $maClasse-> selectionnerTresorerie();
                  ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="x_card_code" class="control-label mb-1">Amount</label>
                <input type="number" step="0.01" name="montant_paie" class="form-control form-control-sm cc-exp" required>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" name="" class="btn btn-xs btn-primary">Submit</button>
            </div>

          </form>

          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-striped table-dark  table-sm text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Ref.</th>
                    <th>Account</th>
                    <th>Amount</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="detail_paiement_facture"></tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">

    $('#detail_invoice_pending_report').DataTable({
       lengthMenu: [
          [20, 30, 50, -1],
          [20, 30, 50, 1000, 'All'],
      ],
      dom: 'Bfrtip',
      buttons: [
          {
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i>',
            className: 'btn btn-success'
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
            "id_cli": "844"
        },
        "data": {
            "id_cli": <?php echo $_GET['id_cli'];?>,
            "id_mod_lic": <?php echo $_GET['id_mod_lic'];?>,
            "operation": "detail_invoice_pending_report"
        }
      },
      "columns":[
        {"data":"compteur"},
        {"data":"ref_dos"},
        {"data":"num_lot"},
        {"data":"po_ref"},
        {"data":"nom_march"},
        {"data":"truck"},
        {"data":"ref_decl"},
        {"data":"date_decl"},
        {"data":"ref_liq"},
        {"data":"date_liq"},
        {"data":"montant_liq"},
        {"data":"delay_liq"},
        {"data":"ref_quit"},
        {"data":"date_quit"},
        {"data":"nom_mod_lic"},
        {"data":"nom_util"},
        {"data":"annee"}
      ] 
    });
  </script>