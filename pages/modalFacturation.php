
<div class="modal fade modal_facture" id="modal_facture">
  <div class="modal-dialog modal-lg">
    <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="id_mod_lic_fact" value="">
      <input type="hidden" name="id_cli" value="">
      <input type="hidden" name="id_mod_fact" value="">
      <input type="hidden" name="id_march" value="">
      <input type="hidden" name="id_mod_trans" value="">
    <div class="modal-content">
      <div class="modal-header btn-dark">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Invoicing </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <span class="text-md font-weight-bold">Group by Licenses</span>
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small table-head-fixed table-dark">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Commodity</th>
                      <th>Transport</th>
                      <th>License</th>
                      <th>Files</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody id="tableau_modele_facture">
              </tbody>
            </table>
          </div>

          <!-- <div class="col-md-6">
            <span class="text-md font-weight-bold">Group by Declaration Date</span>
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small table-head-fixed table-dark">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Commodity</th>
                      <th>Transport</th>
                      <th>Declaration Date</th>
                      <th>Files</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody id="tableau_modele_facture_2">
              </tbody>
            </table>
          </div> -->
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_client_worksheet">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header btn-dark">
        <h4 class="modal-title"><i class="fa fa-list"></i> Clients </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="text" id="search_client_worksheet" class="form-control form-control-sm" placeholder="e.g.: KAMOA" onkeyup="search_client_worksheet(this.value);">
          <hr>

          <div class="col-md-12 table-responsive p-0 " style="height: 500px;">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Code</th>
                      <th>Client</th>
                      <!-- <th>Pending Files</th> -->
                      <!-- <th colspan="2">Action</th> -->
                  </tr>
              </thead>
              <tbody id="tableau_client_worksheet">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_client_ogefrem">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header btn-dark">
        <h4 class="modal-title"><i class="fa fa-list"></i> Clients </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="text" id="search_client_ogefrem" class="form-control form-control-sm" placeholder="e.g.: KAMOA" onkeyup="search_client_ogefrem(this.value);">
          <hr>

          <div class="col-md-12 table-responsive p-0 " style="height: 500px;">
            <table class="table table-bordered table-striped text-nowrap table-hover  text-nowrap table-head-fixed table-dark">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Code</th>
                      <th>Client</th>
                      <!-- <th>Pending Files</th> -->
                      <!-- <th colspan="2">Action</th> -->
                  </tr>
              </thead>
              <tbody id="tableau_client_ogefrem">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_depense_modele_licence">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header btn-dark">
        <h4 class="modal-title"><i class="fa fa-list"></i> Clients </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12 table-responsive p-0 " style="height: 500px;">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Code</th>
                      <th>Client</th>
                      <th></th>
                      <!-- <th>Pending Files</th> -->
                      <!-- <th colspan="2">Action</th> -->
                  </tr>
              </thead>
              <tbody id="tableau_client_depense_modele_licence">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_client_rapport_invoice">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header btn-dark">
        <h4 class="modal-title"><i class="fa fa-list"></i> Clients </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="id_mod_lic_search">

          <input type="text" id="search_client_rapport_invoice" class="form-control form-control-sm" placeholder="e.g.: KAMOA" onkeyup="search_client_rapport_invoice(this.value);">
          <hr>
          <div class="col-md-12 table-responsive p-0 " style="height: 500px;">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
              <thead>
                  <tr>
                  <tr>
                      <th>#</th>
                      <th>Code</th>
                      <th>Client</th>
                      <!-- <th>Pending Files</th> -->
                      <!-- <th colspan="2">Action</th> -->
                  </tr>
              </thead>
              <tbody id="tableau_client_rapport_invoice">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  
    // function menuLicence(id_mod_lic, mot_cle=null){

    //   $('#spinner-div').show();
    //   $.ajax({
    //     type: "POST",
    //     url: "ajax.php",
    //     data: { id_mod_lic: id_mod_lic, mot_cle: mot_cle, operation: 'menuLicence'},
    //     dataType:"json",
    //     success:function(data){
    //       if (data.logout) {
    //         alert(data.logout);
    //         window.location="../deconnexion.php";
    //       }else{
    //         $('#id_mod_lic_search').val(id_mod_lic);
    //         console.log($('#id_mod_lic_search').val());
    //         $('#table_menuLicence').html(data.table_menuLicence);
    //         $('#modal_menuLicence').modal('show');
    //       }
    //     },
    //     complete: function () {
    //         $('#spinner-div').hide();//Request is complete so hide spinner
    //     }
    //   });


    // }

  function modal_depense_modele_licence(id_mod_lic){
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_mod_lic: id_mod_lic, operation: 'modal_depense_modele_licence'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#tableau_client_depense_modele_licence').html(data.tableau_client_depense_modele_licence);
          $('#modal_depense_modele_licence').modal("show");
        }
      }
    });
  }

    function modal_facture(id_cli, id_mod_lic){

      $('#spinner-div').show();

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: { id_cli: id_cli, id_mod_lic: id_mod_lic, operation: 'modal_facture'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#tableau_modele_facture').html(data.tableau_modele_facture);
            $('#tableau_modele_facture_2').html(data.tableau_modele_facture_2);
            $('#modal_facture').modal("show");
          }
        }
      });

      $('#spinner-div').hide();

    }

    function modal_dossier_pending_worksheet(id_mod_lic){

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {id_mod_lic: id_mod_lic, operation: 'modal_dossier_pending_worksheet'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#tableau_dossier_pending_worksheet').html(data.tableau_dossier_pending_worksheet);
            $('#modal_dossier_pending_worksheet').modal("show");
          }
        }
      });


    }

    function modal_client_worksheet(id_mod_lic){

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {id_mod_lic: id_mod_lic, operation: 'modal_client_worksheet'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#tableau_client_worksheet').html(data.tableau_client_worksheet);
            $('#modal_client_worksheet').modal("show");
            $('#id_mod_lic_search').val(id_mod_lic);
            document.getElementById("search_client_worksheet").focus();
          }
        }
      });


    }

    function search_client_worksheet(mot_cle){

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {id_mod_lic: $('#id_mod_lic_search').val(), mot_cle: mot_cle, operation: 'search_client_worksheet'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#tableau_client_ogefrem').html(data.tableau_client_worksheet);
          }
        }
      });


    }

    function modal_client_ogefrem(){

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {operation: 'modal_client_ogefrem'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#tableau_client_ogefrem').html(data.tableau_client_ogefrem);
            $('#modal_client_ogefrem').modal("show");
            document.getElementById("search_client_ogefrem").focus();
          }
        }
      });


    }

    function search_client_ogefrem(mot_cle){

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {mot_cle: mot_cle, operation: 'search_client_ogefrem'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#tableau_client_ogefrem').html(data.tableau_client_ogefrem);
          }
        }
      });


    }

</script>

