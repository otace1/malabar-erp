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
      <div class="col-md-2">
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label">License: </label>
          <input class="form-control form-control-sm bg bg-dark" disabled value="<?php echo $_GET['num_lic'];?>">
        </div>
      </div>

      <div class="col-md-2">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">ARSP:</label>
            <select class="form-control form-control-sm" name="statut_arsp" id="statut_arsp" onchange="maj_statut_arsp('<?php echo $_GET['ref_fact'];?>', this.value);" required>
              <option value="1">Enabled</option>
              <option value="0">Disabled</option>
            </select>
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
                  <?php
                  if($maClasse-> get_aff_client_modele_licence($_GET['id_cli'], $_GET['id_mod_lic_fact'])['bank_rate']=='0'){
                    ?>
                  <th>Rate</th>
                    <?php
                  }else{
                    ?>
                  <th>Bank</th>
                  <th>Bank Rate</th>
                  <th>BCC Rate</th>
                    <?php
                  }

                  if($maClasse-> get_aff_client_modele_licence($_GET['id_cli'], $_GET['id_mod_lic_fact'])['bl_export_usd']== '1'){
                    ?>
                    <th>Total Duty(CDF)</th>
                    <th>DDE(CDF)</th>
                    <th>RIE(USD)</th>
                    <th style="background-color: #95afc0;">RLS Qty</th>
                    <th style="background-color: #95afc0;">RLS Amount(USD)</th>
                    <th style="background-color: #f0932b;">LSE Qty</th>
                    <th style="background-color: #f0932b;">LSE Amount(USD)</th>
                    <th>CSO(CDF)</th>
                    <th>FSR(CDF)</th>
                    <?php
                  }else{
                    ?>
                  <th>DDE(CDF)</th>
                  <th>RIE(CDF)</th>
                  <th>RLS(CDF)</th>
                  <th>CSO(CDF)</th>
                  <th>FSR(CDF)</th>
                  <th>LSE(CDF)</th>
                  <th>Total Duty(CDF)</th>
                    <?php
                  }
                  ?>
                  <th>GOVERNORS TAX($)</th>
                  <th>CONCENTRATE TAX($)</th>
                  <th>FERE($)</th>
                  <th>Container 10'($)</th>
                  <th>Container 20'($)</th>
                  <th>Container 40'($)</th>
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
                  <th>SEGUCE CHARGE($)</th>
                  <th>ASSAY CGW($)</th>
                  <th>LOADING ASSIST.</th>
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

  function getBank(id_bank_liq, compteur) {
    $('#id_bank_liq_'+compteur).val(id_bank_liq);
  }

  function maj_id_bank_liq(id_dos, id_bank_liq, compteur){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, id_bank_liq: id_bank_liq, operation: 'maj_id_bank_liq'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#roe_decl_'+compteur).val(data.roe_decl);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_roe_liq(id_dos, roe_liq, compteur){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_liq: roe_liq, operation: 'maj_roe_liq'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#roe_liq_'+compteur).val(roe_liq);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_montant_liq(id_dos, montant_liq, compteur){
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
        }else{
          $('#montant_liq_'+compteur).val(montant_liq);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  // $(document).ready(function(){
  //   calcul_rls(compteur);
  // });

  function calcul_rls(compteur){

    if (parseFloat($('#rls_qty_'+compteur).val()) > 0 ) {
      rls_qty = parseFloat($('#rls_qty_'+compteur).val());
    }else{
      rls_qty=0;
    }

    rls = rls_qty*140;

    if (Math.round(rls*1000)/1000 > 0) {
      $('#rls').val(rls.toFixed(2));
    }else{
      $('#rls').val('');
    }

    $('#rls_'+compteur).val(rls);

  }

  function calcul_lse(compteur){

    if (parseFloat($('#lse_qty_'+compteur).val()) > 0 ) {
      lse_qty = parseFloat($('#lse_qty_'+compteur).val());
    }else{
      lse_qty=0;
    }

    lse = lse_qty*30;

    if (Math.round(lse*1000)/1000 > 0) {
      $('#lse').val(lse.toFixed(2));
    }else{
      $('#lse').val('');
    }

    $('#lse_'+compteur).val(lse);

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

    if (parseFloat($('#lse_'+compteur).val()) > 0 ) {
      lse = parseFloat($('#lse_'+compteur).val());
    }else{
      lse=0;
    }

    total_duty = dde + rie + rls + cso + fsr + lse;


    if (Math.round(total_duty*1000)/1000 > 0) {
      
      $('#total_duty_'+compteur).html(new Intl.NumberFormat('en-DE').format(Math.round(total_duty*1000)/1000));
      $('#total_duty_'+compteur).addClass("badge badge-danger");

    }else{
      
      $('#total_duty_'+compteur).html('');
      $('#total_duty_'+compteur).removeClass("badge badge-danger");

    }

  }

  function calculFSR(compteur){

    if (parseFloat($('#roe_decl_'+compteur).val()) > 0 ) {
      roe_decl = parseFloat($('#roe_decl_'+compteur).val());
    }else{
      roe_decl=0;
    }

    if (parseFloat($('#montant_liq_'+compteur).val()) > 0 ) {
      montant_liq = parseFloat($('#montant_liq_'+compteur).val());
    }else{
      montant_liq=0;
    }

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

    if (parseFloat($('#lse_'+compteur).val()) > 0 ) {
      lse = parseFloat($('#lse_'+compteur).val());
    }else{
      lse=0;
    }

    fsr = montant_liq - cso - dde - ( (rie + rls + lse) * roe_decl);

    $('#fsr_'+compteur).val(fsr);

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
