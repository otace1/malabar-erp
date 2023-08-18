<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  // include("menuGauche.php");

   if( isset($_POST['creerFactureDossier']) ){
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>';
    </script>
    <?php
  }
$_GET['id_mod_trans'] = 1;
$_GET['id_march'] = 11;

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
            <i class="fa fa-calculator nav-icon"></i> NEW SERVICE INVOICE
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
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                
<!-- <form id="enregistrerFactureImportMMGAcid_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="form_creerFactureService" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="creerFactureService">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" id="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="note_debit" id="note_debit" value="<?php echo $_GET['note_debit'];?>">
      <input type="hidden" name="id_mod_lic" id="id_mod_lic" value="<?php echo $_GET['id_mod_lic_fact'];?>">
      <input type="hidden" name="id_mod_fact" id="id_mod_fact" value="12">
      <input type="hidden" name="id_dos" id="id_dos" value="1">
      <div class="col-md-3">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Invoice Ref.: </label>
          <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli'], $_GET['id_mod_lic_fact']);?>" required>
          </div>

      </div>
      <div class="col-md-2">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Rate(CDF/USD) BCC: </label>
            <input type="number" step="0.0001" min="1" class="form-control form-control-sm" name="taux" id="taux" required>
          </div>

      </div>
      <div class="col-md-5">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Naration: </label>
            <textarea class="form-control form-control-sm" type="text" name="information" id="information" required></textarea>
          </div>

      </div>

      <div class="col-md-12">
        <hr>
      </div>

      <div class="col-md-10">
        <label for="x_card_code" class="control-label mb-1"><u>Invoice Details</u></label>
        <table class="table table-bordered table-responsive table-striped text-nowrap table-hover table-sm text-nowrap table-head-fixed table-dark">
          <thead>
              <tr>
                  <th>#</th>
                  <th width="55%">Description</th>
                  <th>Nbr</th>
                  <th>Amount($)</th>
                  <th>TVA</th>
              </tr>
          </thead>
          <tbody>
            <?php
              $maClasse-> getServiceFees();
            ?>
          </tbody>
        </table>
      </div>

    </div>

    </div>  


<!-- -------VALIDATION FORMULAIRE------- -->

  <div class="modal-footer justify-content-between">
    <!-- <span  data-toggle="modal" data-target=".validerCotation"class="btn btn-xs btn-primary" onclick="enregistrerFactureImportMMGAcid(roe_decl.value, id_dos.value, ref_fact.value, id_deb_1.value, montant_1.value, usd_1.value, tva_1.value);">Submit</span> -->
    <button class="btn btn-xs btn-primary" type="submit"><i class="fa fa-save"></i> Submit</button>
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


<div class="modal fade" id="modal_liste_dossier">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" id="form_actePV" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <!-- <div class="modal-header ">
        <h4 class="modal-title"><img src="../images/presse-papiers.png" width="30px"> Account </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
        <input type="hidden" id="compteur_compte2">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table id="liste_dossier_ajax" cellspacing="0" width="100%" class="table hover display compact table-bordered table-striped table-sm text-nowrap small">
              <thead class="">
                <tr class="">
                  <th style="">File Ref.</th>
                </tr>
              </thead>
              <tbody id="">
                
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

  <?php include("pied.php");?>

<script type="text/javascript">
  
  $(document).ready(function(){

      $('#form_creerFactureService').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

          if ($('#ref_fact').val()===null || $('#ref_fact').val()==='' ) {
            alert('Error !! Please enter the invoice ref.');
          }else if ($('#information').val()===null || $('#information').val()==='' ) {
            alert('Error !! Please enter the naration.');
          }else {
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
                }else{
                  $( '#form_creerFactureService' ).each(function(){
                      this.reset();
                  });
                  $('#ref_fact').val(data.ref_fact);
                  $('#id_dos').html(data.ref_dos);
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  // alert(data.message);
                  window.open('viewFactureService.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
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


</script>
