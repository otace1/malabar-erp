<?php
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
          <h5><i class="fa fa-balance-scale nav-icon"></i> 
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'Trial Balance';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Balance de Comptes';
              }
            ?> 
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
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  List of Accounts
                </h5>


                <div class="card-tools">
                  
                </div>
              </div>   -->  
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="file_data" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style="" width="5px">#</th>
                      <th style="">Particulars</th>
                      <th style="">Group</th>
                      <th style="" width="35px">Debit</th>
                      <th style="" width="35px">Credit</th>
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
                          <th></th>
                          <th style="text-align: right;"></th>
                          <th style="text-align: right;"></th>
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

<div class="modal fade rechercheClient" id="modal_desactiver_facturation_dossier">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="ref_fact" id="ref_fact">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage CLIENT.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  // $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn-xs btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

    <script type="text/javascript">
      var today   = new Date();
      // document.title = "All_Accounts_" + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
      var groupColumn = 2;
      $('#file_data').DataTable({
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
            title: 'Trial Balance <?php echo date('Y-m-d');?>'
          }
        ],
        columnDefs: [{ visible: false, targets: groupColumn }],
        order: [[groupColumn, 'asc']],
        displayLength: 100,
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var last = null;
 
            api
                .column(groupColumn, { page: 'current' })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before('<tr class="group bg bg-secondary"><td colspan="6">' + group + '</td></tr>');
 
                        last = group;
                    }
                });
        },

    footerCallback: function (row, data, start, end, display) {
        var api = this.api();

        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        };

        // Total over all pages
        col_debit = 3;
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

        col_credit = 4;
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
              "operation": "afficherTialBalanceAjax"
          }
        },
        "columns":[
          {"data":"compteur"},
          {"data":"nom_sub_class"},
          {"data":"nom_class"},
          {"data":"solde_debit",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'},
          {"data":"solde_credit",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'}
        ] 
      });

    </script>