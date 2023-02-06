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
      <div class="col-md-3">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Invoice Ref.: </label>
            <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>">
          </div>

      </div>

      <div class="col-md-3">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Files Ref.:</label>
            <select class="form-control form-control-sm" name="id_dos" id="id_dos" onchange="getTableauImportInvoiceSingle(id_mod_fact.value, this.value, id_mod_lic.value, id_march.value, id_mod_trans.value)" required>
              <option></option>
              <?php
                $maClasse-> selectionnerDossierClientModeleLicenceMarchandise($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans']);
              ?>
            </select>
          </div>

      </div>

      <div class="col-md-12"></div>
      <div class="col-md-4 table-responsive">
        <label for="x_card_code" class="control-label mb-1"><u>File Data</u></label>
        <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <tbody>
            <tr>
              <th>Rate</th>
              <th><input style="text-align: center;" id="roe_decl" name="roe_decl" onblur="maj_roe_decl(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1" required></th>
            </tr>
            <tr>
              <th>Total of Duty (CDF)</th>
              <th><input style="text-align: center;" id="montant_liq" onblur="maj_montant_liq(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1" class="" required></th>
            </tr>
            <tr>
              <th>FOB (USD)</th>
              <th><input style="text-align: center;" id="fob_usd" name="fob_usd" onblur="maj_fob_usd(id_dos.value, this.value);calculCIF();calculCIF();" type="number" step="0.000001" min="1" class="" required></th>
            </tr>
            <tr>
              <th>Fret (USD)</th>
              <th><input style="text-align: center;" id="fret_usd" name="fret_usd" onblur="maj_fret_usd(id_dos.value, this.value);calculCIF();" class="" required></th>
            </tr>
            <tr>
              <th>Autres Charges (USD)</th>
              <th><input style="text-align: center;" id="autre_frais_usd" name="autre_frais_usd" onblur="maj_autre_frais_usd(id_dos.value, this.value);calculCIF();" class="" required></th>
            </tr>
            <tr>
              <th>Assurance (USD)</th>
              <th><input style="text-align: center;" id="assurance_usd" name="assurance_usd" onblur="maj_assurance_usd(id_dos.value, this.value);calculCIF();" class="" required></th>
            </tr>
            <tr>
              <th>CIF (USD)</th>
              <th><input style="text-align: center; font-weight: bold;" id="cif_usd" class="bg bg-primary" disabled></th>
            </tr>
            <tr>
              <th>CIF (CDF)</th>
              <th><input style="text-align: center; font-weight: bold;" id="cif_cdf" onblur="maj_montant_liq(id_dos.value, this.value);" class="bg bg-primary" disabled></th>
            </tr>
            <tr>
              <th>Poids (kg)</th>
              <th><input style="text-align: center;" id="poids" name="poids" class="" required></th>
            </tr>
            <tr>
              <th>Tariff Code Client:</th>
              <th><input style="text-align: center;" id="code_tarif" name="code_tarif" type="text" class="" required></th>
            </tr>
            <tr>
              <th>Horse</th>
              <th><input style="text-align: center;" id="horse" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Trailer 1</th>
              <th><input style="text-align: center;" id="trailer_1" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Trailer 2</th>
              <th><input style="text-align: center;" id="trailer_2" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Facture/PFI No.:</th>
              <th><input style="text-align: center;" id="ref_fact_dos" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>BIVAC inspection:</th>
              <th><input style="text-align: center;" id="cod" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Produit</th>
              <th><input style="text-align: center;" id="commodity" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Exoneration/Code:</th>
              <th><input style="text-align: center;" id="num_exo" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Declaration No.</th>
              <th><input style="text-align: center;" id="ref_decl" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Declaration Date</th>
              <th><input style="text-align: center;" id="date_decl" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Liquidation No.</th>
              <th><input style="text-align: center;" id="ref_liq" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Liquidation Date</th>
              <th><input style="text-align: center;" id="date_liq" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Quittance No.</th>
              <th><input style="text-align: center;" id="ref_quit" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Quittance Date</th>
              <th><input style="text-align: center;" id="date_quit" disabled class="bg bg-dark"></th>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-8 table-responsive">
        <label for="x_card_code" class="control-label mb-1"><u>Items</u></label>
        <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <thead>
              <tr>
                  <th colspan="2">ITEMS</th>
                  <th>UNIT</th>
                  <th>AMOUNT</th>
                  <th>CURRENCY</th>
                  <th>TVA</th>
              </tr>
          </thead>
          <tbody id="debours">
            <?php
              // $maClasse-> getDeboursPourFactureClientModeleLicence($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans']);
            ?>
            </div>
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

  function getTableauImportInvoiceSingle(id_mod_fact, id_dos, id_mod_lic, id_march, id_mod_trans){
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_mod_fact: id_mod_fact, id_dos: id_dos, id_mod_lic: id_mod_lic, id_march:id_march, id_mod_trans:id_mod_trans, operation: 'getTableauImportInvoiceSingle'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // alert('Hello');
          $('#roe_decl').val(data.roe_decl);
          $('#commodity').val(data.commodity);
          $('#horse').val(data.horse);
          $('#trailer_1').val(data.trailer_1);
          $('#trailer_2').val(data.trailer_2);
          $('#ref_fact_dos').val(data.ref_fact);
          $('#cod').val(data.cod);
          $('#num_exo').val(data.num_exo);
          $('#code_tarif').val(data.code_tarif);
          $('#ref_decl').val(data.ref_decl);
          $('#date_decl').val(data.date_decl_dos);
          $('#ref_liq').val(data.ref_liq);
          $('#date_liq').val(data.date_liq_dos);
          $('#ref_quit').val(data.ref_quit);
          $('#date_quit').val(data.date_quit_dos);
          $('#poids').val(Math.round((data.poids*1000))/1000);
          $('#fob_usd').val(Math.round((data.fob_usd*1000))/1000);
          $('#fret_usd').val(Math.round((data.fret_usd*1000))/1000);
          $('#assurance_usd').val(Math.round((data.assurance_usd*1000))/1000);
          $('#autre_frais_usd').val(Math.round((data.autre_frais_usd*1000))/1000);
          $('#cif_usd').val(Math.round((data.cif_usd*1000))/1000);
          $('#montant_liq').val(Math.round((data.montant_liq*1000))/1000);
          //Items ------------
          $('#debours').html(data.debours);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

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
                  window.open('viewExportInvoiceSingle2022.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  // window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
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


  function calculCIF(){

    if (parseFloat($('#fob_usd').val()) > 0 ) {
      fob_usd = parseFloat($('#fob_usd').val());
    }else{
      fob_usd=0;
    }

    if (parseFloat($('#fret_usd').val()) > 0 ) {
      fret_usd = parseFloat($('#fret_usd').val());
    }else{
      fret_usd=0;
    }

    if (parseFloat($('#assurance_usd').val()) > 0 ) {
      assurance_usd = parseFloat($('#assurance_usd').val());
    }else{
      assurance_usd=0;
    }

    if (parseFloat($('#autre_frais_usd').val()) > 0 ) {
      autre_frais_usd = parseFloat($('#autre_frais_usd').val());
    }else{
      autre_frais_usd=0;
    }

    if (parseFloat($('#roe_decl').val()) > 0 ) {
      roe_decl = parseFloat($('#roe_decl').val());
    }else{
      roe_decl=1;
    }

    cif_usd = fob_usd + fret_usd + assurance_usd + autre_frais_usd;

    cif_cdf = cif_usd*roe_decl+1;


    if (Math.round(cif*1000)/1000 > 0) {
      
      $('#cif_usd').val(new Intl.NumberFormat('en-DE').format(Math.round(cif_usd*1000)/1000));
      // $('#cif_usd').addClass("badge badge-danger");

    }else{
      
      $('#cif_usd').val('');
      $('#cif_usd').removeClass("badge badge-danger");

    }

    if (Math.round(cif_cdf*1000)/1000 > 0) {
      
      $('#cif_cdf').val(new Intl.NumberFormat('en-DE').format(Math.round(cif_cdf*1000)/1000));
      // $('#cif_cdf').addClass("badge badge-danger");

    }else{
      
      $('#cif_cdf').val('');
      $('#cif_cdf').removeClass("badge badge-danger");

    }

  }

  function maj_roe_decl(id_dos, roe_decl){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_decl: roe_decl, operation: 'maj_roe_decl'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_montant_liq(id_dos, montant_liq){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, montant_liq: montant_liq, operation: 'maj_montant_liq'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_fob_usd(id_dos, fob_usd){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, fob_usd: fob_usd, operation: 'maj_fob_usd'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_fret_usd(id_dos, fret_usd){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, fret_usd: fret_usd, operation: 'maj_fret_usd'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_assurance_usd(id_dos, assurance_usd){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, assurance_usd: assurance_usd, operation: 'maj_assurance_usd'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_autre_frais_usd(id_dos, autre_frais_usd){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, autre_frais_usd: autre_frais_usd, operation: 'maj_autre_frais_usd'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function getTotal(){

  }
</script>
