<?php
$connect = mysqli_connect("localhost", "root", "", "malabar_db");
if(isset($_POST["ref_dos"], $_POST["last_name"]))
{

 $ref_dos = mysqli_real_escape_string($connect, $_POST["ref_dos"]);
 $id_mod_trans = mysqli_real_escape_string($connect, $_POST["id_mod_trans"]);
 $id_cli = mysqli_real_escape_string($connect, $_POST["id_cli"]);
 $id_mod_lic = mysqli_real_escape_string($connect, $_POST["id_mod_lic"]);
 $num_lic = mysqli_real_escape_string($connect, $_POST["num_lic"]);
 $id_util = mysqli_real_escape_string($connect, $_POST["id_util"]);

 $last_name = mysqli_real_escape_string($connect, $_POST["last_name"]);

 $query = "INSERT INTO dossier(ref_dos, id_mod_trans, id_cli, id_mod_lic, num_lic, id_util) VALUES('$ref_dos', '$id_mod_trans', '$id_cli', '$id_mod_lic', '$num_lic', '$id_util')";

 if(mysqli_query($connect, $query))
 {
  echo 'Dossier créé avec succès!';
 }
}
?>