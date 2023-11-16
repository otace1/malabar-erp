<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="fa fa-plus"></i>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'Create Debit Note';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Nouvelle Note de Debit';
              }
            ?>
          </h5>
          <div class="pull-right">
            <!-- <button class="btn btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                <i class="fa fa-filter"></i> Filtrage
            </button> -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <form id="form_creer_note_debit" method="POST" action="">
          <input type="hidden" name="operation" value="creer_note_debit">
          <input type="hidden" name="id_model_nd" value="1">
        <div class="row">
          <div class="col-12">
            <div class="card">   
              <!-- /.card-header -->
              <div class="card-body">
                <?php 
                  $_GET['id_mod_lic_fact'] = $_GET['id_mod_lic'];
                ?>
                <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
                <input type="hidden" name="id_mod_lic" value="<?php echo $_GET['id_mod_lic'];?>">
                <div class="row">
                  <div class="col-md-3">
                  
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Invoice Ref.: </label>
                        <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_note" id="ref_note" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>" required>
                      </div>

                  </div>

                  <div class="col-md-3">
                  
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Information: </label>
                        <input class="form-control form-control-sm bg bg-dark" type="text" name="libelle" id="libelle" value="" required>
                      </div>

                  </div>

                  <div class="col-md-3">
                  
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">PO Ref.: </label>
                        <input class="form-control form-control-sm bg bg-dark" disabled value="<?php echo $_GET['po_ref'];?>" required>
                      </div>

                  </div>

                  <div class="col-md-3">
                  
                      <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">Client: </label>
                        <input class="form-control form-control-sm bg bg-dark" disabled value="<?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?>" required>
                      </div>

                  </div>

                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-8">
            <div class="card">   
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="client_note_debit" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm text-nowrap table-hover table-dark">
                  <thead>
                    <tr>
                      <th width="10px">#</th>
                      <th>File Ref.</th>
                      <th>PO Ref.</th>
                      <th>Item</th>
                      <th>Amount</th>
                      <th>TVA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $maClasse-> afficherDossierNewNoteDeDebitKamoa($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_dep'], $_GET['po_ref_2']);
                    ?>
                  </tbody>
                </table>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </form>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>

<div class="modal fade" id="modal_kamoa_nd">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-list"></i> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Item</th>
                      <th>PO</th>
                      <th>Files</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody id="tableau_kamoa_nd">
                
              </tbody>
            </table>

          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn btn-primary">Valider</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script type="text/javascript">

  $(document).ready(function(){

      $('#form_creer_note_debit').submit(function(e){

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
                }else if(data.message){
                  
                  window.open('viewNoteDebitKAMOAImport.php?ref_note='+fd.get('ref_note'),'pop1','width=1000,height=800');
                  window.location="listerNoteDebit.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic']?>";
                }
              },
              complete: function () {
                  $('#spinner-div').hide();//Request is complete so hide spinner
              }
            });


        }

      });
    
  });

function kamoa_nd(id_mod_lic, id_cli){
  $('#spinner-div').show();
  $.ajax({
    type: 'post',
    url: 'ajax.php',
    data: {id_mod_lic: id_mod_lic, id_cli: id_cli, operation: 'kamoa_nd'},
    dataType: 'json',
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        $('#tableau_kamoa_nd').html(data.tableau_kamoa_nd);
        $('#modal_kamoa_nd').modal('show');
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });

}

</script>
