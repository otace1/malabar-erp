<?php		
	$keyword = strval($_POST['query']);
	$search_param = "%{$keyword}%";
	$entree['search_param'] = $search_param;
	include("../classes/connexion.php");
	//$conn =new mysqli('localhost', 'root', '' , 'blog_samples');

	$sql = $connexion->prepare("SELECT num_lic FROM licence WHERE num_lic LIKE ?");
	/*$sql->bind_param("s",$search_param);			
	$sql->execute();*/
	$sql-> execute(array($entree['search_param']));
	while($reponse = $sql-> fetch()){
		$numDos[] = $reponse["num_lic"];
	}$sql-> closeCursor();
	//echo '<br>';
	echo json_encode($numDos);
	/*$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$countryResult[] = $row["country_name"];
		}
		echo json_encode($countryResult);
	}
	$conn->close();*/
?>

