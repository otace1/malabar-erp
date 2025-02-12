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
            <div class="card">
              <div class="card-header">
                <h5>Base on Quittance Date | Between <?php echo $_GET['debut']?> and <?php echo $_GET['fin']?></h5>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                
                <table id="dossier_no_dispatch_dashboard" class="table table-bordered table-hover table-sm small">
                  <thead>
                    <tr class="">
                      <th style="">#</th>
                      <th>Client</th>
                      <th>Category</th>
                      <th>Mode of Transport</th>
                      <th style="">Ref.Dossier</th>
                      <th>Lot Num</th>
                      <th>Ref.Fact.</th>
                      <th>License Num</th>
                      <th>Declaration Ref.</th>
                      <th>Declaration Date</th>
                      <th>Liquidation Ref.</th>
                      <th>Liquidation Date</th>
                      <th>Liquidation Amount</th>
                      <th>Quittance Ref.</th>
                      <th>Quittance Date</th>
                    </tr>
                  </thead>
                  <tbody class="">
                   
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
    $('#spinner-div').show();
    $('#dossier_no_dispatch_dashboard').DataTable({
       lengthMenu: [
          [10, 20, 50, -1],
          [10, 20, 50, 500, 'All'],
      ],
      dom: 'Bfrtip',
      buttons: [,
        'pageLength',
          {
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i>',
            title: 'Not_dispatched_report_between_<?php echo $_GET['debut'];?>_and_<?php echo $_GET['fin'];?>',
            className: 'btn btn-success'
          }
      ],
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
        },
        "data": {
            "id_cli": "<?php echo $_GET['id_cli'];?>",
            "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
            "debut": "<?php echo $_GET['debut'];?>",
            "fin": "<?php echo $_GET['fin'];?>",  
            "operation": "dossier_quittance_dashboard"
        }
      },
      "columns":[
        {"data":"compteur"},
        {"data":"nom_cli"},
        {"data":"nom_march"},
        {"data":"nom_mod_trans",
          className: 'dt-body-center'
        },
        {"data":"ref_dos",
          className: ' text-nowrap'
        },
        {"data":"num_lot",
          className: 'dt-body-center'
        },
        {"data":"ref_fact",
          className: 'dt-body-center'
        },
        {"data":"num_lic",
          className: 'dt-body-center text-nowrap'
        },
        {"data":"ref_decl",
          className: 'dt-body-center'
        },
        {"data":"date_decl",
          className: 'dt-body-center'
        },
        {"data":"ref_liq",
          className: 'dt-body-center'
        },
        {"data":"date_liq",
          className: 'dt-body-center'
        },
        {"data":"montant_liq",
          className: 'dt-body-center'
        },
        {"data":"ref_quit",
          className: 'dt-body-center'
        },
        {"data":"date_quit",
          className: 'dt-body-center'
        }
      // ,
      //   {"data":"lmc_id",
      //     className: 'dt-body-center'
      //   }
      ] 
    });
      $('#spinner-div').hide();
    </script>
