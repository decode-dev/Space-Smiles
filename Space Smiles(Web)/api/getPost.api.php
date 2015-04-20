<?php

if(!defined("API")) {
	die("Direct access is permitted.");
}

$id = $_GET['id'];
if(empty($id)) 
{
	$throw = json_encode(array("error" => array("message" => "You must choose id to get a post.")));
	die($throw);
} else 
{
	$sql = "SELECT * FROM post WHERE id='$id'";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	if($count == 0) 
	{
		$throw = json_encode(array("error" => array("message" => "Wrong post ID.")));
		die($throw);
	} else {
		$data = mysql_fetch_array($query);
		$uid = $data['uid'];
		$uname = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id='$uid'"));
		$throw = json_encode(
			array("post" => array(
				"id" => $data['id'],
				"uid" => $data['uid'],
				"fullname" => $uname['name'],
				"url" => $data['url'],
				"description" => $data['description'],
				"postdate" => $data['postdate'],
				"stars" => $data['stars'],
				"published" => $data['published_with']
				)));
		echo $throw;
	}
}

?>