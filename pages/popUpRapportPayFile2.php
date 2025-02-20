<?php
  include("tetePopCDN.php");
  //include("licenceExcel.php");
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card table-responsive p-0">
              <div class="card-header">
                <h5><i class="fa fa-folder-open nav-icon"></i> Files Request No. <?php echo $_GET['id_df'];?>
                </h5>
                <div class="card-tools">
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body">
                <table id="pay_report" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm small text-nowrap">
                  <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th>MCA File Ref.</th>
                      <th>Request No.</th>
                      <th>Date</th>
                      <th>Expense</th>
                      <th>Currency</th>
                      <th>Amount</th>
                      <th>Statut</th>
                      <th>Liq.Ref.</th>
                      <th>Liq.Date</th>
                      <th>Liq.Amount</th>
                      <th>Action</th>
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

  <?php 

  include("pied.php");
  ?>

    <script type="text/javascript">
      var today   = new Date();
      document.title = "report_files_" + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
    $('#spinner-div').show();
      $('#pay_report').DataTable({
         lengthMenu: [
            [15, 25, 50, 100, 500, -1],
            [15, 25, 50, 100, 500, 'All'],
        ],
        dom: 'Bfrtip',
        buttons: [
            'excel',
            'pageLength', 'colvis'
        ],
        // fixedColumns: {
        //   left: 3
        // },
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        // scrollY: 300,

      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      // "responsive": true,
        "ajax":{
          "type": "GET",
          "url":"ajax.php",
          "method":"post",
          "dataSrc":{
              "id_cli": ""
          },          "data": {
              "id_cli": "",
              "id_df": "<?php echo $_GET['id_df'];?>",
              "operation": "pay_report_file_df"
          }
        },
        "columns":[
      {"data":"compteur"},
      {"data":"ref_dos",
        className: 'dt-body-center'
      },
      {"data":"id_df",
        className: 'dt-body-center'
      },
      // {"data":"code_cli"},
      {"data":"date_df",
        className: 'dt-body-center'
      },
      {"data":"nom_dep",
        className: 'dt-body-center'
      },
      {"data":"monnaie",
        className: 'dt-body-center'
      },
      {"data":"montant",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"statut",
        className: 'dt-body-center'
      },
      {"data":"ref_liq",
        className: 'dt-body-center'
      },
      {"data":"date_liq",
        className: 'dt-body-center'
      },
      {"data":"montant_liq",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] ,
      "createdRow": function( row, data, dataIndex ) {
        if ( data['statut'] == "Rejected") {
          $(row).addClass('text text-danger');
        }
        else if ( data['statut'] == "Paid") {
          $(row).addClass('text text-primary');
        }
      } 
      });
      $('#spinner-div').hide();
    </script>
