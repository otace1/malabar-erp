<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

  $_GET['id_mod_lic_fact'] = $maClasse-> getDossier($maClasse-> getDossierFacturePartielle($_GET['ref_fact']))['id_mod_lic'];

  if(isset($_POST['creerFactureDossier'])){

    $maClasse-> supprimerFactureDossier($_POST['ref_fact']);

    if (isset($_POST['nbre']) && ($_POST['nbre']>0)) {
      
      for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

        if ((isset($_GET['note_debit']) && ($_GET['note_debit']=='1')) || ($maClasse-> getDossier($_POST['id_dos_dos_'.$i])['principal']=='0')) {
          
          $note_debit = '1';

        }else{
          
          $note_debit = '0';

        }
        
        if ($i==1) {
          $prefixe = '';
          $maClasse-> creerFactureDossier($prefixe.$_POST['ref_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_GET['id_mod_lic_fact'], 'partielle', $_POST['info'], $note_debit);
        }else{
          $prefixe = ($i-1).'-';
          $maClasse-> creerFactureDossier($prefixe.$_POST['ref_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_GET['id_mod_lic_fact'], 'partielle', $_POST['info'], $note_debit);
        }
        
        $maClasse-> MAJ_roe_decl($_POST['id_dos_dos_'.$i], $_POST['roe_decl_'.$i]);
        $maClasse-> MAJ_fob($_POST['id_dos_dos_'.$i], $_POST['fob_'.$i]);
        $maClasse-> MAJ_fret($_POST['id_dos_dos_'.$i], $_POST['fret_'.$i]);
        $maClasse-> MAJ_assurance($_POST['id_dos_dos_'.$i], $_POST['assurance_'.$i]);
        $maClasse-> MAJ_autre_frais($_POST['id_dos_dos_'.$i], $_POST['autre_frais_'.$i]);
        $maClasse-> MAJ_poids($_POST['id_dos_dos_'.$i], $_POST['poids_'.$i]);

        for ($a=1; $a <= $_POST['sous_compteur_'.$i] ; $a++) { 
          if (isset($_POST['id_deb_'.$a.'_'.$i]) && isset($_POST['montant_'.$a.'_'.$i]) && ($_POST['montant_'.$a.'_'.$i]>0)) {

            if (isset($_POST['detail_'.$a.'_'.$i]) && ($_POST['detail_'.$a.'_'.$i]!='')) {
              $detail = $_POST['detail_'.$a.'_'.$i];
            }else{
              $detail = NULL;
            }

            $maClasse-> creerDetailFactureDossier($prefixe.$_POST['ref_fact'], $_POST['id_dos_dos_'.$i], 
                                                  $_POST['id_deb_'.$a.'_'.$i], $_POST['montant_'.$a.'_'.$i], 
                                                  $_POST['tva_'.$a.'_'.$i], $_POST['usd_'.$a.'_'.$i], $detail);
            //echo '----------------------------------'.$a.' == '.strval($_POST['ref_dos'][$key]).'<br><br>';
          }
        }
      
        // $debours_1 = $_POST['debours_1'];

        // foreach ($debours_1 as $key => $value) {
        //   if (isset($_POST['id_deb_1'][$key]) && isset($_POST['montant_1_'.$i][$key]) && ($_POST['montant_1_'.$i][$key]>0)) {

        //     $maClasse-> creerDetailFactureDossier($prefixe.$_POST['ref_fact'], $_POST['id_dos_'.$i][$key], 
        //                     $_POST['id_deb_1'][$key], $_POST['montant_1_'.$i][$key], $_POST['tva_1_'.$i][$key], $_POST['usd_1_'.$i][$key]);
        //     //echo '----------------------------------'.$a.' == '.strval($_POST['ref_dos'][$key]).'<br><br>';
        //   }
         
        // }
        // unset($value);
        // unset($key);
        // unset($debours_1);

      }

    }


    ?>
    <script type="text/javascript">
      alert('Facture <?php echo $_POST['ref_fact'];?> a été modifiée avec succès!');
    </script>
    <script type="text/javascript">
      window.open('generateurFacturePartielle.php?ref_fact=<?php echo $_POST['ref_fact'];?>','pop1','width=1900,height=900');
    </script>
    <script type="text/javascript">
      window.location='listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']; ?>';
    </script>
    <?php
    
  }

?>

<script type="text/javascript">
  function nextChar(c) {
          if (c == 'Z') {
            return 'A';
          } else {
            return String.fromCharCode(c.charCodeAt(0) + 1);
          }
          
      }
      

      $(document).ready(function(){
        var max = 100;
        var x = 1;
        //var masque = 'A';
        var masque = '';

        $("#add").click(function(){

          if (x<max){


            var html = '<tr style="border: 1px solid black;"><td class="col_debours_1">'+ x +'<input type="hidden" name="debours_1[]"><br>--</td>'
                        +'<td style="border: 0.5px solid black;" class="col_debours_6">'
                        +'<select class="form-control cc-exp" name="id_deb_1[]" required><option></option><?php //echo $maClasse-> selectionnerDebours3($_GET['id_mod_lic_fact']);?></select>'
                        +'</td><?php //echo $maClasse-> afficherLigneDossierFacturePartielle($_GET['id_dos']);?>'+
                        '</tr>';

            $("#table_field").append(html);
            x++;
            //masque=nextChar(masque);

          }

        });

          $("#table_field").on('click','#remove', function(){
            $(this).closest('tr').remove();
            x--;
          });

      });

</script>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5>
            <i class="fa fa-calculator nav-icon"></i> MODIFICATION FACTURE PARTIELLE
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
              </div>
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                
<form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">

  <div class="card-body">

    <div class="row">
      
      <div class="col-md-4">
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label" style="text-align: ;">Client:</label>
            <div class="col-sm-9">  
              <input class="form-control form-control-sm cc-exp bg bg-dark" value="<?php echo $maClasse-> getAllDataDossier($maClasse-> getDossierFacturePartielle($_GET['ref_fact']))['nom_cli'];?>" disabled/>
            </div>
          </div>

      </div>

      <div class="col-md-4">
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label" style="text-align: ;">Facture: </label>
            <div class="col-sm-9">
              <input class="form-control form-control-sm cc-exp bg bg-dark" value="<?php echo $_GET['ref_fact'];?>" disabled/>
              <input type="hidden" name="ref_fact" value="<?php echo $_GET['ref_fact'];?>"/>
            </div>
          </div>

      </div>

      <div class="col-md-4">
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label" style="text-align: ;">Dossier:</label>
            <div class="col-sm-9">  
              <input class="form-control form-control-sm cc-exp bg bg-dark" value="<?php echo $maClasse-> getAllDataDossier($maClasse-> getDossierFacturePartielle($_GET['ref_fact']))['ref_dos'];?>" disabled/>
              <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>"/>
            </div>
          </div>

      </div>

      <div class="col-md-12">
        <hr>
      </div>
    </div>

    </div>  


  <div class="card-body">

    <div class="row">
      <div class="col-md-12">
        
        <?php
          /*if (isset($_GET['id_dos'])) {
            
        ?>

        <button type="button" class="btn-xs btn-warning" name="add" id="add">
          <i class="fa fa-plus"></i>
        </button>
        <div class="card-body table-responsive p-0">
          <table id="table_field" cellspacing="0" width="100%" class="tableau_debours table-dark table-bordered table table-hover text-nowrap table-sm">
            <thead>
              <tr class="bg bg-dark">
                <th style="border: 1px solid white; background-color: #222530; color: white; padding-bottom: 50px; padding-top: 50px;" class="col_debours_1" rowspan="2">#</th>
                <th style="border: 1px solid white; background-color: #222530; color: white; padding-bottom: 50px; padding-top: 50px;" class="col_debours_6" rowspan="2">DEBOURS</th>
                <?php
                  $maClasse-> afficherEnTeteDossierFacturePartielle($_GET['id_dos']);
                ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                  $maClasse-> afficherEnTeteDossierFacturePartielle2($_GET['id_dos']);
                ?>
              </tr>
            </tbody>
          </table>
        </div>
        <?php

          }*/
        ?>

      </div>
    </div>

    <div class="row">
        <div class="col-12">
          <!-- Custom Tabs -->
          <div class="card">
            <!-- <div class="card-header d-flex p-0">
              <h5 class="card-title p-3">Formulaire</h5>
              <ul class="nav nav-pills ml-auto p-2">
                <?php
                  //$maClasse-> afficherBoutonFormulaireFacturePartielle($maClasse-> getDossierFacturePartielle($_GET['ref_fact']));
                ?>
              </ul>
            </div> --><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <?php
                  $maClasse-> afficherFormulaireFacturePartielleEdit($maClasse-> getDossierFacturePartielle($_GET['ref_fact']));
                ?>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- ./card -->
        </div>
        <!-- /.col -->
      </div>
  </div>
<!-- -------VALIDATION FORMULAIRE------- -->

  <div class="modal-footer justify-content-between">
    <span  data-toggle="modal" data-target=".validerCotation"class="btn-xs btn-primary">Valider</span>
  </div>


  <div class="modal fade validerCotation" id="modal-default">
    <div class="modal-dialog">
      <!-- <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <div class="modal-content">
        <div class="modal-header ">
          <h4 class="modal-title"><i class="fa fa-plus"></i> Confirmation.</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">
                Voulez-vous modifier cette Facture ?
              </label>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="creerFactureDossier" class="btn-xs btn-primary">Valider</button>
        </div>
      </div>
      <!-- </form> -->
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<!-- -------FIN VALIDATION FORMULAIRE------- -->

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
  <?php include("pied.php");?>

