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
          <!-- <h5><i class="fa fa-object-group nav-icon"></i> GROUPS OF ACCOUNTS</h5> -->
        </div>

      </div><!-- /.container-fluid -->

                  <!-- <div class="card-tools">
                    <div class="pull-right">
                      <button class="btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".newRegister">
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
                  <i class="fa fa-folder-open nav-icon"></i> 
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'REGISTERS';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'JOURNAUX';
                  }
                ?>
                </h5>


                <div class="card-tools">
                  <div class="pull-right">
                      <button class="btn-xs btn-primary square-btn-adjust" data-toggle="modal" data-target=".newRegister">
                          <i class="fa fa-plus"></i> New Register
                      </button>
                    </div>
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class=" table table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="">
                      <th style="" width="10px;">#</th>
                      <th style="">Name</th>
                      <th style=" text-align: center;">Accounts</th>
                      <th style=" text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody id="journaux">
                    <?php
                    // $maClasse-> afficherDossierEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                    ?>
                  </tbody>
                </table>
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

<div class="modal fade newRegister" id="newRegister">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="ref_fact" id="ref_fact">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Register</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Name Of Register</label>
            <input name="nom_jour" id="nom_jour" class="form-control form-control-sm cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button name="creerJournal" class="btn-xs btn-primary" onclick="creerJournal(nom_jour.value);">Submit</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade editJournal" id="editJournal">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="ref_fact" id="ref_fact">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Register</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <input type="hidden" id="id_jour_edit">
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Name Of Register</label>
            <input name="nom_jour" id="nom_jour_edit" class="form-control form-control-sm cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button name="editJournal" class="btn-xs btn-primary" onclick="editJournal(id_jour_edit.value, nom_jour_edit.value);">Submit</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_compte_journal">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="id_journal_compte" id="id_jour_compte">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title"><i class="fa fa-list"></i>  Accounts Affected</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <div class="input-group mb-3">
              <span id="liste_compte_hors_journal"></span>
              <span class="input-group-append">
                <button type="button" class="btn btn-info btn-sm btn-flat" onclick="creer_compte_journal(id_compte_add.value, id_jour_compte.value)">Add</button>
              </span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class=" table table-head-fixed table-bordered table-hover text-nowrap table-sm">
                <thead>
                  <tr class="bg bg-dark">
                    <th class="bg bg-dark" style="" width="10px;">#</th>
                    <th class="bg bg-dark" style="">Name</th>
                    <th class="bg bg-dark" style="">Action</th>
                  </tr>
                </thead>
                <tbody id="compte_journal">
                  <?php
                  // $maClasse-> afficherDossierEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                  ?>
                </tbody>
              </table>
            </div>
            
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">

      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $('#spinner-div').show();
    journaux();
    $('#spinner-div').hide();//Request is complete so hide spinner

  });

  function journaux(){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'journaux'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#journaux').html(data.journaux);
          // $('#spinner-div').hide();//Request is complete so hide spinner
        }
      }
    });

  }

  function creerJournal(nom_jour, id_cat_cmpte){

    if(confirm('Do really you want to submit ?')) {
      $('#newRegister').modal('hide');
      $('#spinner-div').show();

       $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {nom_jour: nom_jour, id_cat_cmpte: id_cat_cmpte, operation: 'creerJournal'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            alert(data.message);
            $('#nom_jour').val('');
            journaux();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

    }

  }

  function modalEditJournal(id_jour){
      
      $('#spinner-div').show();

       $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_jour: id_jour, operation: 'modalEditJournal'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#id_jour_edit').val(data.id_jour);
            $('#nom_jour_edit').val(data.nom_jour);
            $('#editJournal').modal('show');
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

  }

  function modal_compte_journal(id_jour){
      
      $('#spinner-div').show();

       $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_jour: id_jour, operation: 'compte_journal'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#compte_journal').html(data.compte_journal);
            $('#id_jour_compte').val(id_jour);
            $('#label_nom_journal').html(nom_jour);
            liste_compte_hors_journal(id_jour);
            $('#modal_compte_journal').modal('show');
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

  }

  function editJournal(id_jour, nom_jour){

    if(confirm('Do really you want to submit ?')) {
      $('#editJournal').modal('hide');
      $('#spinner-div').show();

       $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_jour: id_jour, nom_jour: nom_jour, operation: 'editJournal'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#id_jour_edit').val('');
            $('#nom_jour_edit').val('');
            alert(data.message);
            journaux();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

    }

  }

  function liste_compte_hors_journal(id_jour){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'liste_compte_hors_journal', id_jour: id_jour},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte_hors_journal').html(data.liste_compte_hors_journal);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function creer_compte_journal(id_compte, id_jour){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'creer_compte_journal', id_compte: id_compte, id_jour: id_jour},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte_hors_journal').html('');
          liste_compte_hors_journal(id_jour);
          $('#compte_journal').html(data.compte_journal);
          journaux();
          alert(data.message);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

</script>