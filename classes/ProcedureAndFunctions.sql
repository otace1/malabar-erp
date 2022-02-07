DROP PROCEDURE IF EXISTS `nbreLicence`;

DELIMITER |
CREATE PROCEDURE nbreLicence(IN p_type_lic INT)
BEGIN
	DECLARE v_num_lic VARCHAR(100); 
	DECLARE v_fob_lic DECIMAL(20,2);
	DECLARE v_fob_dos_lic DECIMAL(20,2);
	DECLARE i INT DEFAULT 0;
	DECLARE done BOOL;
	
	DECLARE curs_licence CURSOR
		FOR SELECT num_lic, fob
			FROM licence
			WHERE id_mod_lic = p_type_lic;
		
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

	OPEN curs_licence;
	
	read_loop: LOOP

	    IF done THEN
	      LEAVE read_loop;
	    END IF;
	
		FETCH curs_licence INTO v_num_lic, v_fob_lic;
		SET v_fob_dos_lic = FobDossierLicence(v_num_lic);
	
		IF v_fob_dos_lic = v_fob_lic THEN
			SET i = i + 1;
		
		END IF;

	END LOOP;
	
	CLOSE curs_licence;
	
	SELECT i;

END |
DELIMITER ;