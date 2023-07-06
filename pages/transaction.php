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
          <h5><img src="../images/dollar.png" width="30px"> Transactions</h5>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">

        <div class="row">
          <div class="col-md-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-file_data_ecriture_comptable table-responsive p-0">
                <table id="file_data_ecriture_comptable" cellspacing="0" width="100%" class="table hover display compact table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style=""></th>
                      <th style="">ID</th>
                      <th style="">Naration</th>
                      <th style="">Date</th>
                      <th style="">Voucher Type</th>
                      <th style="">Doc.Support Ref.</th>
                      <th style="">Register</th>
                      <th style="">Amount</th>
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
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<div class="modal fade creerEcritureComptable_1" id="modal_creerEcritureComptable_1">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="" id="creerEcriture_1_form">
    <input type="hidden" name="operation" value="creerEcriture_1">
    <input type="hidden" name="id_taux" value="<?php echo $maClasse-> getLastTaux()['id_taux'];?>">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Accounting Voucher Creation | Single Entry</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Type</label>
            <select name="id_t_e" id="id_t_e" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerTypeEcriture();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Doc.Support Ref.</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="reference" name="reference" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date</label>
            <input class="form-control cc-exp form-control-sm" value="<?php echo date('Y-m-d');?>" type="date" id="date_e" name="date_e" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Journal</label>
            <select name="id_jour" id="id_jour" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerJournal();
                ?>
            </select>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-9">
            <label for="x_card_code" class="control-label mb-1">Account</label>
            <div class="input-group mb-3  input-group-sm">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-sm btn-info" onclick="liste_compte(0);"><i class="fa fa-list"></i></button>
              </div>
            <!-- /btn-group -->
              <input type="text" id="nom_compte_0" class="form-control text-dark form-control-sm" disabled>
              <span class="input-group-append">
                <button type="button" class="btn btn-default text-danger btn-flat" onclick="remove_compte(0);">
                  <span class="fa fa-times"></span>
                </button>
              </span>
            </div>
            <input type="hidden" id="id_compte_0" name="id_compte_0">
            <span class="small" id="solde_compte_0"></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Mvt</label>
            <select name="mvt" id="mvt" class="form-control cc-exp form-control-sm" required>
              <option></option>
              <option value="debit">Debit</option>
              <option value="credit">Credit</option>
            </select>
          </div>

          <div class="col-md-12">
            <hr>
          </div>
          
          <div class="col-md-12 table-responsive" style="height: 300px;">
            <table class="small table table-head-fixed table-foot-fixed table-bordered table-hover text-nowrap table-sm">
              <thead>
                <tr class="">
                  <th style="" width="5%">#</th>
                  <th style="">Particular</th>
                  <th style=" text-align: center;" width="20%">Amount</th>
                </tr>
              </thead>
              <tbody id="">
                <?php
                for ($i=1; $i <=10 ; $i++) { 
                  ?>
                  <tr>
                    <td style="text-align: center;">
                      <?php echo $i;?>
                    </td>
                    <td>
                      <div class="input-group mb-3  input-group-sm">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-sm btn-info" onclick="liste_compte(<?php echo $i;?>);"><i class="fa fa-list"></i></button>
                        </div>
                      <!-- /btn-group -->
                        <input type="text" id="nom_compte_<?php echo $i;?>" class="form-control text-dark form-control-sm" disabled>
                        <span class="input-group-append">
                          <button type="button" class="btn btn-default text-danger btn-flat" onclick="remove_compte(<?php echo $i;?>);">
                            <span class="fa fa-times"></span>
                          </button>
                        </span>
                      </div>
                      <input type="hidden" id="id_compte_<?php echo $i;?>" name="id_compte_<?php echo $i;?>">
                      <span class="small" id="solde_compte_<?php echo $i;?>"></span>
                    </td>
                    <td>
                      <input class="form-control cc-exp form-control-sm text-center" type="number" onblur="getTotal1();" id="montant_<?php echo $i;?>" name="montant_<?php echo $i;?>">
                    </td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
              <tfoot>
                
                <input type="hidden" name="nbre" value="<?php echo $i;?>">
                  <tr>
                    <td style="text-align: right;" colspan="2">
                      TOTAL
                    </td>
                    <td>
                      <input class="form-control cc-exp form-control-sm text-danger text-dark text-weight text-center" type="number" disabled id="total_1" name="total_1">
                    </td>
                  </tr>
              </tfoot>
            </table>
          </div>
          <div class="col-6 small">
            <label for="x_card_code" class="control-label mb-1">Naration</label>
            <textarea class="form-control form-control-sm" name="libelle_e" required></textarea>
          </div>
          <div class="col-6 text-right">
            <span>Total <span class="text-md badge badge-dark" id="total_debit_1"></span></span>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button> -->
        <button type="submit" name="" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade creerEcritureComptable" id="modal_creerEcritureComptable">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="" id="creerEcriture_form">
    <input type="hidden" name="operation" value="creerEcriture">
    <input type="hidden" name="id_taux" value="<?php echo $maClasse-> getLastTaux()['id_taux'];?>">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Accounting Voucher Creation | Double Entry</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Type</label>
            <select name="id_t_e" id="id_t_e" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerTypeEcriture();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Doc.Support Ref.</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="reference" name="reference" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date</label>
            <input class="form-control cc-exp form-control-sm" value="<?php echo date('Y-m-d');?>" type="date" id="date_e" name="date_e" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Journal</label>
            <select name="id_jour" id="id_jour" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerJournal();
                ?>
            </select>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12 table-responsive" style="height: 300px;">
            <table class="small table table-head-fixed table-foot-fixed table-bordered table-hover text-nowrap table-sm">
              <thead>
                <tr class="">
                  <th style="" width="5%">#</th>
                  <th style="">Particular</th>
                  <th style=" text-align: center;" width="20%">Debit</th>
                  <th style=" text-align: center;" width="20%">Credit</th>
                </tr>
              </thead>
              <tbody id="">
                <?php
                for ($i=1; $i <=10 ; $i++) { 
                  ?>
                  <tr>
                    <td style="text-align: center;">
                      <?php echo $i;?>
                    </td>
                    <td>
                      <div class="input-group mb-3  input-group-sm">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-sm btn-info" onclick="liste_compte(<?php echo $i;?>);"><i class="fa fa-list"></i></button>
                        </div>
                      <!-- /btn-group -->
                        <input type="text" id="nom_compte_<?php echo $i;?>" class="form-control text-dark form-control-sm" disabled>
                        <span class="input-group-append">
                          <button type="button" class="btn btn-default text-danger btn-flat" onclick="remove_compte(<?php echo $i;?>);">
                            <span class="fa fa-times"></span>
                          </button>
                        </span>
                      </div>
                      <input type="hidden" id="id_compte_<?php echo $i;?>" name="id_compte_<?php echo $i;?>">
                      <span class="small" id="solde_compte_<?php echo $i;?>"></span>
                    </td>
                    <td>
                      <input class="form-control cc-exp form-control-sm text-center" type="number" onblur="getTotal();" id="montant_debit_<?php echo $i;?>" name="montant_debit_<?php echo $i;?>">
                    </td>
                    <td>
                      <input class="form-control cc-exp form-control-sm text-center" type="number" onblur="getTotal();" id="montant_credit_<?php echo $i;?>" name="montant_credit_<?php echo $i;?>">
                    </td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
              <tfoot>
                
                <input type="hidden" name="nbre" value="<?php echo $i;?>">
                  <tr>
                    <td style="text-align: right;" colspan="2">
                      TOTAL
                    </td>
                    <td>
                      <input class="form-control cc-exp form-control-sm text-danger text-dark text-weight text-center" type="number" disabled id="total_debit" name="total_debit">
                    </td>
                    <td>
                      <input class="form-control cc-exp form-control-sm text-danger text-dark text-weight text-center" type="number" disabled id="total_credit" name="total_credit">
                    </td>
                  </tr>
              </tfoot>
            </table>
          </div>
          <div class="col-6 small">
            <label for="x_card_code" class="control-label mb-1">Naration</label>
            <textarea class="form-control form-control-sm" name="libelle_e" required></textarea>
          </div>
          <div class="col-6 text-right">
            <span>Total Debit <span class="text-md badge badge-dark" id="total_debit_2"></span></span><br>
            <span>Total Credit <span class="text-md badge badge-dark" id="total_credit_2"></span></span>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button> -->
        <button type="submit" name="" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade actePV" id="modal_compte">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" id="form_actePV" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="operation" value="actePV">
      <input type="hidden" id="id_pv_acte" name="id_pv_acte">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><img src="../images/presse-papiers.png" width="30px"> Account </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <input type="hidden" id="compteur_compte">
      <div class="modal-body">
          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Search</label>
            <input class="form-control cc-exp bg-dark form-control-sm" type="text" id="nom_compte_search" onkeyup="nom_compte_search(this.value, compteur_compte.value);">
          </div>

        <div class="row">
          <div class="col-md-12 table-responsive" style="height: 300px;">
            <table class="small table table-hover table-bordered table-head-fixed text-nowrap table-sm">
              <thead class="">
                <tr class="">
                  <th width="5%">#</th>
                  <th style="">Name</th>
                  <th style="">Balance</th>
                </tr>
              </thead>
              <tbody id="liste_compte">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade creerEcritureComptable" id="modal_detail_ecriture">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Accounting Voucher Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Type</label>
            <input id="nom_t_e_det" class="form-control cc-exp form-control-sm" disabled>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Doc.Ref.</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="reference_det" disabled>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_e_det" disabled>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Journal</label>
            <input id="nom_jour_det" class="form-control cc-exp form-control-sm" disabled>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12 table-responsive" style="">
            <table id="detail_ecriture" cellspacing="0" width="100%" class="small table hover display compact table-bordered table-striped table-sm text-nowrap">
              <thead>
                <tr>
                  <th style="" width="5%">#</th>
                  <th style="">Particular</th>
                  <th style=" text-align: center;" width="20%">Debit</th>
                  <th style=" text-align: center;" width="20%">Credit</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2" style="text-align: right;">Total</td>
                  <td style="text-align: right;"></td>
                  <td style="text-align: right;"></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="col-6 small">
            <label for="x_card_code" class="control-label mb-1">Naration</label>
            <textarea class="form-control form-control-sm" id="libelle_e_det" disabled></textarea>
          </div>
          <div class="col-6 text-right">
            <span>Total Debit <span class="text-md badge badge-dark" id="total_debit_2"></span></span><br>
            <span>Total Credit <span class="text-md badge badge-dark" id="total_credit_2"></span></span>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Close</button>
        <!-- <button type="submit" name="" class="btn-xs btn-primary">Submit</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  function getEcriture(id_e){

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getEcriture', id_e: id_e},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#nom_t_e_det').val(data.nom_t_e);
          $('#reference_det').val(data.reference);
          $('#date_e_det').val(data.date_e);
          $('#nom_jour_det').val(data.nom_jour);
          $('#libelle_e_det').val(data.libelle_e);
        }
      }
    });

  }

  function detail_ecriture(id_e){
    
    $('#spinner-div').show();

    getEcriture(id_e)

     var today   = new Date();
    document.title = id_e + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();

    $('#label_compte').html(id_e);
    if ( $.fn.dataTable.isDataTable( '#detail_ecriture' ) ) {
        table = $('#detail_ecriture').DataTable();
    }
    else {
        table = $('#detail_ecriture').DataTable( {
            paging: false
        } );
    }

    table.destroy();

    $('#detail_ecriture').DataTable({
       lengthMenu: [
          [500, -1],
          [500, 1000, 'All'],
      ],
      dom: 'Bfrtip',
      buttons: [
          'excel'
      ],
      footerCallback: function (row, data, start, end, display) {
        var api = this.api();
 
        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        };
 
        // Total over all pages
        total = api
            .column(2)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Total over this page
        pageTotal = api
            .column(2, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Update footer
        // $(api.column(2).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
            $(api.column(2).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));
        total = api
            .column(3)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Total over this page
        pageTotal = api
            .column(3, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
 
        // Update footer
            $(api.column(3).footer()).html(DataTable.render.number( null, null, 2, null ).display(pageTotal));
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
            "id_e": id_e,
            "operation": "detail_ecriture_comptable"
        }
      },
      "columns":[
        {"data":"compteur"},
        {"data":"nom_compte"},
        {"data":"debit",
          render: DataTable.render.number( null, null, 2, null ),
          className: 'dt-body-right'
        },
        {"data":"credit",
          render: DataTable.render.number( null, null, 2, null ),
          className: 'dt-body-right'
        }
      ] 
    });
    $('#spinner-div').hide();//Request is complete so hide spinner

    $('#modal_detail_ecriture').modal('show');
    
  }
  $(document).ready(function(){

      $('#creerEcriture_form').submit(function(e){

        e.preventDefault();
        
        getTotal();

        if ($('#total_debit').val()!=$('#total_credit').val()) {
          alert('Error!! Operation is not well balanced.');
        }else{
          
          if(confirm('Do really you want to submit ?')) {

            var fd = new FormData(this);
            $('#spinner-div').show();

            $.ajax({
              type: 'post',
              url: 'ajax.php',
              processData: false,
              contentType: false,
              data: fd,
              dataType: 'json',
              success:function(data){
                if (data.logout) {
                  alert(data.logout);
                  window.location="../deconnexion.php";
                }else if(data.message){
                  $( '#creerEcriture_form' ).each(function(){
                      this.reset();
                  });
                  $('#file_data_ecriture_comptable').DataTable().ajax.reload();
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  // alert(data.message);
                }
              },
              complete: function () {
                  $('#spinner-div').hide();//Request is complete so hide spinner
              }
            });

          }

        }

      });
    
  });

  function nom_compte_search(nom_compte, compteur_compte){

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'nom_compte_search', nom_compte: nom_compte, compteur_compte: compteur_compte},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte').html(data.liste_compte_journal);
        }
      }
    });

  }


  $(document).ready(function(){
    getTotal();
  });

  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  function getTotal(){
    total_debit = 0;
    total_credit = 0;
    for (var i = 1; i <= 5; i++) {
       
      if (parseFloat($('#montant_debit_'+i).val()) > 0 ) {
        total_debit += parseFloat($('#montant_debit_'+i).val());
      }
      if (parseFloat($('#montant_credit_'+i).val()) > 0 ) {
        total_credit += parseFloat($('#montant_credit_'+i).val());
      }

    }
    // console.log(total);
    $('#total_debit').val(total_debit);
    $('#total_credit').val(total_credit);
    $('#total_debit_2').html(new Intl.NumberFormat('en-DE').format(Math.round(total_debit*1000)/1000));
    $('#total_credit_2').html(new Intl.NumberFormat('en-DE').format(Math.round(total_credit*1000)/1000));
    // $('#total_debit_2').html(total_debit);
    // $('#total_credit_2').html(total_credit);
  }

  function getTotal1(){
    total_1 = 0;
    for (var i = 1; i <= 5; i++) {
       
      if (parseFloat($('#montant_'+i).val()) > 0 ) {
        total_1 += parseFloat($('#montant_'+i).val());
      }

    }
    // console.log(total);
    $('#total_1').val(total_1);
    $('#total_debit_1').html(new Intl.NumberFormat('en-DE').format(Math.round(total_1*1000)/1000));
    // $('#total_debit_2').html(total_debit);
    // $('#total_credit_2').html(total_credit);
  }

  function remove_compte(compteur_compte){
    
    $('#nom_compte_'+compteur_compte).val('');
    // document.getElementById('nom_compte').classList.remove("is-invalid");
    // document.getElementById('nom_compte').classList.remove("text-danger");
    $('#id_compte_'+compteur_compte).val('');
    $('#solde_compte_'+compteur_compte).html('');


  }

  function select_compte(id_compte, nom_compte, solde_compte, compteur_compte){
    
    $('#modal_compte').modal('hide');
    $('#spinner-div').show();
    $('#liste_compte').html('');
    $('#nom_compte_'+compteur_compte).val(nom_compte);
    $('#solde_compte_'+compteur_compte).html('Current Bal.: '+(new Intl.NumberFormat('en-DE').format(Math.round(solde_compte*1000)/1000)));
    // document.getElementById('nom_compte').classList.remove("is-invalid");
    // document.getElementById('nom_compte').classList.remove("text-danger");
    $('#id_compte_'+compteur_compte).val(id_compte);


    $('#spinner-div').hide();

  }

  function liste_compte(compteur_compte, id_jour){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'liste_compte', compteur_compte: compteur_compte, id_jour: id_jour},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte').html(data.liste_compte);
          $('#nom_compte_search').val('');
          $('#modal_compte').modal('show');
          $('#compteur_compte').val(compteur_compte);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $('#file_data_ecriture_comptable').DataTable({
     lengthMenu: [
        [10, 100, 500, -1],
        ['10 Rows', '100 Rows', '500 Rows', 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
      {
            extend: 'collection',
            text: '<i class="fa fa-plus"></i> Accounting Voucher Creation',
            buttons: [
                {
                  text: '<i class="fa fa-window-maximize"></i> Single Entry',
                  className: 'btn btn-info bt',
                  action: function ( e, dt, node, config ) {
                      $( '#creerEcriture_1_form' ).each(function(){
                        this.reset();
                      });
                      $('#modal_creerEcritureComptable_1').modal('show');
                  }
                },
                {
                  text: '<i class="fa fa-columns"></i> Double Entry',
                  className: 'btn btn-info bt',
                  action: function ( e, dt, node, config ) {
                      $( '#creerEcriture_form' ).each(function(){
                        this.reset();
                      });
                      $('#modal_creerEcritureComptable').modal('show');
                  }
                }
            ]
        },
        ,
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel"></i> Extract In Excel',
          className: 'btn btn-success'
        },
        {
          extend: 'pageLength',
          text: '<i class="fa fa-list"></i> Showing',
          className: 'btn btn-dark'
        }
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
          "id_cli": ""
      },
      "data": {
          "operation": "ecriture_comptable"
      }
    },
    order: [
        [3, 'asc']
    ],
    rowGroup: {
        dataSrc: 2,

    },
    "columns":[
      {"data":"btn_action"},
      {"data":"id_e"},
      {"data":"libelle_e"},
      {"data":"date_e_2"},
      {"data":"nom_t_e"},
      {"data":"reference"},
      {"data":"nom_jour"},
      {"data":"debit",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      }
    ] 
  });

  $(document).ready(function(){

    $('#creerEcriture_1_form').submit(function(e){

      e.preventDefault();

       if(confirm('Do you really want to submit ?')) {
          
          $('#spinner-div').show();
          $('#modal_creerEcritureComptable_1').modal('hide');

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
                
                $( 'form' ).each(function(){
                    this.reset();
                });

                $('#file_data_ecriture_comptable').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
              }
            },
            complete: function () {
                loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });


</script>