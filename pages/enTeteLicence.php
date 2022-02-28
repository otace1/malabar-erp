<tr class="bg bg-dark">
    <th class="col_1" style="border: 1px solid white; background-color: #222530; color: white;">#</th>
    <th class="col_6_licence" style="border: 1px solid white; background-color: #222530; color: white;">N.LICENCE</th>
    <th style="border: 1px solid white;">SOUSCRIPTEUR</th>
    <th style="border: 1px solid white;">DATE VAL.</th>
    <th style="border: 1px solid white;">EXTREME VAL.</th>
    <?php
    if($_GET['id_mod_lic'] == '1'){
    ?>
    <th style="border: 1px solid white; text-align: center;">ACHETEUR</th>
    <?php  
    }
    if($_GET['id_mod_lic'] == '2'){
    ?>
    <th style="border: 1px solid white; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REF.COD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th style="border: 1px solid white; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOURNISSEUR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <?php  
    }
    if($_GET['id_mod_lic'] != '3'){
    ?>
    <th style="border: 1px solid white; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MARCHANDISE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <?php  
    }
    ?>
    <?php
    if($_GET['id_mod_lic'] == '1'){
        ?>
    <th style="border: 1px solid white;">MEASURE</th>
        <?php
    }else{
        ?>
    <th style="border: 1px solid white;">MONNAIE</th>
    <th style="border: 1px solid white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <?php
    }
    ?>
    <?php
    if($_GET['id_mod_lic'] == '2'){
    ?>
    <th style="border: 1px solid white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ASSURANCE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th style="border: 1px solid white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FRET&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th style="border: 1px solid white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CIF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <?php  
    }
    ?>
    <?php
    if($_GET['id_mod_lic'] == '1'){
    ?>
    <th style="border: 1px solid white;">QUANTITE DECLAREE</th>
    <?php  
    }
    ?>
    <th style="border: 1px solid white;">BANQUE</th>
    <?php
    if($_GET['id_mod_lic'] == '1'){
    ?>
    <th style="border: 1px solid white;">QUANTITE DOSSIERS/SORTIES</th>
    <?php  
    }
    ?>
    <th style="border: 1px solid white;">DOSSIER(S)</th>
    <th style="border: 1px solid white;">BALANCE</th>
    <?php
    if($_GET['id_mod_lic'] == '2'){
    ?>
    <th style="border: 1px solid white;">N<sup><u>o</u></sup> FACTURE</th>
    <th style="border: 1px solid white;">DATE FACTURE</th>
    <?php  
    }
    ?>
    <th style="border: 1px solid white;">REMARQUE</th>
    <th colspan="2" style="border: 1px solid white;">ACTION</th>
</tr>