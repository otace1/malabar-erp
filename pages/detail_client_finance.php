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
                  <?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?> Statement
                </h3>
              </div>
              <!-- /.card-header -->
                  <div class="card card">
                    <!-- /.card-header -->
                    
                    <div class="card  card-body table-responsive p-0">
                      <table id="detail_client_finance" cellspacing="0" width="100%" class="table table-dark table-bordered table-striped  table-sm text-nowrap small">
                        <thead>
                          <tr>
                            <th style="" width="5px">#</th>
                            <th style="">Invoice Ref.</th>
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
            <!-- /.card -->
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>
  <?php
  include('pied.php');
  ?>

  <div class="modal fade " id="modal_paiement_facture">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><img src="../images/terminal-de-point-de-vente.png" width="30px"> Payments <span class="badge badge-dark" id="label_ref_fact"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="form_paiement_facture" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
            <input type="hidden" name="operation" value="paiement_facture">
            <input type="hidden" name="ref_fact" id="ref_fact">
            <div class="row">
              <div class="col-md-6">
                <label for="x_card_code" class="control-label mb-1">Date</label>
                <input type="date" name="date_paie" class="form-control form-control-sm cc-exp" required>
              </div>
              <div class="col-md-6">
                <label for="x_card_code" class="control-label mb-1">Reference</label>
                <input type="text" name="ref_paie" class="form-control form-control-sm cc-exp" required>
              </div>
              <div class="col-md-6">
                <label for="x_card_code" class="control-label mb-1">Account</label>
                <select name="id_tres" class="form-control form-control-sm cc-exp" required>
                  <option></option>
                  <?php
                    $maClasse-> selectionnerTresorerie();
                  ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="x_card_code" class="control-label mb-1">Amount</label>
                <input type="number" step="0.01" name="montant_paie" class="form-control form-control-sm cc-exp" required>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" name="" class="btn btn-xs btn-primary">Submit</button>
            </div>

          </form>

          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-striped table-dark  table-sm text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Ref.</th>
                    <th>Account</th>
                    <th>Amount</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="detail_paiement_facture"></tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">

   var today   = new Date();
  document.title = '<?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?>_statement_' + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();

  $('#detail_client_finance').DataTable({
     lengthMenu: [
        [10, 20, 50, 100, 500, -1],
        [10, 20, 50, 100, 500, 1000, 'All'],
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
            "operation": "detail_client_finance",
            "id_cli": "<?php echo $_GET['id_cli'];?>"
        }
      },
      "columns":[
        {"data":"compteur"},
        {"data":"ref_fact"},
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
        }
        ,
        {"data":"btn_action",
          className: 'dt-body-center'
        }
      ] 
    });

  function modal_paiement_facture(ref_fact) {
    $('#spinner-div').show();
    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {ref_fact: ref_fact, operation: "modal_paiement_facture"},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_ref_fact').html(ref_fact);
          $('#ref_fact').val(ref_fact);
          $('#detail_paiement_facture').html(data.detail_paiement_facture);
          $('#modal_paiement_facture').modal('show');
        }
      },
      complete: function () {
          // loadPV();
          $('#spinner-div').hide();//Request is complete so hide spinner
      }

    });
  }


  $(document).ready(function(){

      $('#form_paiement_facture').submit(function(e){

              e.preventDefault();

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
              }else{
                $( '#form_paiement_facture' ).each(function(){
                    this.reset();
                });
                $('#detail_paiement_facture').html(data.detail_paiement_facture);
                $('#detail_client_finance').DataTable().ajax.reload();
                // $('#modal_paiement_facture').modal('hide');
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }else{
          $('#spinner-div').hide();//Request is complete so hide spinner
          alert('Error !! Please enter the rate of exchange of this file.');
          $('#roe_decl').addClass("bg bg-danger");
        }


      });
    
  });
  </script>