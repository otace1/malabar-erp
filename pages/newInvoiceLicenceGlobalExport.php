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
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                
<!-- <form id="form_creerFactureLicenceGlobale" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="form_creerFactureLicenceGlobale" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="creerFactureLicenceGlobale">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" id="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" id="id_mod_lic" value="<?php echo $_GET['id_mod_lic_fact'];?>">
      <input type="hidden" name="id_mod_fact" id="id_mod_fact" value="<?php echo $_GET['id_mod_fact'];?>">
      <input type="hidden" name="num_lic" id="num_lic" value="<?php echo $_GET['num_lic'];?>">
      
      <div class="col-md-3">
        
          <div class="form-group">
            <label for="ref_fact" class="col-form-label">Invoice Ref.:</label>
            <input type="text" name="ref_fact" id="ref_fact" class="form-control form-control-sm"  value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli'], $_GET['id_mod_lic_fact']);?>" required />
          </div>

      </div>

      <div class="col-md-3">
        
          <div class="form-group">
            <label for="taux" class="col-form-label">Rate:</label>
            <input type="number" step="0.0001" name="taux" id="taux" class="form-control form-control-sm text-center" required />
          </div>

      </div>

      <div class="col-md-3">
        
          <div class="form-group">
            <label for="" class="col-form-label">License Num.:</label>
            <input type="text" value="<?php echo $_GET['num_lic'];?>" class="form-control form-control-sm" disabled/>
          </div>

      </div>

      <div class="col-md-3">
        
          <div class="form-group">
            <label for="nbre_dos" class="col-form-label">Nbr Files/Trucks:</label>
            <input type="number" name="nbre_dos" id="nbre_dos" value="<?php echo $maClasse-> getNbreDossierLicence($_GET['num_lic']);?>" class="form-control form-control-sm text-center" disabled/>
          </div>

      </div>

      <div class="col-md-10">
        <label for="x_card_code" class="control-label mb-1"><u>Items</u></label>
        <table class="table table-bordered table-responsive table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed">
          <thead>
              <tr>
                  <th colspan="2">ITEMS</th>
                  <th>Unite</th>
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
    <!-- <span  data-toggle="modal" data-target=".validerCotation"class="btn btn-xs btn-primary" onclick="FactureLicenceGlobale(roe_decl.value, id_dos.value, ref_fact.value, id_deb_1.value, montant_1.value, usd_1.value, tva_1.value);">Submit</span> -->
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

  $(document).ready(function(){
    getDeboursPourFactureLicenceGlobale();
  });

  function getDeboursPourFactureLicenceGlobale(){

    $('#spinner-div').show();

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDeboursPourFactureLicenceGlobale', id_cli: '<?php echo $_GET['id_cli'];?>', num_lic: '<?php echo $_GET['num_lic'];?>', id_mod_lic: '<?php echo $_GET['id_mod_lic_fact'];?>'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#debours').html(data.debours);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
    
  }

  $(document).ready(function(){

      $('#form_creerFactureLicenceGlobale').submit(function(e){

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
                // $( '#form_creerFactureLicenceGlobale' ).each(function(){
                //     this.reset();
                // });
                window.open('viewInvoiceLicenceGlobalExport.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
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
