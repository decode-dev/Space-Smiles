<?php

if(!defined("API")) {
	die("Access Denied");
}

$uid = $_POST['uid'];
$img = $_POST['img'];
$description = $_POST['description'];
$postdate = date("H:i/d-m-Y");
$stars = 0;
if(!empty($uid) || !empty($img) || !empty($description)) {
	$str = base64_decode($img);
	$random = time().".jpg";
	$dir = "uploads/".$random;
	$fh = fopen($dir, "w") or die("Cannot create file.");
	fwrite($fh, $str);
	fclose($fh);
	$s = "SELECT url FROM post WHERE url='$random'";
	$q = mysql_query($s);
	$num = mysql_num_rows($q);
	if($num > 0) 
	{
		$throw = json_encode(array(
				"result" => 0
			));
		die($throw);
	} else 
	{
		$sql = mysql_query("INSERT INTO post (uid, url, description, postdate, stars) VALUES ('$uid', '$random', '$description', '$postdate', '$stars')");
		if($sql) 
		{
			$throw = json_encode(array(
					"result" => 1
				));
			die($throw);
		} else 
		{
			$throw = json_encode(array(
					"result" => -1
				));
			die($throw);
		}
	}
} else {
	$throw = json_encode(array(
			"result" => 0
		));
	die($throw);
}
?>