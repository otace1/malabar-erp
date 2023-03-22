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
                        <button class="btn btn-xs bg-purple square-btn-adjust" onclick="formulaire_ecriture();">
                            <i class="fa fa-plus"></i> New Record
                        </button>
<!-- 
                        <button class="btn btn-xs bg-purple square-btn-adjust" data-toggle="modal" data-target=".creerPVContentieux">
                            <i class="fa fa-plus"></i> Nouveau PV
                        </button>
 -->
                        <button class="btn btn-xs bg-teal square-btn-adjust" onclick="reload_formulaire_ecriture()">
                            <i class="fa fa-refresh"></i> Actualiser
                        </button>

                      </div>

                  </div>
                
              </div>

              <div class="card-body">

                <div id="formulaire_ecriture" style="display: none;" class="">
                  <div class="modal-content">
                    <div class="modal-header ">
                      <h5 class="modal-title"><i class="fa fa-plus"></i> New Record</h5>
                      <button type="button" class="close" onclick="close_formulaire_ecriture();">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="formulaire_ecriture_detail">
                      <div class="row">

                        <div class="col-md-2">
                          <label for="x_card_code" class="control-label mb-1">Record Ref.</label>
                          <input class="form-control cc-exp form-control-sm" type="text" value="<?php echo uniqid();?>" id="ref_e" name="" required>
                        </div>

                        <div class="col-md-2">
                          <label for="x_card_code" class="control-label mb-1">Date</label>
                          <input class="form-control cc-exp form-control-sm" type="date" id="date_e" name="date_e" value="<?php echo date('Y-m-d');?>" required>
                        </div>

                        <div class="col-md-1">
                          <label for="x_card_code" class="control-label mb-1">Currency</label>
                          <select class="form-control cc-exp form-control-sm" id="usd" name="usd" required>
                            <option value="1">USD</option>
                            <option value="0">CDF</option>
                          </select>
                        </div>

                        <div class="col-md-1">
                          <label for="x_card_code" class="control-label mb-1">ROE</label>
                          <input class="form-control cc-exp form-control-sm bg-dark text-danger" style="text-align: center;" type="text" id="taux" disabled >
                          <input type="hidden" id="id_taux" >
                        </div>

                        <div class="col-md-2">
                          <label for="x_card_code" class="control-label mb-1">Supporting Doc. Ref.</label>
                          <input class="form-control cc-exp form-control-sm" type="text" id="reference" name="" required>
                        </div>
<!-- 
                        <div class="col-md-2">
                          <label for="x_card_code" class="control-label mb-1">Supporting Doc. File</label>
                          <input class="form-control cc-exp form-control-sm" type="file" id="" name="" required>
                        </div>
 -->
                        <div class="col-md-3">
                          <label for="x_card_code" class="control-label mb-1">Naration</label>
                          <textarea class="form-control cc-exp form-control-sm" id="libelle_e" name="" required></textarea>
                        </div>

                        <div class="col-md-12">
                          <hr>
                        </div>

                        <div class="col-md-12">
                          <table class=" table table-dark table-hover table-bordered text-nowrap table-sm">
                            <thead>
                              <tr>
                                <th width="5%"></th>
                                <th width="55%">Account</th>
                                <th width="20%">Debit</th>
                                <th width="20%">Credit</th>
                                <th width="5%"></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="text-align: center;">
                                  <button class="btn btn-xs btn-info" onclick="liste_compte_journal();">
                                    <i class="fa fa-plus"></i>
                                  </button>
                                </td>
                                <td>
                                  <input type="hidden" id="id_compte">
                                  <input type="text" class="form-control form-control-sm" disabled id="nom_compte">
                                </td>
                                <td>
                                  <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="debit" style="text-align: center;">
                                </td>
                                <td>
                                  <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="credit" style="text-align: center;">
                                </td>
                                <td style="text-align: center;">
                                  <button class="btn btn-xs btn-success" onclick="creerDetailEcriture(ref_e.value, date_e.value, libelle_e.value, reference.value, <?php echo $_GET['id_jour'];?>, id_taux.value, usd.value, id_compte.value, debit.value, credit.value);;">
                                    <i class="fa fa-check"></i>
                                  </button>
                                </td>
                              </tr>
                              <span id="afficher_detail_ecriture"></span>
                            </tbody>
                          </table>
                        </div>
                        
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button>
                      <button type="submit" name="" class="btn-xs btn-primary">Créer</button>
                    </div>
                  </div>
                  <hr>
                </div>

                <table class=" table table-dark table-hover table-bordered text-nowrap table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                      <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>

              <!-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div> -->
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
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Search</label>
            <input class="form-control cc-exp bg-dark" type="text" id="nom_compte_search" onkeyup="nom_compte_search(this.value);">
          </div>

          <div class="col-md-12 table-responsive" style="height: 300px;">
            <table class="table table-hover table-bordered table-head-fixed text-nowrap table-sm">
              <thead class="">
                <tr class="">
                  <th width="5%">#</th>
                  <th style="">Name</th>
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

  });

  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  let USDollar = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
  });
  

  function formulaire_ecriture(){

    document.getElementById("formulaire_ecriture").style.display = "block";

  }

  function close_formulaire_ecriture(){

    document.getElementById("formulaire_ecriture").style.display = "none";

  }

  function reload_formulaire_ecriture(){

    $('#spinner-div').show();
    $("#formulaire_ecriture_detail").load(window.location.href + " #formulaire_ecriture_detail" );
    $('#spinner-div').hide();

  }

  function liste_compte_journal(){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'liste_compte_journal'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_compte_journal').html(data.liste_compte_journal);
          $('#nom_compte_search').val('');
          $('#modal_compte').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function nom_compte_search(nom_compte){

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'nom_compte_search', nom_compte: nom_compte},
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

  function select_compte(id_compte, nom_compte){
    
    $('#spinner-div').show();
    $('#modal_compte').modal('hide');
    $('#liste_compte_journal').html('');
    $('#nom_compte').val(nom_compte);
    document.getElementById('nom_compte').classList.remove("is-invalid");
    document.getElementById('nom_compte').classList.remove("text-danger");
    $('#id_compte').val(id_compte);
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

    // const ref_fact_input = document.getElementById('ref_fact');
    // ref_fact_input.setAttribute("disabled", "");
    // const taux_input = document.getElementById('taux');
    // taux_input.setAttribute("disabled", "");
    // document.getElementById("creerFacture").style.display = "none";
    // document.getElementById("dossier").style.display = "block";
    // document.getElementById("detail_facture").style.display = "block";
  // if(confirm('Voulez-vous modifier ce PV ?')) {}

</script>