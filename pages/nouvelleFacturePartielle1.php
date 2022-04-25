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
            <i class="fa fa-calculator nav-icon"></i> NOUVELLE FACTURE PARTIELLE
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
                
<form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
<!-- 
      <div class="col-md-4">
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-6 col-form-label" style="text-align: right;">Client:</label>
            <div class="col-sm-6">  
              <select class="form-control" name="id_cli" id="id_cli" onchange="xajax_selectionnerDossierPrincipalEnAttenteFacture(this.value, <?php echo $_GET['id_mod_lic_fact'];?>);xajax_buildRefFacture(this.value);xajax_getDataDossier(id_dos.value);">
                <option></option>
                <?php
                  $maClasse-> selectionnerClientModeleLicence($_GET['id_mod_lic_fact']);
                ?>
              </select>
            </div>
          </div>

      </div>
 -->
      <div class="col-md-4">
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-4 col-form-label" style="text-align: right;">Référence: </label>
            <div class="col-sm-8">
              <input class="form-control bg bg-dark" type="text" name="ref_fact" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>">
            </div>
          </div>

      </div>

      <div class="col-md-4">
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-6 col-form-label" style="text-align: right;">Dossier:</label>
            <div class="col-sm-6">  
              <select class="form-control" name="id_dos" id="id_dos" required>
                <option></option>
                <?php
                  $maClasse-> selectionnerDossierPrincipalEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                ?>
              </select>
            </div>
          </div>

      </div>
    </div>

    </div>  


<!-- -------VALIDATION FORMULAIRE------- -->

  <div class="modal-footer justify-content-between">
    <span  data-toggle="modal" data-target=".validerCotation"class="btn btn-primary">Valider</span>
  </div>


  <div class="modal fade validerCotation" id="modal-default">
    <div class="modal-dialog">
      <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <div class="modal-content">
        <div class="modal-header ">
          <h4 class="modal-title"><i class="fa fa-plus"></i> Confirmation.</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">
                Voulez-vous créer cette Facture ?
              </label>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="creerFactureDossier" class="btn btn-primary">Valider</button>
        </div>
      </div>
      <!-- </form> -->
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

