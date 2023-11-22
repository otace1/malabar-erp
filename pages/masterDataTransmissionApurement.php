<?php
  include("tetePopCDN.php");
 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
          <!-- /.card-header -->

          <div class="row">
            <div class="col-sm-12">
              <div class="card ">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight: bold;">
                    <i class="fa fa-folder-open nav-icon"></i> <?php echo $maClasse-> getNomClient($_GET['id_cli']).' | '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']);?>
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="card-body table-responsive p-0">
                    <table id="master_data_transmit" cellspacing="0" width="100%" class="table table-bordered table-striped small  text-nowrap">
                      <thead>
                        <tr>
                          <th style="text-align: center; ">#</th>
                          <th>Licence</th>
                          <th>Ref.Dossier</th>
                          <th>Decl.Ref.</th>
                          <th>Decl.Date</th>
                          <th>Liq.Ref.</th>
                          <th>Liq.Date</th>
                          <th>Quit.Ref.</th>
                          <th>Quit.Date</th>
                          <th>Ref.Transmit</th>
                          <th>Date Transmit</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                       
                      </tbody>
                    </table>
                  </div>
                    <!-- input states -->
                  <!-- /.card-body -->
                </div>
              <!-- /.card -->
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <?php
  include('pied.php');
  ?>

  <script type="text/javascript">
    
  $('#master_data_transmit').DataTable({
     lengthMenu: [
        [15, 30, 50, 100, 500, -1],
        [15, 30, 50, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
        // fixedColumns: {
        //   left: 3
        // },
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      }
      // ,
      // {
      //   text: '<i class="fa fa-check"></i>',
      //   className: 'btn btn-info bt',
      //   action: function ( e, dt, node, config ) {
      //       modal_edit_dossier();
      //   }
      // }
  ],
  
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
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
          "operation": "master_data_transmit"
      }
    },
    // rowGroup: {
    //     dataSrc: "num_lic",

    // },
    "columns":[
      {"data":"compteur"},
      {"data":"num_lic",
        className: 'dt-body-left'
      },
      {"data":"ref_dos",
        className: 'dt-body-left'
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
      {"data":"ref_quit",
        className: 'dt-body-center'
      },
      {"data":"date_quit",
        className: 'dt-body-center'
      },
      {"data":"ref_trans_ap",
        className: 'dt-body-center'
      },
      {"data":"date_trans_ap",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

  </script>