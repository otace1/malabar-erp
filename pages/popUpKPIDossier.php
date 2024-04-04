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
                </h3>
              </div>
              <!-- /.card-header -->
                  <div class="card ">
                    <div class="card-header">
                      <h3 class="card-title">

                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class=" table-responsive p-0 small">
                        <table id="kpi_tracking_reportAll" class=" table table-bordered table-hover text-nowrap table-head-fixed table-sm">
                          <thead>
                            <tr class="">
                              <th style="text-align: center;">#</th>
                              <th style="text-align: center;">MCA REF</th>
                              <th style="text-align: center;">Client</th>
                              <th style="text-align: center;">Transport Mode</th>
                              <th style="text-align: center;">PRE-ALERTE DATE</th>
                              <th style="text-align: center;">INVOICE</th>
                              <th style="text-align: center;">COMMODITY</th>
                              <th style="text-align: center;">SUPPLIER</th>
                              <th style="text-align: center;">PO Ref</th>
                              <th style="text-align: center;">WEIGHT</th>
                              <th style="text-align: center;">FOB</th>
                              <th style="text-align: center;">ROAD MANIF</th>
                              <th style="text-align: center;">HORSE</th>
                              <th style="text-align: center;">TRAILER 1</th>
                              <th style="text-align: center;">TRAILER 2</th>
                              <th style="text-align: center;">Container</th>
                              <th style="text-align: center;">Regime</th>
                              <th style="text-align: center;">Entry Point</th>
                              <th style="text-align: center;">Border Arrival Date</th>
                              <th style="text-align: center;">Border warehouse</th>
                              <th style="text-align: center;">Border warehouse arrival date</th>
                              <th style="text-align: center;">Dispacth from Border</th>
                              <th style="text-align: center;">T1 Number</th>
                              <th style="text-align: center;">Bonded Warehouse</th>
                              <th style="text-align: center;">Warehouse Arrival Date</th>
                              <th style="text-align: center;">Warehouse Departure Date</th>
                              <th style="text-align: center;">LICENCE Num.</th>
                              <th style="text-align: center;">CRF Reference</th>
                              <th style="text-align: center;">CRF Received Date</th>
                              <th style="text-align: center;">Clearing Based on IR/CRF/ARA</th>
                              <th style="text-align: center;">AD Date</th>
                              <th style="text-align: center;">INSURANCE Date</th>
                              <th style="text-align: center;">Declaration Date</th>
                              <th style="text-align: center;">Declaration Reference</th>
                              <th style="text-align: center;">Liquidation Reference</th>
                              <th style="text-align: center;">Date Liquidation</th>
                              <th style="text-align: center;">Quittance Reference</th>
                              <th style="text-align: center;">Date Quittance</th>
                              <th style="text-align: center;">DISPACTH/DELIVER DATE</th>
                              <th style="text-align: center;">REMARKS</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                          </tbody>
                        </table>
                      </div>
                        
                    </div>
                        <!-- input states -->
                    <!-- /.card-body -->
                  </div>
            <!-- /.card -->
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>
</div>
</section>
</div>





<?php
include('pied.php');
?>
<script type="text/javascript">
  
  $('#spinner-div').show();
  $('#kpi_tracking_reportAll').DataTable({
     lengthMenu: [
        [25, 50, 100, 500, -1],
        [25, 50, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        title: 'Tracking KPI\'S',
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
  // "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "operation": "kpi_tracking_reportAll",
          "debut": "<?php echo $_GET['debut'];?>",
          "fin": "<?php echo $_GET['fin'];?>",
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>"
      }
    },
    // order: [[1, 'asc']],
    // rowGroup: {
    //     dataSrc: 0,
    //     endRender: function (rows, group) {
    //         var avg =
    //             rows
    //                 .data()
    //                 .pluck(4)
    //                 .reduce((a, b) => a + b.replace(/[^\d]/g, '') * 1, 0) / rows.count() * rows.count();
 
    //         // Use the DataTables number formatter
    //         // return (
    //         //     'Total in group: ' +
    //         //     DataTable.render.number(null, null, 0, null).display(avg)
    //         // );
    //     }
    // },

    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos",
        className: 'dt-body-center'
      },
      {"data":"nom_cli",
        className: 'dt-body-left'
      },
      {"data":"nom_mod_trans",
        className: 'dt-body-left'
      },
      {"data":"date_preal",
        className: 'dt-body-center'
      },
      {"data":"ref_fact",
        className: 'dt-body-center'
      },
      {"data":"commodity",
        className: 'dt-body-center'
      },
      {"data":"supplier",
        className: 'dt-body-center'
      },
      {"data":"po_ref",
        className: 'dt-body-center'
      },
      {"data":"poids",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null )
      },
      {"data":"fob",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null )
      },
      {"data":"road_manif",
        className: 'dt-body-center'
      },
      {"data":"horse",
        className: 'dt-body-center'
      },
      {"data":"trailer_1",
        className: 'dt-body-center'
      },
      {"data":"trailer_2",
        className: 'dt-body-center'
      },
      {"data":"container",
        className: 'dt-body-center'
      },
      {"data":"regime",
        className: 'dt-body-center'
      },
      {"data":"frontiere",
        className: 'dt-body-center'
      },
      {"data":"klsa_arriv",
        className: 'dt-body-center'
      },
      {"data":"entrepot_frontiere",
        className: 'dt-body-center'
      },
      {"data":"wiski_arriv",
        className: 'dt-body-center'
      },
      {"data":"wiski_dep",
        className: 'dt-body-center'
      },
      {"data":"t1",
        className: 'dt-body-center'
      },
      {"data":"bond_warehouse",
        className: 'dt-body-center'
      },
      {"data":"warehouse_arriv",
        className: 'dt-body-center'
      },
      {"data":"warehouse_dep",
        className: 'dt-body-center'
      },
      {"data":"num_lic",
        className: 'dt-body-center'
      },
      {"data":"ref_crf",
        className: 'dt-body-center'
      },
      {"data":"date_crf",
        className: 'dt-body-center'
      },
      {"data":"ir_crf",
        className: 'dt-body-center'
      },
      {"data":"date_ad",
        className: 'dt-body-center'
      },
      {"data":"date_assurance",
        className: 'dt-body-center'
      },
      {"data":"date_decl",
        className: 'dt-body-center'
      },
      {"data":"ref_decl",
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
      {"data":"dispatch_deliv",
        className: 'dt-body-center'
      },
      {"data":"remarque",
        className: 'dt-body-left'
      }
    ]
    // ,
    // "createdRow": function( row, data, dataIndex ) {
    //   if ( data.delay_klsa < 0) {
    //     $('td:eq(10)', row).addClass("font-weight-bold bg-danger");
    //   }else if ( data.delay_klsa < 2) {
    //     $('td:eq(10)', row).addClass("font-weight-bold bg-success");
    //   }else if ( data.delay_klsa < 3) {
    //     $('td:eq(10)', row).addClass("font-weight-bold bg-info");
    //   }else if ( data.delay_klsa < 4) {
    //     $('td:eq(10)', row).addClass("font-weight-bold bg-warning");
    //   }else {
    //     $('td:eq(10)', row).addClass("font-weight-bold bg-danger");
    //   }

    //   if ( data.comment_delay_klsa == 'On time') {
    //     $('td:eq(11)', row).addClass("font-weight-bold text-success");
    //   }else{
    //     $('td:eq(11)', row).addClass("font-weight-bold text-danger");
    //   }

    // } 
  });
  $('#spinner-div').hide();
  // let table = new DataTable('#pending_report');
  // table.on('click', 'tbody tr', function () {
  //     let data = table.row(this).data();

  //     modal_detail_invoice_pending_report(data.id_cli, data.id_mod_lic);
      
  //     // alert('You clicked on ' + data[0] + "'s row");
  // });

</script>
