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
          <h5><img src="../images/poignee-de-main.png" width="25px" />
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'CLIENT SETTING | '.$maClasse-> getClient($_GET['id_cli'])['nom_cli'];
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'PARAMETRAGE CLIENT | '.$maClasse-> getClient($_GET['id_cli'])['nom_cli'];
              }
            ?>
          </h5>
          <div class="pull-right">
            <button class="btn btn-xs btn-danger square-btn-adjust" onclick="window.location.replace('client.php');">
                << Return
            </button>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12" id="detail_client">
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <b><?php echo $maClasse-> getClient($_GET['id_cli'])['nom_complet'];?></b>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h5 class="lead"><b><?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?></b></h5>
                      <p class="text-muted text-sm">Code: <b><?php echo $maClasse-> getClient($_GET['id_cli'])['code_cli'];?></b>  </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <b><?php echo $maClasse-> getClient($_GET['id_cli'])['adr_cli'];?></b></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-minus"></i></span> RCCM: <b><?php echo $maClasse-> getClient($_GET['id_cli'])['rccm_cli'];?></b></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-minus"></i></span> Id.Nat: <b><?php echo $maClasse-> getClient($_GET['id_cli'])['id_nat'];?></b></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-minus"></i></span> NIF: <b><?php echo $maClasse-> getClient($_GET['id_cli'])['nif_cli'];?></b></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-minus"></i></span> Import/Export Ref.: <b><?php echo $maClasse-> getClient($_GET['id_cli'])['num_imp_exp'];?></b></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="../images/logo.jpeg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <!-- <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a> -->
                    <a href="#" class="btn btn-sm btn-warning" onclick="modal_edit_detail_client(<?php echo $_GET['id_cli'];;?>);">
                      <i class="fas fa-edit"></i> Edit Profile
                    </a>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="col-md-12">
          <h5>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'Facturation';;
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Invoicing';;
              }
            ?>
          </h5>
          <div class="row">
            <div class="col-md-6">
              <table class="table table-responsive table-bordered small table-sm text-nowrap table-dark table-hover-color">
                <thead>
                    <tr>
                        <th colspan="10">Template</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Intitule</th>
                        <th>Commodity</th>
                        <th>Transport Mode</th>
                        <th>Transit</th>
                        <th style="text-align: center;"><button class="btn btn-xs btn-success" onclick="modal_affectation_modele_facture(<?php echo $_GET['id_cli'];?>);"><i class=" fa fa-plus"></i></button></th>
                    </tr>
                </thead>
                <tbody id="tableau_modele_facture_detail">
                </tbody>
              </table>
            </div>
            <div class="col-md-6" style="display: none;" id="tableau_debours">
              <div class="row">
                <div class="col-md-8">
                  <table class="table table-responsive table-bordered small table-sm table-dark table-hover-color">
                    <thead>
                        <tr>
                            <th colspan="10">Items/Debours</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>TVA</th>
                            <th style="text-align: center;"><button class="btn btn-xs btn-success" onclick="modal_affectation_debours(<?php echo $_GET['id_cli'];?>, id_mod_lic_deb_2.value, id_march_deb.value, id_mod_trans_deb.value);"><i class=" fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="tableau_debours_modele_facture">
                    </tbody>
                  </table>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="x_card_code" class="control-label mb-1">Transit</label>
                      <input id="nom_mod_lic_deb" class="form-control form-control-sm form-control-sm cc-exp" disabled>
                      <input id="id_mod_lic_deb_2" type="hidden">
                    </div>
                    <div class="col-md-12">
                      <label for="x_card_code" class="control-label mb-1">Commodity</label>
                      <input id="nom_march_deb" class="form-control form-control-sm form-control-sm cc-exp" disabled>
                      <input id="id_march_deb" type="hidden">
                    </div>
                    <div class="col-md-12">
                      <label for="x_card_code" class="control-label mb-1">Transport Mode</label>
                      <input id="nom_mod_trans_deb" class="form-control form-control-sm form-control-sm cc-exp" disabled>
                      <input id="id_mod_trans_deb" type="hidden">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>

<div class="modal fade" id="modal_affectation_modele_facture">
  <div class="modal-dialog modal-lg">
    <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Template</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Template</label>
            <select id="id_mod_fact_fact" onchange="" class="form-control form-control-sm cc-exp">
              <option></option>
                <?php
                  $maClasse->selectionnerNewModeleFactureClient($_GET['id_cli']);
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Commodity</label>
            <select id="id_march" onchange="" class="form-control form-control-sm cc-exp">
              <option></option>
                <?php
                  $maClasse->selectionnerMarchandiseClient($_GET['id_cli']);
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Transport</label>
            <select id="id_mod_trans" onchange="" class="form-control form-control-sm cc-exp">
              <option></option>
                <?php
                  $maClasse->selectionnerModeTransport();
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <span type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</span>
        <span type="submit" class="btn btn-primary btn-xs" onclick="creerAffectationModeleFacture(id_mod_fact_fact.value, <?php echo $_GET['id_cli'];?>, id_march.value, id_mod_trans.value);">Submit</span>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_affectation_debours">
  <div class="modal-dialog modal-md">
    <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Item/Debours</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Item/Debours</label>
            <span id="select_debours"></span>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Amount</label>
            <input id="montant_deb" type="number" step="0.01" min="0" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Currency</label>
            <select id="usd_deb" onchange="" class="form-control form-control-sm cc-exp">
              <option></option>
              <option value="1">USD</option>
              <option value="0">CDF</option>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">TVA</label>
            <select id="tva_deb" onchange="" class="form-control form-control-sm cc-exp">
              <option></option>
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <span type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</span>
        <span type="submit" class="btn btn-primary btn-xs" onclick="creerAffectationDebours(id_deb.value, <?php echo $_GET['id_cli'];?>, id_march_deb.value, id_mod_trans_deb.value, montant_deb.value, usd_deb.value, tva_deb.value, id_mod_lic_deb_2.value);">Submit</span>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_edit_detail_client">
  <div class="modal-dialog modal-lg">
    <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Complet Name</label>
            <input id="nom_complet" type="text" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Short Name</label>
            <input id="nom_cli" type="text" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Code</label>
            <input id="code_cli" type="text" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">RCCM</label>
            <input id="rccm_cli" type="text" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">NIF</label>
            <input id="nif_cli" type="text" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Id.Nat.</label>
            <input id="id_nat" type="text" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Num.Import-Export</label>
            <input id="num_imp_exp" type="text" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Address</label>
            <textarea id="adr_cli" type="text" class="form-control form-control-sm cc-exp"></textarea>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <span type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</span>
        <span type="submit" class="btn btn-primary btn-xs" onclick="editClient(<?php echo $_GET['id_cli'];?>, nom_complet.value, nom_cli.value, code_cli.value, rccm_cli.value, nif_cli.value, id_nat.value, num_imp_exp.value, adr_cli.value);">Submit</span>
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
    data: {operation: 'modal_facture_client', id_cli: <?php echo $_GET['id_cli'];?>},
    dataType: 'json',
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        $('#tableau_modele_facture_detail').html(data.tableau_modele_facture_detail);
        $('#spinner-div').hide();//Request is complete so hide spinner
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });
});

function viewDebours(id_cli, id_mod_lic, id_march, id_mod_trans){
  $('#spinner-div').show();
  $.ajax({
    type: 'post',
    url: 'ajax.php',
    data: {id_cli: id_cli, id_mod_lic: id_mod_lic, id_march: id_march, id_mod_trans: id_mod_trans, operation: 'view_debours_modele_facture'},
    dataType: 'json',
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        document.getElementById('tableau_debours').style.display = 'block';
        $('#tableau_debours_modele_facture').html(data.tableau_debours_modele_facture);
        $('#id_mod_lic_deb_2').val(id_mod_lic);
        $('#id_march_deb').val(id_march);
        $('#id_mod_trans_deb').val(id_mod_trans);
        $('#nom_mod_trans_deb').val(data.nom_mod_trans);
        $('#nom_march_deb').val(data.nom_march);
        $('#nom_mod_lic_deb').val(data.nom_mod_lic);
        $('#spinner-div').hide();//Request is complete so hide spinner
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });
}

function modal_affectation_modele_facture(id_cli){
  $('#modal_affectation_modele_facture').modal('show');
}

function modal_edit_detail_client(id_cli){
  $.ajax({
    type: 'post',
    url: 'ajax.php',
    data: {id_cli: id_cli, operation: 'modal_edit_detail_client'},
    dataType: 'json',
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        $('#nom_cli').val(data.nom_cli);
        $('#nom_complet').val(data.nom_complet);
        $('#code_cli').val(data.code_cli);
        $('#adr_cli').val(data.adr_cli);
        $('#rccm_cli').val(data.rccm_cli);
        $('#nif_cli').val(data.nif_cli);
        $('#id_nat').val(data.id_nat);
        $('#num_imp_exp').val(data.num_imp_exp);
        $('#spinner-div').hide();//Request is complete so hide spinner
      }
    },
    complete: function () {
        $('#modal_edit_detail_client').modal('show');
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });

}

function creerAffectationModeleFacture(id_mod_fact, id_cli, id_march, id_mod_trans){
  if(confirm('Do really you want to submit ?')) {
    if ($('#id_mod_fact').val()===null || $('#id_mod_fact').val()==='' ) {

      alert('Error !! Please select the template.');

    }else if ($('#id_march').val()===null || $('#id_march').val()==='' ) {

      alert('Error !! Please select the commodity.');

    }else if ($('#id_mod_trans').val()===null || $('#id_mod_trans').val()==='' ) {

      alert('Error !! Please select the transport mode.');

    }else{

        $('#spinner-div').show();
        $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: {id_cli: id_cli, id_mod_fact: id_mod_fact, id_march: id_march, id_mod_trans: id_mod_trans, operation: 'creerAffectationModeleFacture'},
          dataType: 'json',
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#modal_affectation_modele_facture').modal('hide');
              $('#tableau_modele_facture_detail').html(data.tableau_modele_facture_detail);
              $('#spinner-div').hide();//Request is complete so hide spinner
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

    }
  }

}
  
function modal_affectation_debours(id_cli, id_mod_lic, id_march, id_mod_trans){
  $('#spinner-div').show();

  $.ajax({
    type: 'post',
    url: 'ajax.php',
    data: {id_cli: id_cli, id_mod_lic: id_mod_lic, id_march: id_march, id_mod_trans: id_mod_trans, operation: 'modal_affectation_debours'},
    dataType: 'json',
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        $('#select_debours').html(data.select_debours);
        $('#modal_affectation_debours').modal('show');
        $('#spinner-div').hide();//Request is complete so hide spinner
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });
}

function creerAffectationDebours(id_deb, id_cli, id_march, id_mod_trans, montant, usd, tva, id_mod_lic){

  if ($('#id_deb').val()===null || $('#id_deb').val()==='' ) {

    alert('Error !! Please select an item.');

  }else if ($('#usd_deb').val()===null || $('#usd_deb').val()==='' ) {

    alert('Error !! Please select the currency.');

  }else if ($('#tva_deb').val()===null || $('#tva_deb').val()==='' ) {

    alert('Error !! Please specify the VAT.');

  }else{
    if(confirm('Do really you want to submit ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_cli: id_cli, id_deb: id_deb, montant: montant, usd: usd, tva: tva, id_march: id_march, id_mod_trans: id_mod_trans, id_mod_lic: id_mod_lic, operation: 'creerAffectationDebours'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            // $('#modal_affectation_debours').modal('hide');
            $('#select_debours').html(data.select_debours);
            $('#montant_deb').val('');
            $('#usd_deb').val('');
            $('#tva_deb').val('');
            $('#tableau_debours_modele_facture').html(data.tableau_debours_modele_facture);
            $('#tableau_modele_facture_detail').html(data.tableau_modele_facture_detail);
            $('#spinner-div').hide();//Request is complete so hide spinner
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }


}

function editClient(id_cli, nom_complet, nom_cli, code_cli, rccm_cli, nif_cli, id_nat, num_imp_exp, adr_cli){

  if ($('#nom_complet').val()===null || $('#nom_complet').val()==='' ) {

    alert('Error !! Please enter the complet name.');

  }else if ($('#code_cli').val()===null || $('#code_cli').val()==='' ) {

    alert('Error !! Please enter the client code.');

  }else if ($('#nom_cli').val()===null || $('#nom_cli').val()==='' ) {

    alert('Error !! Please enter the short name.');

  }else if ($('#nif_cli').val()===null || $('#nif_cli').val()==='' ) {

    alert('Error !! Please enter the NIF.');

  }else if ($('#id_nat').val()===null || $('#id_nat').val()==='' ) {

    alert('Error !! Please enter ID.NAT');

  }else{
    if(confirm('Do really you want to submit ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_cli: id_cli, nom_complet: nom_complet, rccm_cli: rccm_cli, nif_cli: nif_cli, id_nat: id_nat, nom_cli: nom_cli, code_cli: code_cli, num_imp_exp: num_imp_exp, adr_cli: adr_cli, operation: 'editClient'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            // $('#modal_affectation_debours').modal('hide');
            $('#modal_edit_detail_client').modal('hide');
            $("#detail_client").load(window.location.href + " #detail_client" );
            alert('Client updated!');
            $('#spinner-div').hide();//Request is complete so hide spinner
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }


}
  
function supprimerAffectationDebours(id_deb, id_cli, id_march, id_mod_trans, id_mod_lic){

  if(confirm('Do really you want to delete ?')) {
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_cli: id_cli, id_deb: id_deb, id_march: id_march, id_mod_trans: id_mod_trans, id_mod_lic: id_mod_lic, operation: 'supprimerAffectationDebours'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#modal_affectation_debours').modal('hide');
          $('#tableau_debours_modele_facture').html(data.tableau_debours_modele_facture);
          $('#tableau_modele_facture_detail').html(data.tableau_modele_facture_detail);
          $('#spinner-div').hide();//Request is complete so hide spinner
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }
  
}
  
function supprimerAffectationModeleFacture(id_mod_fact, id_cli, id_march, id_mod_trans){
  if(confirm('Do really you want to delete ?')) {
    
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_cli: id_cli, id_mod_fact: id_mod_fact, id_march: id_march, id_mod_trans: id_mod_trans, operation: 'supprimerAffectationModeleFacture'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#modal_affectation_modele_facture').modal('hide');
          $('#tableau_modele_facture_detail').html(data.tableau_modele_facture_detail);
          $('#spinner-div').hide();//Request is complete so hide spinner
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });


  }

}
</script>
