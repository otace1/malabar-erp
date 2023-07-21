<?php
  // include("tete.php");
  include("tetepopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><img src="../images/calculator.png" width="25px"> PENDING INVOICES REPORT</h5>
        </div>

      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">

          <div class="col-8">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="pending_report" class=" table table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="">
                      <th style="text-align: center;">Client</th>
                      <th style="text-align: center;">Personne</th>
                      <th style="text-align: center;">Export</th>
                      <th style="text-align: center;">Import</th>
                      <th style="text-align: center;">Grand Total</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                  <tfoot>
                    <tr>
                      <td style="text-align: right;" colspan="2">Total</td>
                      <td style="text-align: right;" class="font-weight-bold"></td>
                      <td style="text-align: right;" class="font-weight-bold"></td>
                      <td style="text-align: right;" class="font-weight-bold"></td>
                    </tr>
                  </tfoot>
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

          <div class="col-md-12"><hr></div>

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

<div class="modal fade" id="modal_detail_invoice_pending_report">
  <div class="modal-dialog modal-xl small">
   
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-file"></i> Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12 table-responsive">
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
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  
  $('#pending_report').DataTable({
     lengthMenu: [
        [25, 50, -1],
        [25, 50, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        title: 'PENDING INVOICES REPORT',
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
          "operation": "pending_report"
      }
    },
    order: [[1, 'asc']],
    rowGroup: {
        dataSrc: 0,
        endRender: function (rows, group) {
            var avg =
                rows
                    .data()
                    .pluck(4)
                    .reduce((a, b) => a + b.replace(/[^\d]/g, '') * 1, 0) / rows.count() * rows.count();
 
            // Use the DataTables number formatter
            return (
                'Total in group: ' +
                DataTable.render.number(null, null, 0, null).display(avg)
            );
        }
    },

      footerCallback: function (row, data, start, end, display) {
        var api = this.api();
 
        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        };
        
        col_export = 2;
        col_import = 3;
        col_total = 4;
        // Total over all pages
        total = api
            .column(col_export)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Total over this page
        pageTotal = api
            .column(col_export, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Update footer
        $(api.column(col_export).footer()).html(DataTable.render.number( null, null, 0, null ).display(pageTotal) + ' (' + DataTable.render.number( null, null, 0, null ).display(total) + ')');
            // $(api.column(col_export).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));
        total = api
            .column(col_import)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Total over this page
        pageTotal = api
            .column(col_import, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Update footer
        $(api.column(col_import).footer()).html(DataTable.render.number( null, null, 0, null ).display(pageTotal) + ' (' + DataTable.render.number( null, null, 0, null ).display(total) + ')');

        total = api
            .column(col_total)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Total over this page
        pageTotal = api
            .column(col_total, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Update footer
        $(api.column(col_total).footer()).html(DataTable.render.number( null, null, 0, null ).display(pageTotal) + ' (' + DataTable.render.number( null, null, 0, null ).display(total) + ')');
    },
    "columns":[
      {"data":"nom_cli"},
      {"data":"nom_util"},
      {"data":"nbre_export",
        render: DataTable.render.number( null, null, 0, null ),
        className: 'dt-body-right'
      },
      {"data":"nbre_import",
        render: DataTable.render.number( null, null, 0, null ),
        className: 'dt-body-right'
      },
      {"data":"nbre_total",
        render: DataTable.render.number( null, null, 0, null ),
        className: 'dt-body-right'
      }
    ],
    "createdRow": function( row, data, dataIndex ) {
      if ( data.nbre_export > 1 && data.nbre_export <= 10) {
        $('td:eq(2)', row).addClass("font-weight-bold bg-info");
      }else if ( data.nbre_export > 10 && data.nbre_export <= 50) {
        $('td:eq(2)', row).addClass("font-weight-bold bg-warning");
      }else if ( data.nbre_export > 50 ) {
        $('td:eq(2)', row).addClass("font-weight-bold bg-danger");
      }

      if ( data.nbre_import > 1 && data.nbre_import <= 10) {
        $('td:eq(3)', row).addClass("font-weight-bold bg-info");
      }else if ( data.nbre_import > 10 && data.nbre_import <= 50) {
        $('td:eq(3)', row).addClass("font-weight-bold bg-warning");
      }else if ( data.nbre_import > 50 ) {
        $('td:eq(3)', row).addClass("font-weight-bold bg-danger");
      }

      if ( data.nbre_total > 1 && data.nbre_total <= 10) {
        $('td:eq(4)', row).addClass("font-weight-bold bg-info");
      }else if ( data.nbre_total > 10 && data.nbre_total <= 50) {
        $('td:eq(4)', row).addClass("font-weight-bold bg-warning");
      }else if ( data.nbre_total > 50 ) {
        $('td:eq(4)', row).addClass("font-weight-bold bg-danger");
      }
    } 
  });
  let table = new DataTable('#pending_report');
  table.on('click', 'tbody tr', function () {
      let data = table.row(this).data();

      modal_detail_invoice_pending_report(data.id, data.id_mod_lic);
      
      // alert('You clicked on ' + data[0] + "'s row");
  });

  function modal_detail_invoice_pending_report(id_cli, id_mod_lic){
    
    $('#spinner-div').show();

    if ( $.fn.dataTable.isDataTable( '#detail_invoice_pending_report' ) ) {
        table = $('#detail_invoice_pending_report').DataTable();
    }
    else {
        table = $('#detail_invoice_pending_report').DataTable( {
            paging: false
        } );
    }

    table.destroy();

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
            "id_cli": id_cli,
            "id_mod_lic": id_mod_lic,
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
    $('#spinner-div').hide();//Request is complete so hide spinner

    $('#modal_detail_invoice_pending_report').modal('show');
    
  }
</script>
