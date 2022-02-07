
<div class="">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_dos" value="<?php echo $_GET['id_dos'];?>">
      <input type="hidden" name="ref_dos" value="<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-folder"></i> Documents Dossier <input type="text" value="<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>" disabled="disabled" style="width: 25em; color: white; background-color: black; text-align: center;" class="cc-exp"></h4>
        
      </div>
      <div class="modal-body">
        <div class="row">

          <?php
            $maClasse-> afficherDocumentDossier($_GET['id_mod_trac'], $_GET['id_dos']);
          ?>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" name="archiver" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
