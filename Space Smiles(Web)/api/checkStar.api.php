<?php
if(!defined("API")) {
	die("Access Denied");
}

$uid = $_GET['uid'];
$pid = $_GET['pid'];

if(empty($uid) || empty($pid)) {
	$throw = json_encode(array("success" => 0));
	die($throw);
}

$sql = "SELECT * FROM stars WHERE uid='$uid' AND pid='$pid'";
$query = mysql_query($sql);
$count = mysql_num_rows($query);

if($count == 0) {
	$throw = json_encode(array("result" => 0));
	die($throw);
} else {
	$throw = json_encode(array("result" => 1));
	die($throw);
}


?>