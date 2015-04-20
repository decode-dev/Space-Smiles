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
	$query = mysql_query("INSERT INTO stars (uid, pid) VALUES ('$uid', '$pid')");
	if($query) {
		$sql2 = "SELECT stars FROM post WHERE pid='$pid'";
		$query2 = mysql_query($sql2);
		$data2 = mysql_fetch_array($query2);
		$tmp_stars = $data2['stars'] + 1;
		$sql3 = "UPDATE post SET stars='$tmp_stars' WHERE id='$pid'";
		$query3 = mysql_query($sql3);
		if($query3) {
			$throw = json_encode(array("success" => 1));
			die($throw);
		} else {
			$throw = json_encode(array("success" => 0));
			die($throw);
		}
	} else {
		$throw = json_encode(array("success" => 0));
		die($throw);
	}
} else {
	$throw = json_encode(array("success" => 0));
	die($throw);
}

?>