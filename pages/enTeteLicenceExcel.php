<tr class="bg bg-dark">
    <th style="border: 1px solid white; background-color: #696969; color: white;">#</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">N.LICENCE</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">SOUSCRIPTEUR</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">DATE VAL.</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">EXTREME VAL.</th>
    <?php
    if($_GET['id_mod_lic'] == '1'){
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white; text-align: center;">ACHETEUR</th>
    <?php  
    }
    if($_GET['id_mod_lic'] == '2'){
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white; text-align: center;">FOURNISSEUR</th>
    <?php  
    }
    if($_GET['id_mod_lic'] != '3'){
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white; text-align: center;">MARCHANDISE</th>
    <?php  
    }
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white;">FOB</th>
    <?php
    if($_GET['id_mod_lic'] == '2'){
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white;">ASSURANCE</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">FRET</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">CIF</th>
    <?php  
    }
    ?>
    <?php
    if($_GET['id_mod_lic'] == '1'){
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white;">QUANTITE DECLAREE(Kg)</th>
    <?php  
    }
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white;">BANQUE</th>
    <?php
    if($_GET['id_mod_lic'] == '1'){
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white;">BALANCE QUANTITE(Kg)</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">BALANCE FOB($)</th>
    <?php  
    }
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white;">DOSSIER(S)</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">BALANCE</th>
    <?php
    if($_GET['id_mod_lic'] == '2'){
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white;">N<sup><u>o</u></sup> FACTURE</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">DATE FACTURE</th>
    <?php  
    }
    ?>
    <th style="border: 1px solid white; background-color: #696969; color: white;">REMARQUE</th>
    <th style="border: 1px solid white; background-color: #696969; color: white;">STATUS</th>
</tr>