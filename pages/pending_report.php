<?php
  // include("tete.php");
  include("tetePopCDN.php");
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

          <div class="col-7">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="pending_report" class=" table table-bordered table-hover text-nowrap table-head-fixed table-sm"style="cursor:pointer">
                  <thead>
                    <tr class="">
                      <th style="text-align: center;">Client</th>
                      <th style="text-align: center;">Person Name</th>
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

          <div class="col-5">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="invoice_assigned" class=" table table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="">
                      <th style="text-align: center;">Client</th>
                      <th style="text-align: center;">Person Name</th>
                      <th style="text-align: center;">transit</th>
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

<div class="modal fade" id="modal_create_assignement">
  <div class="modal-dialog modal-sm small">
    <form id="create_assignement_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="create_assignement">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Assignement</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Person</label>
          <select class="form-control cc-exp form-control-sm" name="id_util">
            <option></option>
            <?php
              $maClasse-> selectionnerUtilisateurRole(12);
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Client</label>
          <select class="form-control cc-exp form-control-sm" name="id_cli">
            <option></option>
            <?php
              $maClasse-> selectionnerClient();
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Transit</label>
          <select class="form-control cc-exp form-control-sm" name="id_mod_lic">
            <option></option>
            <?php
              $maClasse-> selectionnerModeleLicence();
            ?>
          </select>
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
  
  $(document).ready(function(){

    $('#create_assignement_form').submit(function(e){

      e.preventDefault();

       if(confirm('Do you really want to submit ?')) {
          
          $('#spinner-div').show();
          $('#modal_create_assignement').modal('hide');

          var fd = new FormData(this);
          // alert($(this).attr('action'));
          $.ajax({

            url: 'ajax.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                
                $( 'form' ).each(function(){
                    this.reset();
                });

                $('#pending_report').DataTable().ajax.reload();
                $('#invoice_assigned').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
              }
            },
            complete: function () {
                loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });
  function remove_assignement(id_util, id_mod_lic, id_cli){

    if(confirm('Do really you want to delete this assignement ?')) {

      $('#spinner-div').show();

        $.ajax({
          type: "POST",
          url: "ajax.php",
          data: { id_util: id_util, id_cli:id_cli, id_mod_lic:id_mod_lic, operation: 'remove_assignement'},
          dataType:"json",
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#invoice_assigned').DataTable().ajax.reload();
              $('#pending_report').DataTable().ajax.reload();
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

    }

  }

  $('#invoice_assigned').DataTable({
     lengthMenu: [
        [15, 25, 50, -1],
        [15, 25, 50, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        title: 'ASSIGNEMENT',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      }
      <?php
      if ($maClasse-> getUtilisateur($_SESSION['id_util'])['assignement_facturation']=='1') {
      ?>
      ,
      {
        text: '<i class="fa fa-plus"></i> New',
        className: 'btn btn-info',
        action: function ( e, dt, node, config ) {
            $( '#create_assignement_form' ).each(function(){
              this.reset();
            });
            $('#modal_create_assignement').modal('show');
        }
      }
      <?php
      }
      ?>
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
          "operation": "invoice_assigned"
      }
    },
    order: [[0, 'asc']],
    rowGroup: {
        dataSrc: 0
    },

    "columns":[
      {"data":"nom_util"},
      {"data":"nom_cli"},
      {"data":"nom_mod_lic"}
    ]
  });

  $('#pending_report').DataTable({
     lengthMenu: [
        [15, 25, 50, -1],
        [15, 25, 50, 'All'],
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

      modal_detail_invoice_pending_report(data.id_cli, data.id_mod_lic);
      
      // alert('You clicked on ' + data[0] + "'s row");
  });

  function modal_detail_invoice_pending_report(id_cli, id_mod_lic){
    window.open('detail_pending_report.php?id_cli='+id_cli+'&id_mod_lic='+id_mod_lic,'pop10','width=1500,height=950');
  }

</script>
