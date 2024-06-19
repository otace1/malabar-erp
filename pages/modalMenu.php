<input type="hidden" id="id_mod_lic_search">
<input type="hidden" id="id_type_lic_search">
<input type="hidden" id="page_search">

<div class="modal fade" id="modal_menuLicence">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header btn-dark">
        <h4 class="modal-title"><img src="../images/certificate.png" width="25px"> Menu Licence </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="id_mod_lic_search">

          <input type="text" id="mot_cle" class="form-control form-control-sm" placeholder="Ex.: Mining DRC LTD" onkeyup="table_menuLicence_synthese($('#id_mod_lic_search').val(), $('#id_type_lic_search').val(), $('#page_search').val(), this.value);">
          <hr>
          <div class="col-md-12 table-responsive p-0 " style="height: 500px;">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed ">
              <thead>
                  <tr>
                  <tr>
                      <th>#</th>
                      <th>Code</th>
                      <th>Intitule</th>
                  </tr>
              </thead>
              <tbody id="table_menuLicence">
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
  
    function table_menuLicence_synthese(id_mod_lic, id_type_lic, page, mot_cle=null){

      $('#id_mod_lic_search').val(id_mod_lic);
      $('#id_type_lic_search').val(id_type_lic);
      $('#page_search').val(page);

      // let id_mod_lic = $('#id_mod_lic_search').val();
      // let id_type_lic = $('#id_type_lic_search').val();
      // let page = $('#page_search').val();

      $('#spinner-div').show();
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: { id_mod_lic: $('#id_mod_lic_search').val(), id_type_lic: $('#id_type_lic_search').val(), page: $('#page_search').val(), mot_cle: mot_cle, operation: 'table_menuLicence_synthese'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#table_menuLicence').html(data.table_menuLicence);
            $('#modal_menuLicence').modal('show');
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });


    }

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

  // function modal_depense_modele_licence(id_mod_lic){
  //   $.ajax({
  //     type: "POST",
  //     url: "ajax.php",
  //     data: {id_mod_lic: id_mod_lic, operation: 'modal_depense_modele_licence'},
  //     dataType:"json",
  //     success:function(data){
  //       if (data.logout) {
  //         alert(data.logout);
  //         window.location="../deconnexion.php";
  //       }else{
  //         $('#tableau_client_depense_modele_licence').html(data.tableau_client_depense_modele_licence);
  //         $('#modal_depense_modele_licence').modal("show");
  //       }
  //     }
  //   });
  // }

  //   function modal_facture(id_cli, id_mod_lic){

  //     $('#spinner-div').show();

  //     $.ajax({
  //       type: "POST",
  //       url: "ajax.php",
  //       data: { id_cli: id_cli, id_mod_lic: id_mod_lic, operation: 'modal_facture'},
  //       dataType:"json",
  //       success:function(data){
  //         if (data.logout) {
  //           alert(data.logout);
  //           window.location="../deconnexion.php";
  //         }else{
  //           $('#tableau_modele_facture').html(data.tableau_modele_facture);
  //           $('#tableau_modele_facture_2').html(data.tableau_modele_facture_2);
  //           $('#modal_facture').modal("show");
  //         }
  //       }
  //     });

  //     $('#spinner-div').hide();

  //   }

  //   function modal_dossier_pending_worksheet(id_mod_lic){

  //     $.ajax({
  //       type: "POST",
  //       url: "ajax.php",
  //       data: {id_mod_lic: id_mod_lic, operation: 'modal_dossier_pending_worksheet'},
  //       dataType:"json",
  //       success:function(data){
  //         if (data.logout) {
  //           alert(data.logout);
  //           window.location="../deconnexion.php";
  //         }else{
  //           $('#tableau_dossier_pending_worksheet').html(data.tableau_dossier_pending_worksheet);
  //           $('#modal_dossier_pending_worksheet').modal("show");
  //         }
  //       }
  //     });


  //   }

  //   function modal_client_worksheet(id_mod_lic){

  //     $.ajax({
  //       type: "POST",
  //       url: "ajax.php",
  //       data: {id_mod_lic: id_mod_lic, operation: 'modal_client_worksheet'},
  //       dataType:"json",
  //       success:function(data){
  //         if (data.logout) {
  //           alert(data.logout);
  //           window.location="../deconnexion.php";
  //         }else{
  //           $('#tableau_client_worksheet').html(data.tableau_client_worksheet);
  //           $('#modal_client_worksheet').modal("show");
  //           $('#id_mod_lic_search').val(id_mod_lic);
  //           document.getElementById("search_client_worksheet").focus();
  //         }
  //       }
  //     });


  //   }

  //   function search_client_worksheet(mot_cle){

  //     $.ajax({
  //       type: "POST",
  //       url: "ajax.php",
  //       data: {id_mod_lic: $('#id_mod_lic_search').val(), mot_cle: mot_cle, operation: 'search_client_worksheet'},
  //       dataType:"json",
  //       success:function(data){
  //         if (data.logout) {
  //           alert(data.logout);
  //           window.location="../deconnexion.php";
  //         }else{
  //           $('#tableau_client_ogefrem').html(data.tableau_client_worksheet);
  //         }
  //       }
  //     });


  //   }

  //   function modal_client_ogefrem(){

  //     $.ajax({
  //       type: "POST",
  //       url: "ajax.php",
  //       data: {operation: 'modal_client_ogefrem'},
  //       dataType:"json",
  //       success:function(data){
  //         if (data.logout) {
  //           alert(data.logout);
  //           window.location="../deconnexion.php";
  //         }else{
  //           $('#tableau_client_ogefrem').html(data.tableau_client_ogefrem);
  //           $('#modal_client_ogefrem').modal("show");
  //           document.getElementById("search_client_ogefrem").focus();
  //         }
  //       }
  //     });


  //   }

  //   function search_client_ogefrem(mot_cle){

  //     $.ajax({
  //       type: "POST",
  //       url: "ajax.php",
  //       data: {mot_cle: mot_cle, operation: 'search_client_ogefrem'},
  //       dataType:"json",
  //       success:function(data){
  //         if (data.logout) {
  //           alert(data.logout);
  //           window.location="../deconnexion.php";
  //         }else{
  //           $('#tableau_client_ogefrem').html(data.tableau_client_ogefrem);
  //         }
  //       }
  //     });


    // }

</script>

