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
            <i class="fa fa-files nav-icon"></i> FILES ////
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
                
<form method="POST" id="file_form" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="files_upload">

  <div class="card-body">

    <div class="row">
      
      <div class="col-md-4">
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label">Files: </label>
          <input class="form-control form-control-sm bg bg-dark" type="file" name="fichier" id="fichier" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="inputEmail3" class="col-form-label">Location: </label>
          <select class="form-control form-control-sm bg bg-dark" id="localisation" name="localisation">
            <option></option>
            <option value="pages">pages</option>
            <option value="classes">classes</option>
            <option value="images">images</option>
            <option value="images/signature_facture">signature_facture</option>
          </select>
        </div>
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


  $(document).ready(function(){

      $('#file_form').submit(function(e){

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
                $( '#file_form' ).each(function(){
                      this.reset();
                  });
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert('Done!');
              },
              complete: function () {
                  $('#spinner-div').hide();//Request is complete so hide spinner
              }
            });


        }

      });
    
  });

</script>
