<?php
	require_once("connexion.php");
	require_once("maClasse.class.php");
	$maClasse = new MaClasse();

	if(!empty($_POST['num_lic']) && ($_POST['num_lic']=='UNDER VALUE')){
		?>
		<input type="text" name="balance_fob" value="2 500$" disabled class="form-control cc-exp">
		<?php
	}else if(!empty($_POST['num_lic'])){
		$requete = $connexion-> prepare("SELECT SUM(fob) AS fob
											FROM dossier
											WHERE num_lic = ?");
		$requete-> execute(array($_POST['num_lic']));
		$reponse = $requete-> fetch();
		$reponse['fob'] = $maClasse-> getLicence($_POST['num_lic'])['fob']-$reponse['fob'];
		?>
		<input type="text" name="balance_fob" value="<?php echo number_format($reponse['fob'], 2, ',', ' ');?>" disabled class="form-control cc-exp">
		<?php
	}
?>