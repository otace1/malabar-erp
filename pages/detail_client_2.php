<?php
  // include("tete.php");
  include("tetePopCDN.php");
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
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5><img src="../images/parametres.png" width="25px"> Settings | <?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?></h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="config_invoice.php">Settings</a></li>
                <li class="breadcrumb-item active"><?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?></li>
              </ol>
            </div>
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
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h5>Template</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="modele_facture_client" class=" table table-bordered table-hover text-nowrap table-head-fixed">
                  <thead>
                    <tr class="">
                      <th>Transit</th>
                      <th>Modele</th>
                      <th>Commodity</th>
                      <th>Transport Mode</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h5>Quotations</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="resume_facture_client" class=" table table-bordered table-hover text-nowrap table-head-fixed"style="cursor:pointer">
                  <thead>
                    <tr class="">
                      <th>Transit</th>
                      <th>Commodity</th>
                      <th>Transport Mode</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                   
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

<div class="modal fade" id="modal_edit_detail_client">
  <div class="modal-dialog modal-lg">
    <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Profil</h4>
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

<div class="modal fade" id="modal_insert_modele_facture">
  <div class="modal-dialog modal-md modal-dialog-scrollable">
    <form id="form_insert_modele_facture" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="insert_modele_facture">
      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Insert Template</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-info">Please choose an existing template to set the quotation parameters.</p>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Client</label>
          <span class="float-right btn-xs btn btn-info" onclick="$('#modal_template_invoice_excl_client').modal('show');"><i class="fa fa-search"></i></span>
          <input id="label_nom_cli" type="text" class="form-control cc-exp form-control-sm" disabled>
          <input type="hidden" name="id_cli_old" id="id_cli_new">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Transit</label>
          <input id="label_nom_mod_lic" type="text" class="form-control cc-exp form-control-sm" disabled>
          <input type="hidden" name="id_mod_lic" id="id_mod_lic_new">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Commodity</label>
          <input id="label_nom_march" type="text" class="form-control cc-exp form-control-sm" disabled>
          <input type="hidden" name="id_march" id="id_march_new">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Mode Transport</label>
          <input id="label_nom_mod_trans" type="text" class="form-control cc-exp form-control-sm" disabled>
          <input type="hidden" name="id_mod_trans" id="id_mod_trans_new">
        </div>
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Template</label>
          <input id="label_nom_mod_fact" type="text" class="form-control cc-exp form-control-sm" disabled>
          <input type="hidden" name="id_mod_fact" id="id_mod_fact_new">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade " id="modal_template_invoice_excl_client">
  <div class="modal-dialog modal-lg">
    <!-- <form method="POST" id="form_" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="operation" value="">
      <input type="hidden" id="id_pv_acte" name="id_pv_acte">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-list"></i> Existing Templates</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
    
        <div class="card-body table-responsive p-0 small">
          <table id="template_invoice_excl_client" width="100%" class=" table table-bordered table-hover  table-sm" style="cursor:pointer">
            <thead>
              <tr>
                <!-- <th style="" width="5%">#</th> -->
                <th style="">Client</th>
                <th style="">Transit</th>
                <th style="">Commodity</th>
                <th style="">Transport Mode</th>
                <th style="">Template</th>
              </tr>
            </thead>
            <tbody>
             
            </tbody>
          </table>
        </div>

      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Close</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_detail_cotation">
  <div class="modal-dialog modal-xl small">
    <!-- <form id="create_assignement_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="create_assignement"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-calculator"></i> Cotation Details <span id="label_cotation"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <span id="detail_cotation"></span>

      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancelled</button>
        <button type="submit" name="rechercheClient" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('#form_insert_modele_facture').submit(function(e){

      e.preventDefault();

       if(confirm('Do you really want to submit ?')) {
          
          $('#spinner-div').show();
          $('#modal_insert_modele_facture').modal('hide');

          var fd = new FormData(this);
          // alert($(this).attr('action'));
          $.ajax({

            url: 'ajax.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                
                $( 'form' ).each(function(){
                    this.reset();
                });

                $('#modele_facture_client').DataTable().ajax.reload();
                $('#resume_facture_client').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
              }
            },
            complete: function () {
                
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });


$('#template_invoice_excl_client').DataTable({
     lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel"></i>',
          className: 'btn btn-success'
        }
    ],
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": true,
  // "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "operation": "template_invoice_excl_client",
          "id_cli": "<?php echo $_GET['id_cli'];?>"
      }
    },
    "columns":[
      // {"data":"compteur"},
      // {"data":"compteur"},
      {"data":"nom_cli"},
      {"data":"nom_mod_lic"},
      {"data":"nom_march"},
      {"data":"nom_mod_trans"},
      {"data":"nom_mod_fact"}
    ] 
  });

let table2 = new DataTable('#template_invoice_excl_client');
 
table2.on('click', 'tbody tr', function () {
    let data = table2.row(this).data();
    $('#id_cli_new').val(data['id_cli']);
    $('#label_nom_cli').val(data['nom_cli']);
    $('#label_nom_mod_lic').val(data['nom_mod_lic']);
    $('#id_mod_lic_new').val(data['id_mod_lic']);
    $('#id_march_new').val(data['id_march']);
    $('#label_nom_march').val(data['nom_march']);
    $('#id_mod_trans_new').val(data['id_mod_trans']);
    $('#label_nom_mod_trans').val(data['nom_mod_trans']);
    $('#id_mod_fact_new').val(data['id_mod_fact']);
    $('#label_nom_mod_fact').val(data['nom_mod_fact']);
    $('#modal_template_invoice_excl_client').modal('hide');
});

  $('#modele_facture_client').DataTable({
     lengthMenu: [
        [15, 25, 50, -1],
        [15, 25, 50, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
      {
        text: '<i class="fa fa-plus"></i> Insert',
        className: 'btn btn-info',
        action: function ( e, dt, node, config ) {
            $('#modal_insert_modele_facture').modal('show');
        }
      },
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        title: 'Template <?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?>',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      }
  ],
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": true,
  "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "operation": "modele_facture_client",
          "id_cli": "<?php echo $_GET['id_cli'];?>"
      }
    },
    order: [[0, 'asc']],
    rowGroup: {
        dataSrc: 0,
        // endRender: function (rows, group) {
        //     var avg =
        //         rows
        //             .data()
        //             .pluck(3)
        //             .reduce((a, b) => a + b.replace(/[^\d]/g, '') * 1, 0) / rows.count() * rows.count();
 
        //     // Use the DataTables number formatter
        //     return (
        //         'Total in group: ' +
        //         DataTable.render.number(null, null, 2, null).display(avg)
        //     );
        // }
    },

    "columns":[
      {"data":"nom_mod_lic"},
      {"data":"nom_mod_fact"},
      {"data":"nom_march"},
      {"data":"nom_mod_trans"},
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ]
  });

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

  function supprimer_aff_debours(id_deb, id_cli, id_mod_lic, id_march, id_mod_trans, montant, usd, tva){
    
    // $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_deb: id_deb, id_cli: id_cli, id_mod_lic: id_mod_lic, id_march: id_march, id_mod_trans: id_mod_trans, operation: 'supprimer_aff_debours'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          modal_detail_cotation(id_cli, id_mod_lic, id_march, id_mod_trans);
          $('#resume_facture_client').DataTable().ajax.reload();
        }
      },
      complete: function () {
          // $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

    // $('#modal_detail_cotation').modal('show');
  }

  function inserer_aff_debours(id_deb, id_cli, id_mod_lic, id_march, id_mod_trans, montant, montant_under_value, usd, tva){
    
    // $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_deb: id_deb, id_cli: id_cli, id_mod_lic: id_mod_lic, id_march: id_march, id_mod_trans: id_mod_trans, montant: montant, montant_under_value: montant_under_value, usd: usd, tva: tva, operation: 'inserer_aff_debours'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          modal_detail_cotation(id_cli, id_mod_lic, id_march, id_mod_trans);
          $('#resume_facture_client').DataTable().ajax.reload();
        }
      },
      complete: function () {
          // $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

    // $('#modal_detail_cotation').modal('show');
  }

  function modal_detail_cotation(id_cli, id_mod_lic, id_march, id_mod_trans){
    
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_cli: id_cli, id_mod_lic: id_mod_lic, id_march: id_march, id_mod_trans: id_mod_trans, operation: 'detail_cotation'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#detail_cotation').html(data.detail_cotation);
          $('#label_cotation').html(data.label_cotation);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

    $('#modal_detail_cotation').modal('show');
  }

  $(document).ready(function(){

    $('#create_assignement_form').submit(function(e){

      e.preventDefault();

       if(confirm('Do you really want to submit ?')) {
          
          $('#spinner-div').show();
          $('#modal_create_assignement').modal('hide');

          var fd = new FormData(this);
          // alert($(this).attr('action'));
          $.ajax({

            url: 'ajax.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                
                $( 'form' ).each(function(){
                    this.reset();
                });

                $('#resume_facture_client').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
              }
            },
            complete: function () {
                
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });

  $('#resume_facture_client').DataTable({
     lengthMenu: [
        [15, 25, 50, -1],
        [15, 25, 50, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        title: 'Cotations <?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?>',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      }
  ],
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": true,
  "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "operation": "resume_facture_client",
          "id_cli": "<?php echo $_GET['id_cli'];?>"
      }
    },
    order: [[0, 'asc']],
    rowGroup: {
        dataSrc: 0,
        // endRender: function (rows, group) {
        //     var avg =
        //         rows
        //             .data()
        //             .pluck(3)
        //             .reduce((a, b) => a + b.replace(/[^\d]/g, '') * 1, 0) / rows.count() * rows.count();
 
        //     // Use the DataTables number formatter
        //     return (
        //         'Total in group: ' +
        //         DataTable.render.number(null, null, 2, null).display(avg)
        //     );
        // }
    },

    "columns":[
      {"data":"nom_mod_lic"},
      {"data":"nom_march"},
      {"data":"nom_mod_trans"},
      {"data":"montant",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      }
    ]
  });
  let table = new DataTable('#resume_facture_client');
  table.on('click', 'tbody tr', function () {
      let data = table.row(this).data();

      modal_detail_cotation(data.id_cli, data.id_mod_lic, data.id_march, data.id_mod_trans);
      
      // alert('You clicked on ' + data[0] + "'s row");
  });

</script>
