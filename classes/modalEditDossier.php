
<div class="">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_dos" value="<?php echo $_GET['id_dos'];?>">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit File <input type="text" value="<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>" disabled="disabled" style="width: 25em; color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.replace('dossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_trac']; ?>&commodity=<?php echo $_GET['commodity']; ?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?><?php echo $page;?>','pop1','width=80,height=80');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MCA FILE REF.</label>
            <input type="text" name="ref_dos" value="<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>" class="form-control cc-exp" required>
          </div>

          <?php

          if (($_GET['id_cli']!=869) && ($_GET['id_mod_trac']==2)) {
            ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FOB</label>
              <input type="number" name="fob" step="0.0001" class="form-control cc-exp" value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['fob'];?>" required>
            </div>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FRET</label>
              <input type="number" name="fret" step="0.0001" class="form-control cc-exp" value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['fret'];?>" required>
            </div>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
              <input type="number" name="assurance" step="0.0001" class="form-control cc-exp" value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['assurance'];?>" required>
            </div>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">AUTRES FRAIS</label>
              <input type="number" name="autre_frais" step="0.0001" class="form-control cc-exp" value="<?php echo $maClasse-> getDataDossier($_GET['id_dos'])['autre_frais'];?>" required>
            </div>
            <?php
          }

            $maClasse-> afficherRowDossierUpdate($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_dos']);
          ?>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">REGIME SUSPENSION</label>
              <select name="temporelle" class="form-control cc-exp" required>
                <?php
                if ($maClasse-> getDataDossier($_GET['id_dos'])['temporelle'] == '1') {
                  ?>
                  <option value="1">YES</option>
                  <option value="0">NO</option>
                  <?php
                }else{
                  ?>
                  <option value="0">NO</option>
                  <option value="1">YES</option>
                  <?php
                }
                ?>
              </select>
            </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" name="updateDossier" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
