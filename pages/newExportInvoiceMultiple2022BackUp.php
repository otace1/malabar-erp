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
                
<!-- <form id="enregistrerFactureExportMultiple_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="enregistrerFactureExportMultiple_form" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="enregistrerFactureExportMultiple">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" value="<?php echo $_GET['id_mod_lic_fact'];?>">
      <input type="hidden" name="id_march" value="<?php echo $_GET['id_march'];?>">
      <input type="hidden" name="id_mod_fact" value="<?php echo $_GET['id_mod_fact'];?>">
      <input type="hidden" name="id_mod_trans" value="<?php echo $_GET['id_mod_trans'];?>">
      <div class="col-md-2">
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label">Invoice Ref.: </label>
          <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>" required>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label">Client: </label>
          <input class="form-control form-control-sm bg bg-dark" disabled value="<?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label">Commodity: </label>
          <input class="form-control form-control-sm bg bg-dark" disabled value="<?php echo $maClasse-> getMarchandise($_GET['id_march']);?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label">Transport Mode: </label>
          <input class="form-control form-control-sm bg bg-dark" disabled value="<?php echo $maClasse-> getModeTransport($_GET['id_mod_trans'])['nom_mod_trans'];?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label">License: </label>
          <input class="form-control form-control-sm bg bg-dark" disabled value="<?php echo $_GET['num_lic'];?>">
        </div>
      </div>

      <div class="col-12"></div>

      <div class="col-md-12 table-responsive" style="height: 500px;">
        <label for="x_card_code" class="control-label mb-1"><u>Files</u></label>
        <table class="table table-bordered small table-sm text-nowrap table-head-fixed table-dark table-hover-color">
          <thead>
              <tr>
                  <th>#</th>
                  <th>File Ref.</th>
                  <th>Lot Num.</th>
                  <th>Declaration</th>
                  <th>Liquidation</th>
                  <th style="text-align: center;">Truck(Wagon)</th>
                  <th>Qty(Mt)</th>
                  <th>Action</th>
                  <th>Exchange Rate</th>
                  <th>DDE(CDF)</th>
                  <th>RIE(CDF)</th>
                  <th>RLS(CDF)</th>
                  <th>CSO(CDF)</th>
                  <th>FSR(CDF)</th>
                  <th>Total Duty(CDF)</th>
                  <th>GOVERNORS TAX($)</th>
                  <th>CONCENTRATE TAX($)</th>
                  <th>FERE($)</th>
                  <th>LMC($)</th>
                  <th>OCC : SAMPLING($)</th>
                  <th>OCC/CGEA($)</th>
                  <th>CEEC (UPTO 30MT)($)</th>
                  <th>CEEC (30MT to 60MT)($)</th>
                  <th>DGDA SEALS($)</th>
                  <th>DM/CE/OCC($)</th>
                  <th>DILOLO BORDER($)</th>
                  <th>ASSAY FEE($)</th>
                  <th>OCC FEES($)</th>
                  <th>CEEC FEES($)</th>
                  <th>COMMERCE EXTERIOR($)</th>
                  <th>PNHF - NAC($)</th>
                  <th>KLSA BORDER CHARGES($)</th>
                  <th>OCC OPS($)</th>
                  <th>SNCC L'SHI STATION($)</th>
                  <th>SAKANIA BORDER CHARGES($)</th>
                  <th>MINE DIV($)</th>
                  <th>MINE POLICE($)</th>
                  <th>ANR($)</th>
                  <th>DGDA($)</th>
                  <th>PRINTING AND STATIONERY($)</th>
                  <th>BANK CHARGES($)</th>
                  <th>KISANGA TOLL GATES($)</th>
                  <th>TRANSFER FEE($)</th>
                  <th>PRE-CLEARANCE FEES($)</th>
                  <th>COST INTERNAL($)</th>
                  <th>OTHER SERVICES COST($)</th>
                  <th>CONTRACTOR AGENCY FEE($)</th>
              </tr>
          </thead>
          <tbody>
            <?php
              $maClasse-> getDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans'], $_GET['num_lic']);
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

  function calculDDE(compteur){

    if (parseFloat($('#dde_'+compteur).val()) > 0 ) {
      dde = parseFloat($('#dde_'+compteur).val());
    }else{
      dde=0;
    }

    if (parseFloat($('#rie_'+compteur).val()) > 0 ) {
      rie = parseFloat($('#rie_'+compteur).val());
    }else{
      rie=0;
    }

    if (parseFloat($('#rls_'+compteur).val()) > 0 ) {
      rls = parseFloat($('#rls_'+compteur).val());
    }else{
      rls=0;
    }

    if (parseFloat($('#cso_'+compteur).val()) > 0 ) {
      cso = parseFloat($('#cso_'+compteur).val());
    }else{
      cso=0;
    }

    if (parseFloat($('#fsr_'+compteur).val()) > 0 ) {
      fsr = parseFloat($('#fsr_'+compteur).val());
    }else{
      fsr=0;
    }

    total_duty = dde + rie + rls + cso + fsr;


    if (Math.round(total_duty*1000)/1000 > 0) {
      
      $('#total_duty_'+compteur).html(new Intl.NumberFormat('en-DE').format(Math.round(total_duty*1000)/1000));
      $('#total_duty_'+compteur).addClass("badge badge-danger");

    }else{
      
      $('#total_duty_'+compteur).html('');
      $('#total_duty_'+compteur).removeClass("badge badge-danger");

    }

  }

  let USDollar = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
  });
  

  function getTotal(){

  }


  $(document).ready(function(){

      $('#enregistrerFactureExportMultiple_form').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

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
                  $( '#enregistrerFactureExportMultiple_form' ).each(function(){
                      this.reset();
                  });
                  $('#ref_fact').val(data.ref_fact);
                  $('#id_dos').html(data.ref_dos);
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
                  window.open('viewExportInvoiceMultiple2022.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
                }
              },
              complete: function () {
                  $('#spinner-div').hide();//Request is complete so hide spinner
              }
            });


        }

      });
    
  });

</script>
