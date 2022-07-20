update affectation_colonne_client_modele_licence set id_col = 114 where id_col = 20;

update affectation_colonne_client_modele_licence set id_col = 114 where id_col = 48 and id_mod_lic = 2;

update dossier set klsa_arriv = arrival_date where id_mod_lic = 2 and id_mod_trans <> 1;

update affectation_colonne_client_modele_licence
set id_col = 116
where id_col = 22 or id_col = 92;

update affectation_colonne_client_modele_licence
set id_col = 117
where id_col = 45;

INSERT INTO `affectation_colonne_client_modele_licence` (`id_col`, `id_cli`, `id_mod_lic`, `id_mod_trans`, `rang`, `id_march`) 
VALUES ('118', '845', '2', '1', '10.4', NULL);

update dossier
  set frontiere = 'KASUMBALESA'
  where id_mod_trans = '1';


update dossier
  set frontiere = 'LUANO'
  where id_mod_trans = '3';


update dossier
  set entrepot_frontiere = 'WISKI'
  where id_mod_trans = '1' AND id_mod_lic = '2';


update dossier
  set regime = 'IM4-4000'
  where id_mod_lic = '2' AND temporelle = '0';

