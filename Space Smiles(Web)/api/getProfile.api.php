<?php

if(!defined("API")) {
	die("Direct access is permitted.");
}

$id = $_GET['id'];
if(empty($id)) {
	$throw = json_encode(array("result" => 0));
	die($throw);
} else {
	$sql = "SELECT * FROM users WHERE id='$id'";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	if($count != 0) {
		$data = mysql_fetch_array($query);
		$throw = json_encode(array(
			"result" => 1,
			"profile" => array(
				"id" => $data['id'],
				"username" => $data['username'],
				"email" => $data['email'],
				"name" => $data['name']
			)));
		die($throw);
	} else {
		$throw = json_encode(array("result" => 0));
		die($throw);
	}
}

?>