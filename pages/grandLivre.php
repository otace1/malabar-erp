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
          <h5><i class="fa fa-folder-open nav-icon"></i> 
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'Ledger of Accounts';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Grand Livre de Comptes';
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
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  List of Accounts
                </h5>


                <div class="card-tools">
                  
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="file_data" cellspacing="0" width="100%" class="table table-bordered table-striped table-dark table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th style="">Account Name</th>
                      <th style="">Account Group</th>
                      <th style="">Debit</th>
                      <th style="">Credit</th>
                      <th style="">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // $maClasse-> afficherStatutDossierFacture(844, $_GET['id_mod_lic_fact']);
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  <span id="label_compte"></span>
                </h5>


                <div class="card-tools">
                  <span id="label_debit" class="badge badge-dark"></span>
                  <span id="label_credit" class="badge badge-dark"></span>
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="file_data_2" cellspacing="0" width="100%" class="table table-bordered table-striped table-dark table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th style="">Date</th>
                      <th style="">Naration</th>
                      <th style="">Debit</th>
                      <th style="">Credit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // $maClasse-> afficherStatutDossierFacture(844, $_GET['id_mod_lic_fact']);
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
      $('#file_data').DataTable({
         lengthMenu: [
            [10, 100, 500, -1],
            [10, 100, 500, 'All'],
        ],
        dom: 'Bfrtip',
        buttons: [
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
              "operation": "afficherAllCompteAjax"
          }
        },
        "columns":[
          {"data":"compteur"},
          {"data":"nom_compte"},
          {"data":"nom_class"},
          {"data":"solde_debit"},
          {"data":"solde_credit"},
          {"data":"btn_action"}
        ] 
      });

      function afficherEcritureCompte(id_compte, nom_compte, label_debit, label_credit){
        
        $('#spinner-div').show();

         var today   = new Date();
        document.title = nom_compte + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();

        $('#label_compte').html(nom_compte);
        $('#label_debit').html('Debit: '+label_debit);
        $('#label_credit').html('Credit: '+label_credit);

        if ( $.fn.dataTable.isDataTable( '#file_data_2' ) ) {
            table = $('#file_data_2').DataTable();
        }
        else {
            table = $('#file_data_2').DataTable( {
                paging: false
            } );
        }

        table.destroy();

        $('#file_data_2').DataTable({
           lengthMenu: [
              [500, -1],
              [500, 1000, 'All'],
          ],
          dom: 'Bfrtip',
          buttons: [
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
                "id_compte": id_compte,
                "operation": "afficherEcritureCompte"
            }
          },
          "columns":[
            {"data":"compteur"},
            {"data":"date_e"},
            {"data":"libelle_e"},
            {"data":"debit"},
            {"data":"credit"}
          ] 
        });
        $('#spinner-div').hide();//Request is complete so hide spinner
      }

      // function afficherEcritureCompte(id_compte){
      //   $('#file_data_2').html('');
      //   $('#spinner-div').show();
      //   $.ajax({
      //     type: 'post',
      //     url: 'ajax.php',
      //     data: {id_compte: id_compte, operation: 'afficherEcritureCompte'},
      //     dataType: 'json',
      //     success:function(data){
      //       if (data.logout) {
      //         alert(data.logout);
      //         window.location="../deconnexion.php";
      //       }else{

      //         $('#file_data_2').DataTable({
      //            lengthMenu: [
      //               [10, 100, 500, -1],
      //               [10, 100, 500, 'All'],
      //           ],
      //           dom: 'Bfrtip',
      //           buttons: [
      //               'excel',
      //               'pageLength'
      //           ],
                
      //         "paging": true,
      //         "lengthChange": true,
      //         "searching": true,
      //         "ordering": true,
      //         "info": true,
      //         "autoWidth": true,
      //         "responsive": true,
      //           "ajax":{
      //             "type": "GET",
      //             "url":"ajax.php",
      //             "method":"post",
      //             "dataSrc":{
      //                 "id_cli": "844"
      //             },
      //             "data": {
      //                 "id_cli": "844",
      //                 "id_mod_lic": "2",
      //                 "operation": "statutDossier"
      //             }
      //           },
      //           "columns":[
      //             {"data":"compteur"},
      //             {"data":"libelle_e"},
      //             {"data":"debit"},
      //             {"data":"credit"}
      //           ] 
      //         });
      //       }
      //     },
      //     complete: function () {
      //         $('#spinner-div').hide();//Request is complete so hide spinner
      //     }
      //   });

      // }
    </script>