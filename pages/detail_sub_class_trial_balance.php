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
                  <?php echo $maClasse-> getSubClass($_GET['id_sub_class'])['nom_sub_class'];?>
                </h3>
              </div>
              <!-- /.card-header -->
                  <div class="card card">
                    <!-- /.card-header -->
                    
                    <div class="card  card-body table-responsive p-0">
                      <table id="detail_sub_class_trial_balance" cellspacing="0" width="100%" class="table table-bordered table-striped  table-sm text-nowrap small">
                        <thead>
                          <tr>
                            <th style="" width="5px">#</th>
                            <th style="">Particulars</th>
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
                                <th colspan="2" style="text-align:right">Total:</th>
                                <th style="text-align: right;"></th>
                                <th style="text-align: right;"></th>
                            </tr>
                        </tfoot>
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

   var today   = new Date();

      $('#detail_sub_class_trial_balance').DataTable({
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
            title: '<?php echo $maClasse-> getSubClass($_GET['id_sub_class'])['nom_sub_class'];?> <?php echo date('Y-m-d');?>'
          }
        ],
        // columnDefs: [{ visible: false, targets: groupColumn }],
        // order: [[groupColumn, 'asc']],
        displayLength: 5000,
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
        col_debit = 2;
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

        col_credit = 3;
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
              "operation": "detail_sub_class_trial_balance",
              "id_sub_class": "<?php echo $_GET['id_sub_class'];?>"
          }
        },
        "columns":[
          {"data":"compteur"},
          {"data":"nom_compte"},
          {"data":"solde_debit",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"solde_credit",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'}
        ] 
      });
  function modal_paiement_facture(ref_fact) {
    $('#spinner-div').show();
    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {ref_fact: ref_fact, operation: "modal_paiement_facture"},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_ref_fact').html(ref_fact);
          $('#ref_fact').val(ref_fact);
          $('#detail_paiement_facture').html(data.detail_paiement_facture);
          $('#modal_paiement_facture').modal('show');
        }
      },
      complete: function () {
          // loadPV();
          $('#spinner-div').hide();//Request is complete so hide spinner
      }

    });
  }


  $(document).ready(function(){

      $('#form_paiement_facture').submit(function(e){

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
              }else{
                $( '#form_paiement_facture' ).each(function(){
                    this.reset();
                });
                $('#detail_paiement_facture').html(data.detail_paiement_facture);
                $('#detail_sub_class_trial_balance').DataTable().ajax.reload();
                // $('#modal_paiement_facture').modal('hide');
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }


      });
    
  });
  </script>