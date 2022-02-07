<?php
	function getMarchandiseLicence($num_lic){
		include('connexion.php');
		$entree['num_lic'] = $num_lic;

		$requete = $connexion-> prepare('SELECT UPPER(m.nom_march) AS nom_march
											FROM licence l, marchandise m
											WHERE l.num_lic = ?
												AND l.id_march = m.id_march');
		$requete-> execute(array($entree['num_lic']));
		$reponse = $requete-> fetch();
		if($reponse){
			return $reponse['nom_march'];
		}
	}
	
	function getLastEpirationLicence2($num_lic){
		include("connexion.php");
		$entree['num_lic'] = $num_lic;

		$requete = $connexion-> prepare("SELECT date_exp
											FROM expiration_licence
											WHERE num_lic = ?
											ORDER BY id_date_exp DESC LIMIT 0, 1");
		$requete-> execute(array($entree['num_lic']));
		$reponse = $requete-> fetch();

		return $reponse['date_exp'];
	}

	function getSommeFobLicence($num_lic){
		include('connexion.php');
		$entree['num_lic'] = $num_lic;

		$requete = $connexion-> prepare("SELECT SUM(fob) AS fob
											FROM dossier
											WHERE num_lic = ?
												AND cleared <> '2'");
		$requete-> execute(array($entree['num_lic']));
		$reponse = $requete-> fetch();
		if($reponse){
			return $reponse['fob'];
		}
	}

	function getSommePoidsLicence($num_lic){
		include('connexion.php');
		$entree['num_lic'] = $num_lic;

		$requete = $connexion-> prepare("SELECT SUM(poids) AS poids
											FROM dossier
											WHERE num_lic = ?
												AND cleared <> '2'");
		$requete-> execute(array($entree['num_lic']));
		$reponse = $requete-> fetch();
		if($reponse){
			return $reponse['poids'];
		}
	}

	function getDataLicence($num_lic){
		include('connexion.php');
		$entree['num_lic'] = $num_lic;

		$requete = $connexion-> prepare("SELECT *
											FROM licence
											WHERE num_lic = ?");
		$requete-> execute(array($entree['num_lic']));
		$reponse = $requete-> fetch();
		if($reponse){
			return $reponse;
		}
	}

	function getDataFacture($ref_fact){
		include('connexion.php');
		$entree['ref_fact'] = $ref_fact;

		$requete = $connexion-> prepare("SELECT *
											FROM facture_licence
											WHERE ref_fact = ?");
		$requete-> execute(array($entree['ref_fact']));
		$reponse = $requete-> fetch();
		if($reponse){
			return $reponse;
		}
	}

	function getDifferenceDate($date1, $date2){
		include('connexion.php');
		$entree['date1'] = $date1;
		$entree['date2'] = $date2;

		$requete = $connexion-> prepare('SELECT DATEDIFF(?,?) AS difference');
		$requete-> execute(array($entree['date1'], $entree['date2']));
		$reponse = $requete-> fetch();
		if($reponse){
			return $reponse['difference'];
		}
	}

	function selectionnerLicencePourClientModele($id_cli, $id_mod_lic){
		include('connexion.php');

		$entree['id_cli'] = $id_cli;
		$entree['id_mod_lic'] = $id_mod_lic;
		$option = "";
		$objResponse = new xajaxResponse();
		$bg = '';
		$style = '';
		$option = '<option></option><option value="UNDER VALUE">UNDER VALUE</option>';

		$requete = $connexion-> prepare("SELECT num_lic, fob, DATE(CURRENT_DATE()) AS aujourdhui
										FROM licence
										WHERE id_mod_lic = ?
											AND id_cli = ?
										ORDER BY date_creat_lic  DESC");

		$requete-> execute(array($entree['id_mod_lic'], $entree['id_cli']));

		while($reponse = $requete-> fetch()){

			$marchandise = getMarchandiseLicence($reponse['num_lic']);
			$date_exp = getLastEpirationLicence2($reponse['num_lic']);
			
			$bg = "bg-light";
			
			$style = '';//" style='color: black; background-color: orange;'";
			if( ($reponse['fob'] == getSommeFobLicence($reponse['num_lic'])) ){
				$bg = "bg-success";
				$style = " style=''";
			}else if($date_exp < $reponse['aujourdhui']){
				$bg = "bg-danger";
				$style = " style=''";
			}else if( (getDifferenceDate($date_exp, $reponse['aujourdhui']) < 30) && (getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) ){
				$bg = "bg-warning";
				$option .= '<option value="'.$reponse['num_lic'].'">
							'.$reponse['num_lic'].'
						</option>';
				$style = " style=''";
			}else if( (getDifferenceDate($date_exp, $reponse['aujourdhui']) < 30) && (getDifferenceDate($date_exp, $reponse['aujourdhui']) < 0) ){
				$bg = "bg-danger";
				$style = " style=''";
			} else if( ($reponse['fob'] >= getSommeFobLicence($reponse['num_lic'])) && (getSommeFobLicence($reponse['num_lic'])>0) ){
				$bg = "bg-info";
				$style = " style=''";
				$option .= '<option value="'.$reponse['num_lic'].'">
							'.$reponse['num_lic'].'
						</option>';
			}else{
				$option .= '<option value="'.$reponse['num_lic'].'">
							'.$reponse['num_lic'].'
						</option>';
			}
		}
		$objResponse-> addAssign("num_lic", "innerHTML", $option);
		return $objResponse-> getXML();
	}

	function selectionnerAVPourLicence($num_lic){
		include('connexion.php');

		$entree['num_lic'] = $num_lic;
		//$entree['id_mod_lic'] = $id_mod_lic;
		$option = "";
		$objResponse = new xajaxResponse();
		$bg = '';
		$style = '';
		$option = '<option></option>';

		$requete = $connexion-> prepare("SELECT cod
										FROM av
										WHERE num_lic = ?
										ORDER BY date_creat  DESC");

		$requete-> execute(array($entree['num_lic']));

		while($reponse = $requete-> fetch()){
			$option .= '<option value="'.$reponse['cod'].'">
							'.$reponse['cod'].'
						</option>';
		}
		$objResponse-> addAssign("av", "innerHTML", $option);
		return $objResponse-> getXML();
	}

	function selectionnerFacturePourClientModele($id_cli, $id_mod_lic){
		include('connexion.php');

		$entree['id_cli'] = $id_cli;
		$entree['id_mod_lic'] = $id_mod_lic;
		$option = "";
		$objResponse = new xajaxResponse();
		$bg = '';
		$style = '';
		$option = '<option></option>';

		$requete = $connexion-> prepare("SELECT *
										FROM facture_licence
										WHERE id_mod_lic = ?
											AND id_cli = ?
										ORDER BY date_creat_fact  DESC");

		$requete-> execute(array($entree['id_mod_lic'], $entree['id_cli']));

		while($reponse = $requete-> fetch()){

			
			$bg = "bg-light";
			
			$style = '';//" style='color: black; background-color: orange;'";
			
			$option .= '<option value="'.$reponse['ref_fact'].'">
						'.$reponse['ref_fact'].'
					</option>';

		}
		$objResponse-> addAssign("ref_fact_systeme", "innerHTML", $option);
		return $objResponse-> getXML();
	}

	function selectionnerLicenceExportPourClient($id_cli){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$option = "";
		$objResponse = new xajaxResponse();
		
		$requete = $connexion-> prepare("SELECT id_lic, num_lic
											FROM licence
												WHERE id_cli = ?
												AND type_lic = 'export'");
		$requete-> execute(array($entree['id_cli']));
		$reponse=$requete-> fetch();
		if($reponse){
			$option .= '<option value="'.$reponse['id_lic'].'">
						'.$reponse['num_lic'].'
					</option>';
			while ($reponse=$requete-> fetch()) {
				$option .= '<option value="'.$reponse['id_lic'].'">
							'.$reponse['num_lic'].'
						</option>';
			}$requete-> closeCursor();
			
		}else{
			$option .= '<option>
							Aucune licence d\'exportation
						</option>';
		}
		
		$objResponse-> addAssign("export_id_lic", "innerHTML", $option);
		return $objResponse-> getXML();
	}

	function selectionnerExonerationPourClient($id_cli){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$option = "";
		$objResponse = new xajaxResponse();
		
		$requete = $connexion-> prepare("SELECT id_exo, num_exo
											FROM exoneration
												WHERE id_cli = ?");
		$requete-> execute(array($entree['id_cli']));
		$reponse=$requete-> fetch();
		if($reponse){
			while ($reponse=$requete-> fetch()) {
				$option .= '<option value="'.$reponse['id_exo'].'">
							'.$reponse['num_exo'].'
						</option>';
			}
			
		}else{
			$option .= '<option>
							Aucune exoneration
						</option>';
		}
		
		$objResponse-> addAssign("id_exo", "innerHTML", $option);
		return $objResponse-> getXML();
	}


	function getMcaFileImport($id_cli, $id_type_trans){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';

		if($id_type_trans == '3'){

			$i = 1;
			$code = codePourClient($id_cli).'-AW'.date('y').'-'.$i;

			while(verifierExistanceMCAFile($code) == true){
				$i++;
				$code = codePourClient($id_cli).'-AW'.date('y').'-'.$i;
			}

		}
		else if($id_type_trans == '1'){

			$i = 1;
			$code = codePourClient($id_cli).'-SC'.date('y').'-'.$i;

			while(verifierExistanceMCAFile($code) == true){
				$i++;
				$code = codePourClient($id_cli).'-SC'.date('y').'-'.$i;
			}

		}
		else if($id_type_trans == '2'){

			$i = 1;
			$code = codePourClient($id_cli).'-'.date('y').'-'.$i;

			while(verifierExistanceMCAFile($code) == true){
				$i++;
				$code = codePourClient($id_cli).'-'.date('y').'-'.$i;
			}

		}

		return $code;
	}

	function getMcaFileCooper($id_cli, $id_type_trans, $id_prod){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';
		//$id_prod = 2;

		if($id_type_trans == '3'){

			
			$i = 1;
			$a = getTailleCompteur2($i);

			//Cooper
			if ($id_prod == '1') {
				$code = codePourClient($id_cli).'-C'.date('y').'-W'.$a;

				while(verifierExistanceMCAFile($code) == true){
					$i++;

					$a = getTailleCompteur2($i);

					$code = codePourClient($id_cli).'-C'.date('y').'-W'.$a;
				}
			}
			//Cobalt
			else if ($id_prod == '2') {
				$code = codePourClient($id_cli).'-CO'.date('y').'-W'.$a;

				while(verifierExistanceMCAFile($code) == true){
					$i++;

					$a = getTailleCompteur2($i);

					$code = codePourClient($id_cli).'-CO'.date('y').'-W'.$a;
				}
			}
			

		}
		else if($id_type_trans == '1'){

			$i = 1;

			$a = getTailleCompteur2($i);

			/*$code = codePourClient($id_cli).'-C'.date('y').'-SC'.$a;

			while(verifierExistanceMCAFile($code) == true){
				$i++;

				$a = getTailleCompteur2($i);

				$code = codePourClient($id_cli).'-C'.date('y').'-SC'.$a;
			}*/

			//Cooper
			if ($id_prod == '1') {
				$code = codePourClient($id_cli).'-C'.date('y').'-SC'.$a;

				while(verifierExistanceMCAFile($code) == true){
					$i++;

					$a = getTailleCompteur2($i);

					$code = codePourClient($id_cli).'-C'.date('y').'-SC'.$a;
				}
			}
			//Cobalt
			else if ($id_prod == '2') {
				$code = codePourClient($id_cli).'-CO'.date('y').'-SC'.$a;

				while(verifierExistanceMCAFile($code) == true){
					$i++;

					$a = getTailleCompteur2($i);

					$code = codePourClient($id_cli).'-CO'.date('y').'-SC'.$a;
				}
			}

		}
		else if($id_type_trans == '2'){


			$i = 1;
			
			$a = getTailleCompteur2($i);

			/*$code = codePourClient($id_cli).'-C'.date('y').'-'.$a;

			while(verifierExistanceMCAFile($code) == true){
				$i++;

				$a = getTailleCompteur2($i);

				$code = codePourClient($id_cli).'-C'.date('y').'-'.$a;
			}*/

			//Cooper
			if ($id_prod == '1') {

				//Teste TCC
				if ($id_cli == '20') {
					
					//$code = codePourClient($id_cli).'-C'.date('y').'-'.$a; 
					
					$code = codePourClient($id_cli).'-EX'.date('y').'-CU'.$a;
					//On saute a 130 compte tenu du decalage entre numero lot et mca file constate le 29/05/2019
					//$i=130;
					while(verifierExistanceMCAFile($code) == true){
						$i++;

						$a = getTailleCompteur2($i);

						//$code = codePourClient($id_cli).'-C'.date('y').'-'.$a; 
						$code = codePourClient($id_cli).'-EX'.date('y').'-CU'.$a;
					}

				}else{

					$code = codePourClient($id_cli).'-C'.date('y').'-'.$a;

					while(verifierExistanceMCAFile($code) == true){
						$i++;

						$a = getTailleCompteur2($i);

						$code = codePourClient($id_cli).'-C'.date('y').'-'.$a;
					}

				}
			}
			//Cobalt
			else if ($id_prod == '2') {

				//Teste TCC
				if ($id_cli == '20') {

					//$code = codePourClient($id_cli).'-CO'.date('y').'-'.$a;TCC-EX18-HC001
					$code = codePourClient($id_cli).'-EX'.date('y').'-HC'.$a;

					while(verifierExistanceMCAFile($code) == true){
						$i++;

						$a = getTailleCompteur2($i);

						//$code = codePourClient($id_cli).'-CO'.date('y').'-'.$a;
						$code = codePourClient($id_cli).'-EX'.date('y').'-HC'.$a;
					}

				}else{

					$code = codePourClient($id_cli).'-CO'.date('y').'-'.$a;

					while(verifierExistanceMCAFile($code) == true){
						$i++;

						$a = getTailleCompteur2($i);

						$code = codePourClient($id_cli).'-CO'.date('y').'-'.$a;
					}

				}
				
			}

		}

		return $code;
	}

	function getMcaFileAcid($id_cli, $id_type_trans){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';

		$i = 21;

		$a = getTailleCompteur2($i);

		$code = codePourClient($id_cli).'-Acid-'.date('y').'-'.$a;

		while(verifierExistanceMCAFile($code) == true){
			$i++;

			$a = getTailleCompteur2($i);

			$code = codePourClient($id_cli).'-Acid-'.date('y').'-'.$a;
		}

		return $code;
	}

	function getRefDos($id_cli, $id_type_trans, $id_march){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';

		$i = 1;

		$commodity_mask = '';

		if ($id_march == '6') {
			$commodity_mask = '-Acid-';
		}

		$a = getTailleCompteur2($i);

		//$code = codePourClient($id_cli).'-Acid-'.date('y').'-'.$a;
		$code = codePourClient($id_cli).$commodity_mask.date('y').'-'.$a;

		while(verifierExistanceMCAFile($code) == true){
			$i++;

			$a = getTailleCompteur2($i);

			$code = codePourClient($id_cli).$commodity_mask.date('y').'-'.$a;
		}

		return $code;
	}

	function getMcaFileDiluent($id_cli, $id_type_trans){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';

		$i = 1;

		$a = getTailleCompteur2($i);

		$code = codePourClient($id_cli).'-DIL-'.date('y').'-'.$a;

		while(verifierExistanceMCAFile($code) == true){
			$i++;

			$a = getTailleCompteur2($i);

			$code = codePourClient($id_cli).'-DIL-'.date('y').'-'.$a;
		}

		return $code;
	}

	function getMcaFileGeneral($id_cli, $id_type_trans, $type_gen){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';

		if($type_gen == 'general export'){

			$i = 1;

			$a = getTailleCompteur2($i);

			$code = codePourClient($id_cli).'-EXP'.date('y').'-W'.$a;

			while(verifierExistanceMCAFile($code) == true){
				$i++;

				$a = getTailleCompteur2($i);

				$code = codePourClient($id_cli).'-EXP'.date('y').'-W'.$a;
			}

		}
		else if($type_gen == 'general import'){

			//---------------------------------

			if($id_type_trans == '3' || $id_type_trans == '4'){

				$i = 1;

				$a = getTailleCompteur2($i);

				$code = codePourClient($id_cli).'-AW'.date('y').'-'.$a;

				while(verifierExistanceMCAFile($code) == true){
					$i++;

					$a = getTailleCompteur2($i);

					$code = codePourClient($id_cli).'-AW'.date('y').'-'.$a;
				}

			}
			else if($id_type_trans == '1' || $id_type_trans == '2'){

				$i = 1;

				$a = getTailleCompteur2($i);

				$code = codePourClient($id_cli).'-RF'.date('y').'-'.$a;

				while(verifierExistanceMCAFile($code) == true){
					$i++;

					$a = getTailleCompteur2($i);

					$code = codePourClient($id_cli).'-RF'.date('y').'-'.$a;
				}

			}
			//---------------------------------

		}

		return $code;
	}

	function getMcaFileSolvent($id_cli){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';

		$i = 1;

		$a = getTailleCompteur2($i);

		$code = codePourClient($id_cli).'-SOL'.date('y').'-'.$a;

		while(verifierExistanceMCAFile($code) == true){
			$i++;

			$a = getTailleCompteur2($i);

			$code = codePourClient($id_cli).'-SOL'.date('y').'-'.$a;
		}

		return $code;
	}

	function getMcaFileSulfure($id_cli){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';

		$i = 1;

		$a = getTailleCompteur2($i);

		$code = codePourClient($id_cli).'-SUL'.date('y').'-'.$a;

		while(verifierExistanceMCAFile($code) == true){
			$i++;

			$a = getTailleCompteur2($i);

			$code = codePourClient($id_cli).'-SUL'.date('y').'-'.$a;
		}

		return $code;
	}

	function getMcaFileSodium($id_cli){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$code = '';

		$i = 1;

		$a = getTailleCompteur2($i);

		$code = codePourClient($id_cli).'-SODIUM-'.date('y').'-'.$a;

		while(verifierExistanceMCAFile($code) == true){
			$i++;

			$a = getTailleCompteur2($i);

			$code = codePourClient($id_cli).'-SODIUM-'.date('y').'-'.$a;
		}

		return $code;
	}

	function codePourClient($id_cli){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;

		$requete = $connexion-> prepare("SELECT code_cli
											FROM client
												WHERE id_cli = ?");
		$requete-> execute(array($entree['id_cli']));
		$reponse=$requete-> fetch();
		if($reponse){
			return $reponse['code_cli'];
		}
	}

	function verifierExistanceMCAFile($mca_file){
		include('connexion.php');
		$entree['mca_file'] = $mca_file;

		$requete = $connexion-> prepare("SELECT id_dos
											FROM dossier
												WHERE ref_dos = ?");
		$requete-> execute(array($entree['mca_file']));
		$reponse=$requete-> fetch();
		if($reponse){
			return true;
		}
	}

	function verifierExistanceAvMask($cod){
		include('connexion.php');
		$entree['cod'] = $cod;

		$requete = $connexion-> prepare("SELECT id_dos
											FROM dossier
												WHERE cod = ?");
		$requete-> execute(array($entree['cod']));
		$reponse=$requete-> fetch();
		if($reponse){
			return true;
		}
	}

	function getTailleCompteur($i){
		if(strlen($i) == '1' ){
			$i = '000'.$i;
		}else if(strlen($i) == '2' ){
			$i = '00'.$i;
		}else if(strlen($i) == '3' ){
			$i = '0'.$i;
		}else if(strlen($i) == '4' ){
			$i = $i;
		}
		return $i;
	}

	function getTailleCompteur2($i){
		if(strlen($i) == '1' ){
			$i = '00'.$i;
		}else if(strlen($i) == '2' ){
			$i = '0'.$i;
		}else if(strlen($i) == '3' ){
			$i = $i;
		}
		return $i;
	}

	function afficherMcaFileCooper($id_cli, $id_type_trans, $id_prod){
		include('connexion.php');
		$code = getMcaFileCooper($id_cli, $id_type_trans, $id_prod);

		$input = "<input name='mca_file' type='text' class='form-control cc-exp'  type='text' value='$code' />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("mca_file", "innerHTML", $input);
		return $objResponse-> getXML();
	}
	
	function afficherFobMaxLicence($num_lic){
		include('connexion.php');
		$licence = getDataLicence($num_lic);

		if (isset($licence)) {
			if ($num_lic == 'UNDER VALUE') {
				// $input = "<input name='fob' type='number' step='0.01' class='form-control cc-exp' max='2500' />";
				$input = "<input name='fob' type='number' step='0.0001' class='form-control cc-exp' />";
				$inputPoids = "<input name='poids' type='number' step='0.0001' class='form-control cc-exp' />";
				$input3 = "<input name='fret' type='number' step='0.01' class='form-control cc-exp' />";
				$input4 = "<input name='assurance' type='number' step='0.01' class='form-control cc-exp' />";
				$input5 = "<input name='autre_frais' type='number' step='0.01' class='form-control cc-exp' />";
				$input2 = "<input type='number' class='form-control cc-exp' value='2500' disabled='disabled' />";
				$inputBalancePoids = "<input type='number' class='form-control cc-exp' value='' disabled='disabled' />";
			}else{
				$fob = $licence['fob']-getSommeFobLicence($num_lic);
				$poids = $licence['poids']-getSommePoidsLicence($num_lic);
				$input = "<input name='fob' type='number' step='0.0001' class='form-control cc-exp' max='$fob' />";
				$inputPoids = "<input name='poids' type='number' step='0.0001' class='form-control cc-exp' max='$poids' />";
				$input3 = "<input name='fret' type='number' step='0.01' class='form-control cc-exp' />";
				$input4 = "<input name='assurance' type='number' step='0.01' class='form-control cc-exp' />";
				$input5 = "<input name='autre_frais' type='number' step='0.01' class='form-control cc-exp' />";
				$input2 = "<input type='number' class='form-control cc-exp' value='$fob' disabled='disabled' />";
				$inputBalancePoids = "<input type='number' class='form-control cc-exp' value='$poids' disabled='disabled' />";
			}
		}else{
			$input = "<input name='fob' step='0.01' class='form-control cc-exp'  type='number' value='' />";
			$inputPoids = "<input name='poids' step='0.01' class='form-control cc-exp'  type='number' value='' />";
			$input3 = "<input name='fret' type='number' step='0.01' class='form-control cc-exp' />";
			$input4 = "<input name='assurance' type='number' step='0.01' class='form-control cc-exp' />";
			$input5 = "<input name='autre_frais' type='number' step='0.01' class='form-control cc-exp' />";
			$input2 = "<input step='0.01' class='form-control cc-exp'  type='number' disabled='disabled' />";
			$inputBalancePoids = "<input type='number' class='form-control cc-exp' value='' disabled='disabled' />";
		}

		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("fob", "innerHTML", $input);
		$objResponse-> addAssign("fret", "innerHTML", $input3);
		$objResponse-> addAssign("assurance", "innerHTML", $input4);
		$objResponse-> addAssign("autre_frais", "innerHTML", $input5);
		$objResponse-> addAssign("balance_fob", "innerHTML", $input2);
		$objResponse-> addAssign("balance_poids", "innerHTML", $inputBalancePoids);
		$objResponse-> addAssign("poids", "innerHTML", $inputPoids);
		return $objResponse-> getXML();
	}
	
	function afficherMaskAV($cod){
		include('connexion.php');

		$i = 1;
		//$input = "<input name='cod' type='text' value='$cod' class='form-control cc-exp' required/>";
		if (!empty($cod)) {
			
			$cod_dos = $cod.' '.$i;
			
			while ( verifierExistanceAvMask($cod_dos) == true) {
				$i++;
				$cod_dos = $cod.' '.$i;
			}

			//$cod_dos = verifierExistanceAvMask($cod.' '.$i);

			$input = "<input name='cod' type='text' value='$cod_dos' class='form-control cc-exp' required/>";

		}else{
			$input = "<input name='cod' class='form-control cc-exp'  type='text' value='' required/>";
		}

		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("cod_dos_1", "innerHTML", $input);
		return $objResponse-> getXML();
	}
	
	function afficherDetailFacture($ref_fact){
		include('connexion.php');
		$facture = getDataFacture($ref_fact);

		if (isset($facture)) {
			
			$date_fact = $facture['date_fact'];
			$fournisseur = $facture['fournisseur'];
			$date_val = $facture['date_val'];
			$commodity = $facture['commodity'];
			$fsi = $facture['fsi'];
			$aur = $facture['aur'];
			//$ = $facture[''];
			//$ = $facture[''];
			$inputFacture = "
							<input name='ref_fact' type='text' class='form-control cc-exp' value='$ref_fact' disabled='disabled'/>
							<input name='ref_fact' type='hidden' class='form-control cc-exp' value='$ref_fact'/>
							";
			$inputDateFacture = "
							<input name='' type='date' class='form-control cc-exp' value='$date_fact' disabled='disabled' />
							<input name='date_fact' type='hidden' class='form-control cc-exp' value='$date_fact'/>
							";
			$inputDateVal = "
							<input name='' type='date' class='form-control cc-exp' value='$date_val' disabled='disabled'/>
							<input type='hidden' class='form-control cc-exp' value='$date_val'/>
							";
			$inputFournisseur = "
							<input name='' type='text' class='form-control cc-exp' value='$fournisseur' disabled='disabled'/>
							<input name='fournisseur' type='hidden' class='form-control cc-exp' value='$fournisseur'/>
							";
			$inputFsi = "
							<input type='text' class='form-control cc-exp' value='$fsi' name='fsi'/>
							";
			$inputAur = "
							<input type='text' class='form-control cc-exp' value='$aur' name='aur' />
							";
			$inputCommodity = "
							<input name='' type='text' class='form-control cc-exp' value='$commodity' disabled='disabled'/>
							<input name='commodity' type='hidden' class='form-control cc-exp' value='$commodity'/>
							";
			$labelFichierFacture = "";
			$inputFichierFacture = "";
			//$input2 = "<input type='number' class='form-control cc-exp' value='$fob' disabled='disabled' />";

		}else{
			$inputFacture = "<input name='ref_fact' type='text' class='form-control cc-exp'  required/>";
			$inputDateFacture = "<input name='date_fact' type='date' class='form-control cc-exp'  required/>";
			$inputDateVal = "<input name='date_val_fact' type='date' class='form-control cc-exp'  required/>";
			$inputFournisseur = "<input name='fournisseur' type='text' class='form-control cc-exp'  required/>";
			$inputCommodity = "<input name='commodity' type='text' class='form-control cc-exp'  required/>";
			$inputFsi = "<input name='fsi' type='text' class='form-control cc-exp'  />";
			$inputAur = "<input name='fsi' type='text' class='form-control cc-exp'  />";
			$labelFichierFacture = "<label for='x_card_code' class='control-label mb-1'>FICHIER FACTURE</label>";
			$inputFichierFacture = "<input name='fichier_facture' type='file' class='form-control cc-exp'  required/>";
		}

		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("ref_fact", "innerHTML", $inputFacture);
		$objResponse-> addAssign("date_fact", "innerHTML", $inputDateFacture);
		$objResponse-> addAssign("date_val", "innerHTML", $inputDateVal);
		$objResponse-> addAssign("fournisseur", "innerHTML", $inputFournisseur);
		$objResponse-> addAssign("commodity", "innerHTML", $inputCommodity);
		$objResponse-> addAssign("fsi", "innerHTML", $inputFsi);
		$objResponse-> addAssign("aur", "innerHTML", $inputAur);
		$objResponse-> addAssign("lfichier_facture", "innerHTML", $labelFichierFacture);
		$objResponse-> addAssign("fichier_facture", "innerHTML", $inputFichierFacture);
		return $objResponse-> getXML();
		/*
		?>
		<script type="text/javascript">
			alert("<?php echo $ref_fact;?>");
		</script>
		<?php
		*/
	}
	
	function afficherDetailFactureExport($ref_fact){
		include('connexion.php');
		$facture = getDataFacture($ref_fact);

		if (isset($facture)) {
			
			$date_fact = $facture['date_fact'];
			$fournisseur = $facture['fournisseur'];
			$date_val = $facture['date_val'];
			$commodity = $facture['commodity'];
			//$ = $facture[''];
			//$ = $facture[''];
			$inputFacture = "
							<input name='ref_fact' type='text' class='form-control cc-exp' value='$ref_fact' disabled='disabled'/>
							<input name='ref_fact' type='hidden' class='form-control cc-exp' value='$ref_fact'/>
							";
			$inputDateFacture = "
							<input name='' type='date' class='form-control cc-exp' value='$date_fact' disabled='disabled' />
							<input name='date_fact' type='hidden' class='form-control cc-exp' value='$date_fact'/>
							";
			$inputDateVal = "
							<input name='' type='date' class='form-control cc-exp' value='$date_val' disabled='disabled'/>
							<input type='hidden' class='form-control cc-exp' value='$date_val'/>
							";
			$inputFournisseur = "
							<input name='' type='text' class='form-control cc-exp' value='$fournisseur' disabled='disabled'/>
							<input name='fournisseur' type='hidden' class='form-control cc-exp' value='$fournisseur'/>
							";
			$inputCommodity = "
							<input name='' type='text' class='form-control cc-exp' value='$commodity' disabled='disabled'/>
							<input name='commodity' type='hidden' class='form-control cc-exp' value='$commodity'/>
							";
			$labelFichierFacture = "";
			$inputFichierFacture = "";
			//$input2 = "<input type='number' class='form-control cc-exp' value='$fob' disabled='disabled' />";

		}else{
			$inputFacture = "<input name='ref_fact' type='text' class='form-control cc-exp'  required/>";
			$inputDateFacture = "<input name='date_fact' type='date' class='form-control cc-exp'  required/>";
			$inputDateVal = "<input name='date_val_fact' type='date' class='form-control cc-exp'  required/>";
			$inputFournisseur = "<input name='fournisseur' type='text' class='form-control cc-exp'  required/>";
			$inputCommodity = "<input name='commodity' type='text' class='form-control cc-exp'  required/>";
			$labelFichierFacture = "<label for='x_card_code' class='control-label mb-1'>FICHIER FACTURE</label>";
			$inputFichierFacture = "<input name='fichier_facture' type='file' class='form-control cc-exp'  required/>";
		}

		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("ref_factExport", "innerHTML", $inputFacture);
		$objResponse-> addAssign("date_factExport", "innerHTML", $inputDateFacture);
		$objResponse-> addAssign("date_valExport", "innerHTML", $inputDateVal);
		$objResponse-> addAssign("fournisseurExport", "innerHTML", $inputFournisseur);
		$objResponse-> addAssign("commodityExport", "innerHTML", $inputCommodity);
		$objResponse-> addAssign("lfichier_factureExport", "innerHTML", $labelFichierFacture);
		$objResponse-> addAssign("fichier_factureExport", "innerHTML", $inputFichierFacture);
		return $objResponse-> getXML();
		/*
		?>
		<script type="text/javascript">
			alert("<?php echo $ref_fact;?>");
		</script>
		<?php
		*/
	}
	
	function afficherDetailsDossier($id_dos){
		include('connexion.php');
		$maClasse = new maClasse();
		$num_lic = $maClasse-> getDossier($id_dos)['num_lic'];

		$input_num_lic = "<input value='$num_lic' type='text' class='form-control cc-exp' disabled />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("num_lic", "innerHTML", $input_num_lic);
		return $objResponse-> getXML();
	}
	
	function afficherDetailsDossierMutliple($id_dos, $i){
		include('connexion.php');
		$maClasse = new maClasse();
		$num_lic = $maClasse-> getDossier($id_dos)['num_lic'];
		$montant_decl = number_format($maClasse-> getDossier($id_dos)['fob'], 2, ',', ' ');
		$ref_decl = $maClasse-> getDossier($id_dos)['ref_decl'];
		$ref_liq = $maClasse-> getDossier($id_dos)['ref_liq'];
		$ref_quit = $maClasse-> getDossier($id_dos)['ref_quit'];

		$input_num_lic = "<input value='$num_lic' style='text-align: center; width: 100%; color: black;' type='text' style='' class='' disabled />";
		$input_montant_decl = "<input value='$montant_decl' style='text-align: right; width: 70%; color: black;' type='text' style='' class='' disabled />";
		$input_ref_decl = "<input value='$ref_decl' style='text-align: center; width: 55%; color: black;' type='text' style='' class='' disabled />";
		$input_ref_liq = "<input value='$ref_liq' style='text-align: center; width: 55%; color: black;' type='text' style='' class='' disabled />";
		$input_ref_quit = "<input value='$ref_quit' style='text-align: center; width: 55%; color: black;' type='text' style='' class='' disabled />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("num_lic$i", "innerHTML", $input_num_lic);
		$objResponse-> addAssign("montant_decl$i", "innerHTML", $input_montant_decl);
		$objResponse-> addAssign("ref_decl$i", "innerHTML", $input_ref_decl);
		$objResponse-> addAssign("ref_liq$i", "innerHTML", $input_ref_liq);
		$objResponse-> addAssign("ref_quit$i", "innerHTML", $input_ref_quit);
		return $objResponse-> getXML();
	}
	
	function afficherMcaFileAcid($id_cli, $id_type_trans){
		include('connexion.php');
		$code = getMcaFileAcid($id_cli, $id_type_trans);

		$input = "<input name='mca_file' type='text' class='form-control cc-exp'  type='text' value='$code' />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("mca_file", "innerHTML", $input);
		return $objResponse-> getXML();
	}
	
	function afficherRefDos($id_cli, $id_type_trans, $id_march){
		include('connexion.php');
		$code = getRefDos($id_cli, $id_type_trans, $id_march);

		$input = "<input name='ref_dos' type='text' class='form-control cc-exp'  type='text' value='$code' />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("ref_dos", "innerHTML", $input);
		return $objResponse-> getXML();
	}
	
	function afficherMcaFileDiluent($id_cli, $id_type_trans){
		include('connexion.php');
		$code = getMcaFileDiluent($id_cli, $id_type_trans);

		$input = "<input name='mca_file' type='text' class='form-control cc-exp'  type='text' value='$code' />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("mca_file", "innerHTML", $input);
		return $objResponse-> getXML();
	}
	
	function afficherMcaFileGeneral($id_cli, $id_type_trans, $type_gen){
		include('connexion.php');
		$code = getMcaFileGeneral($id_cli, $id_type_trans, $type_gen);

		$input = "<input name='mca_file' type='text' class='form-control cc-exp'  type='text' value='$code' />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("mca_file", "innerHTML", $input);
		return $objResponse-> getXML();
	}

	function afficherMcaFileSolvent($id_cli){
		include('connexion.php');
		$code = getMcaFileSolvent($id_cli);

		$input = "<input name='mca_file' type='text' class='form-control cc-exp'  type='text' value='$code' />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("mca_file", "innerHTML", $input);
		return $objResponse-> getXML();
	}
	
	function afficherMcaFileSulfure($id_cli){
		include('connexion.php');
		$code = getMcaFileSulfure($id_cli);

		$input = "<input name='mca_file' type='text' class='form-control cc-exp'  type='text' value='$code' />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("mca_file", "innerHTML", $input);
		return $objResponse-> getXML();
	}
	
	function afficherMcaFileSodium($id_cli){
		include('connexion.php');
		$code = getMcaFileSodium($id_cli);

		$input = "<input name='mca_file' type='text' class='form-control cc-exp'  type='text' value='$code' />";
		$compteur = 0;
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("mca_file", "innerHTML", $input);
		return $objResponse-> getXML();
	}
	
	function afficherFichierArchiveCooperVide(){

		include('connexion.php');

		$input1 = "<input name='fichier_1' type='file' class='form-control cc-exp' />";
		$input2 = "<input name='fichier_2' type='file' class='form-control cc-exp' />";
		$input3 = "<input name='fichier_3' type='file' class='form-control cc-exp' />";
		$input4 = "<input name='fichier_4' type='file' class='form-control cc-exp' />";
		$input5 = "<input name='fichier_5' type='file' class='form-control cc-exp' />";
		$input6 = "<input name='fichier_6' type='file' class='form-control cc-exp' />";
		$input7 = "<input name='fichier_7' type='file' class='form-control cc-exp' />";
		$input8 = "<input name='fichier_8' type='file' class='form-control cc-exp' />";
		$input9 = "<input name='fichier_9' type='file' class='form-control cc-exp' />";
		$input10 = "<input name='fichier_10' type='file' class='form-control cc-exp' />";
		
		
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("fichier_1", "innerHTML", $input1);
		$objResponse-> addAssign("fichier_2", "innerHTML", $input2);
		$objResponse-> addAssign("fichier_3", "innerHTML", $input3);
		$objResponse-> addAssign("fichier_4", "innerHTML", $input4);
		$objResponse-> addAssign("fichier_5", "innerHTML", $input5);
		$objResponse-> addAssign("fichier_6", "innerHTML", $input6);
		$objResponse-> addAssign("fichier_7", "innerHTML", $input7);
		$objResponse-> addAssign("fichier_8", "innerHTML", $input8);
		$objResponse-> addAssign("fichier_9", "innerHTML", $input9);
		$objResponse-> addAssign("fichier_10", "innerHTML", $input10);
		return $objResponse-> getXML();
	}

	function afficherFichierArchiveGIVide(){

		include('connexion.php');

		$input1 = "<input name='fichier_1' type='file' class='form-control cc-exp' />";
		$input2 = "<input name='fichier_2' type='file' class='form-control cc-exp' />";
		$input3 = "<input name='fichier_3' type='file' class='form-control cc-exp' />";
		$input4 = "<input name='fichier_4' type='file' class='form-control cc-exp' />";
		$input5 = "<input name='fichier_5' type='file' class='form-control cc-exp' />";
		$input6 = "<input name='fichier_6' type='file' class='form-control cc-exp' />";
		$input7 = "<input name='fichier_7' type='file' class='form-control cc-exp' />";
		$input8 = "<input name='fichier_8' type='file' class='form-control cc-exp' />";
		$input9 = "<input name='fichier_9' type='file' class='form-control cc-exp' />";
		$input10 = "<input name='fichier_10' type='file' class='form-control cc-exp' />";
		
		
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("fichier_1_a", "innerHTML", $input1);
		$objResponse-> addAssign("fichier_2_a", "innerHTML", $input2);
		$objResponse-> addAssign("fichier_3_a", "innerHTML", $input3);
		$objResponse-> addAssign("fichier_4_a", "innerHTML", $input4);
		$objResponse-> addAssign("fichier_5_a", "innerHTML", $input5);
		$objResponse-> addAssign("fichier_6_a", "innerHTML", $input6);
		$objResponse-> addAssign("fichier_7_a", "innerHTML", $input7);
		$objResponse-> addAssign("fichier_8_a", "innerHTML", $input8);
		$objResponse-> addAssign("fichier_9_a", "innerHTML", $input9);
		$objResponse-> addAssign("fichier_10_a", "innerHTML", $input10);
		return $objResponse-> getXML();
	}

	function afficherDossierArchiveCooperVide(){

		include('connexion.php');

		$input1 = "<option></option>";
		$input2 = "<option></option>";
		$input3 = "<option></option>";
		$input4 = "<option></option>";
		$input5 = "<option></option>";
		$input6 = "<option></option>";
		$input7 = "<option></option>";
		$input8 = "<option></option>";
		$input9 = "<option></option>";
		$input10 = "<option></option>";
		
		
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("id_track_1", "innerHTML", $input1);
		$objResponse-> addAssign("id_track_2", "innerHTML", $input2);
		$objResponse-> addAssign("id_track_3", "innerHTML", $input3);
		$objResponse-> addAssign("id_track_4", "innerHTML", $input4);
		$objResponse-> addAssign("id_track_5", "innerHTML", $input5);
		$objResponse-> addAssign("id_track_6", "innerHTML", $input6);
		$objResponse-> addAssign("id_track_7", "innerHTML", $input7);
		$objResponse-> addAssign("id_track_8", "innerHTML", $input8);
		$objResponse-> addAssign("id_track_9", "innerHTML", $input9);
		$objResponse-> addAssign("id_track_10", "innerHTML", $input10);
		return $objResponse-> getXML();
	}

	function afficherDossierArchiveGIVide(){

		include('connexion.php');

		$input1 = "<option></option>";
		$input2 = "<option></option>";
		$input3 = "<option></option>";
		$input4 = "<option></option>";
		$input5 = "<option></option>";
		$input6 = "<option></option>";
		$input7 = "<option></option>";
		$input8 = "<option></option>";
		$input9 = "<option></option>";
		$input10 = "<option></option>";
		
		
		$objResponse = new xajaxResponse();

		$objResponse-> addAssign("id_track_1_a", "innerHTML", $input1);
		$objResponse-> addAssign("id_track_2_a", "innerHTML", $input2);
		$objResponse-> addAssign("id_track_3_a", "innerHTML", $input3);
		$objResponse-> addAssign("id_track_4_a", "innerHTML", $input4);
		$objResponse-> addAssign("id_track_5_a", "innerHTML", $input5);
		$objResponse-> addAssign("id_track_6_a", "innerHTML", $input6);
		$objResponse-> addAssign("id_track_7_a", "innerHTML", $input7);
		$objResponse-> addAssign("id_track_8_a", "innerHTML", $input8);
		$objResponse-> addAssign("id_track_9_a", "innerHTML", $input9);
		$objResponse-> addAssign("id_track_10_a", "innerHTML", $input10);
		return $objResponse-> getXML();
	}

	function selectionnerDossierMineralPourClientEtProduit($id_cli, $id_prod){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$entree['id_prod'] = $id_prod;
		$option = "<option></option>";
		$objResponse = new xajaxResponse();
		
		$requete = $connexion-> prepare("SELECT t.id_track AS id_track, t.mca_file AS mca_file
											FROM tracking t, tracking_cooper tc
											WHERE t.id_track = tc.id_track
												AND t.id_cli = ?
												AND t.attache IS NULL
												AND tc.id_prod = ?
											ORDER BY t.id_track DESC");
		$requete-> execute(array($entree['id_cli'], $entree['id_prod']));
		$reponse=$requete-> fetch();
		if($reponse){
			while ($reponse=$requete-> fetch()) {
				$option .= '<option value="'.$reponse['id_track'].'">
							'.$reponse['mca_file'].'
						</option>';
			}
			
		}else{
			$option .= '<option>
							Aucun Dossier
						</option>';
		}
		
		$objResponse-> addAssign("id_track_1", "innerHTML", $option);
		$objResponse-> addAssign("id_track_2", "innerHTML", $option);
		$objResponse-> addAssign("id_track_3", "innerHTML", $option);
		$objResponse-> addAssign("id_track_4", "innerHTML", $option);
		$objResponse-> addAssign("id_track_5", "innerHTML", $option);
		$objResponse-> addAssign("id_track_6", "innerHTML", $option);
		$objResponse-> addAssign("id_track_7", "innerHTML", $option);
		$objResponse-> addAssign("id_track_8", "innerHTML", $option);
		$objResponse-> addAssign("id_track_9", "innerHTML", $option);
		$objResponse-> addAssign("id_track_10", "innerHTML", $option);
		return $objResponse-> getXML();
	}

	function selectionnerDossierGIPourClientEtModeTransport($id_cli, $id_mod){
		include('connexion.php');
		$entree['id_cli'] = $id_cli;
		$entree['id_mod'] = $id_mod;
		$option = "<option></option>";
		$objResponse = new xajaxResponse();
		
		$requete = $connexion-> prepare("SELECT t.id_track AS id_track, t.mca_file AS mca_file
											FROM tracking t, tracking_general tg
											WHERE t.id_track = tg.id_track
												AND t.id_cli = ?
												AND t.attache IS NULL
												AND t.id_mod = ?
												AND tg.type_gen = 'import'
											ORDER BY t.id_track DESC");
		$requete-> execute(array($entree['id_cli'], $entree['id_mod']));
		$reponse=$requete-> fetch();
		if($reponse){
			while ($reponse=$requete-> fetch()) {
				$option .= '<option value="'.$reponse['id_track'].'">
							'.$reponse['mca_file'].'
						</option>';
			}
			
		}else{
			$option .= '<option>
							Aucun Dossier
						</option>';
		}
		
		$objResponse-> addAssign("id_track_1_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_2_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_3_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_4_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_5_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_6_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_7_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_8_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_9_a", "innerHTML", $option);
		$objResponse-> addAssign("id_track_10_a", "innerHTML", $option);
		return $objResponse-> getXML();
	}

?>