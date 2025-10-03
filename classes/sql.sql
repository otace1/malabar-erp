SELECT id_dos, date_creat_dos, ref_dos, num_lic, cod, ref_crf, fob, ref_decl, date_decl, remarque, cleared
FROM dossier
where cod like '%COD 2024 289037 1%'
and ref_crf is null

DELIMITER $$

CREATE FUNCTION get_site_dossier(id_dos_P INT)

RETURNS VARCHAR(50)
DETERMINISTIC
BEGIN
    DECLARE nom_site_R VARCHAR(50);
    SELECT site.nom_site INTO nom_site_R
	FROM affectation_client_modele_licence aff, dossier dos, site
	WHERE dos.id_dos = id_dos_P
		AND dos.id_cli = aff.id_cli
		AND dos.id_mod_lic = aff.id_mod_lic
		AND aff.id_site = site.id_site;

	RETURN (nom_site_R);
END$$
DELIMITER ;

CREATE FUNCTION get_inv_process_pour_dossier(id_dos_P INT)

RETURNS DECIMAL(30,4)
DETERMINISTIC
BEGIN
    DECLARE id_inv_pro_R INT;
    SELECT aff.id_inv_pro INTO id_inv_pro_R
	FROM affectation_client_modele_licence aff, dossier dos 
	WHERE dos.id_dos = id_dos_P
		AND dos.id_cli = aff.id_cli
		AND dos.id_mod_lic = aff.id_mod_lic;

	RETURN (id_inv_pro_R);
END$$
DELIMITER ;

DELIMITER $$

CREATE FUNCTION get_solde_fob_licence(num_lic_P VARCHAR(50))

RETURNS DECIMAL(30,4)
DETERMINISTIC
BEGIN
    DECLARE solde_fob DECIMAL(30,4);
    SELECT (fob-get_fob_dossier_licence(num_lic)) INTO solde_fob
	FROM licence 
	WHERE num_lic = num_lic_P;

	RETURN (solde_fob);
END$$
DELIMITER ;


DELIMITER $$

CREATE FUNCTION get_fob_dossier_licence(num_lic_P VARCHAR(50))

RETURNS DECIMAL(30,4)
DETERMINISTIC
BEGIN
    DECLARE total_fob DECIMAL(30,4);
    SELECT SUM(fob) INTO total_fob
	FROM dossier 
	WHERE num_lic = num_lic_P;

	RETURN (total_fob);
END$$
DELIMITER ;


DELIMITER $$

CREATE FUNCTION get_montant_total_depense_dossier_DF(id_df_p INT)

RETURNS DECIMAL(30,4)
DETERMINISTIC
BEGIN
    DECLARE total_montant DECIMAL(30,4);
    SELECT SUM(montant) INTO total_montant
	FROM depense_dossier 
	WHERE id_df = id_df_P;

	RETURN (total_montant);
END$$
DELIMITER ;

DELIMITER $$

CREATE FUNCTION get_nbre_file_voucher(id_df_p INT)

RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE nbre_file INT;
    SELECT COUNT(distinct(id_dos)) INTO nbre_file
	FROM depense_dossier 
	WHERE id_df = id_df_P;

	RETURN (nbre_file);
END$$
DELIMITER ;

delimiter //
CREATE PROCEDURE get_nbre_file_voucher (IN id_df_p INT)
   BEGIN
     UPDATE demande_fond
    	SET nbre_file = get_nbre_file_voucher(id_df)
    	WHERE id_df = id_df_p;
    		
   END//
DELIMITER ;

DELIMITER //
	CREATE TRIGGER update_get_nbre_file_voucher_add
		AFTER INSERT
			ON depense_dossier
		FOR EACH ROW
		CALL get_nbre_file_voucher(NEW.id_df)//
		-- vInsert into customer_status(customer_id, status_notes) VALUES(NEW.customer_id, 'ACCOUNT OPENED SUCCESSFULLY')//
DELIMITER ;

DELIMITER //
	CREATE TRIGGER update_get_nbre_file_vouche_delete
		AFTER DELETE
			ON depense_dossier
		FOR EACH ROW
		CALL get_nbre_file_voucher(OLD.id_df)//
		-- vInsert into customer_status(customer_id, status_notes) VALUES(NEW.customer_id, 'ACCOUNT OPENED SUCCESSFULLY')//
DELIMITER ;

DELIMITER //
	CREATE TRIGGER update_get_nbre_file_vouche_update
		AFTER UPDATE
			ON depense_dossier
		FOR EACH ROW
		CALL get_nbre_file_voucher(OLD.id_df)//
		-- vInsert into customer_status(customer_id, status_notes) VALUES(NEW.customer_id, 'ACCOUNT OPENED SUCCESSFULLY')//
DELIMITER ;

UPDATE demande_fond dem
set dem.nbre_file = get_nbre_file_voucher(dem.id_df)
----


--
ALTER TABLE `demande_fond` ADD `nbre_file` INT NULL AFTER `motif_reject_dept`;


DELIMITER $$

CREATE FUNCTION get_nbre_file_voucher(id_df_p INT)

RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE nbre_file INT;
    SELECT COUNT(distinct(id_dos)) INTO nbre_file
	FROM depense_dossier 
	WHERE id_df = id_df_P;

	RETURN (nbre_file);
END$$
DELIMITER ;


--

select l.num_lic, l.fob, count(dos.id_dos), sum(if(dos.fob>0, dos.fob, 0)), l.fob-sum(if(dos.fob>0, dos.fob, 0))
from licence l
	left join dossier dos
    	on substring(l.num_lic, 1, 10) = substring(dos.num_lic, 1, 10)
where year(l.date_val) = 2020
group by substring(l.num_lic, 1, 10)
having round(l.fob) > sum(if(dos.fob>0, dos.fob, 0))

--  ---------------------

select dos.ref_dos AS ref_dos,
	cl.nom_cli AS nom_cli,
    mt.nom_mod_trans AS nom_mod_trans,
    dos.date_preal,
    dos.ref_fact,
    dos.commodity,
    dos.supplier,
    dos.po_ref,
    round(dos.poids, 2),
    round(dos.fob, 2),
    dos.road_manif,
    dos.horse,
    dos.trailer_1,
    dos.trailer_2,
    dos.container,
    dos.regime,
    dos.frontiere,
    dos.klsa_arriv,
    dos.entrepot_frontiere,
    dos.wiski_arriv,
    dos.dispatch_klsa,
    dos.t1,
    dos.t1_date,
    dos.bond_warehouse,
    dos.warehouse_arriv,
    dos.warehouse_dep,
    dos.num_lic,
    dos.ref_crf,
    dos.date_crf,
    dos.ir_crf,
    dos.date_ad,
    dos.date_assurance,
	dos.date_decl,
    dos.ref_decl,
    dos.ref_liq,
    dos.date_liq,
    dos.ref_quit,
    dos.date_quit, 
    dos.dispatch_deliv,
    datediff(if(dos.dispatch_deliv is not null, dos.dispatch_deliv, CURRENT_DATE()), dos.wiski_arriv),
    dos.remarque,
    dos.statut
from dossier dos, client cl, mode_transport mt
where dos.id_cli = cl.id_cli
	and cl.id_cli = 857
	and dos.id_mod_trans = mt.id_mod_trans
    and dos.wiski_arriv BETWEEN '2024-01-01' AND CURRENT_DATE()

    

-- ------------
update dossier
set mca_b_ref = CONCAT(IF(id_mod_trans=1, 'IMP-RR-', IF(id_mod_trans=3, 'IMP-AW-', 'IMP-W-')), SUBSTRING(ref_dos, 1, 3), '24', SUBSTRING(ref_dos, 9))
where ref_dos like '%24-%'
    -- and id_cli =916
	and id_mod_lic = 2
   -- and id_mod_trans = 1
    and mca_b_ref is null
    and (id_cli <> 869 and id_march =11);

update dossier, marchandise
set dossier.mca_b_ref = CONCAT(IF(dossier.id_mod_trans=1, 'IMP-RR-', IF(dossier.id_mod_trans=3, 'IMP-AW-', 'IMP-W-')), SUBSTRING(dossier.ref_dos, 1, 3), '24-', SUBSTRING(dossier.ref_dos, 10))

where dossier.ref_dos like '%24-%'
	and dossier.id_mod_lic = 2
    and dossier.mca_b_ref is null
    and (dossier.id_cli = 869 and dossier.id_march = 11)
    and dossier.id_march = marchandise.id_march;
--group by marchandise.id_march;

update dossier, marchandise
set dossier.mca_b_ref = CONCAT(IF(dossier.id_mod_trans=1, 'IMP-RR-', IF(dossier.id_mod_trans=3, 'IMP-AW-', 'IMP-W-')), SUBSTRING(dossier.ref_dos, 1, 3),'-',marchandise.code, '24', SUBSTRING(dossier.ref_dos, 10))

where (dossier.ref_dos like '%RAC24%' or dossier.ref_dos like '%RLI24%' or dossier.ref_dos like '%RSO24%' or dossier.ref_dos like '%RDL24%')
	and dossier.id_mod_lic = 2
    and dossier.mca_b_ref is null
    and (dossier.id_cli = 869 and dossier.id_march <>11)
    and dossier.id_march = marchandise.id_march;

update dossier, marchandise
set dossier.mca_b_ref = CONCAT(IF(dossier.id_mod_trans=1, 'EXP-RR-', IF(dossier.id_mod_trans=3, 'EXP-AW-', 'EXP-W-')), SUBSTRING(dossier.ref_dos, 1, 3),'-',marchandise.code, '24', SUBSTRING(dossier.ref_dos, 10))

where (dossier.ref_dos like '%RCU24%' or dossier.ref_dos like '%RHC24%' or dossier.ref_dos like '%RAL24%' or dossier.ref_dos like '%RZI24%')
	and dossier.id_mod_lic = 1
    and dossier.mca_b_ref is null
    --and (dossier.id_cli = 869 and dossier.id_march <>11)
    and dossier.id_march = marchandise.id_march;
--group by marchandise.id_march;
-- order by id_dos DESC
-- ------------

SELECT dos.id_dos, dos.ref_dos, dos.commodity, dos.id_march
from dossier dos
where dos.id_mod_lic = 2
	and dos.id_cli = 912
    and dos.id_march is null;

update dossier dos
set dos.id_march = 11
where dos.id_mod_lic = 2
	and dos.id_cli = 918
    and dos.id_march is null;


update licence, dossier 
	set dossier.id_march = 19
WHERE (licence.id_cli=845 )
	and licence.id_mod_lic = 2 
    and (licence.commodity = 'SULPHUR' or licence.commodity = 'CONSOMMABLE' or licence.consommable='1')
    and licence.num_lic = dossier.num_lic
    and dossier.id_march is null


-- kin servere amicongo mmg

CREATE TABLE `malabar_db`.`modele_facture` (`id_mod_fact` INT NOT NULL AUTO_INCREMENT , `nom_mod_fact` VARCHAR(50) NOT NULL , `create_page` VARCHAR(50) NOT NULL , `edit_page` VARCHAR(50) NOT NULL , `view_page` VARCHAR(50) NOT NULL , `id_mod_lic` INT NOT NULL , PRIMARY KEY (`id_mod_fact`), INDEX (`id_mod_lic`)) ENGINE = InnoDB;

ALTER TABLE `modele_facture` ADD FOREIGN KEY (`id_mod_lic`) REFERENCES `modele_licence`(`id_mod_lic`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `modele_facture` (`id_mod_fact`, `nom_mod_fact`, `create_page`, `edit_page`, `view_page`, `id_mod_lic`) 
	VALUES (NULL, 'EXPORT INVOICE-SINGLE FILE - 2022', 'newExportInvoiceSingle2022.php', 'editExportInvoiceSingle2022.php', 'viewExportInvoiceSingle2022.php', '1'), 
		(NULL, 'EXPORT INVOICES-MULTIPLE FILES - 2022', 'newExportInvoiceMultiple2022.php', 'editExportInvoiceMultiple2022.php', 'viewExportInvoiceMultiple2022.php', '1'), 
		(NULL, 'IMPORT INVOICE-SINGLE FILE - 2023', 'newImportInvoiceSingle2023.php', 'editImportInvoiceSingle2023.php', 'viewImportInvoiceSingle2023.php', '2'), 
		(NULL, 'ACID IMPORT INVOICES-MULTIPLE FILES - 2022', 'newAcidImportInvoiceMultiple2022.php', 'editAcidImportInvoiceMultiple2022.php', 'viewAcidImportInvoiceMultiple2022.php', '2');
ALTER TABLE `modele_facture` ADD `id_mod_trans` INT NOT NULL DEFAULT '1' AFTER `id_mod_lic`, ADD INDEX (`id_mod_trans`);
ALTER TABLE `modele_facture` ADD FOREIGN KEY (`id_mod_trans`) REFERENCES `mode_transport`(`id_mod_trans`) ON DELETE RESTRICT ON UPDATE RESTRICT;

DELETE FROM `facture_dossier`;

CREATE TABLE `malabar_db`.`affectation_modele_facture_client_marchandise` (`id_mod_fact` INT NOT NULL AUTO_INCREMENT , `id_cli` INT NOT NULL , `id_march` INT NOT NULL , `date_create` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id_mod_fact`, `id_cli`, `id_march`)) ENGINE = InnoDB;

ALTER TABLE `affectation_modele_facture_client_marchandise` ADD FOREIGN KEY (`id_mod_fact`) REFERENCES `modele_facture`(`id_mod_fact`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `affectation_modele_facture_client_marchandise` ADD FOREIGN KEY (`id_cli`) REFERENCES `client`(`id_cli`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `affectation_modele_facture_client_marchandise` ADD FOREIGN KEY (`id_march`) REFERENCES `marchandise`(`id_march`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `facture_dossier` ADD `id_mod_fact` INT NOT NULL AFTER `id_four`, ADD INDEX (`id_mod_fact`);

ALTER TABLE `facture_dossier` ADD FOREIGN KEY (`id_mod_fact`) REFERENCES `modele_facture`(`id_mod_fact`) ON DELETE CASCADE ON UPDATE CASCADE;

update dossier set not_fact = '1' where year(date_liq) = '2021';
update dossier set not_fact = '1' where month(date_liq) < '10';





-- ------------------------
SELECT deb.abr_deb AS abr_deb, UPPER(REPLACE(deb.nom_deb, '\'', '')) AS nom_deb, 
		deb.id_deb AS id_deb, deb.id_t_deb, type_debours.nom_t_deb
	FROM debours deb, affectation_debours_modele_facture af, type_debours
	WHERE deb.id_deb = af.id_deb
		AND af.id_mod_fact = 1
        AND deb.id_t_deb = type_debours.id_t_deb


select substring_index(ref_dos,'-',-1) from dossier where year(date_creat_dos) = '2022' order by id_dos desc;


select client.nom_cli, marchandise.nom_march, mode_transport.nom_mod_trans
from dossier, client, marchandise, mode_transport
where DATE(dossier.date_creat_dos) > '2022-06-01'
	and dossier.id_mod_lic = 1
    and dossier.id_cli = client.id_cli
    and dossier.id_march = marchandise.id_march
    and dossier.id_mod_trans = mode_transport.id_mod_trans
    and CONCAT(client.id_cli, '-', marchandise.id_march, '-', mode_transport.id_mod_trans) in (
    		select concat(aff.id_cli, '-', aff.id_march, '-', aff.id_mod_trans)
        		from affectation_modele_facture_client_marchandise aff
    	)
group BY client.id_cli, marchandise.id_march, mode_transport.id_mod_trans







select client.nom_cli, marchandise.nom_march, mode_transport.nom_mod_trans
from dossier, client, marchandise, mode_transport
where DATE(dossier.date_creat_dos) > '2022-06-01'
	and dossier.id_mod_lic = 1
    and dossier.id_cli = client.id_cli
    and dossier.id_march = marchandise.id_march
    and dossier.id_mod_trans = mode_transport.id_mod_trans
    -- and CONCAT(client.id_cli, '-', marchandise.id_march, '-', mode_transport.id_mod_trans) 
    
group BY client.id_cli, marchandise.id_march, mode_transport.id_mod_trans
EXCEPT 
    		select cl.nom_cli, m.nom_march, mt.nom_mod_trans
        		from affectation_modele_facture_client_marchandise aff, 
        			client cl, marchandise m, mode_transport mt
        		where aff.id_cli = cl.id_cli
        			and aff.id_march = m.id_march
        			and aff.id_mod_trans = mt.id_mod_trans 




INSERT INTO `affectation_colonne_client_modele_licence` (`id_col`, `id_cli`, `id_mod_lic`, `id_mod_trans`, `rang`, `id_march`) 

select '4', client.id_cli, 2, 1, '13.5', NULL
from client
where client.id_cli not in (select id_cli from affectation_colonne_client_modele_licence where id_col = 4)
	and client.id_cli in (select id_cli from affectation_colonne_client_modele_licence where id_mod_lic = 2 and id_mod_trans = 1)

---- MAJ 31/01/2022 ----
ALTER TABLE `banque` ADD `adr_banq` VARCHAR(150) NULL AFTER `nom_banq`, ADD `swift_banq` VARCHAR(20) NULL AFTER `adr_banq`;

INSERT INTO `banque` (`id_banq`, `nom_banq`, `adr_banq`, `swift_banq`) VALUES (NULL, 'EQUITY BANK CONGO SA', 'LUBUMBASHI, R.D. CONGO', 'PRCBCDKI');

CREATE TABLE `compte_bancaire` (`num_cmpt` VARCHAR(50) NOT NULL , `intitule_cmpt` VARCHAR(50) NOT NULL , `id_banq` INT NOT NULL , PRIMARY KEY (`num_cmpt`), INDEX (`id_banq`)) ENGINE = InnoDB;

ALTER TABLE `compte_bancaire` ADD FOREIGN KEY (`id_banq`) REFERENCES `banque`(`id_banq`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `compte_bancaire` (`num_cmpt`, `intitule_cmpt`, `id_banq`) VALUES ('MALABAR RDC SARL', '00018 - 00016 - 01231051200 - 54', '14');

ALTER TABLE `facture_dossier` ADD `num_cmpt` VARCHAR(50) NOT NULL DEFAULT '00018 - 00016 - 01231051200 - 54' AFTER `date_mail`;

UPDATE `compte_bancaire` SET `num_cmpt` = '00018 - 00016 - 01231051200 - 54', `intitule_cmpt` = 'MALABAR RDC SARL' WHERE `compte_bancaire`.`num_cmpt` = 'MALABAR RDC SARL';

-----

insert into affectation_marchandise_client_modele_licence(id_march, id_cli, id_mod_lic) select 11, id_cli, 2 from client where id_cli not in (select id_cli from affectation_marchandise_client_modele_licence WHERE id_mod_lic = 2 ) and id_cli in ( select id_cli from affectation_client_modele_licence where id_mod_lic = 2 );

update dossier, affectation_marchandise_client_modele_licence
	set dossier.id_march = affectation_marchandise_client_modele_licence.id_march
	where dossier.id_march is null
		and dossier.id_cli = affectation_marchandise_client_modele_licence.id_cli
		and dossier.id_mod_lic = affectation_marchandise_client_modele_licence.id_mod_lic
		and dossier.id_mod_lic = 2

select dossier.ref_dos, client.nom_cli, dossier.id_march, dossier.id_mod_trans
from  dossier, affectation_marchandise_client_modele_licence, client
	where dossier.id_march is null
		and dossier.id_cli = affectation_marchandise_client_modele_licence.id_cli
		and dossier.id_mod_lic = affectation_marchandise_client_modele_licence.id_mod_lic
		and dossier.id_mod_lic = 2
		and dossier.id_cli = client.id_cli
group by dossier.id_cli, dossier.id_mod_trans


INSERT INTO `affectation_marchandise_client_modele_licence` (`id_march`, `id_cli`, `id_mod_lic`, `code`, `code_2`, `active`, `compteur_fact`, `annee_fact`) VALUES ('19', '901', '2', NULL, NULL, '1', NULL, NULL);
		
-- -------
update dossier 
	set dossier.id_march = 11
WHERE dossier.id_march IS NULL
	and dossier.id_mod_lic = 2;

update licence, dossier 
	set dossier.id_march = 19
WHERE (licence.id_cli = 901 OR licence.id_cli = 916 OR licence.id_cli=845 OR licence.id_cli=933)
	and licence.id_mod_lic = 2 
    and (licence.commodity = 'SULPHUR' or licence.commodity = 'CONSOMMABLE' or licence.consommable='1')
    and licence.num_lic = dossier.num_lic
 -- ----------------


SELECT dossier.ref_dos, licence.num_lic, dossier.id_march 
FROM licence, dossier 
WHERE (licence.id_cli = 901 OR licence.id_cli=845 )
	and licence.id_mod_lic = 2 
    and (licence.commodity = 'SULPHUR' or licence.commodity = 'CONSOMMABLE')
    and licence.num_lic = dossier.num_lic
    and (YEAR(dossier.date_quit)=2023 or dossier.date_quit is null)


update licence, dossier 
	set dossier.id_march = 19, dossier.not_fact = '0'
WHERE licence.id_cli = 901 
	and licence.id_mod_lic = 2 
    and (licence.commodity = 'SULPHUR' or licence.commodity = 'CONSOMMABLE')
    and licence.num_lic = dossier.num_lic
    and (YEAR(dossier.date_quit)=2023 or dossier.date_quit is null)


update licence, dossier 
	set dossier.id_march = 19
WHERE (licence.id_cli=845 )
	and licence.id_mod_lic = 2 
    and (licence.commodity = 'SULPHUR' or licence.commodity = 'CONSOMMABLE' or licence.consommable='1')
    and licence.num_lic = dossier.num_lic


update dossier
	set not_fact = '0'
	where id_mod_lic = 2
		and (year(date_quit) = 2023 or date_quit is not null)
		and ref_dos not like '%20-%'
		and ref_dos not like '%21-%'
		and fob > 2500
		and cleared <> 2
        and date(date_creat_dos) > '2022-06-01'


update dossier
	set not_fact = '0'
	where id_mod_lic = 2
		and (
				(year(date_quit) = 2023 and date_quit > '2023-01-31') 
				or
				(date_quit is null)
			)
		and ref_dos not like '%20-%'
		and ref_dos not like '%21-%'
		and fob > 2500
		and cleared <> 2
        and date(date_creat_dos) > '2022-12-01'


update dossier
    set not_fact = '0'
    where id_mod_lic = 2
        and id_cli = 864
        -- and not_fact = '0'
        and (date_quit > '2023-02-08' or date_quit is null);

-- -------- Procedure FOB negatif -----------
delimiter //

CREATE PROCEDURE av_fob_negatif (IN consommable INT, OUT nbre INT)
       BEGIN

         SELECT COUNT(part.id_part) INTO nbre
			FROM partielle_av part, licence l
			WHERE part.cod = l.cod
				AND l.consommable = consommable
				-- $sqlClient
				AND part.fob < (
					SELECT SUM(fob)
						FROM dossier 
						WHERE REPLACE(ref_crf, ' ', '') = REPLACE(CONCAT(part.cod,part.num_part), ' ', '')
						GROUP BY REPLACE(ref_crf, ' ', '')
				)

       END//

delimiter ;
-- -------- Fin Procedure FOB negatif -----------

update facture_dossier
set num_cmpt = '00011-00130-00001020614-41'
where (id_mod_lic = 1 and (id_cli = '878' or id_cli = '876'))
	or id_cli = 864;
update facture_dossier
set num_cmpt = '00018 - 00016 - 01231051200 - 54'
where id_cli = 920 or id_cli = 916;



DELETE FROM detail_facture_dossier
WHERE ref_fact = '2023-MKS-EXP-001' and id_deb = '27';

INSERT INTO detail_facture_dossier(ref_fact, id_deb, id_dos, montant, tva, usd)
SELECT '2023-MKS-EXP-001', 15, id_dos, 130, '0', '1'
FROM detail_facture_dossier
WHERE ref_fact = '2023-MKS-EXP-001'
group by id_dos;


update dossier
	set id_march = 11
	where id_march is null;
update licence, dossier 
	set dossier.id_march = 19
WHERE (licence.id_cli = 901 or licence.id_cli = 916 or licence.id_cli = 845)
	and licence.id_mod_lic = 2 
    and (licence.commodity = 'SULPHUR' or licence.commodity = 'CONSOMMABLE' or licence.consommable='1')
    and licence.num_lic = dossier.num_lic
    -- and (YEAR(dossier.date_quit)=2023 or dossier.date_quit is null)







select c.nom_cli, 
	COUNT(IF(d.id_mod_lic=2, d.id_dos, NULL)) AS dossier_import,
	COUNT(IF(d.id_mod_lic=1, d.id_dos, NULL)) AS dossier_export
from dossier d, client c
where d.id_cli = c.id_cli
	and year(d.date_creat_dos) = 2021
group by c.id_cli;




SELECT facture_dossier.ref_fact, facture_dossier.date_fact, detail_facture_dossier.id_dos, detail_facture_dossier.montant, (dossier.poids*50), (detail_facture_dossier.montant / dossier.poids)
FROM detail_facture_dossier, facture_dossier, dossier
WHERE facture_dossier.id_cli = 904
	and facture_dossier.ref_fact = detail_facture_dossier.ref_fact
    and detail_facture_dossier.id_deb = 7
    and detail_facture_dossier.id_dos = dossier.id_dos
    and (detail_facture_dossier.montant / dossier.poids) > 50;

update detail_facture_dossier, facture_dossier, dossier
set detail_facture_dossier.montant = (dossier.poids*50)
WHERE facture_dossier.id_cli = 904
	and facture_dossier.ref_fact = detail_facture_dossier.ref_fact
    and detail_facture_dossier.id_deb = 7
    and detail_facture_dossier.id_dos = dossier.id_dos
    and (detail_facture_dossier.montant / dossier.poids) > 50;

-- ----------------------------

CREATE TABLE `report_type` (
	`id_r_t` INT NOT NULL AUTO_INCREMENT , 
	`nom_r_t` VARCHAR(50) NOT NULL , PRIMARY KEY (`id_r_t`)
) ENGINE = InnoDB;
INSERT INTO `report_type` (`id_r_t`, `nom_r_t`) VALUES (NULL, 'BS'), (NULL, 'P&L');

CREATE TABLE `categorie_compte` (
	`id_cat_cmpte` INT NOT NULL AUTO_INCREMENT , 
	`nom_cat_cmpte` VARCHAR(50) NOT NULL , 
	`id_r_t` INT NOT NULL , 
	PRIMARY KEY (`id_cat_cmpte`), 
	INDEX (`id_r_t`)
) ENGINE = InnoDB;
ALTER TABLE `categorie_compte` 
	ADD FOREIGN KEY (`id_r_t`) REFERENCES `report_type`(`id_r_t`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `categorie_compte` (`id_cat_cmpte`, `nom_cat_cmpte`, `id_r_t`) 
	VALUES (NULL, 'Equity & Liabilities', '1'), 
		(NULL, 'Assets', '1'), 
		(NULL, 'Expense & Loses', '2'), 
		(NULL, 'Incomes', '2');

CREATE TABLE `malabar_db`.`sous_categorie_compte` (
	`id_sous_cat` INT NOT NULL AUTO_INCREMENT , 
	`nom_sous_cat` VARCHAR(50) NOT NULL , 
	`id_cat_cmpte` INT NOT NULL , 
	PRIMARY KEY (`id_sous_cat`), 
	INDEX (`id_cat_cmpte`)
) ENGINE = InnoDB;
ALTER TABLE `sous_categorie_compte` 
	ADD FOREIGN KEY (`id_cat_cmpte`) REFERENCES `categorie_compte`(`id_cat_cmpte`) ON DELETE CASCADE ON UPDATE CASCADE;



SELECT client.nom_cli
from client, affectation_client_modele_licence aff
where client.id_cli = aff.id_cli
	and aff.id_mod_lic = 2
    and client.id_cli not in (
    	select cl.id_cli
        	from client cl, modele_facture md, affectation_modele_facture_client_marchandise af
        	where cl.id_cli = af.id_cli
        		and af.id_mod_fact = md.id_mod_fact
        		and md.id_mod_lic = 2
    )



CREATE TABLE `malabar_db`.`type_facture_liquidation` (`id_fact_liq` INT NOT NULL AUTO_INCREMENT , `nom_fact_liq` VARCHAR(50) NOT NULL , PRIMARY KEY (`id_fact_liq`)) ENGINE = InnoDB;
INSERT INTO `type_facture_liquidation` (`id_fact_liq`, `nom_fact_liq`) VALUES (NULL, '1 Bloc'), (NULL, '2 Bloc Incl. Liquidation'), (NULL, '2 Bloc Excl. Liquidation');\

ALTER TABLE `facture_dossier` CHANGE `with_duty` `id_fact_liq` INT(11) NULL DEFAULT '1';
ALTER TABLE `facture_dossier` ADD INDEX(`id_fact_liq`);
ALTER TABLE `facture_dossier` ADD FOREIGN KEY (`id_fact_liq`) REFERENCES `type_facture_liquidation`(`id_fact_liq`) ON DELETE SET NULL ON UPDATE SET NULL;


INSERT INTO detail_facture_dossier(ref_fact, id_dos, id_deb, montant, tva, usd)
SELECT ref_fact, id_dos, 2, SUM(montant), tva, usd
	FROM detail_facture_dossier
	WHERE ref_fact LIKE '%MMG-EXP%'
		AND (id_deb = 1 OR id_deb = 3 OR id_deb = 4)
		group by ref_fact, id_dos


													IF((SUM(det.debit) IS NOT NULL) OR (SUM(det.credit) IS NOT NULL),
														IF((SUM(IF(det.debit IS NULL, 0, IF(ec.id_mon=c.id_mon, det.debit, IF(ec.id_mon='1', det.debit, det.debit/te.montant))))-SUM(IF(det.credit IS NULL, 0, IF(ec.id_mon=c.id_mon, det.credit, IF(ec.id_mon='1', det.credit, det.credit/te.montant)))))>0,
															(SUM(IF(det.debit IS NULL, 0, IF(ec.id_mon=c.id_mon, det.debit, IF(ec.id_mon='1', det.debit, det.debit/te.montant))))-SUM(IF(det.credit IS NULL, 0, IF(ec.id_mon=c.id_mon, det.credit, IF(ec.id_mon='1', det.credit, det.credit/te.montant))))),
															''
														),
														''
													) AS solde_debit,

													IF((SUM(det.debit) IS NOT NULL) OR (SUM(det.credit) IS NOT NULL),
														IF((SUM(IF(det.credit IS NULL, 0, IF(ec.id_mon=c.id_mon, det.credit, IF(ec.id_mon='1', det.credit, det.credit/te.montant))))-SUM(IF(det.debit IS NULL, 0, IF(ec.id_mon=c.id_mon, det.debit, IF(ec.id_mon='1', det.debit, det.debit/te.montant)))))>0,
															(SUM(IF(det.credit IS NULL, 0, IF(ec.id_mon=c.id_mon, det.credit, IF(ec.id_mon='1', det.credit, det.credit/te.montant))))-SUM(IF(det.debit IS NULL, 0, IF(ec.id_mon=c.id_mon, det.debit, IF(ec.id_mon='1', det.debit, det.debit/te.montant))))),
															''
														),
														''
													) AS solde_credit,
													

----------------------------------------------
 insert into detail_facture_dossier(ref_fact, id_dos, id_deb, montant, tva, usd) 
select det.ref_fact, det.id_dos, 198, 100, '0', '1'
-- SELECT det.* 
	from dossier, detail_facture_dossier det 
    where dossier.container IS NOT NULL 
        and dossier.pied_container = '40' 
        and dossier.id_dos = det.id_dos 
        and det.ref_fact LIKE '2023-MMG-EXP-05%' 
     group by dossier.id_dos;



select fact.ref_fact, fact.date_fact, dos.ref_dos, dos.ref_decl, dos.date_decl, dos.ref_liq, dos.date_liq, dos.ref_quit, dos.date_quit 
from dossier dos, detail_facture_dossier det, facture_dossier fact
where year(dos.date_quit) = 2023
	and dos.id_dos = det.id_dos
	and det.ref_fact = fact.ref_fact
    and fact.id_mod_lic = 1
    AND year(fact.date_fact) = 2024
   group by fact.ref_fact
   order by fact.date_fact ASC
   

   select fact.ref_fact, u.ref_fact_old, u.ref_fact_new
from facture_dossier fact, update_facture_2023 u
where replace(fact.ref_fact, ' ', '') =replace( u.ref_fact_old, ' ', '')

--- BackUp
SELECT dos.ref_dos, dos.date_creat_dos, cl.code_cli, mt.cod_mod_trans, 
	dos.date_preal, dos.ref_fact, dos.commodity, 
    IF(lic.fournisseur IS NOT NULL,
      	lic.fournisseur,
       	dos.supplier
      ) AS fournisseur,
    dos.po_ref, dos.poids, dos.fob, dos.road_manif, dos.horse, dos.trailer_1, dos.trailer_2,
	dos.container, dos.regime, dos.frontiere, dos.klsa_arriv, dos.entrepot_frontiere, dos.wiski_arriv,
    dos.wiski_dep, dos.dispatch_klsa, dos.t1, dos.bond_warehouse, dos.warehouse_arriv, dos.warehouse_dep,
    dos.num_lic, dos.ref_crf, dos.date_crf, dos.ir_crf, dos.date_ad, dos.date_assurance, dos.dgda_in, dos.ref_decl, dos.date_decl, dos.ref_liq, dos.date_liq, dos.ref_quit, dos.date_quit, dos.dgda_out, 
    IF(dos.cleared = '0',
      	'Transit',
       	IF(dos.cleared='1',
          	'Cleared',
           	'Cancelled'
          )
      ),
      dos.dispatch_deliv,
      dos.remarque
FROM dossier dos
	LEFT JOIN client cl
    	ON dos.id_cli = cl.id_cli
    LEFT JOIN mode_transport mt 
    	ON dos.id_mod_trans = mt.id_mod_trans
    LEFT JOIN licence lic
    	ON dos.num_lic = lic.num_lic
WHERE dos.id_mod_lic = 2
ORDER BY dos.date_creat_dos;

-- Transmis apurement sans A/R
SELECT fd.ref_fact AS ref_fact, 
if(fd.id_mod_lic='1', 'Export', 'Import'),
													fd.date_fact AS date_fact,
													cl.nom_cli AS nom_cli,
													IF(fd.validation='0',
														'Pending Validation',
														IF(fd.date_mail IS NULL,
															'Awaiting to send',
															IF(fd.ref_paie IS NULL,
																'Pending Payment',
																'Payed'
																)
															)
														) AS statut,
													CONCAT(CONCAT('<button class=\"btn btn-xs bg-primary square-btn-adjust\" onclick=\"window.open(\'',mf.view_page,'?ref_fact=',fd.ref_fact,'\',\'pop3\',\'width=1000,height=800\');\" title=\"View invoice\">
									                    <i class=\"fas fa-eye\"></i> 
									                </button>'),' ',
									                IF(mf.excel IS NOT NULL, CONCAT('<button class=\"btn btn-xs bg-success square-btn-adjust\" onclick=\"window.location.replace(\'',mf.excel,'?ref_fact=',fd.ref_fact,'\',\'pop4\',\'width=1000,height=800\');\" title=\"Export Annex\">
									                    <i class=\"fas fa-file-excel\"></i> 
									                </button>'), '')) AS view_page,
									                SUM( 
															IF(det.usd='1', 
																det.montant, 
																IF(det.tva='1',
																	IF(det.montant_tva>0,
																		(det.montant_tva+det.montant)/dos.roe_decl,
																		(det.montant)/dos.roe_decl
																	),
																	(det.montant/dos.roe_decl)
																)
															) 
														) AS montant_ht,
									                SUM(
																IF(det.usd='1', 
																	IF(det.tva='1',
																		det.montant*0.16,
																		0
																	), 
																	0
																)
															) AS tva_usd,
									                SUM(
														IF(det.usd='0', 
															IF(det.tva='1',
																IF(det.montant_tva>0,
																	(det.montant_tva+det.montant)/dos.roe_decl,
																	(det.montant*0.16)/dos.roe_decl
																	),
																det.montant/dos.roe_decl
															), 
															IF(det.tva='1',
																det.montant*1.16,
																det.montant
															)
														)
													) AS montant,

													SUM(
														IF(det.usd='1', 
															IF(det.tva='1',
																det.montant*1.16,
																det.montant
															), 
															IF(det.tva='1',
																IF(det.montant_tva>0,
																	((det.montant_tva+det.montant)/dos.roe_decl),
																	(det.montant/dos.roe_decl)*1.16
																),
																(det.montant/dos.roe_decl)
															)
														)
													) AS ttc_usd,

													SUM(
														IF(det.usd='0', 
															IF(det.tva='1',
																IF(det.montant_tva>0,
																	det.montant_tva+det.montant,
																	det.montant*0.16
																	),
																det.montant
															),
															0
														)
													) AS ttc_cdf_2,
													SUM(
														IF(debours.id_t_deb='1',
															IF(det.tva='1',
																IF(det.usd='0',
																	det.montant*1.16,
																	(det.montant*dos.roe_decl)*1.16),
																IF(det.usd='0',
																	det.montant,
																	det.montant*dos.roe_decl)
																)
															, 0)
														) AS duty_cdf_2,
													AVG(dos.roe_decl) AS roe_decl,
													SUM(
														IF(debours.id_t_deb='1' AND det.usd='0',
															det.montant,
															0)
														) AS duty_vat_excl_cdf,
													SUM(
														IF(debours.id_t_deb='1' AND det.usd='0',
															det.montant/dos.roe_decl,
															0)
														) AS duty_vat_excl_usd,
													SUM(
														IF(debours.id_t_deb='1' AND det.usd='0' AND det.tva='1',
															IF(det.montant_tva>0,
																det.montant_tva,
																det.montant*0.16
																),
															0)
														) AS duty_vat_cdf,
													SUM(
														IF(debours.id_t_deb='1' AND det.usd='0' AND det.tva='1',
															IF(det.montant_tva>0,
																det.montant_tva/dos.roe_decl,
																(det.montant*0.16)/dos.roe_decl
																),
															0)
														) AS duty_vat_usd,
													SUM(
														IF(debours.id_t_deb='1' AND det.usd='0',
															IF(det.tva='1',
																IF(det.montant_tva>0,
																	det.montant+det.montant_tva,
																	det.montant*1.16
																),
																det.montant
															),
															0
														)
													) AS total_duty_cdf,
													SUM(
														IF(debours.id_t_deb='1' AND det.usd='0',
															IF(det.tva='1',
																IF(det.montant_tva>0,
																	(det.montant+det.montant_tva)/dos.roe_decl,
																	(det.montant*1.16)/dos.roe_decl
																),
																det.montant/dos.roe_decl
															),
															0
														)
													) AS total_duty_usd,
													SUM(
														IF(debours.id_t_deb='2',
															det.montant,
															0
															)
														) AS other_charge_vat_excl,
													SUM(
														IF(debours.id_t_deb='2' AND det.tva='1',
															det.montant*0.16,
															0
															)
														) AS other_charge_vat,
													SUM(
														IF(debours.id_t_deb='3',
															det.montant,
															0
															)
														) AS ops_vat_excl,
													SUM(
														IF(debours.id_t_deb='3' AND det.tva='1',
															det.montant*0.16,
															0
															)
														) AS ops_vat,
													SUM(
														IF(debours.id_t_deb='4',
															det.montant,
															0
															)
														) AS service_vat_excl,
													SUM(
														IF(debours.id_t_deb='4' AND det.tva='1',
															det.montant*0.16,
															0
															)
														) AS service_vat
												FROM facture_dossier fd, modele_facture mf, client cl, detail_facture_dossier det, dossier dos, debours
												WHERE fd.id_mod_fact = mf.id_mod_fact
													AND fd.id_cli = cl.id_cli
													AND fd.ref_fact = det.ref_fact
													AND debours.id_deb = det.id_deb
													AND det.id_dos = dos.id_dos
												GROUP BY fd.ref_fact
												ORDER BY fd.date_fact DESC

--- ---------------------
-- Update code client
update client, client_2 set client.code_cli = client_2.code where client.id_cli = client_2.id_cli;

-- Dossiers crees en 2024
SELECT dos.id_dos, dos.ref_dos, dos.commodity, dos.id_march, dos.id_cli, COUNT(dos.id_dos)
from dossier dos
where dos.ref_dos like '%24-%'
group by dos.id_cli
order by COUNT(dos.id_dos) DESC

-- Dossiers sans id_march 
SELECT dos.id_dos, dos.ref_dos, dos.commodity, dos.id_march, dos.id_cli, COUNT(dos.id_dos), cl.nom_cli
from dossier dos, client cl
where dos.id_mod_lic = 2
	and dos.id_cli = cl.id_cli
    and dos.id_march is null
group by dos.id_cli
order by COUNT(dos.id_dos) DESC

-- Detail dossiers sans id_march
SELECT dos.id_dos, dos.ref_dos, dos.commodity, dos.id_march
from dossier dos
where dos.id_mod_lic = 2
	and dos.id_cli = 948
    and dos.id_march is null;

-- Update id_march

update licence, dossier 
	set dossier.id_march = 19
WHERE (licence.id_cli=948 )
	and licence.id_mod_lic = 2 
    and (licence.commodity = 'SULPHUR' or licence.commodity = 'CONSOMMABLE' or licence.consommable='1')
    and licence.num_lic = dossier.num_lic
    and dossier.id_march is null;


update dossier dos
set dos.id_march = 11
where dos.id_mod_lic = 2
	and dos.id_cli = 948
    and dos.id_march is null;

--- Update Poids Factures 
Select id_dos, ref_dos, poids 
From dossier 
Where ref_dos = 'CCR-EX23-HC328' 
	or ref_dos = 'CCR-E24-R-CU-060'
	or ref_dos = 'CCR-E24-R-CU-061';

--FERE
update detail_facture_dossier, dossier
set detail_facture_dossier.montant = dossier.poids * 3
where detail_facture_dossier.id_dos = dossier.id_dos
	and detail_facture_dossier.id_deb = 5
	and (
		dossier.ref_dos = 'CCR-EX23-HC328' 
		or dossier.ref_dos = 'CCR-E24-R-CU-060'
		or dossier.ref_dos = 'CCR-E24-R-CU-061'
	);
--LMC 
update detail_facture_dossier, dossier
set detail_facture_dossier.montant = dossier.poids * 5
where detail_facture_dossier.id_dos = dossier.id_dos
	and detail_facture_dossier.id_deb = 6
	and (
		dossier.ref_dos = 'CCR-EX23-HC328' 
		or dossier.ref_dos = 'CCR-E24-R-CU-060'
		or dossier.ref_dos = 'CCR-E24-R-CU-061'
	);
--GOV 
update detail_facture_dossier, dossier
set detail_facture_dossier.montant = dossier.poids * 50
where detail_facture_dossier.id_dos = dossier.id_dos
	and detail_facture_dossier.id_deb = 7
	and (
		dossier.ref_dos = 'CCR-EX23-HC328' 
		or dossier.ref_dos = 'CCR-E24-R-CU-060'
		or dossier.ref_dos = 'CCR-E24-R-CU-061'
	);


210TATA
12345

-- Rapport Debours
select cl.nom_cli,
	ml.nom_mod_lic,
    mt.nom_mod_trans,
    march.nom_march,
    deb.nom_deb,
    td.nom_t_deb,
    aff.montant,
    if(aff.tva='1', aff.montant*0.16, 0) AS tva,
    if(aff.tva='1', aff.montant*1.16, aff.montant) AS total,
    if(aff.usd='1', 'USD', 'CDF') AS usd
from client cl, modele_licence ml, mode_transport mt, marchandise march, debours deb, type_debours td, affectation_debours_client_modele_licence aff
where cl.id_cli = aff.id_cli
	and ml.id_mod_lic = aff.id_mod_lic
    and mt.id_mod_trans = aff.id_mod_trans
    and aff.id_march = march.id_march
    and aff.id_deb = deb.id_deb
    and td.id_t_deb = deb.id_t_deb
order by ml.nom_mod_lic, cl.nom_cli, td.id_t_deb, deb.nom_deb

-- Rapport under value
select dos.ref_dos, fd.ref_fact, dos.num_lic, round(dos.fob_usd, 2), round(dos.roe_decl, 2), dos.id_mon_fob, round(dos.roe_inv, 2), if(dos.id_mon_fob<>'1', round(dos.fob_usd/dos.roe_inv, 2), round(dos.fob_usd, 2)) AS montant_convert,
if(dos.id_mon_fob=1,
	'USD',
	if(dos.id_mon_fob=2, 
		'CDF',
		if(dos.id_mon_fob=3, 
			'ZAR',
			if(dos.id_mon_fob=4, 
				'EUR',
				if(dos.id_mon_fob=6, 
					'GBP',
					if(dos.id_mon_fob=7, 
						'ZAR',
						if(dos.id_mon_fob=8, 
							'AUD',
							''
						)
					)
				)
			)
		)
	)
) AS monnaie

from dossier dos, detail_facture_dossier det, facture_dossier fd
where dos.id_mod_lic = 2
	and length(replace(dos.num_lic, ' ','')) >= 10
    and dos.num_lic not like '%und%'
    and dos.fob_usd > 0
    and dos.roe_decl > 0
    and if(dos.id_mon_fob<>'1', dos.fob_usd/dos.roe_inv, dos.fob_usd) <= 2500
    and det.id_dos = dos.id_dos
    and fd.ref_fact = det.ref_fact
    -- and dos.id_mon_fob = 2
GROUP by dos.id_dos


-- Disable Application Licence invoicing KAMOA
insert into licence(num_lic, id_cli, id_mod_lic, id_mon, fact_suiv_lic)
select distinct(num_lic), 857, 2, 1, '0'
from dossier
where num_lic not in (
	select num_lic 
		from licence

)
and id_cli = 857
and id_mod_lic = 2;


update licence, dossier
	set licence.fact_suiv_lic = '0'
	where licence.num_lic = dossier.num_lic
		and dossier.id_cli = 857
		and dossier.id_mod_lic = 2
		and dossier.ref_dos not like '%23-%'
		and dossier.ref_dos not like '%24-%';


select *
from detail_facture_dossier 
where ref_fact in (
	select ref_fact
        from facture_dossier
        where DATE(date_fact)>='2024-02-17'
            and id_cli = 857
)
and id_dos in (
	select id_dos
    	from dossier
    	where date_quit >='2024-02-01'
    		and id_cli = 857
    		and id_mod_lic = 2
    and ((fob_usd*roe_inv)/roe_decl) >=2500
)
and (
    	(id_deb=143 and montant=30)
);



select id_dos, ref_dos, mca_b_ref, SUBSTR(mca_b_ref, -3), REPLACE(mca_b_ref, SUBSTR(mca_b_ref, -3), concat('0', SUBSTR(mca_b_ref, -3)))
from dossier
where mca_b_ref is not null
order by id_dos desc;

update dossier
set mca_b_ref = REPLACE(mca_b_ref, SUBSTR(mca_b_ref, -3), concat('0', SUBSTR(mca_b_ref, -3)))
where mca_b_ref is not null
-- order by id_dos desc


-- -----------------------------------------
select fd.ref_fact, fd.date_fact, d.ref_dos
from facture_dossier fd, dossier d, detail_facture_dossier det
where fd.id_cli = 869
	and fd.ref_fact = det.ref_fact
	and det.id_dos = d.id_dos
    and det.id_deb = 5




select fd.ref_fact, fd.date_fact, d.ref_dos
from facture_dossier fd, dossier d, detail_facture_dossier det
where fd.id_cli = 869
	and fd.id_mod_lic = 1
    and year(fd.date_fact) = 2024
	and fd.ref_fact = det.ref_fact
	and det.id_dos = d.id_dos
    and d.id_dos not in (
    	select d.id_dos
            from facture_dossier fd, dossier d, detail_facture_dossier det
            where fd.id_cli = 869
                and fd.ref_fact = det.ref_fact
                and det.id_dos = d.id_dos
                and det.id_deb = 5
    ) 
group by d.id_dos


insert into detail_facture_dossier(ref_fact, id_dos, id_deb, montant)

select fd.ref_fact, d.id_dos, 5 , (d.poids*3)
from facture_dossier fd, dossier d, detail_facture_dossier det
where fd.id_cli = 869
	and fd.id_mod_lic = 1
    -- and year(fd.date_fact) = 2024
	and fd.ref_fact = det.ref_fact
	and det.id_dos = d.id_dos
    and d.id_dos not in (
    	select d.id_dos
            from facture_dossier fd, dossier d, detail_facture_dossier det
            where fd.id_cli = 869
                and fd.ref_fact = det.ref_fact
                and det.id_dos = d.id_dos
                and det.id_deb = 5
    ) 
    and d.id_march in (1, 2, 13)
    and year(d.date_creat_dos) = 2024
    and (d.pied_container = 'N/A')
group by d.id_dos
-- -----------------------------------------









select cl.id_cli, cl.nom_cli
from client cl, affectation_client_modele_licence af
where cl.id_cli = af.id_cli
	and af.id_mod_lic = 2
    and af.id_cli not in (

select dos.id_cli
from transmission_apurement ta, detail_apurement da, dossier dos
where ta.id_mod_lic = 2
	and ta.id_trans_ap = da.id_trans_ap
	and da.id_dos = dos.id_dos
group by dos.id_cli

        )



select dos.ref_dos, march.nom_march, mt.nom_mod_trans, dos.commodity, round(dos.poids, 2), dos.ref_fact, dos.nbr_bags, dos.num_lic, 
	dos.road_manif, dos.transporter, dos.destination, dos.horse, dos.trailer_1, dos.trailer_2,
	dos.container, dos.ref_decl, dos.date_decl, dos.ref_liq, dos.date_liq, dos.ref_quit, dos.date_quit,
	dos.drc_exit
from dossier dos, mode_transport mt, marchandise march
where dos.id_mod_lic = 1
	and dos.id_cli = 879
	and dos.id_mod_trans = mt.id_mod_trans
	and dos.id_march = march.id_march



select dos.ref_dos, year(dos.date_creat_dos), march.nom_march, mt.nom_mod_trans, dos.commodity, round(dos.poids, 2), 
		dos.ref_fact, dos.nbr_bags, dos.num_lic, dos.road_manif, dos.transporter, dos.destination, dos.horse, 
		dos.trailer_1, dos.trailer_2, dos.container, dos.ref_decl, dos.date_decl, dos.ref_liq, dos.date_liq, 
		dos.ref_quit, dos.date_quit, dos.exit_drc 
	from dossier dos, mode_transport mt, marchandise march 
	where dos.id_mod_lic = 1 
		and dos.id_cli = 879 
		and dos.id_mod_trans = mt.id_mod_trans 
		and dos.id_march = march.id_march



insert into affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march)

select 131, id_cli, id_mod_lic, id_mod_trans, rang+0.01, id_march
from affectation_colonne_client_modele_licence 
where id_col = 4;


select * from detail_facture_dossier where ref_fact = '2024-KAM-2372' and id_deb in (143, 146);


select l.num_lic, l.ref_fact, cl.nom_cli, dos.num_lic
from licence l
	left join client cl
		on l.id_cli = cl.id_cli
    left join dossier dos
    	on substring(l.num_lic, 1, 10) = substring(dos.num_lic, 1, 10)
where dos.num_lic is null
group by l.num_lic


SELECT lfa.*, substring(replace(lfa.num_lic, ' ', ''), 1, 10), l.num_lic, substring(replace(l.num_lic, ' ', ''), 1, 10), l.fob, SUM(dos.fob), COUNT(dos.id_dos), IF(l.fob IS NOT NULL, l.fob, 0)-sum(dos.fob), CONCAT('Tmp File ', l.num_lic)
FROM licence_force_apurement lfa, licence l, dossier dos
WHERE substring(replace(lfa.num_lic, ' ', ''), 1, 10) = substring(replace(l.num_lic, ' ', ''), 1, 10)
	AND substring(replace(lfa.num_lic, ' ', ''), 1, 10) = substring(replace(dos.num_lic, ' ', ''), 1, 10)
group by substring(replace(lfa.num_lic, ' ', ''), 1, 10)
having IF(l.fob IS NOT NULL, l.fob, 0)-IF(sum(dos.fob) IS NOT NULL, sum(dos.fob), 0) <> '0'


-- Dossier Export
SELECT cl.nom_cli, m.nom_march, YEAR(d.date_creat_dos), d.ref_dos, d.num_lot, d.num_lic, mt.nom_mod_trans, d.road_manif, d.horse, d.trailer_1, d.trailer_2, d.container, d.pied_container, d.transporter, d.nbr_bags, d.poids, d.arrival_date, d.load_date, d.doc_receiv, d.pv_mine, d.demande_attestation, d.assay_date, d.ceec_in, d.ceec_out, d.min_div_in, d.min_div_out, d.ref_decl, d.date_decl, d.ref_liq, d.date_liq, d.ref_quit, d.date_quit, d.dgda_out, d.gov_in, d.gov_out, d.dispatch_date, d.klsa_arriv, d.end_form, d.exit_drc, IF(d.cleared='1', 'Cleared', IF(d.cleared='0', 'Transit', 'Cancelled')), d.statut, d.lmc_id, d.ogefrem_ref_fact, d.remarque
from client cl, dossier d, mode_transport mt, marchandise m
where cl.id_cli = d.id_cli
    and d.id_mod_lic = 1
    -- and cl.id_cli = 845
    and YEAR(d.date_creat_dos) >= 2023
    and d.id_mod_trans = mt.id_mod_trans
    and d.id_march = m.id_march
-- ORDER BY d.id_dos DESC
-- Fin Dossier Export

-- Rapport Licence
select l.num_lic, cl.nom_cli, b.nom_banq, l.date_val, exp.date_exp, round(l.poids, 2) AS poids_licence, 
		round(sum(if(d.poids>0, d.poids, 0)), 2) AS poids_dossier,
        round((l.poids-sum(if(d.poids>0, d.poids, 0))), 2) AS balance_poids, 
        round(l.fob, 2) AS fob_licence, 
        round(sum(if(d.fob>0, d.fob, 0)), 2) AS fob_dossier, 
        round((l.fob-sum(if(d.fob>0, d.fob, 0))), 2) AS balance_fob

from licence l
left join banque b
	on l.id_banq = b.id_banq
    
left join client cl
	on l.id_cli = cl.id_cli
    
left join expiration_licence exp
	on l.num_lic = exp.num_lic
    	and exp.id_etat = '1'
    
left join dossier d
	on substring(l.num_lic, 1, 10) = substring(d.num_lic, 1, 10)

where l.id_mod_lic = 1
group by l.num_lic
order by l.num_lic
-- ---------------------- Rapport ----------------
select deb.nom_deb,
	round(SUM(
           IF(det.usd="1", 
              IF(det.tva="1",
                 det.montant*1.16,
                 det.montant
                ), 
              IF(det.tva="1",
                 (det.montant/dos.roe_decl)*1.16,
                 (det.montant/dos.roe_decl)
                )
             )
       ),2) AS ttc_usd,
   	fd.ref_fact
from detail_facture_dossier det, facture_dossier fd, debours deb, dossier dos
where fd.id_cli = 869
and fd.id_mod_lic = 1
and fd.ref_fact = det.ref_fact
and det.id_deb = deb.id_deb
AND det.id_dos = dos.id_dos
group by det.id_deb, fd.ref_fact




select deb.nom_deb, REPLACE(round(SUM( IF(det.usd="1", IF(det.tva="1", det.montant*1.16, det.montant ), IF(det.tva="1", (det.montant/dos.roe_decl)*1.16, (det.montant/dos.roe_decl) ) ) ),2), '.', ',') AS ttc_usd, fd.ref_fact from detail_facture_dossier det, facture_dossier fd, debours deb, dossier dos where fd.id_cli = 869 and fd.id_mod_lic = 1 and fd.ref_fact = det.ref_fact and det.id_deb = deb.id_deb AND det.id_dos = dos.id_dos group by det.id_deb, fd.ref_fact

-- ---------------------- Rapport ----------------


-- ---------- Rapport Factures --------
SELECT fact.ref_fact AS ref_fact,
	YEAR(fact.date_fact) AS annee,
	Date(fact.date_fact) AS date_fact,
	d.nom_deb AS nom_deb,
	-- det.tva AS tva,
	ROUND(SUM( 
		IF(det.usd="1", 
			det.montant,
			(det.montant/dos.roe_decl)
		) 
	), 2) AS ht_usd,
	ROUND(SUM(
		IF(det.usd="1", 
			IF(det.tva="1",
				det.montant*0.16,
				0
			), 
			IF(det.tva="1",
				(det.montant/dos.roe_decl)*0.16,
				0
			)
		)
	), 2) AS tva_usd,
	ml.nom_mod_lic,
	cl.nom_cli
FROM facture_dossier fact, detail_facture_dossier det, debours d, dossier dos, modele_licence ml, client cl
WHERE year(fact.date_fact) in (2025)
	AND fact.id_cli in (858) 
	AND fact.id_mod_lic = ml.id_mod_lic
	AND fact.id_cli = cl.id_cli
	AND det.ref_fact = fact.ref_fact
	AND det.id_deb = d.id_deb
	AND det.id_dos = dos.id_dos
GROUP BY d.id_deb, fact.ref_fact
ORDER BY d.id_t_deb, d.nom_deb


SELECT year(fact.date_fact), fact.ref_fact AS ref_fact,
	d.nom_deb AS nom_deb,
	-- det.tva AS tva,
	ROUND(SUM( 
		IF(det.usd="1", 
			det.montant,
			(det.montant/dos.roe_decl)
		) 
	), 2) AS ht_usd,
	ROUND(SUM(
		IF(det.usd="1", 
			IF(det.tva="1",
				det.montant*0.16,
				0
			), 
			IF(det.tva="1",
				(det.montant/dos.roe_decl)*0.16,
				0
			)
		)
	), 2) AS tva_usd,
	ml.nom_mod_lic,
	cl.nom_cli
FROM facture_dossier fact, detail_facture_dossier det, debours d, dossier dos, modele_licence ml, client cl
WHERE year(fact.date_fact) in (2024, 2025)
	AND fact.id_cli = 858
	AND fact.id_mod_lic = ml.id_mod_lic
	AND fact.id_cli = cl.id_cli
	AND det.ref_fact = fact.ref_fact
	AND det.id_deb = d.id_deb
	AND det.id_dos = dos.id_dos
GROUP BY d.id_deb, fact.ref_fact
ORDER BY d.id_t_deb, d.nom_deb


-- ---------- FIN Rapport Factures --------



select *
from detail_facture_dossier
where concat(ref_fact,'-',id_dos) in (

	select concat(fd.ref_fact,'-', dos.id_dos)
from facture_dossier fd, detail_facture_dossier det, dossier dos
where det.ref_fact = fd.ref_fact
	and det.id_dos = dos.id_dos
    and det.id_deb = 8
    and date(fd.date_fact) >= '2025-04-27'
    and dos.id_march = 1
)
and id_deb = 8

-- Rapport Charge Back
select dos.ref_dos, df.id_df, df.date_create, dep.nom_dep, depdos.montant, IF(df.usd='1', 'USD', 'CDF'),  IF(df.cash='1', 'Cash', 'Bank'), df.beneficiaire, df.libelle, df.date_visa_dept, df.date_visa_fin, df.date_visa_dir, df.date_decaiss, df.ref_decaiss, df.nom_recep_fond
from dossier dos, depense_dossier depdos, depense dep, demande_fond df
where dos.id_dos = depdos.id_dos
	and depdos.id_dep = dep.id_dep
    and depdos.id_df = df.id_df
    and df.a_facturer = '1'
    and df.date_reject_dept is null






INSERT INTO `detail_facture_dossier` (`ref_fact`, `id_dos`, `id_deb`, `detail`, `montant`, `montant_tva`, `tva`, `usd`, `unite`, `pourcentage_qte`) 
VALUES 
	-- DDI
	('2025-MMG-DIV-338', '1231323681', '32', NULL, '7066203', '0.00', '0', '0', NULL, NULL),
	-- FPI 
	('2025-MMG-DIV-338', '1231323681', '95', NULL, '2730380', '0.00', '0', '0', NULL, NULL),
	-- RII 
	('2025-MMG-DIV-338', '1231323681', '38', NULL, '3179791', '0.00', '0', '0', NULL, NULL),
	-- COG 
	('2025-MMG-DIV-338', '1231323681', '35', NULL, '645851', '0.00', '0', '0', NULL, NULL),
	-- RLS 
	('2025-MMG-DIV-338', '1231323681', '3', NULL, '728586', '0.00', '0', '0', NULL, NULL),
	-- QPT 
	('2025-MMG-DIV-338', '1231323681', '33', NULL, '2314336', '0.00', '0', '0', NULL, NULL),
	-- RCO 
	('2025-MMG-DIV-338', '1231323681', '36', NULL, '35331', '0.00', '0', '0', NULL, NULL),
	-- CSO 
	('2025-MMG-DIV-338', '1231323681', '37', NULL, '25438', '0.00', '0', '0', NULL, NULL),
	-- RET 
	('2025-MMG-DIV-338', '1231323681', '39', NULL, '94177', '0.00', '0', '0', NULL, NULL),
	-- RAN 
	('2025-MMG-DIV-338', '1231323681', '40', NULL, '5935', '0.00', '0', '0', NULL, NULL),
	-- ANA 
	('2025-MMG-DIV-338', '1231323681', '41', NULL, '142454', '0.00', '0', '0', NULL, NULL),
	-- LAB 
	('2025-MMG-DIV-338', '1231323681', '42', NULL, '422152', '0.00', '0', '0', NULL, NULL),
	-- ROC 
	('2025-MMG-DIV-338', '1231323681', '43', NULL, '1286', '0.00', '0', '0', NULL, NULL),



	-- BIVAC 
	('2025-MMG-DIV-338', '1231323681', '46', NULL, '45', '0.00', '0', '1', NULL, NULL),
	-- NAC 
	('2025-MMG-DIV-338', '1231323681', '47', NULL, '15', '0.00', '0', '1', NULL, NULL),
	-- Frais Seguce 
	('2025-MMG-DIV-338', '1231323681', '44', NULL, '120', '0.00', '0', '1', NULL, NULL),
	-- Scelle Electronique 
	('2025-MMG-DIV-338', '1231323681', '45', NULL, '35', '0.00', '0', '1', NULL, NULL),
	-- OPS Cost 
	('2025-MMG-DIV-338', '1231323681', '100', NULL, '375', '0.00', '0', '1', NULL, NULL),
	-- Frais Agence 
	('2025-MMG-DIV-338', '1231323681', '21', NULL, '170', '0.00', '1', '1', NULL, NULL);


	-- -----------------------

DELIMITER //
CREATE PROCEDURE inserer_n_dossier(IN nombre_P INT, IN mask_ref_dos VARCHAR(20), dernier_num_P INT)
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE ref_dos_init INT DEFAULT dernier_num_P;
    WHILE i <= nombre_P DO
    	SET ref_dos_init = ref_dos_init + 1;
        INSERT INTO dossier (ref_dos, id_cli, num_lic, id_march, id_mod_lic, id_mod_trans, destination, id_util)
        VALUES (
            CONCAT(mask_ref_dos, ref_dos_init),
            850,
            'DEC1575043-1F62-EB',
            1,
            1,
            1,
            'CHINA',
            214
        );
        SET i = i + 1;
    END WHILE;
END //
DELIMITER ;

-- CALL inserer_n_dossier(300, 'EBR-RCU25-', 501)
-- CALL inserer_n_dossier(18, 'EBR-RCU25-', 801)





update facture_dossier
set date_fact = '2025-07-31'
where ref_fact in (
select fd.ref_fact
from facture_dossier fd, detail_facture_dossier det, dossier dos
where fd.ref_fact = det.ref_fact
	and det.id_dos = dos.id_dos
	and dos.ref_dos in 

('DLM-RF25-039',
'KAM-RF25-1172',
'KAM-RF25-1189',
'KAM-RF25-1125',
'KAM-RF25-1296',
'KAM-RF25-1097',
'KAM-RF25-1295',
'KIC-RF25-221',
'KIC-RF25-228',
'KIC-RF25-229',
'KIC-RF25-216',
'KIC-RF25-226',
'MMG-RF25-329',
'MMG-RF25-327',
'SDV-RF25-143')

group by fd.ref_fact



)


SELECT * 
from facture_dossier
where date_quit > '2025-07-31'
	and ref_fact in (
select fd.ref_fact
from facture_dossier fd, detail_facture_dossier det, dossier dos
where fd.ref_fact = det.ref_fact
	and det.id_dos = dos.id_dos
	and dos.date_quit <= '2025-07-31'
group by fd.ref_fact



)




INSERT INTO `detail_facture_dossier` (`ref_fact`, `id_dos`, `id_deb`, `detail`, `montant`, `montant_tva`, `tva`, `usd`, `unite`, `pourcentage_qte`) VALUES ('2025-MMG-DIV-470', '1231329148', '46', NULL, '540', '0', '0', '1', NULL, NULL);



-- SEGUCE
INSERT INTO `detail_facture_dossier` (`ref_fact`, `id_dos`, `id_deb`, `detail`, `montant`, `montant_tva`, `tva`, `usd`, `unite`, `pourcentage_qte`) 
SELECT '2025-MMG-DIV-470', id_dos, 44, NULL, 120, 0, '0', '1', NULL, NULL
from dossier 
where ref_dos in ('MMG-RF25-249');
-- Electronic Seal
INSERT INTO `detail_facture_dossier` (`ref_fact`, `id_dos`, `id_deb`, `detail`, `montant`, `montant_tva`, `tva`, `usd`, `unite`, `pourcentage_qte`) 
SELECT '2025-MMG-DIV-470', id_dos, 234, NULL, 35, 0, '0', '1', NULL, NULL
from dossier 
where ref_dos in ('MMG-RF25-249');
-- Electronic Seal
INSERT INTO `detail_facture_dossier` (`ref_fact`, `id_dos`, `id_deb`, `detail`, `montant`, `montant_tva`, `tva`, `usd`, `unite`, `pourcentage_qte`) 
SELECT '2025-MMG-DIV-470', id_dos, 100, NULL, 375, 0, '0', '1', NULL, NULL
from dossier 
where ref_dos in ('MMG-RF25-249');
-- Agency Fee
INSERT INTO `detail_facture_dossier` (`ref_fact`, `id_dos`, `id_deb`, `detail`, `montant`, `montant_tva`, `tva`, `usd`, `unite`, `pourcentage_qte`) 
SELECT '2025-MMG-DIV-470', id_dos, 21, NULL, 170, 0, '0', '1', NULL, NULL
from dossier 
where ref_dos in ('MMG-RF25-249');



-- Rapport licence Export
SELECT l.num_lic, l.date_val, exp.date_exp, REPLACE(l.poids, '.', ','), REPLACE(l.fob, '.', ','), cl.nom_cli, d.ref_dos, d.num_lot, REPLACE(d.poids, '.', ','), REPLACE(d.fob, '.', ','), mt.nom_mod_trans, d.road_manif, d.horse, d.trailer_1, d.trailer_2, d.ref_decl, d.date_decl, d.ref_liq, d.date_liq, d.ref_quit, d.date_quit
from licence l
left join expiration_licence exp
	on l.num_lic = exp.num_lic
    	and exp.id_etat = '1'
left join dossier d
	on d.num_lic = l.num_lic
left join mode_transport mt
	on d.id_mod_trans = mt.id_mod_trans
left join client cl
	on cl.id_cli = l.id_cli
where YEAR(l.date_val) = 2025
	and month(l.date_val) in ('7', '8')
	and l.id_mod_lic = 1




DELIMITER $$

CREATE FUNCTION get_sum_detail_facture_dossier_type_debours(id_dos_P INT, id_t_deb_P INT)

RETURNS DECIMAL(30, 4)
DETERMINISTIC
BEGIN
    DECLARE montant_R DECIMAL(30, 4);
    SELECT SUM(
				IF(det.usd='1', 
					IF(det.tva='1',
						det.montant*1.16,
						det.montant
					), 
					IF(det.tva='1',
						IF(det.montant_tva>0,
							((det.montant_tva+det.montant)/dos.roe_decl),
							(det.montant/dos.roe_decl)*1.16
						),
						(det.montant/dos.roe_decl)
					)
				)
			) INTO montant_R
	FROM detail_facture_dossier det, dossier dos, debours deb
	WHERE dos.id_dos = id_dos_P
		AND dos.id_dos = det.id_dos
		AND deb.id_deb = det.id_deb
		AND deb.id_t_deb = id_t_deb_P;

	RETURN (montant_R);
END$$
DELIMITER ;

-- Finance Cost
select det.ref_fact AS ref_fact, det.id_dos AS id_dos, ROUND(SUM(
				IF(det.usd='1', 
					IF(det.tva='1',
						det.montant*1.16,
						det.montant
					), 
					IF(det.tva='1',
						IF(det.montant_tva>0,
							((det.montant_tva+det.montant)/dos.roe_decl),
							(det.montant/dos.roe_decl)*1.16
						),
						(det.montant/dos.roe_decl)
					)
				)
			), 4) AS montant,
            ROUND((SUM(
				IF(det.usd='1', 
					IF(det.tva='1',
						det.montant*1.16,
						det.montant
					), 
					IF(det.tva='1',
						IF(det.montant_tva>0,
							((det.montant_tva+det.montant)/dos.roe_decl),
							(det.montant/dos.roe_decl)*1.16
						),
						(det.montant/dos.roe_decl)
					)
				)
			)*0.015), 4) AS finance_charge,
            ROUND(((SUM(
				IF(det.usd='1', 
					IF(det.tva='1',
						det.montant*1.16,
						det.montant
					), 
					IF(det.tva='1',
						IF(det.montant_tva>0,
							((det.montant_tva+det.montant)/dos.roe_decl),
							(det.montant/dos.roe_decl)*1.16
						),
						(det.montant/dos.roe_decl)
					)
				)
			)*0.015)-(120*0.015*COUNT(dos.id_dos))), 4) AS finance_cost
from detail_facture_dossier det, dossier dos, debours deb
WHERE det.ref_fact in ('2025-STL-EXP-ZN-059', '2025-STL-EXP-ZN-060', '2025-STL-EXP-ZN-061')
	and det.id_dos = dos.id_dos
	and det.id_deb = deb.id_deb
    and deb.id_t_deb = 1
    and deb.id_deb <> 54
group by det.ref_fact




update detail_facture_dossier
set montant = montant - (120*0.015*N)
where ref_fact = '2025-STL-EXP-ZN-061'
and id_deb = 213

-- Loading Ass GCM
insert into detail_facture_dossier(id_dos, id_deb, montant, usd, ref_fact)

select dos.id_dos, 247, (dos.poids*1000)/dos.roe_decl, '1', det.ref_fact
from detail_facture_dossier det, dossier dos
where det.id_dos = dos.id_dos
and det.ref_fact like '2025-GDI-CU-%'
group by dos.id_dos
