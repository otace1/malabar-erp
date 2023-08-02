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
                  <?php echo $maClasse-> getCompte($_GET['id_compte'])['nom_compte'];?>
                </h3>
              </div>
              <!-- /.card-header -->
                    
                    <div class="card-body table-responsive p-0">
                      <table id="detail_compte" cellspacing="0" width="100%" class="table table-bordered table-striped  table-sm text-nowrap small">
                        <thead>
                          <tr>
                            <th style="" width="5px">#</th>
                            <th style="">Date</th>
                            <th style="">Naration</th>
                            <th style="">Currency</th>
                            <th style="">Rate</th>
                            <th style="">Encoded Debit</th>
                            <th style="">Encoded Credit</th>
                            <th style="">Debit</th>
                            <th style="">Credit</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // $maClasse-> afficherStatutDossierFacture(844, $_GET['id_mod_lic_fact']);
                          ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:right">Total:</th>
                                <th style="text-align: right;"></th>
                                <th style="text-align: right;"></th>
                                <th style="text-align: right;"></th>
                                <th style="text-align: right;"></th>
                            </tr>
                        </tfoot>
                      </table>

                    </div>

          </div>
    </section>
    <!-- /.content -->
  </div>
  <?php
  include('pied.php');
  ?>

<div class="modal fade creerEcritureComptable" id="modal_detail_ecriture">
  <div class="modal-dialog modal-xl">

    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Accounting Voucher Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Type</label>
            <input id="nom_t_e_det" class="form-control cc-exp form-control-sm" disabled>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Doc.Ref.</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="reference_det" disabled>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Date</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_e_det" disabled>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Journal</label>
            <input id="nom_jour_det" class="form-control cc-exp form-control-sm" disabled>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Currency</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="sig_mon_det" disabled>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12 table-responsive" style="">
            <table id="detail_ecriture" cellspacing="0" width="100%" class="small table hover display compact table-bordered table-striped table-sm text-nowrap">
              <thead>
                <tr>
                  <th style="">Particular</th>
                  <th style=" text-align: center;" width="20%">Debit</th>
                  <th style=" text-align: center;" width="20%">Credit</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                  <td style="text-align: right;">Total</td>
                  <td style="text-align: right;" class="font-weight-bold"></td>
                  <td style="text-align: right;" class="font-weight-bold"></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="col-6 small">
            <label for="x_card_code" class="control-label mb-1">Naration</label>
            <textarea class="form-control form-control-sm" id="libelle_e_det" disabled></textarea>
          </div>
          <!-- <div class="col-6 text-right">
            <span>Total Debit <span class="text-md badge badge-dark" id="total_debit_2"></span></span><br>
            <span>Total Credit <span class="text-md badge badge-dark" id="total_credit_2"></span></span>
          </div> -->
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Close</button>
        <!-- <button type="submit" name="" class="btn-xs btn-primary">Submit</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <script type="text/javascript">

   var today   = new Date();

      $('#detail_compte').DataTable({
         lengthMenu: [
            [5, 10, 20, 50, 100, 200, 500, -1],
            [5, 10, 20, 50, 100, 200, 500, 'All'],
        ],
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i>',
            className: 'btn btn-success',
            title: '<?php echo $maClasse-> getCompte($_GET['id_compte'])['nom_compte'];?> <?php echo date('Y-m-d');?>'
          }
        ],
        // columnDefs: [{ visible: false, targets: groupColumn }],
        // order: [[groupColumn, 'asc']],
        displayLength: 50,
        // drawCallback: function (settings) {
        //     var api = this.api();
        //     var rows = api.rows({ page: 'current' }).nodes();
        //     var last = null;
 
        //     api
        //         .column(groupColumn, { page: 'current' })
        //         .data()
        //         .each(function (group, i) {
        //             if (last !== group) {
        //                 $(rows)
        //                     .eq(i)
        //                     .before('<tr class="group bg bg-secondary"><td colspan="6">' + group + '</td></tr>');
 
        //                 last = group;
        //             }
        //         });
        // },

    footerCallback: function (row, data, start, end, display) {
        var api = this.api();

        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        };

        // Total over all pages
        col_debit = 5;
        total = api
            .column(col_debit)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Total over this page
        pageTotal = api
            .column(col_debit, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(col_debit).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));
        // $(api.column(col_debit).footer()).html(pageTotal + ' ( ' + total + ' total)');

        col_credit = 6;
        total = api
            .column(col_credit)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Total over this page
        pageTotal = api
            .column(col_credit, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        // $(api.column(4).footer()).html(pageTotal + ' ( ' + total + ' total)');
        $(api.column(col_credit).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));

        // Total over all pages
        col_debit = 7;
        total = api
            .column(col_debit)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Total over this page
        pageTotal = api
            .column(col_debit, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(col_debit).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));
        // $(api.column(col_debit).footer()).html(pageTotal + ' ( ' + total + ' total)');

        col_credit = 8;
        total = api
            .column(col_credit)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Total over this page
        pageTotal = api
            .column(col_credit, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        // $(api.column(4).footer()).html(pageTotal + ' ( ' + total + ' total)');
        $(api.column(col_credit).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));

    },

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
              "operation": "detail_compte",
              "id_compte": "<?php echo $_GET['id_compte'];?>"
          }
        },
        "columns":[
          {"data":"compteur"},
          {"data":"date_e"},
          {"data":"libelle_e"},
          {"data":"sig_mon"},
          {"data":"montant_taux",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"debit",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"credit",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"debit_acc",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"credit_acc",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'}
        ] 
      });

  
  function detail_ecriture(id_e){
    
    $('#spinner-div').show();

    getEcriture(id_e)

     var today   = new Date();
    document.title = id_e + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();

    $('#label_compte').html(id_e);
    if ( $.fn.dataTable.isDataTable( '#detail_ecriture' ) ) {
        table = $('#detail_ecriture').DataTable();
    }
    else {
        table = $('#detail_ecriture').DataTable( {
            paging: false
        } );
    }

    table.destroy();

    $('#detail_ecriture').DataTable({
       lengthMenu: [
          [500, -1],
          [500, 1000, 'All'],
      ],
      dom: 'Bfrtip',
      buttons: [
          {
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i>',
            className: 'btn btn-success'
          }
      ],
      footerCallback: function (row, data, start, end, display) {
        var api = this.api();
 
        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        };
        
        col_debit = 1;
        col_credit = 2;
        // Total over all pages
        total = api
            .column(col_debit)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Total over this page
        pageTotal = api
            .column(col_debit, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Update footer
        // $(api.column(2).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
            $(api.column(col_debit).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));
        total = api
            .column(col_credit)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Total over this page
        pageTotal = api
            .column(col_credit, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Update footer
            $(api.column(col_credit).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));
    },
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
            "id_e": id_e,
            "operation": "detail_ecriture_comptable"
        }
      },
      "columns":[
        {"data":"nom_compte"},
        {"data":"debit",
          render: DataTable.render.number( null, null, 2, null ),
          className: 'dt-body-right'
        },
        {"data":"credit",
          render: DataTable.render.number( null, null, 2, null ),
          className: 'dt-body-right'
        }
      ] 
    });
    $('#spinner-div').hide();//Request is complete so hide spinner

    $('#modal_detail_ecriture').modal('show');
    
  }


  function getEcriture(id_e){

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getEcriture', id_e: id_e},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#nom_t_e_det').val(data.nom_t_e);
          $('#reference_det').val(data.reference);
          $('#date_e_det').val(data.date_e);
          $('#nom_jour_det').val(data.nom_jour);
          $('#libelle_e_det').val(data.libelle_e);
          $('#sig_mon_det').val(data.sig_mon);
        }
      }
    });

  }

  </script>