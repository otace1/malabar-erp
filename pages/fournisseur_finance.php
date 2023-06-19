<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  // include("menuGauche.php");
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
          <h5><img src="../images/livreur.png" width="30px">
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'Vendors';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Fournisseurs';
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
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas  fa-balance-scale"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Solde</span>
                <span class="info-box-number" id="balance">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas  fa-arrow-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payments</span>
                <span class="info-box-number" id="paiement">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas  fa-arrow-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Invoices</span>
                <span class="info-box-number" id="invoice_amount">
                  
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

            <div class="card  card-body table-responsive p-0">
              <table id="fournisseur_finance" cellspacing="0" width="100%" class="table table-dark table-bordered table-striped  table-sm text-nowrap">
                <thead>
                  <tr>
                    <th style="" width="10px">#</th>
                    <th style="">Vendor Name</th>
                    <th style="">Debit</th>
                    <th style="">Credit</th>
                    <th style="">Solde</th>
                    <th style=""></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // $maClasse-> afficherStatutDossierFacture(844, $_GET['id_mod_lic_fact']);
                  ?>
                </tbody>
              </table>
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

<div class="modal fade " id="modal_new_vendor">
  <div class="modal-dialog modal-md">
    <form method="POST" action="" id="form_new_vendor" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="new_vendor">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Vendor.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Name<sup class="text-danger">*</sup></label>
            <input type="text" autocomplete="off" name="nom_four" id="nom_four" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">NIF<sup class="text-danger">*</sup></label>
            <input type="text" autocomplete="off" name="nif_four" id="nif_four" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">RCCM<sup class="text-danger">*</sup></label>
            <input type="text" autocomplete="off" name="rccm_four" id="rccm_four" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Address<sup class="text-danger">*</sup></label>
            <input type="text" autocomplete="off" name="adr_four" id="adr_four" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Tel<sup class="text-danger">*</sup></label>
            <input type="text" autocomplete="off" name="tel_four" id="tel_four" class="form-control form-control-sm cc-exp" required>
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
        getMontantClientFinance();
      });

      function getMontantClientFinance(){
        $('#spinner-div').show();
        $.ajax({

            url: 'ajax.php',
            type: 'post',
            data: {operation: "getMontantClientFinance"},
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                $('#balance').html(new Intl.NumberFormat().format(data.balance));
                $('#paiement').html(new Intl.NumberFormat().format(data.montant_paie));

                $('#invoice_amount').html(new Intl.NumberFormat().format(data.montant_facture));
              }
            },
            complete: function () {
                // loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });
      }

        $('#fournisseur_finance').DataTable({
           lengthMenu: [
              [15, 25, 50, 100, 500, -1],
              [15, 25, 50, 100, 500, 1000, 'All'],
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                  text: '<i class="fa fa-plus"></i> New Vendor',
                  className: 'btn btn-info',
                  action: function ( e, dt, node, config ) {
                      $('#modal_new_vendor').modal('show');
                  }
                },
                'excel',
                'pageLength'
            ],
            
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
                  "operation": "fournisseur_finance"
              }
            },
            "columns":[
              {"data":"compteur"},
              {"data":"nom_four"},
              {"data":"montant_facture",
                render: DataTable.render.number( null, null, 2, null ),
                className: 'dt-body-right'
              },
              {"data":"montant_paie",
                render: DataTable.render.number( null, null, 2, null ),
                className: 'dt-body-right'
              },
              {"data":"solde",
                render: DataTable.render.number( null, null, 2, null ),
                className: 'dt-body-right'
              },
              {"data":"btn_action",
                className: 'dt-body-center'
              }
            ] 
          });


  $(document).ready(function(){

    $('#form_new_vendor').submit(function(e){

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
                $( '#form_new_vendor' ).each(function(){
                    this.reset();
                });
                $('#fournisseur_finance').DataTable().ajax.reload();
                $('#modal_new_vendor').modal('hide');
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