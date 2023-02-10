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
                
<!-- <form id="enregistrerFactureAcidImportMultiple_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="enregistrerFactureAcidImportMultiple_form" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="enregistrerFactureAcidImportMultiple">

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
          <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>">
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
                  <th>Declaration</th>
                  <th>Liquidation</th>
                  <th style="text-align: center;">Truck(Wagon)</th>
                  <th>Qty(Mt)</th>
                  <th>Action</th>
                  <th>Exchange Rate</th>
                  <th>DDI(CDF)</th>
                  <th>FPI(CDF)</th>
                  <th>RRI(CDF)</th>
                  <th>COG(CDF)</th>
                  <th>DCI(CDF)</th>
                  <th>RLS(CDF)</th>
                  <th>Autres Taxes(CDF)</th>
                  <th>Total Duty(CDF)</th>
              </tr>
          </thead>
          <tbody>
            <?php
              $maClasse-> getDossiersImportAcidAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans'], $_GET['num_lic']);
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

  function calculDuty(compteur){

    if (parseFloat($('#ddi_'+compteur).val()) > 0 ) {
      ddi = parseFloat($('#ddi_'+compteur).val());
    }else{
      ddi=0;
    }

    if (parseFloat($('#rls_'+compteur).val()) > 0 ) {
      rls = parseFloat($('#rls_'+compteur).val());
    }else{
      rls=0;
    }

    if (parseFloat($('#qpt_'+compteur).val()) > 0 ) {
      qpt = parseFloat($('#qpt_'+compteur).val());
    }else{
      qpt=0;
    }

    if (parseFloat($('#tpi_'+compteur).val()) > 0 ) {
      tpi = parseFloat($('#tpi_'+compteur).val());
    }else{
      tpi=0;
    }

    if (parseFloat($('#cog_'+compteur).val()) > 0 ) {
      cog = parseFloat($('#cog_'+compteur).val());
    }else{
      cog=0;
    }

    if (parseFloat($('#rco_'+compteur).val()) > 0 ) {
      rco = parseFloat($('#rco_'+compteur).val());
    }else{
      rco=0;
    }

    if (parseFloat($('#cso_'+compteur).val()) > 0 ) {
      cso = parseFloat($('#cso_'+compteur).val());
    }else{
      cso=0;
    }

    if (parseFloat($('#rii_'+compteur).val()) > 0 ) {
      rii = parseFloat($('#rii_'+compteur).val());
    }else{
      rii=0;
    }

    if (parseFloat($('#ret_'+compteur).val()) > 0 ) {
      ret = parseFloat($('#ret_'+compteur).val());
    }else{
      ret=0;
    }

    if (parseFloat($('#ran_'+compteur).val()) > 0 ) {
      ran = parseFloat($('#ran_'+compteur).val());
    }else{
      ran=0;
    }

    if (parseFloat($('#ana_'+compteur).val()) > 0 ) {
      ana = parseFloat($('#ana_'+compteur).val());
    }else{
      ana=0;
    }

    if (parseFloat($('#lab_'+compteur).val()) > 0 ) {
      lab = parseFloat($('#lab_'+compteur).val());
    }else{
      lab=0;
    }

    if (parseFloat($('#roc_'+compteur).val()) > 0 ) {
      roc = parseFloat($('#roc_'+compteur).val());
    }else{
      roc=0;
    }

    total_duty = ddi + rls + qpt + tpi + cog + rco + cso + rii + ret + ran + ana + lab + roc ;


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

      $('#enregistrerFactureAcidImportMultiple_form').submit(function(e){

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
                  $( '#enregistrerFactureAcidImportMultiple_form' ).each(function(){
                      this.reset();
                  });
                  $('#ref_fact').val(data.ref_fact);
                  $('#id_dos').html(data.ref_dos);
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
                  window.open('viewAcidImportInvoiceMultiple2022.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
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
