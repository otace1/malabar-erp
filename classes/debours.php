<?php

include("connexion.php");

$requeteClient = $connexion-> query("SELECT *
							FROM affectation_client_modele_licence
							WHERE id_mod_lic = 2");
while ($reponseClient = $requeteClient-> fetch()) {

	$id_cli = $reponseClient['id_cli'];

	$connexion-> exec("INSERT INTO `affectation_debours_client_modele_licence` 
														(`id_deb`, `id_cli`, `id_mod_lic`, `code_serv`, `montant`, `usd`, `tva`, `detail`, `unite`) VALUES
										(1, $id_cli, 1, NULL, '0.000', '0', '0', '0', 'CIF'),
										(2, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(3, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(4, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(5, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(6, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(7, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(8, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(9, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(10, $id_cli, 2, NULL, '0.000', '1', '0', '0', 'par declaration'),
										(12, $id_cli, 2, NULL, '0.000', '1', '1', '0', 'par declaration'),
										(17, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(18, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(19, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(26, $id_cli, 2, NULL, '0.000', '1', '0', '0', 'par declaration'),
										(28, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(31, $id_cli, 2, NULL, '0.000', '1', '1', '0', 'par declaration'),
										(32, $id_cli, 2, NULL, '0.000', '1', '1', '0', 'par declaration'),
										(48, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(50, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(56, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(57, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(58, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(64, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(66, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(67, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(68, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(69, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(70, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(71, $id_cli, 2, NULL, '0.000', '0', '0', '0', 'CIF'),
										(86, $id_cli, 2, NULL, '0.000', '1', '0', '0', 'par declaration'),
										(87, $id_cli, 2, NULL, '0.000', '1', '0', '0', 'par declaration'),
										(88, $id_cli, 2, NULL, '0.000', '1', '0', '0', 'par declaration'),
										(89, $id_cli, 2, NULL, '0.000', '1', '0', '0', 'par declaration'),
										(90, $id_cli, 2, NULL, '0.000', '1', '1', '0', 'par declaration'),
										(91, $id_cli, 2, NULL, '0.000', '1', '1', '0', 'par declaration'),
										(92, $id_cli, 2, NULL, '0.000', '1', '1', '0', 'par declaration');
						");

}$requeteClient-> closeCursor();

?>