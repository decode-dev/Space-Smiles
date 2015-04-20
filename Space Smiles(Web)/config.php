<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "space_smiles";

// Uploads Configuration
$upload_dir = "uploads";

define("CMS", TRUE);

$connect = mysql_connect($host, $user, $pass);
$select = mysql_select_db($db);


if(!$connect)
	die("Cannot connect to MySQL");
else if(!$select)
	die("Cannot select Database!");
?>