
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
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
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
