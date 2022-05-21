<?php
/*	include('../classes/connexion.php');
	include('function.php');
	$query = '';
	// $id_util = $_SESSION['id_util'];
	$id_util = 42;
	$output = array();
	$query .= " SELECT dos.ref_dos AS ref_dos,
						dos.date_preal AS date_preal,
						dos.ref_fact AS ref_fact,
						dos.commodity AS commodity,
						dos.supplier AS supplier ,
						dos.po_ref AS po_ref ,
						dos.poids AS poids 
					FROM dossier dos, client cl --, affectation_utilisateur_client afuc
						WHERE dos.id_cli = cl.id_cli
							-- AND afuc.id_cli = cl.id_cli
							-- AND afuc.id_util = $id_util";

	if(isset($_POST['search']['value'])){
		$query .= 'AND (dos.ref_dos LIKE "%'.$_POST['search']['value'].'%" 
						OR dos.ref_fact LIKE "%'.$_POST['search']['value'].'%" 
						OR dos.horse LIKE "%'.$_POST['search']['value'].'%" 
						OR dos.trailer_1 LIKE "%'.$_POST['search']['value'].'%" 
						OR dos.trailer_2 LIKE "%'.$_POST['search']['value'].'%" )';
	}

	if (isset($_POST['order'])) {
		$query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}else{
		$query .= ' ORDER BY dos.ref_dos DESC ';
	}

	if ($_POST['length'] != -1) {
		$query .= ' LIMIT '.$_POST['start'].' , '.$_POST['length'];
	}

	$requete = $connexion-> prepare($query);
	$requete-> execute();
	$reponse = $requete-> fetchAll();
	$data = array();
	$filtered_rows = $requete-> rowCount();
	$compteur = 0;

	foreach($reponse as $row){

		$compteur++;

		$sub_array = array();

		$sub_array = $compteur;
		$sub_array = $row['ref_dos'];
		$sub_array = $row['date_preal'];
		$sub_array = $row['ref_fact'];
		$sub_array = $row['commodity'];
		$sub_array = $row['supplier'];
		$sub_array = $row['po_ref'];
		$sub_array = $row['poids'];

		$data[] = $sub_array;

	}

	$output = array(
		"draw"				=> intval($_POST['draw']);
		"recordsTotal"		=> $filtered_rows,
		"recordsFiltered"	=> getRecords(),
		"data"				=> $data 
	);

	echo json_encode($output);

*/
include('../classes/connexion.php');
include('function.php');
$query = '';
$compteur = 1;
$output = array();
$query .= "SELECT * FROM dossier ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE ref_dos LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR horse LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id_dos DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connexion->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 

 $sub_array = array();

$sub_array = $compteur;
$sub_array = $row['ref_dos'];
$sub_array = $row['date_preal'];
$sub_array = $row['ref_fact'];
$sub_array = $row['commodity'];
$sub_array = $row['supplier'];
$sub_array = $row['po_ref'];
$sub_array = $row['poids'];

 
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => getRecords(),
 "data"    => $data
);
echo json_encode($output);

?>

