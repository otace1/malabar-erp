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
                <h5><i class="fa fa-folder-open nav-icon"></i> Reporting 
                </h5>
                <div class="card-tools">
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body">
                <table id="report_roe_decl" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm small text-nowrap">
                  <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th>MCA File Ref.</th>
                      <th>Transit</th>
                      <th>Decl.Ref.</th>
                      <th>Decl.Date</th>
                      <th>Rate</th>
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
      $('#report_roe_decl').DataTable({
         lengthMenu: [
            [10, 100, 500, -1],
            [10, 100, 500, 'All'],
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
              "operation": "report_roe_decl",
              "date_decl": "<?php echo $_GET['date_decl'];?>",
              "roe_decl": "<?php echo $_GET['roe_decl'];?>"
          }
        },
        "columns":[
      {"data":"compteur"},
      {"data":"ref_dos",
        className: 'dt-body-center'
      },
      {"data":"nom_mod_lic",
        className: 'dt-body-center'
      },
      {"data":"ref_decl",
        className: 'dt-body-center'
      },
      {"data":"date_decl",
        className: 'dt-body-center'
      },
      {"data":"roe_decl",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
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
