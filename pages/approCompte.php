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
                <form method="POST" action="" id="creerEcritureAppro_form">
                  <input type="hidden" name="operation" value="creerEcritureAppro">
                  <input type="hidden" name="id_jour" value="4">
                  <input type="hidden" name="id_taux" value="<?php echo $maClasse-> getLastTaux()['id_taux'];?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-3">
                        <label for="x_card_code" class="control-label mb-1">Compte Emetteur</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-sm btn-info" onclick="liste_compte_tresorerie(0);"><i class="fa fa-list"></i></button>
                          </div>
                          <!-- /btn-group -->
                          <input type="text" id="nom_compte_0" class="form-control form-control-sm" disabled>
                          <input type="hidden" id="id_compte_0" name="id_compte_0">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <label for="x_card_code" class="control-label mb-1">Solde</label>
                        <input class="form-control cc-exp form-control-sm" type="number" id="solde_compte" disabled>
                      </div>

                      <div class="col-md-1">
                        <label for="x_card_code" class="control-label mb-1">Monnaie</label>
                        <input class="form-control cc-exp form-control-sm" type="text" id="sig_mon" name="sig_mon" disabled>
                        <input type="hidden" id="id_mon" name="id_mon">
                      </div>

                      <div class="col-md-2">
                        <label for="x_card_code" class="control-label mb-1">Montant</label>
                        <input class="form-control cc-exp form-control-sm" type="number" id="montant_0" name="montant_0" required>
                      </div>

                      <div class="col-md-2">
                        <label for="x_card_code" class="control-label mb-1">Libelle</label>
                        <input class="form-control cc-exp form-control-sm" type="text" id="libelle_e" name="libelle_e" required>
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
                          <th style="" width="5%">#</th>
                          <th style="">Compte Recepteur</th>
                          <th style=" text-align: center;" width="20%">Montant</th>
                        </tr>
                      </thead>
                      <tbody id="">
                        <?php
                        for ($i=1; $i <=5 ; $i++) { 
                          ?>
                          <tr>
                            <td style="text-align: center;">
                              <?php echo $i;?>
                            </td>
                            <td>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <button type="button" class="btn btn-sm btn-info" onclick="liste_compte_tresorerie(<?php echo $i;?>);"><i class="fa fa-list"></i></button>
                                </div>
                              <!-- /btn-group -->
                                <input type="text" id="nom_compte_<?php echo $i;?>" class="form-control bg-dark form-control-sm" disabled>
                              </div>
                              <input type="hidden" id="id_compte_<?php echo $i;?>" name="id_compte_<?php echo $i;?>">
                            </td>
                            <td>
                              <input class="form-control cc-exp form-control-sm text-center" type="number" onblur="getTotal();" id="montant_<?php echo $i;?>" name="montant_<?php echo $i;?>">
                            </td>
                          </tr>
                          <?php
                        }
                        ?>
                        <input type="hidden" name="nbre" value="<?php echo $i;?>">
                          <tr>
                            <td style="text-align: right;" colspan="2">
                              TOTAL
                            </td>
                            <td>
                              <input class="form-control cc-exp form-control-sm text-danger bg-dark text-weight text-center" type="number" disabled id="total" name="total">
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="modal-footer justify-content-between col-md-12">
                    <button type="submit" class="btn-xs btn-primary" data-dismiss="modal">Valider</button>
                  </div>

                </div>
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
        <input type="hidden" id="compteur_compte">
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Search</label>
            <input class="form-control cc-exp bg-dark" type="text" id="nom_compte_tresorerie_search" onkeyup="nom_compte_tresorerie_search(this.value, compteur_compte.value);">
          </div>

          <div class="col-md-12 table-responsive" style="height: 300px;">
            <table class="table table-hover table-bordered table-head-fixed text-nowrap table-sm">
              <thead class="">
                <tr class="">
                  <th width="5%">#</th>
                  <th style="">Name</th>
                  <th style="text-align: center;">Solde</th>
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
  
  function liste_compte_tresorerie(compteur_compte){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'liste_compte_tresorerie', compteur_compte: compteur_compte},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte_tresorerie').html(data.liste_compte_tresorerie);
          $('#compteur_compte').val(compteur_compte);
          $('#modal_liste_compte').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function nom_compte_tresorerie_search(nom_compte, compteur_compte){

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'nom_compte_tresorerie_search', nom_compte: nom_compte, compteur_compte: compteur_compte},
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

  function select_compte(id_compte, nom_compte, solde_compte, sig_mon, id_mon, compteur_compte){
    
    $('#modal_liste_compte').modal('hide');
    $('#spinner-div').show();
    $('#liste_compte_tresorerie').html('');
    $('#nom_compte_'+compteur_compte).val(nom_compte);
    // document.getElementById('nom_compte').classList.remove("is-invalid");
    // document.getElementById('nom_compte').classList.remove("text-danger");
    $('#id_compte_'+compteur_compte).val(id_compte);
    $('#sig_mon').val(sig_mon);
    $('#id_mon').val(id_mon);

    if (compteur_compte<'1') {
      if (solde_compte > 0) {
        $('#solde_compte').val(solde_compte);
        document.getElementById("montant_0").max = solde_compte;
      }else{
        $('#solde_compte').val(0);
        document.getElementById("montant_0").max = "0";
      }
    }
    

    $('#spinner-div').hide();

  }

  function getTotal(){
    total = 0;
    for (var i = 1; i <= 5; i++) {
       
      if (parseFloat($('#montant_'+i).val()) > 0 ) {
        total += parseFloat($('#montant_'+i).val());
      }

    }
    console.log(total);
    $('#total').val(total);
  }

  $(document).ready(function(){
      $('#creerEcritureAppro_form').submit(function(e){
        getTotal()


              e.preventDefault();

        if($('#total').val() != $('#montant_0').val()){
          alert('Error!! Operation is not well balanced.');
        }else{

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
                  $( '#creerEcritureAppro_form' ).each(function(){
                      this.reset();
                  });
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
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