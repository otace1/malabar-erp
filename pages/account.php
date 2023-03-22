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
                  <i class="fa fa-table nav-icon"></i> ACCOUNTS
                </h5>


                <div class="card-tools">
                  <div class="pull-right">
                      <button class="btn-xs btn-primary square-btn-adjust" data-toggle="modal" data-target=".newAccount">
                          <i class="fa fa-plus"></i> New Account
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
                      <th style="">Name Of Account</th>
                      <th style=" text-align: center;">Code</th>
                      <th style=" text-align: center;">Group</th>
                      <th style=" text-align: center;">Category</th>
                      <th style=" text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody id="account">
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

<div class="modal fade newAccount" id="newAccount">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="ref_fact" id="ref_fact">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Group</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Name Of Account</label>
            <input name="nom_compte" id="nom_compte" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Code Of Account</label>
            <input name="code_compte" id="code_compte" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Group</label>
            <select name="id_class" id="id_class" onchange="" class="form-control form-control-sm cc-exp">
              <option></option>
                <?php
                  $maClasse->selectionnerClasseCompte();
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button name="newAccount" class="btn-xs btn-primary" onclick="creerCompte(nom_compte.value, code_compte.value, id_class.value);">Submit</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade editGroup" id="editGroup">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="ref_fact" id="ref_fact">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Group</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <input type="hidden" id="id_class_edit">
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Name Of Group</label>
            <input name="nom_class" id="nom_class_edit" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Category</label>
            <select name="id_cat_cmpte" id="id_cat_cmpte_edit" onchange="" class="form-control form-control-sm cc-exp">
                <?php
                  $maClasse->selectionnerCategorieCompte($modele['id_mod_lic']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button name="editGroup" class="btn-xs btn-primary" onclick="editClasseCompte(id_class_edit.value, nom_class_edit.value, id_cat_cmpte_edit.value);">Submit</button>
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
    account();
    $('#spinner-div').hide();//Request is complete so hide spinner

  });

  function account(){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'account'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#account').html(data.account);
          // $('#spinner-div').hide();//Request is complete so hide spinner
        }
      }
    });

  }

  function creerCompte(nom_compte, code_compte, id_class){

    if(confirm('Do really you want to submit ?')) {
      $('#newGroup').modal('hide');
      $('#spinner-div').show();

       $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {nom_compte: nom_compte, code_compte: code_compte, id_class: id_class, operation: 'creerCompte'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#id_class').val('');
            $('#nom_compte').val('');
            $('#code_compte').val('');
            account();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

    }

  }

  function modalEditClasse(id_class){
      
      $('#spinner-div').show();

       $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_class: id_class, operation: 'modalEditClasse'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#id_class_edit').val(data.id_class);
            $('#nom_class_edit').val(data.nom_class);
            $('#id_cat_cmpte_edit').val(data.id_cat_cmpte);
            $('#editGroup').modal('show');
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

  }

  function editClasseCompte(id_class, nom_class, id_cat_cmpte){

    if(confirm('Do really you want to submit ?')) {
      $('#editGroup').modal('hide');
      $('#spinner-div').show();

       $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_class: id_class, nom_class: nom_class, id_cat_cmpte: id_cat_cmpte, operation: 'editClasseCompte'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#id_class_edit').val('');
            $('#nom_class_edit').val('');
            $('#id_cat_cmpte_edit').val('');
            account();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

    }

  }

</script>