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
          <h5><img src="../images/kpi.png" width="25px"> TRACKING KPI'S <span class="badge badge-primary text-md"><?php echo $_GET['debut'].' To '.$_GET['fin'];?></span></h5>
        </div>

      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">

          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <!-- style="cursor:pointer" -->
              <div class="card-body table-responsive p-0 small">
                <table id="kpi_tracking_report" class=" table table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="">
                      <th style="text-align: center;">#</th>
                      <th style="text-align: center;">Code</th>
                      <th style="text-align: center;">File Ref.</th>
                      <th style="text-align: center;">Truck</th>
                      <th style="text-align: center;">Border</th>
                      <th style="text-align: center;">Border Arrival</th>
                      <th style="text-align: center;">Wisky Arrival</th>
                      <th style="text-align: center;">Wisky Departure</th>
                      <th style="text-align: center;">Delay</th>
                      <th style="text-align: center;">Dispatch From Border</th>
                      <th style="text-align: center;">Delay</th>
                      <th style="text-align: center;">Comment</th>
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


<div class="modal fade" id="modal_filtre_date">
  <div class="modal-dialog modal-sm">
    <!-- <form method="POST" id="form_dossierTransport" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="filtre_date">
      <input type="hidden" name="id_trans" value="<?php echo $_GET['id_trans'];?>">
      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_trans" value="<?php echo $_GET['id_mod_trans'];?>"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title">
          <i class="fa fa-filter"></i> Filter By Date
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">

         <div class="form-group">
            <div class="row">
               <div class="col-sm-6">
                  <div class="form-group">
                     <label>Begin</label>
                     <input type="date" id="debut" name="debut" class="form-control form-control-sm" required>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label>End</label>
                     <input type="date" id="fin" name="fin" class="form-control form-control-sm" required>
                  </div>
               </div>
            </div>
         </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" onclick="filter_by_date(debut.value, fin.value)"><i class="fa fa-check"></i> Submit</button>
      </div>

    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<script type="text/javascript">

  function filter_by_date(debut, fin){
    window.location.replace('kpi_tracking.php?debut='+debut+'&fin='+fin,'pop1','width=80,height=80');
  }

  $('#spinner-div').show();
  $('#kpi_tracking_report').DataTable({
     lengthMenu: [
        [15, 25, 50, -1],
        [15, 25, 50, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
         {
            text: '<i class="fa fa-filter"></i> Filter By Date',
            className: 'btn btn-info',
            action: function ( e, dt, node, config ) {
                $('#modal_filtre_date').modal('show');
            }
        },
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
          "operation": "kpi_tracking_report",
          "debut": "<?php echo $_GET['debut'];?>",
          "fin": "<?php echo $_GET['fin'];?>"
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
            // return (
            //     'Total in group: ' +
            //     DataTable.render.number(null, null, 0, null).display(avg)
            // );
        }
    },

    "columns":[
      {"data":"compteur"},
      {"data":"code_kpi_tracking",
        className: 'dt-body-center'
      },
      {"data":"ref_dos",
        className: 'dt-body-center'
      },
      {"data":"truck",
        className: 'dt-body-center'
      },
      {"data":"frontiere",
        className: 'dt-body-center'
      },
      {"data":"klsa_arriv",
        className: 'dt-body-center'
      },
      {"data":"wiski_arriv",
        className: 'dt-body-center'
      },
      {"data":"wiski_dep",
        className: 'dt-body-center'
      },
      {"data":"delay_wiski",
        className: 'dt-body-center'
      },
      {"data":"dispatch_klsa",
        className: 'dt-body-center'
      },
      {"data":"delay_klsa",
        className: 'dt-body-center'
      },
      {"data":"comment_delay_klsa",
        className: 'dt-body-center'
      }
    ],
    "createdRow": function( row, data, dataIndex ) {
      if ( data.delay_klsa < 0) {
        $('td:eq(10)', row).addClass("font-weight-bold bg-danger");
      }else if ( data.delay_klsa < 2) {
        $('td:eq(10)', row).addClass("font-weight-bold bg-success");
      }else if ( data.delay_klsa < 3) {
        $('td:eq(10)', row).addClass("font-weight-bold bg-info");
      }else if ( data.delay_klsa < 4) {
        $('td:eq(10)', row).addClass("font-weight-bold bg-warning");
      }else {
        $('td:eq(10)', row).addClass("font-weight-bold bg-danger");
      }

      if ( data.comment_delay_klsa == 'On time') {
        $('td:eq(11)', row).addClass("font-weight-bold text-success");
      }else{
        $('td:eq(11)', row).addClass("font-weight-bold text-danger");
      }

    } 
  });
  $('#spinner-div').hide();
  // let table = new DataTable('#pending_report');
  // table.on('click', 'tbody tr', function () {
  //     let data = table.row(this).data();

  //     modal_detail_invoice_pending_report(data.id_cli, data.id_mod_lic);
      
  //     // alert('You clicked on ' + data[0] + "'s row");
  // });

  function modal_detail_invoice_pending_report(id_cli, id_mod_lic){
    window.open('detail_pending_report.php?id_cli='+id_cli+'&id_mod_lic='+id_mod_lic,'pop10','width=1500,height=950');
  }

</script>
