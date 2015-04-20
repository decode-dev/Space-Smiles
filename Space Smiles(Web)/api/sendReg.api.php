<?php

if(!defined("API")) 
{
	die("Direct access is not permitted.");
}

$name = $_GET['name'];
$username = $_GET['username'];
$email = $_GET['email'];
$password = $_GET['password'];

if(empty($name) || empty($username) || empty($email) || empty($password)) 
{
	$throw = json_encode(array("success" => 0));
	die($throw);
} else 
{
	$sql = mysql_query("SELECT * FROM users WHERE username = '$username'");
	$count = mysql_num_rows($sql);
	$sql2 = mysql_query("SELECT * FROM users WHERE email = '$email'");
	$count2 = mysql_num_rows($sql2);

	if($count != 0 || $count2 != 0) 
	{
		$throw = json_encode(array("success" => 0));
		die($throw);
	}

	$query = mysql_query("INSERT INTO users (username, password, email, name) VALUES ('$username', '$password', '$email', '$name')");
	if($query) 
	{
		$throw = json_encode(array("success" => 1));
		die($throw);
	} else 
	{
		$throw = json_encode(array("success" => -1));
		die($throw);
	}
}
?>