
INSERT INTO `affectation_client_modele_licence` (`id_cli`, `id_mod_lic`, `id_etat`) 
	VALUES ('845', '1', '1');

INSERT INTO `licence` (`num_lic`, `date_creat_lic`, `date_val`, `fob`, `fret`, `assurance`, `autre_frais`, `tonnage`, `poids`, `unit_mes`, `fsi`, `aur`, `acheteur`, `fournisseur`, `provenance`, `ref_fact`, `date_fact`, `fichier_fact`, `id_mod_paie`, `id_cli`, `id_march`, `commodity`, `qte_decl`, `fichier_lic`, `id_mod_lic`, `id_mon`, `id_et_lic`, `rc`, `id_util`, `id_banq`, `id_post`, `id_mod_trans`, `id_type_lic`, `id_sous_type_paie`, `remarque`, `under_value`, `active`, `comment`, `destination`, `apurement`, `seuil_alert`, `affichier_tracking`) 
	VALUES ('DEC0989268-DC3E5D2B-EB', current_timestamp(), '2021-07-31', NULL, NULL, NULL, NULL, '1', '920', 'T', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '845', '13', NULL, NULL, NULL, '1', '1', '1', NULL, '1', '7', NULL, '1', '1', NULL, NULL, '0', '1', NULL, NULL, '0', NULL, '1');

INSERT INTO `expiration_licence` (`id_date_exp`, `date_creat`, `date_exp`, `num_lic`, `id_etat`) 
	VALUES (NULL, current_timestamp(), '2022-01-31', 'DEC0989268-DC3E5D2B-EB', '1');


INSERT INTO `licence` (`num_lic`, `date_creat_lic`, `date_val`, `fob`, `fret`, `assurance`, `autre_frais`, `tonnage`, `poids`, `unit_mes`, `fsi`, `aur`, `acheteur`, `fournisseur`, `provenance`, `ref_fact`, `date_fact`, `fichier_fact`, `id_mod_paie`, `id_cli`, `id_march`, `commodity`, `qte_decl`, `fichier_lic`, `id_mod_lic`, `id_mon`, `id_et_lic`, `rc`, `id_util`, `id_banq`, `id_post`, `id_mod_trans`, `id_type_lic`, `id_sous_type_paie`, `remarque`, `under_value`, `active`, `comment`, `destination`, `apurement`, `seuil_alert`, `affichier_tracking`) 
	VALUES ('DEC0974366-4871-EB', current_timestamp(), '2021-04-26', NULL, NULL, NULL, NULL, '1', '2150', 'T', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '845', '1', NULL, NULL, NULL, '1', '1', '1', NULL, '1', '7', NULL, '1', '1', NULL, NULL, '0', '1', NULL, NULL, '0', NULL, '1');

INSERT INTO `expiration_licence` (`id_date_exp`, `date_creat`, `date_exp`, `num_lic`, `id_etat`) 
	VALUES (NULL, current_timestamp(), '2022-10-26', 'DEC0974366-4871-EB', '1');


INSERT INTO `licence` (`num_lic`, `date_creat_lic`, `date_val`, `fob`, `fret`, `assurance`, `autre_frais`, `tonnage`, `poids`, `unit_mes`, `fsi`, `aur`, `acheteur`, `fournisseur`, `provenance`, `ref_fact`, `date_fact`, `fichier_fact`, `id_mod_paie`, `id_cli`, `id_march`, `commodity`, `qte_decl`, `fichier_lic`, `id_mod_lic`, `id_mon`, `id_et_lic`, `rc`, `id_util`, `id_banq`, `id_post`, `id_mod_trans`, `id_type_lic`, `id_sous_type_paie`, `remarque`, `under_value`, `active`, `comment`, `destination`, `apurement`, `seuil_alert`, `affichier_tracking`) 
	VALUES ('DEC0945577-B1C7-EB', current_timestamp(), '2021-05-11', NULL, NULL, NULL, NULL, '1', '2150', 'T', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '845', '1', NULL, NULL, NULL, '1', '1', '1', NULL, '1', '7', NULL, '1', '1', NULL, NULL, '0', '1', NULL, NULL, '0', NULL, '1');

INSERT INTO `expiration_licence` (`id_date_exp`, `date_creat`, `date_exp`, `num_lic`, `id_etat`) 
	VALUES (NULL, current_timestamp(), '2022-11-10', 'DEC0945577-B1C7-EB', '1');


ALTER TABLE `affectation_marchandise_client_modele_licence` ADD `code_2` VARCHAR(15) NULL AFTER `code`; 

INSERT INTO `affectation_marchandise_client_modele_licence` (`id_march`, `id_cli`, `id_mod_lic`, `code`, `code_2`, `active`) 
	VALUES ('1', '845', '1', 'EX', 'CU', '1'), ('13', '845', '1', 'EX', 'HC', '1');

