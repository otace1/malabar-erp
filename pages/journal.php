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
    <?php

    ?>
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><img src="../images/registre.png" width="30px"> <span class="badge badge-dark"><?php echo $maClasse-> getDataJournal($_GET['id_jour'])['nom_jour'];?> Register</span></h3>


                  <div class="card-tools">

                      <div class="pull-right">
                        <button class="btn btn-xs bg-purple square-btn-adjust" id="btn_formulaire_ecriture" onclick="reload_formulaire_ecriture();formulaire_ecriture();">
                            <i class="fa fa-plus"></i> New Record
                        </button>
                        <button class="btn btn-xs bg-danger square-btn-adjust" id="btn_close_formulaire_ecriture" style="display: none;" onclick="close_formulaire_ecriture();">
                            <i class="fa fa-plus"></i> Cancel
                        </button>
<!-- 
                        <button class="btn btn-xs bg-purple square-btn-adjust" data-toggle="modal" data-target=".creerPVContentieux">
                            <i class="fa fa-plus"></i> Nouveau PV
                        </button>

                        <button class="btn btn-xs bg-teal square-btn-adjust" onclick="reload_formulaire_ecriture()">
                            <i class="fa fa-refresh"></i> Actualiser
                        </button>
 -->
                      </div>

                  </div>
                
              </div>

              <div class="card-body">

                <div id="formulaire_ecriture" style="display: none;" class="">
                  <form method="POST" action="" id="creerEcriture_form">
                  <input type="hidden" name="operation" value="creerEcriture">
                  <input type="hidden" name="id_jour" value="<?php echo $_GET['id_jour'];?>">
                  <input type="hidden" name="id_taux" value="<?php echo $maClasse-> getLastTaux()['id_taux'];?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">

                      <div class="col-md-1">
                        <label for="x_card_code" class="control-label mb-1">Currency</label>
                        <select class="form-control cc-exp form-control-sm" type="text" id="id_mon" name="id_mon" required>
                          <option></option>
                          <?php
                            $maClasse-> selectionnerMonnaieComptable();
                          ?>
                        </select>
                      </div>

                      <div class="col-md-6">
                        <label for="x_card_code" class="control-label mb-1">Naration</label>
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
                          <th style="">Account</th>
                          <th style=" text-align: center;" width="20%">Debit</th>
                          <th style=" text-align: center;" width="20%">Credit</th>
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
                                  <button type="button" class="btn btn-sm btn-info" onclick="liste_compte_journal(<?php echo $i;?>, <?php echo $_GET['id_jour'];?>);"><i class="fa fa-list"></i></button>
                                </div>
                              <!-- /btn-group -->
                                <input type="text" id="nom_compte_<?php echo $i;?>" class="form-control bg-dark form-control-sm" disabled>
                              </div>
                              <input type="hidden" id="id_compte_<?php echo $i;?>" name="id_compte_<?php echo $i;?>">
                            </td>
                            <td>
                              <input class="form-control cc-exp form-control-sm text-center" type="number" onblur="getTotal();" id="montant_debit_<?php echo $i;?>" name="montant_debit_<?php echo $i;?>">
                            </td>
                            <td>
                              <input class="form-control cc-exp form-control-sm text-center" type="number" onblur="getTotal();" id="montant_credit_<?php echo $i;?>" name="montant_credit_<?php echo $i;?>">
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
                              <input class="form-control cc-exp form-control-sm text-danger bg-dark text-weight text-center" type="number" disabled id="total_debit" name="total_debit">
                            </td>
                            <td>
                              <input class="form-control cc-exp form-control-sm text-danger bg-dark text-weight text-center" type="number" disabled id="total_credit" name="total_credit">
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="modal-footer justify-content-between col-md-12">
                    <button type="submit" class="btn-xs btn-primary" data-dismiss="modal">Submit</button>
                  </div>

                </div>
                </form>
                </div>

                <hr>

                <div class="card-body table-responsive p-0" style="height: 500px;">
                  <table class=" table table-head-fixed table-bordered table-hover text-nowrap table-sm">
                    <thead>
                      <tr class="bg bg-dark">
                        <th class="bg bg-dark" style="" width="10px;">#</th>
                        <th class="bg bg-dark" style="">Date</th>
                        <th class="bg bg-dark" style="">Intitule Compte</th>
                        <th class="bg bg-dark" style="">Libelle</th>
                        <th class="bg bg-dark" style="">Monnaie</th>
                        <th class="bg bg-dark" style="">Debit</th>
                        <th class="bg bg-dark" style="">Credit</th>
                      </tr>
                    </thead>
                    <tbody id="getEcritureJournal">
                      <?php
                      // $maClasse-> afficherDossierEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
                      ?>
                    </tbody>
                  </table>
                </div>
                
              </div>

            </div>

          </div>


        </div>



      </div>
    </section>

    <!-- /.content -->
  </div>
  <?php
  include("pied.php");
  ?>

<div class="modal fade actePV" id="modal_compte">
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
        <input type="hidden" id="compteur_compte">
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Search</label>
            <input class="form-control cc-exp bg-dark" type="text" id="nom_compte_search_journal" onkeyup="nom_compte_search_journal(this.value, compteur_compte.value, <?php echo $_GET['id_jour'];?>);">
          </div>

          <div class="col-md-12 table-responsive" style="height: 300px;">
            <table class="table table-hover table-bordered table-head-fixed text-nowrap table-sm">
              <thead class="">
                <tr class="">
                  <th width="5%">#</th>
                  <th style="">Name</th>
                  <th style="">Solde</th>
                </tr>
              </thead>
              <tbody id="liste_compte_journal">
                
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

  $(document).ready(function(){
    loadPageRegister();
  });

  function loadPageRegister(){

    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'loadPageRegister'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#taux').val(new Intl.NumberFormat('en-DE').format(Math.round(data.taux*1000)/1000));
          $('#id_taux').val(data.id_taux);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  let USDollar = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
  });
  

  function formulaire_ecriture(){

    document.getElementById("formulaire_ecriture").style.display = "block";
    document.getElementById("btn_formulaire_ecriture").style.display = "none";
    document.getElementById("btn_close_formulaire_ecriture").style.display = "block";

  }

  function close_formulaire_ecriture(){

    document.getElementById("formulaire_ecriture").style.display = "none";
    document.getElementById("btn_formulaire_ecriture").style.display = "block";
    document.getElementById("btn_close_formulaire_ecriture").style.display = "none";


  }

  function reload_formulaire_ecriture(){

    $('#spinner-div').show();

    $("#formulaire_ecriture_detail").load(window.location.href + " #formulaire_ecriture_detail" );
    loadPageRegister();
    $('#spinner-div').hide();

  }

  function liste_compte_journal(compteur_compte, id_jour){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'liste_compte_journal', compteur_compte: compteur_compte, id_jour: id_jour},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte_journal').html(data.liste_compte_journal);
          $('#nom_compte_search_journal').val('');
          $('#modal_compte').modal('show');
          $('#compteur_compte').val(compteur_compte);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function nom_compte_search_journal(nom_compte, compteur_compte, id_jour){

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'nom_compte_search_journal', nom_compte: nom_compte, compteur_compte: compteur_compte, id_jour: id_jour},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte_journal').html(data.liste_compte_journal);
        }
      }
    });

  }

  // function select_compte(id_compte, nom_compte){
    
  //   $('#spinner-div').show();
  //   $('#modal_compte').modal('hide');
  //   $('#liste_compte_journal').html('');
  //   $('#nom_compte').val(nom_compte);
  //   document.getElementById('nom_compte').classList.remove("is-invalid");
  //   document.getElementById('nom_compte').classList.remove("text-danger");
  //   $('#id_compte').val(id_compte);
  //   $('#spinner-div').hide();

  // }

  function select_compte(id_compte, nom_compte, solde_compte, compteur_compte){
    
    $('#modal_compte').modal('hide');
    $('#spinner-div').show();
    $('#liste_compte_journal').html('');
    $('#nom_compte_'+compteur_compte).val(nom_compte);
    // document.getElementById('nom_compte').classList.remove("is-invalid");
    // document.getElementById('nom_compte').classList.remove("text-danger");
    $('#id_compte_'+compteur_compte).val(id_compte);


    $('#spinner-div').hide();

  }

  function creerDetailEcriture(ref_e, date_e, libelle_e, reference, id_jour, id_taux, usd, id_compte, debit, credit){

    if ($('#date_e').val()===null || $('#date_e').val()==='' ) {

      alert('Please enter the date !');

    }else if ($('#id_compte').val()===null || $('#id_compte').val()==='' ) {

      document.getElementById('nom_compte').classList.add("is-invalid");
      $('#nom_compte').val('Please provide a valid account !');
      document.getElementById('nom_compte').classList.add("text-danger");

    }else if (($('#debit').val()===null || $('#debit').val()==='') && ($('#credit').val()===null || $('#credit').val()==='')) {

      document.getElementById('debit').setAttribute("placeholder", "Enter Amount");
      document.getElementById('debit').classList.add("is-invalid");
      document.getElementById('credit').setAttribute("placeholder", "Enter Amount");
      document.getElementById('credit').classList.add("is-invalid");

    }else if ($('#debit').val()>0 && $('#credit').val()>0) {

      alert('Error! You can\'t enter credit and debit at the same time.');

    }else{

      document.getElementById('debit').removeAttribute("placeholder", "");
      document.getElementById('debit').classList.remove("is-invalid");
      document.getElementById('credit').removeAttribute("placeholder", "");
      document.getElementById('credit').classList.remove("is-invalid");

      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: { id_compte: id_compte, debit: debit, credit: credit, ref_e: ref_e, operation: 'creerDetailEcriture'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{

          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

    }
    

  }

  function getTotal(){
    total_debit = 0;
    total_credit = 0;
    for (var i = 1; i <= 5; i++) {
       
      if (parseFloat($('#montant_debit_'+i).val()) > 0 ) {
        total_debit += parseFloat($('#montant_debit_'+i).val());
      }
      if (parseFloat($('#montant_credit_'+i).val()) > 0 ) {
        total_credit += parseFloat($('#montant_credit_'+i).val());
      }

    }
    // console.log(total);
    $('#total_debit').val(total_debit);
    $('#total_credit').val(total_credit);
  }

  $(document).ready(function(){

      $('#creerEcriture_form').submit(function(e){

        e.preventDefault();
        
        getTotal();

        if ($('#total_debit').val()!=$('#total_credit').val()) {
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
                  $( '#creerEcriture_form' ).each(function(){
                      this.reset();
                  });
                  getEcritureJournal();
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

  $(document).ready(function(){

    getEcritureJournal();

  });

  function getEcritureJournal(){

    $('#spinner-div').show();

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getEcritureJournal', id_jour: <?php echo $_GET['id_jour'];?>},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $( '#getEcritureJournal' ).html(data.getEcritureJournal);
          $('#spinner-div').hide();//Request is complete so hide spinner
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }


</script>