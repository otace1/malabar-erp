<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

   if( isset($_POST['creerFactureDossier']) ){
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>';
    </script>
    <?php
  }


?>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5>
            <i class="fa fa-calculator nav-icon"></i> NEW INVOICE
          </h5>
        </div>

      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                
<!-- <form id="enregistrerFactureExportSingle_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="enregistrerFactureExportSingle_form" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="enregistrerFactureExportSingle">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" value="<?php echo $_GET['id_mod_lic_fact'];?>">
      <input type="hidden" name="id_march" value="<?php echo $_GET['id_march'];?>">
      <input type="hidden" name="id_mod_fact" value="<?php echo $_GET['id_mod_fact'];?>">
      <input type="hidden" name="id_mod_trans" value="<?php echo $_GET['id_mod_trans'];?>">
      <div class="col-md-4">
        <label for="ref_fact" class="col-sm-4 col-form-label">Invoice Ref.: </label>
        <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>">
      </div>

      <div class="col-md-4">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Files Ref.:</label>
        <select class="form-control form-control-sm" name="id_dos" id="id_dos" onchange="getTableauExportInvoiceSingle(id_mod_fact.value, this.value, id_mod_lic.value, id_march.value, id_mod_trans.value)" required>
          <option></option>
          <?php
            $maClasse-> selectionnerDossierClientModeleLicenceMarchandise($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans'], $_GET['num_lic']);
          ?>
        </select>
      </div>

      <div class="col-12"><hr></div>
      <div class="col-md-2">
        <label for="roe_decl">Rate</label>
        <input id="roe_decl" name="roe_decl" type="number" step="0.0001" min="1" class="form-control form-control-sm" required>
      </div>
      <div class="col-md-2">
        <label for="num_lot">Lot Num.</label>
        <input id="num_lot" name="num_lot" type="text" class="form-control form-control-sm" disabled>
      </div>
      <div class="col-md-2">
        <label for="poids">Qty(Mt)</label>
        <input id="poids" name="poids" type="number" class="form-control form-control-sm" disabled>
      </div>
      <div class="col-md-2">
        <label for="destination">Destination</label>
        <input id="destination" name="destination" type="text" class="form-control form-control-sm" disabled>
      </div>
      <div class="col-md-4">
        <label for="truck">Truck/Wagon</label>
        <input id="truck" name="truck" type="text" class="form-control form-control-sm" disabled>
      </div>
      <div class="col-md-10 table-responsive">
        <label for="x_card_code" class="control-label mb-1"><u>Items</u></label>
        <table class="table table-bordered table-responsive table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed">
          <thead>
              <tr>
                  <th colspan="2">ITEMS</th>
                  <th>Qty</th>
                  <th>AMOUNT</th>
                  <th>CURRENCY</th>
                  <th>TVA</th>
              </tr>
          </thead>
          <tbody id="debours">
            <?php
              // $maClasse-> getDeboursPourFactureClientModeleLicence($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans']);
            ?>
          </tbody>
        </table>
      </div>

    </div>

    </div>  


<!-- -------VALIDATION FORMULAIRE------- -->

  <div class="modal-footer justify-content-between">
    <!-- <span  data-toggle="modal" data-target=".validerCotation"class="btn btn-xs btn-primary" onclick="enregistrerFactureExportSingle(roe_decl.value, id_dos.value, ref_fact.value, id_deb_1.value, montant_1.value, usd_1.value, tva_1.value);">Submit</span> -->
    <button type="submit" class="btn btn-xs btn-primary">Submit</button>
  </div>


<!-- -------FIN VALIDATION FORMULAIRE------- -->

</form>

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
  <?php include("pied.php");?>

<script type="text/javascript">

  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  function getTableauExportInvoiceSingle(id_mod_fact, id_dos, id_mod_lic, id_march, id_mod_trans){
    if ($('#id_dos').val()===null || $('#id_dos').val()==='' ) {

      alert('Error !! Please select the file.');

    }else{
      $('#spinner-div').show();
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: { id_mod_fact: id_mod_fact, id_dos: id_dos, id_mod_lic: id_mod_lic, id_march:id_march, id_mod_trans:id_mod_trans, operation: 'getTableauExportInvoiceSingle'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            // alert('Hello');
            $('#roe_decl').val(data.roe_decl);
            $('#num_lot').val(data.num_lot);
            $('#destination').val(data.destination);
            $('#truck').val(data.truck);
            $('#poids').val(Math.round((data.poids*1000))/1000);
            $('#debours').html(data.debours);

            // $('#trailer_1').val(data.trailer_1);
            // $('#trailer_2').val(data.trailer_2);


            // $('#poids').val(Math.round((data.poids*1000))/1000);
            // //Items ------------
            // $('#unite_1').val(Math.round((data.poids*1000))/1000);
            // $('#unite_2').val(Math.round((data.poids*1000))/1000);
            // $('#unite_3').val(Math.round((data.poids*1000))/1000);
            // $('#unite_4').val(Math.round((data.poids*1000))/1000);
            // $('#unite_5').val(Math.round((data.poids*1000))/1000);
            // $('#montant_5').val(Math.round((data.poids*3*1000))/1000);
            // $('#unite_6').val(Math.round((data.poids*1000))/1000);
            // $('#montant_6').val(Math.round((data.poids*8*1000))/1000);
            // $('#unite_7').val(Math.round((data.poids*1000))/1000);
            // $('#montant_7').val(Math.round((data.poids*50*1000))/1000);
            // $('#unite_8').val(Math.round((data.poids*1000))/1000);
            // $('#montant_8').val(Math.round((data.poids*100*1000))/1000);
            // $('#unite_9').val(1);
            // $('#montant_9').val(250);
            // $('#unite_10').val(1);
            // $('#montant_10').val(80);

            // if (data.poids<30) {
            //   $('#unite_11').val(1);
            //   $('#montant_11').val(125);
            // }else{
            //   $('#unite_11').val(0);
            //   $('#montant_11').val(0);
            // }
            
            // if (data.poids>=30) {
            //   $('#unite_12').val(1);
            //   $('#montant_12').val(250);
            // }else{
            //   $('#unite_12').val(0);
            //   $('#montant_12').val(0);
            // }
            
            // $('#unite_13').val(1);
            // $('#montant_13').val(40);

            // $('#unite_14').val(1);
            // $('#montant_14').val(15);

            // $('#unite_15').val(1);
            // $('#montant_15').val(110);

            // $('#unite_16').val(1);
            // $('#montant_16').val(75);

            // $('#unite_17').val(1);
            // $('#montant_17').val(35);

            // $('#unite_18').val(1);
            // $('#montant_18').val(20);

            // $('#unite_19').val(1);
            // $('#montant_19').val(75);

            // $('#unite_20').val(1);
            // $('#montant_20').val(200);

            // $('#unite_21').val(1);
            // $('#montant_21').val(150);

            // $('#msg_modalite_fss').html(data.msg_modalite_fss);
            // $("#updateModaliteFss").modal("hide");
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }

  }

  function enregistrerFactureExportSingle(roe_decl, id_dos, ref_fact, id_deb_1, montant_1, usd_1, tva_1){

    // var ref_po = $('#ref_po').val();

    $('#spinner-div').show();

    if(confirm('Do really you want to submit ?')) {

      if ($('#id_dos').val()===null || $('#id_dos').val()==='' ) {

        $('#spinner-div').hide();//Request is complete so hide spinner
        alert('Error !! Please select the file.');

      }else if (roe_decl > 1) {

        $.ajax({
          type: "POST",
          url: "ajax.php",
          data: { roe_decl: roe_decl, id_deb_1: id_deb_1, montant_1: montant_1, usd_1: usd_1, tva_1: tva_1, operation: 'enregistrerFactureExportSingle'},
          dataType:"json",
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              // $('#tableau_modalite_fss').html(data.tableau_modalite_fss);
              // $('#msg_modalite_fss').html(data.msg_modalite_fss);
              // $("#updateModaliteFss").modal("hide");
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

    }
        $('#spinner-div').hide();//Request is complete so hide spinner

  }

  $(document).ready(function(){

      $('#enregistrerFactureExportSingle_form').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

          if ($('#id_dos').val()===null || $('#id_dos').val()==='' ) {

            alert('Error !! Please select the file.');

          }else if ($('#roe_decl').val() > 1) {
            // alert('Hello');

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
                  $( '#enregistrerFactureExportSingle_form' ).each(function(){
                      this.reset();
                  });
                  $('#ref_fact').val(data.ref_fact);
                  $('#id_dos').html(data.ref_dos);
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
                  // window.open('viewExportInvoiceSingle2022.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  window.open('viewExportInvoiceMultiple2022.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
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

        }

      });
    
  });


  function getTotal(){

  }
</script>
