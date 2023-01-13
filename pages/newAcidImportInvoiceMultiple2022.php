<?php
  include("tete.php");
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
          <h5>
            <i class="fa fa-edit nav-icon"></i> NEW GLOBAL INVOICE <?php echo $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact'])['nom_mod_lic'];?> <span style="padding: 5px;" class="bg bg-dark"> <?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?></span> <span style="padding: 5px;" class="bg bg-dark"><?php echo $maClasse-> getMarchandise($_GET['id_march']);?></span> <span style="padding: 5px;" class="bg bg-dark"><?php echo $maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']);?></span>
          </h5>
        </div>

      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  <?php
                    
                    if(isset($_POST['creerFactureGlobaleMD'])){
                      
                      $maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_cli'], $_SESSION['id_util'], 
                                                      $_GET['id_mod_lic_fact'], 'globale', NULL);
                      $maClasse-> MAJ_taux_facture_dossier($_POST['ref_fact'], $_POST['taux']);

                        for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

                            if (($_POST['honnoraire_'.$i]>0) || ($_POST['seguce_'.$i]>0)) {
                             

                              // if (isset($_POST['roe_decl_'.$i]) && ($_POST['roe_decl_'.$i]>0)) {
                              //   $maClasse-> MAJ_roe_decl($_POST['id_dos_'.$i], $_POST['roe_decl_'.$i]);
                              // }

                              // if (isset($_POST['droits_'.$i]) && ($_POST['droits_'.$i]>0)) {
                              //   $maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], '27', $_POST['droits_'.$i], '0', '0');
                              // }

                              if (isset($_POST['honnoraire_'.$i]) && ($_POST['honnoraire_'.$i]>0)) {
                                $maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], '32', $_POST['honnoraire_'.$i], '1');
                              }

                              if (isset($_POST['seguce_'.$i]) && ($_POST['seguce_'.$i]>0)) {
                                $maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], '60', $_POST['seguce_'.$i], '0');
                              }

                              if (isset($_POST['cout_auxi_'.$i]) && ($_POST['cout_auxi_'.$i]>0)) {
                                $maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], '10', $_POST['cout_auxi_'.$i], '0');
                              }

                              if (isset($_POST['scelle_'.$i]) && ($_POST['scelle_'.$i]>0)) {
                                $maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], '58', $_POST['scelle_'.$i], '0');
                              }


                            }

                        }
                        ?>
                        <script type="text/javascript">
                          alert('Facture <?php echo $_POST['ref_fact'];?> a été créée avec succès!');
                        </script>
                        <script type="text/javascript">
                          window.open('generateurFactureCDM.php?ref_fact=<?php echo $_POST['ref_fact'];?>','pop1','width=1900,height=900');
                        </script>
                        <script type="text/javascript">
                          window.location='listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_march=<?php echo $_GET['id_march'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']; ?>';
                        </script>
                        <?php
                    }

                  ?>
                </h5>

              </div>
              <!-- /.card-header -->

                
                <!-- ------------- --------------- -->

                  <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->

                    <div class="card-body">

                      <div class="row">
                        <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
                        <div class="col-md-3">
                          <label for="inputEmail3" class="col-form-label" style="text-align: right;">Ref.: </label>
                          <input type="text" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>" id="ref_fact" class="form-control form-control-sm bg bg-dark">
                        </div>
                        
                        <div class="col-md-2">
                          <label for="inputEmail3" class="col-form-label" style="text-align: ;">-</label>
                          <span class="btn btn-info  bg-info form-control form-control-sm" id="creerFacture" onclick="creerFacture(ref_fact.value);"><i class="fa fa-check"></i></span>
                        </div>

                        <div class="col-md-12"></div>
                      </div>
                        <div style="display: none;" id="dossier">
                          <div class="row">
                            <div class="col-md-3">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">File Ref.:</label>
                              <div class="input-group input-group-sm" id="dossiers_a_facturer">
                                
                              </div>
                            </div>

                            <div class="col-md-3">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Truck:</label>
                              <input class="form-control form-control-sm cc-exp bg" id="camion" disabled/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Declaration:</label>
                              <input class="form-control form-control-sm cc-exp bg" id="declaration" disabled/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Liquidation:</label>
                              <input class="form-control form-control-sm cc-exp bg" id="liquidation" disabled/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Quittance:</label>
                              <input class="form-control form-control-sm cc-exp bg" id="quittance" disabled/>
                            </div>

                            <div class="col-md-12"><hr></div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Rate:</label>
                              <input id="roe_decl" class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">DDI(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="ddi" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">RLS(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="rls" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">QPT(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="qpt" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">TPI(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="tpi" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">COG(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="cog" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">RCO(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="rco" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">CSO(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="cso" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">RII(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="rii" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">RET(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="ret" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">RAN(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="ran" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">ANA(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="ana" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">LAB(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="lab" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">ROC(CDF):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" min="0" id="roc" onblur="total();"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Total Liq. CDF:</label>
                              <input class="form-control form-control-sm cc-exp bg bg-secondary text-lg" min="0" id="total_liq_cdf" disabled />
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Total Liq. USD:</label>
                              <input class="form-control form-control-sm cc-exp bg bg-secondary text-lg" min="0" id="total_liq_usd" disabled />
                            </div>

                            <div class="col-md-12"><hr></div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Suivi Dossier(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="suivi_dossier"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">OCC Lab(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="occ_lab"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">KLSA(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="scelle"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Quarantaine(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="quarantaine"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Localisation(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="localisation"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">NAC(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="nac"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Total Tax:</label>
                              <input class="form-control form-control-sm cc-exp bg bg-secondary text-lg" disabled style="text-align: center;" id="total_tax"/>
                            </div>

                            <div class="col-md-12"><hr></div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Frais Seguce(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="seguce"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">BIVAC IR(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="bivac"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Operation DGDA(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="dgda"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">OCC Insp. Control(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="occ"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Transit - BorderUSD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="transit"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Operation Cost(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="cout_operation"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Agency Fee(USD):</label>
                              <input class="form-control form-control-sm cc-exp bg bg-dark" type="number" disabled style="text-align: center;" id="frais_agence"/>
                            </div>

                            <div class="col-md-2">
                              <label for="inputEmail3" class="col-form-label" style="text-align: ;">Total Amount:</label>
                              <input class="form-control form-control-sm cc-exp bg bg-purple text-lg" disabled style="text-align: center;" id="total_amount"/>
                            </div>

                          </div>

                        </div>

                        <div class="row">
                        <div class="col-md-12"><hr></div>
                        
                        <div class="col-12" style="display: none;" id="detail_facture">
                            <div>
                              <table width="100%" class="table table-dark table-bordered table-hover text-nowrap table-sm table-head-fixed table-responsive">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>REF. DOSSIER</th>
                                    <th>REF. DECL.</th>
                                    <th>DATE DECL.</th>
                                    <th>PALQUE</th>
                                    <th>MARCHANDISE</th>
                                    <th>HONORAIRE</th>
                                    <th>FRAIS SEGUCE</th>
                                    <th>COUTS AUXIL.</th>
                                    <th>FRAIS SCELLE</th>
                                  </tr>
                                </thead>
                                <tbody id="detail_facture_dossier">
                                  <?php
                                    // $maClasse-> afficherDossierPourFacturationClientModeleLicence($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_mod_trans'], $_GET['id_march']);
                                  ?>
                                </tbody>
                              </table>
                              
                            </div>

                        </div>
                      </div>

                    </div>  


                  <!-- -------VALIDATION FORMULAIRE------- -->

                <!-- ------------- --------------- -->


                  <!-- -------FIN VALIDATION FORMULAIRE------- -->

                  <!-- </form> -->

              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>
<script type="text/javascript">
  
function creerFacture(ref_fact){
  if ($('#ref_fact').val()===null || $('#ref_fact').val()==='' ) {

    alert('Please Entre Invoice Ref.!')

  }else if(confirm('Do you really want to submit ?')) {

    $('#spinner-div').show();

    const ref_fact_input = document.getElementById('ref_fact');
    ref_fact_input.setAttribute("disabled", "");
    document.getElementById("creerFacture").style.display = "none";
    document.getElementById("dossier").style.display = "block";
    document.getElementById("detail_facture").style.display = "block";

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { ref_fact: ref_fact, id_cli: <?php echo $_GET['id_cli'];?>, id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>, id_march: <?php echo $_GET['id_march'];?>, id_mod_trans: <?php echo $_GET['id_mod_trans'];?>, operation: 'creerFactureAcide'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#dossiers_a_facturer').html(data.dossiers_a_facturer);
          // $('#msg_modalite_fss').html(data.msg_modalite_fss);
          // $("#updateModaliteFss").modal("hide");
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
}

function getDataDossier(id_dos){
  $('#spinner-div').show();
  $.ajax({
    type: "POST",
    url: "ajax.php",
    data: { id_dos: id_dos, operation: 'getDataDossier'},
    dataType:"json",
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        // $('#dossiers_a_facturer').html(data.dossiers_a_facturer);
        $('#camion').val(data.camion);
        $('#commodity').val(data.commodity);
        $('#declaration').val(data.declaration);
        $('#liquidation').val(data.liquidation);
        $('#quittance').val(data.quittance);

        $('#suivi_dossier').val(data.suivi_dossier);
        $('#occ_lab').val(data.occ_lab);
        $('#scelle').val(data.scelle);
        $('#quarantaine').val(data.quarantaine);
        $('#localisation').val(data.localisation);
        $('#nac').val(data.nac);

        $('#roe_decl').val(data.roe_decl);
        $('#ddi').val('');
        $('#rls').val('');
        $('#qpt').val('');
        $('#tpi').val('');
        $('#cog').val('');
        $('#rco').val('');
        $('#cso').val('');
        $('#rii').val('');
        $('#ret').val('');
        $('#ran').val('');
        $('#ana').val('');
        $('#lab').val('');
        $('#roc').val('');
        $('#total_liq_cdf').val('');
        $('#total_liq_usd').val('');

        $('#seguce').val(data.seguce);
        $('#bivac').val(data.bivac);
        $('#dgda').val(data.dgda);
        $('#occ').val(data.occ);
        $('#transit').val(data.transit);
        $('#cout_operation').val(data.cout_operation);
        $('#frais_agence').val(data.frais_agence);
      }
    },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
  });
}

function creerDetailFactureDossier(ref_fact, id_dos){
  roe_decl = parseFloat($('#roe_decl').val());
  ddi = parseFloat($('#ddi').val());
  rls = parseFloat($('#rls').val());
  qpt = parseFloat($('#qpt').val());
  tpi = parseFloat($('#tpi').val());
  cog = parseFloat($('#cog').val());
  rco = parseFloat($('#rco').val());
  cso = parseFloat($('#cso').val());
  rii = parseFloat($('#rii').val());
  ret = parseFloat($('#ret').val());
  ran = parseFloat($('#ran').val());
  ana = parseFloat($('#ana').val());
  lab = parseFloat($('#lab').val());
  roc = parseFloat($('#roc').val());
  
  suivi_dossier = parseFloat($('#suivi_dossier').val());
  scelle = parseFloat($('#scelle').val());
  quarantaine = parseFloat($('#quarantaine').val());
  localisation = parseFloat($('#localisation').val());
  nac = parseFloat($('#nac').val());
  
  seguce = parseFloat($('#seguce').val());
  bivac = parseFloat($('#bivac').val());
  dgda = parseFloat($('#dgda').val());
  occ = parseFloat($('#occ').val());
  transit = parseFloat($('#transit').val());
  cout_operation = parseFloat($('#cout_operation').val());
  frais_agence = parseFloat($('#frais_agence').val());


  if (id_dos===null || id_dos==='' ) {

    alert('Veuillez selectionner un dossier !');

  }else{
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_dos: id_dos, roe_decl: roe_decl, ref_fact: ref_fact, ddi: ddi, rls: rls, qpt: qpt, tpi: tpi, cog: cog, rco: rco, cso: cso, rii: rii, ret: ret, ran: ran, ana: ana, lab: lab, roc: roc, suivi_dossier: suivi_dossier, scelle: scelle, quarantaine: quarantaine, localisation: localisation, nac: nac, seguce: seguce, bivac: bivac, dgda: dgda, occ: occ, transit: transit, cout_operation: cout_operation, frais_agence: frais_agence, id_cli: <?php echo $_GET['id_cli'];?>, id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>, id_march: <?php echo $_GET['id_march'];?>, id_mod_trans: <?php echo $_GET['id_mod_trans'];?>, id_mod_fact: <?php echo $_GET['id_mod_fact'];?>, operation: 'creerDetailFactureDossierACID'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#dossiers_a_facturer').html(data.dossiers_a_facturer);
          $('#detail_facture_dossier').html(data.detail_facture_dossier);
          $('#camion').val('');
          $('#commodity').val('');
          $('#declaration').val('');
          $('#liquidation').val('');
          $('#quittance').val('');
          $('#seguce').val('');
          $('#honoraire').val('');
          $('#cout_auxil').val('');
          $('#scelle').val('');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }

}

function cloturer(ref_fact){
  if(confirm('Voulez-vous cloturer cette facture ?')) {
    window.open('generateurFactureCDM.php?ref_fact='+ref_fact,'pop1','width=800,height=600');
    window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
  }
}

function supprimerDetailFactureDossier(ref_fact, id_dos){
  if(confirm('Voulez-vous retirer ce dossier ?')) {
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_dos: id_dos, ref_fact: ref_fact, id_cli: <?php echo $_GET['id_cli'];?>, id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>, id_march: <?php echo $_GET['id_march'];?>, id_mod_trans: <?php echo $_GET['id_mod_trans'];?>, operation: 'supprimerDetailFactureDossier'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#dossiers_a_facturer').html(data.dossiers_a_facturer);
          $('#detail_facture_dossier').html(data.detail_facture_dossier);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }
}

function total(){
  // parseFloat($('#montant_'+i).val())
  if ($('#id_dos').val()===null || $('#id_dos').val()==='' ) {

    alert('Please select the file!');

  }else{

    if (parseFloat($('#roe_decl').val())>0) {
      roe_decl = parseFloat($('#roe_decl').val());
    }else{
      roe_decl=1;
    }

    if (parseFloat($('#ddi').val())>0) {
      ddi = parseFloat($('#ddi').val());
    }else{
      ddi=0;
    }

    if (parseFloat($('#rls').val())>0) {
      rls = parseFloat($('#rls').val());
    }else{
      rls=0;
    }

    if (parseFloat($('#qpt').val())>0) {
      qpt = parseFloat($('#qpt').val());
    }else{
      qpt=0;
    }

    if (parseFloat($('#tpi').val())>0) {
      tpi = parseFloat($('#tpi').val());
    }else{
      tpi=0;
    }

    if (parseFloat($('#cog').val())>0) {
      cog = parseFloat($('#cog').val());
    }else{
      cog=0;
    }

    if (parseFloat($('#rco').val())>0) {
      rco = parseFloat($('#rco').val());
    }else{
      rco=0;
    }

    if (parseFloat($('#cso').val())>0) {
      cso = parseFloat($('#cso').val());
    }else{
      cso=0;
    }

    if (parseFloat($('#rii').val())>0) {
      rii = parseFloat($('#rii').val());
    }else{
      rii=0;
    }

    if (parseFloat($('#ret').val())>0) {
      ret = parseFloat($('#ret').val());
    }else{
      ret=0;
    }

    if (parseFloat($('#ran').val())>0) {
      ran = parseFloat($('#ran').val());
    }else{
      ran=0;
    }

    if (parseFloat($('#ana').val())>0) {
      ana = parseFloat($('#ana').val());
    }else{
      ana=0;
    }

    if (parseFloat($('#lab').val())>0) {
      lab = parseFloat($('#lab').val());
    }else{
      lab=0;
    }

    if (parseFloat($('#roc').val())>0) {
      roc = parseFloat($('#roc').val());
    }else{
      roc=0;
    }

    var total_liq_cdf =  ddi+rls+qpt+tpi+cog+rco+cso+rii+ret+ran+ana+lab+roc;
    var total_liq_usd = total_liq_cdf/roe_decl;

    var suivi_dossier = parseFloat($('#suivi_dossier').val());
    var occ_lab = parseFloat($('#occ_lab').val());
    var scelle = parseFloat($('#scelle').val());
    var quarantaine = parseFloat($('#quarantaine').val());
    var localisation = parseFloat($('#localisation').val());
    var nac = parseFloat($('#nac').val());

    var total_tax = total_liq_usd+suivi_dossier+occ_lab+scelle+quarantaine+localisation+nac;


    if (parseFloat($('#seguce').val())>0) {
      seguce = parseFloat($('#seguce').val());
    }else{
      seguce=0;
    }

    if (parseFloat($('#bivac').val())>0) {
      bivac = parseFloat($('#bivac').val());
    }else{
      bivac=0;
    }

    if (parseFloat($('#dgda').val())>0) {
      dgda = parseFloat($('#dgda').val());
    }else{
      dgda=0;
    }

    if (parseFloat($('#occ').val())>0) {
      occ = parseFloat($('#occ').val());
    }else{
      occ=0;
    }

    if (parseFloat($('#transit').val())>0) {
      transit = parseFloat($('#transit').val());
    }else{
      transit=0;
    }

    if (parseFloat($('#cout_operation').val())>0) {
      cout_operation = parseFloat($('#cout_operation').val());
    }else{
      cout_operation=0;
    }

    if (parseFloat($('#frais_agence').val())>0) {
      frais_agence = parseFloat($('#frais_agence').val());
    }else{
      frais_agence=0;
    }

    total_amount = total_tax+seguce+bivac+dgda+occ+transit+cout_operation+frais_agence;

    $('#total_liq_cdf').val(new Intl.NumberFormat('en-DE').format(Math.round(total_liq_cdf*1000)/1000));
    $('#total_liq_usd').val(new Intl.NumberFormat('en-DE').format(Math.round(total_liq_usd*1000)/1000));
    $('#total_tax').val(new Intl.NumberFormat('en-DE').format(Math.round(total_tax*1000)/1000));
    $('#total_amount').val(new Intl.NumberFormat('en-DE').format(Math.round(total_amount*1000)/1000));

  }

}

</script>
