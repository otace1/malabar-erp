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
          <h5><img src="../images/dollar.png" width="25px"> 
            <span class="badge badge-dark text-lg">
              <?php
                echo $maClasse-> getDataTresorerie($_GET['id_tres'])['nom_tres'].' - '.$maClasse-> getDataTresorerie($_GET['id_tres'])['sig_mon'];
              ?>
            </span>
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
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas  fa-balance-scale"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Balance</span>
                <span class="info-box-number" id="balance">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas  fa-arrow-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Receipt</span>
                <span class="info-box-number" id="entree">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas  fa-arrow-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payment</span>
                <span class="info-box-number" id="sortie">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <!-- /.col -->
        </div>

        <div class="row">

          <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active font-weight-bold text-md text-dark" id="mois-tab" data-toggle="pill" href="#mois" role="tab" aria-controls="mois" aria-selected="true">
                      <?php echo date('M Y');?>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link font-weight-bold text-md text-dark" id="tout-tab" data-toggle="pill" href="#tout" role="tab" aria-controls="tout" aria-selected="false">All</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="mois" role="tabpanel" aria-labelledby="mois-tab">
                     
                     <div class="card-body table-responsive p-0">
                      <table id="file_data" cellspacing="0" width="100%" class="table table-dark table-bordered table-striped  table-sm text-nowrap">
                        <thead>
                          <tr>
                            <th style="">#</th>
                            <th style="">Date</th>
                            <th style="">Reference</th>
                            <th style="">Naration</th>
                            <th style="">Receipt</th>
                            <th style="">Payment</th>
                            <!-- <th style="">Balance</th> -->
                            <th style=""></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // $maClasse-> afficherStatutDossierFacture(844, $_GET['id_mod_lic_fact']);
                          ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" style="text-align:right">Total:</th>
                                <th style="text-align:right"></th>
                                <th style="text-align:right"></th>
                                <th></th>
                            </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tout" role="tabpanel" aria-labelledby="tout-tab">
                     <div class="card-body table-responsive p-0">
                      
                          <table id="tresorerie_all" cellspacing="0" width="100%" class="table table-dark table-bordered table-striped table-sm text-nowrap">
                            <thead>
                              <tr class="">
                                <th style="">#</th>
                                <th style="">Month</th>
                                <th style="">Date</th>
                                <th style="">Reference</th>
                                <th style="">Naration</th>
                                <th style="">Receipt</th>
                                <th style="">Payment</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              // $maClasse-> afficherStatutDossierFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                              ?>
                            </tbody>
                          </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
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

<div class="modal fade " id="modal_new_mouvement">
  <div class="modal-dialog modal-md">
    <form method="POST" action="" id="form_new_mouvement" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_tres" id="id_tres" value="<?php echo $_GET['id_tres'];?>">
      <input type="hidden" name="operation" id="operation" value="new_mouvement">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Mouvement.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Date<sup class="text-danger">*</sup></label>
            <input type="date" name="date_mvt" id="date_mvt" max="<?php echo date('Y-m-d');?>" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Reference<sup class="text-danger">*</sup></label>
            <input maxlength="50" type="text" name="reference" id="reference" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Receipt</label>
            <input type="number" step="0.05" name="entree" id="entree" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Payment</label>
            <input type="number" step="0.05" name="sortie" id="sortie" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Naration<sup class="text-danger">*</sup></label>
            <textarea maxlength="50" name="libelle" id="libelle" class="form-control form-control-sm cc-exp" required></textarea>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade " id="modal_edit_mouvement">
  <div class="modal-dialog modal-md">
    <form method="POST" action="" id="form_edit_mouvement" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_mvt" id="id_mvt_edit">
      <input type="hidden" name="operation" id="operation" value="edit_mouvement">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Mouvement.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Date<sup class="text-danger">*</sup></label>
            <input type="date" name="date_mvt" id="date_mvt_edit" max="<?php echo date('Y-m-d');?>" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Reference<sup class="text-danger">*</sup></label>
            <input maxlength="50" type="text" name="reference" id="reference_edit" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Receipt</label>
            <input type="number" step="0.05" name="entree" id="entree_edit" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Payment</label>
            <input type="number" step="0.05" name="sortie" id="sortie_edit" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Naration<sup class="text-danger">*</sup></label>
            <textarea maxlength="50" name="libelle" id="libelle_edit" class="form-control form-control-sm cc-exp" required></textarea>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

    <script type="text/javascript">
      
      $(document).ready(function(){
        getMontantTresorerie();
      });

      function getMontantTresorerie(){
        $.ajax({

            url: 'ajax.php',
            type: 'post',
            data: {id_tres: <?php echo $_GET['id_tres'];?>, operation: "getMontantTresorerie"},
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                $('#balance').html(data.balance);
                $('#entree').html(data.entree);
                $('#sortie').html(data.sortie);
              }
            },
            complete: function () {
                // loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });
      }

      var today   = new Date();
      document.title = "<?php echo $maClasse-> getDataTresorerie($_GET['id_tres'])['nom_tres'].' - '.$maClasse-> getDataTresorerie($_GET['id_tres'])['sig_mon'];?> du " + today.getDate() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
      var groupColumn = 1;

    $('#tresorerie_all').DataTable({
       lengthMenu: [
            [10, 100, 500, -1],
            [10, 100, 500, 'All'],
        ],
        dom: 'Bfrtip',
        buttons: [
            'excel',
            'pageLength'
        ],
        
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            // Total over all pages
            total = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(4, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html(pageTotal + ' ( ' + total + ' total)');

            // Total over all pages
            total = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(5, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html(pageTotal + ' ( ' + total + ' total)');

        },
        columnDefs: [{ visible: false, targets: groupColumn }],
        order: [[groupColumn, 'asc']],
        displayLength: 25,
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
                            .before('<tr class="group bg bg-secondary"><td colspan="2">' + group + '</td></tr>');
 
                        last = group;
                    }
                });
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
              "operation": "tresorerie_all",
              "id_tres": "<?php echo $_GET['id_tres'];?>"
          }
        },
        "columns":[
          {"data":"compteur"},
          {"data":"mois"},
          {"data":"date_mvt"},
          {"data":"reference"},
          {"data":"libelle"},
          {"data":"entree",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"sortie",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          }
        ] 
    });
      $('#file_data').DataTable({
         lengthMenu: [
            [10, 100, 500, -1],
            [10, 100, 500, 'All'],
        ],
        dom: 'Bfrtip',
        buttons: [
            {
              text: '<i class="fa fa-plus"></i> New Mouvement',
              className: 'btn btn-info',
              action: function ( e, dt, node, config ) {
                  $('#modal_new_mouvement').modal('show');
              }
            },
            'excel',
            'pageLength'
        ],
        
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            // Total over all pages
            total = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(4, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html(pageTotal + ' ( ' + total + ' total)');

            // Total over all pages
            total = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(5, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html(pageTotal + ' ( ' + total + ' total)');

        },
        columnDefs: [{ visible: false, targets: groupColumn }],
        order: [[groupColumn, 'asc']],
        displayLength: 25,
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
                            .before('<tr class="group bg bg-secondary"><td colspan="2">' + group + '</td></tr>');
 
                        last = group;
                    }
                });
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
              "operation": "tresorerie_mois",
              "id_tres": "<?php echo $_GET['id_tres'];?>"
          }
        },
        "columns":[
          {"data":"compteur"},
          {"data":"date_mvt"},
          {"data":"reference"},
          {"data":"libelle"},
          {"data":"entree",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"sortie",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"btn_action",
            className: 'dt-body-center'
          }
        ] 
      });

  $(document).ready(function(){

    $('#form_new_mouvement').submit(function(e){

      e.preventDefault();

       if(confirm('Do you really want to submit ?')) {
          
          $('#spinner-div').show();
          $('#modal_new_mouvement').modal('hide');

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
                // $('#tableau_pv_contentieux').html(data.tableau_pv_contentieux);
                $( '#form_new_mouvement' ).each(function(){
                    this.reset();
                });
                $('#file_data').DataTable().ajax.reload();
                $('#tresorerie_all').DataTable().ajax.reload();
                getMontantTresorerie();
                // alert(data.message);
              }
            },
            complete: function () {
                // loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });

  function supprimer_mouvement_tresorerie(id_mvt){

   if(confirm('Do you really want to delete this mouvement ?')) {
      
      $('#spinner-div').show();

      // alert($(this).attr('action'));
      $.ajax({

        url: 'ajax.php',
        type: 'post',
        data: {id_mvt: id_mvt, operation: "supprimer_mouvement_tresorerie"},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#file_data').DataTable().ajax.reload();
            $('#tresorerie_all').DataTable().ajax.reload();
            getMontantTresorerie();
          }
        },
        complete: function () {
            // loadPV();
            $('#spinner-div').hide();//Request is complete so hide spinner
        }

      });


    }
  }

  function modal_edit_mouvement(id_mvt){
    
    $('#spinner-div').show();

    // alert($(this).attr('action'));
    $.ajax({

      url: 'ajax.php',
      type: 'post',
      data: {id_mvt: id_mvt, operation: "modal_edit_mouvement"},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_mvt_edit').val(data.id_mvt);
          $('#date_mvt_edit').val(data.date_mvt);
          $('#entree_edit').val(data.entree);
          $('#sortie_edit').val(data.sortie);
          $('#libelle_edit').val(data.libelle);
          $('#reference_edit').val(data.reference);
          $('#modal_edit_mouvement').modal('show');
        }
      },
      complete: function () {
          // loadPV();
          $('#spinner-div').hide();//Request is complete so hide spinner
      }

    });


  }

  $(document).ready(function(){

    $('#form_edit_mouvement').submit(function(e){

      e.preventDefault();

       if(confirm('Do you really want to submit ?')) {
          
          $('#spinner-div').show();
          $('#modal_edit_mouvement').modal('hide');

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
                // $('#tableau_pv_contentieux').html(data.tableau_pv_contentieux);
                $( '#form_edit_mouvement' ).each(function(){
                    this.reset();
                });
                $('#file_data').DataTable().ajax.reload();
                $('#tresorerie_all').DataTable().ajax.reload();
                getMontantTresorerie();
                // alert(data.message);
              }
            },
            complete: function () {
                // loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });

    </script>