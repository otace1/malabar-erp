<?php
	
	include('connexion.php');

	$requete = $connexion-> query("DELIMITER |
								CREATE PROCEDURE aujourdhui_demain () 
								BEGIN
									DECLARE v_date DATE DEFAULT CURRENT_DATE();

									SELECT DATE_FORMAT(v_date, '%W %e %M %Y') AS Aujourdhui;
									SET v_date = v_date + INTERVAL 1 DAY; 
									SELECT DATE_FORMAT(v_date, '%W %e %M %Y') AS Demain; 
								END|
								DELIMITER ;");	
	
	
?>