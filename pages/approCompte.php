<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <!-- <h5><i class="fa fa-object-group nav-icon"></i> ACCOUNTS</h5> -->
        </div>

      </div><!-- /.container-fluid -->

                  <!-- <div class="card-tools">
                    <div class="pull-right">
                      <button class="btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".newGroup">
                          <i class="fa fa-filter"></i> Filtrage Client
                      </button>
                    </div>
                  </div> -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  <i class="fa fa-arrow-down nav-icon"></i> 
                  <?php
                    if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                      echo 'Account Funding';
                    }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                      echo 'Appro Compte';
                    }
                  ?>
                </h5>


                <!-- <div class="card-tools">
                  <div class="pull-right">
                      <button class="btn-xs btn-primary square-btn-adjust" data-toggle="modal" data-target=".newAccount">
                          <i class="fa fa-plus"></i> New Account
                      </button>
                    </div>
                </div> -->
              </div>    
              <!-- /.card-header -->
              <div class="card-body" style="">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-3">
                        <label for="x_card_code" class="control-label mb-1">Compte Emetteur</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-sm btn-info" onclick="liste_compte_tresorerie();"><i class="fa fa-list"></i></button>
                          </div>
                          <!-- /btn-group -->
                          <input type="text" class="form-control form-control-sm">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <label for="x_card_code" class="control-label mb-1">Record Ref.</label>
                        <input class="form-control cc-exp form-control-sm" type="text" value="<?php echo uniqid();?>" id="ref_e" name="" required>
                      </div>

                      <div class="col-md-2">
                        <label for="x_card_code" class="control-label mb-1">Date</label>
                        <input class="form-control cc-exp form-control-sm" type="date" id="date_e" name="date_e" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <hr>
                  </div>
                  <div class="col-md-12">
                    <table class=" table table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                      <thead>
                        <tr class="">
                          <th style="" width="10px;">#</th>
                          <th style="">Name Of Account</th>
                          <th style=" text-align: center;">Code</th>
                          <th style=" text-align: center;">Group</th>
                          <th style=" text-align: center;">Category</th>
                          <th style=" text-align: center;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="">
                        <?php
                        // $maClasse-> afficherDossierEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
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
  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<div class="modal fade actePV" id="modal_liste_compte">
  <div class="modal-dialog modal-lg">
    <!-- <form method="POST" id="form_actePV" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="operation" value="actePV">
      <input type="hidden" id="id_pv_acte" name="id_pv_acte">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><img src="../images/presse-papiers.png" width="30px"> Account </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Search</label>
            <input class="form-control cc-exp bg-dark" type="text" id="nom_compte_tresorerie_search" onkeyup="nom_compte_tresorerie_search(this.value);">
          </div>

          <div class="col-md-12 table-responsive" style="height: 300px;">
            <table class="table table-hover table-bordered table-head-fixed text-nowrap table-sm">
              <thead class="">
                <tr class="">
                  <th width="5%">#</th>
                  <th style="">Name</th>
                </tr>
              </thead>
              <tbody id="liste_compte_tresorerie">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  
  function liste_compte_tresorerie(){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'liste_compte_tresorerie'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte_tresorerie').html(data.liste_compte_tresorerie);
          // $('#nom_compte_tresorerie_search').val('');
          $('#modal_liste_compte').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function nom_compte_tresorerie_search(nom_compte){

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'nom_compte_tresorerie_search', nom_compte: nom_compte},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte_tresorerie').html(data.liste_compte_tresorerie);
        }
      }
    });

  }

  function select_compte(id_compte, nom_compte){
    
    $('#spinner-div').show();
    $('#modal_compte').modal('hide');
    $('#liste_compte_tresorerie').html('');
    $('#nom_compte').val(nom_compte);
    document.getElementById('nom_compte').classList.remove("is-invalid");
    document.getElementById('nom_compte').classList.remove("text-danger");
    $('#id_compte').val(id_compte);
    $('#spinner-div').hide();

  }

</script>