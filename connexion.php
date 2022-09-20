<?php
/*	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::MYSQL_ATTR_SSL_CA => 'classes/ca-certificate (4).crt',
		PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
	);
	$connexion = new PDO('mysql:host=db-mysql-sfo2-99144-do-user-4618658-0.b.db.ondigitalocean.com:25060;dbname=admin_malabar;charset=utf8','mrdc_db_user', 'AVNS__sws1ImaA17TOAKgSPg', $options);
*/
$servername = "db-mysql-sfo2-99144-do-user-4618658-0.b.db.ondigitalocean.com";
$username = "mrdc_db_user";
$password = "AVNS__sws1ImaA17TOAKgSPg";
$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	PDO::MYSQL_ATTR_SSL_CA => 'classes/ca-certificate (4).crt',
	PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
);

try {
    $connexion = new PDO("mysql:host=$servername;port=25060;dbname=db_name", $username, $password, $options);

    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
        //var_dump($conn->query("SHOW STATUS LIKE 'Ssl_cipher';")->fetchAll());
        //$conn = null;
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
}
?>
