DELIMITER |
CREATE OR REPLACE PROCEDURE nbreLicence () 
BEGIN
	DECLARE nbre INT|
	DECLARE v_num_lic VARCHAR(255)|
	DECLARE v_fob DECIMAL(20, 2)|
	DECLARE cursor1 cursor for 
		SELECT num_lic, fob from licence |

	open cursor1|
	Set nbre = 0;

	REPEAT 

		fetch from cursor1 INTO v_num_lic, v_fob|

		IF v_fob > 1000 THEN 

			SET nbre = nbre+1|

		END IF|


	END REPEAT|
	CLOSE cursor1|
	SELECT nbre|

END|
DELIMITER ;