<?php

if(!defined("API")) {
	die("Direct access is not permitted.");
}

$username = $_GET['username'];
$md5 = $_GET['md5'];
if(!isset($username) && !isset($md5)) {
	$throw = json_encode(array("result" => 0));
	die($throw);
} else {
	$sql = "SELECT * FROM users WHERE username = '$username' AND password='$md5'";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	$data = mysql_fetch_array($query);
	if($count != 0) {
		$throw = json_encode(array("result" => $count, "id" => $data['id']));
		die($throw);
	} else {
		$throw = json_encode(array("result" => 0));
		die($throw);
	}
}
?>