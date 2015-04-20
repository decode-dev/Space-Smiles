<?php
session_start();
include "config.php";
$action = stripslashes($_GET['action']);
switch($action) {
case "register":
	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email'])) {
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$password = md5($password);
		$name = mysql_real_escape_string($_POST['name']);
		$email = mysql_real_escape_string($_POST['email']);

		$sql = "SELECT * FROM users WHERE username='$username'";
		$query = mysql_query($sql);
		$count = mysql_num_rows($query);

		if($count == 0) {
			$sql = "SELECT * FROM users WHERE email='$email'";
			$query = mysql_query($sql);
			$count = mysql_num_rows($query);
			if($count == 0) {
				$query = mysql_query("INSERT INTO users (username, password, email, name) VALUES ('$username', '$password', '$email', '$name')") or die(mysql_error());
				if($query) {
					$data = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE username='$username'"));
					$_SESSION['username'] = $username;
					$_SESSION['uid'] = $data['id'];
					header("Location: home.php");
					die();
				} else {
					$_SESSION['message'] = "Registration failed. Try again later.";
					$_SESSION['msg-type'] = "fail";
					header("Location: index.php");
					die();
				}
			} else {
				$_SESSION['message'] = "User with the selected email already exists.";
				$_SESSION['msg-type'] = "fail";
				header("Location: index.php");
				die();
			}
		} else {
			$_SESSION['message'] = "User with the selected username already exists.";
			$_SESSION['msg-type'] = "fail";
			header("Location: index.php");
			die();
		}

	} else {
		$_SESSION['message'] = "Please fill in all fields.";
		$_SESSION['msg-type'] = "fail";
		header("Location: index.php");
		die();
	}
break;
case "login":
if(!empty($_POST['username']) && !empty($_POST['password'])) {
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$password = md5($password);

	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	$data = mysql_fetch_array($query);
	if($count == 1) {
		$_SESSION['username'] = $data['username'];
		$_SESSION['uid'] = $data['id'];
		header("Location: home.php");
		die();
	} else {
		$_SESSION['message'] = "Login failed. Please try again !";
		$_SESSION['msg-type'] = "fail";
 		header("Location: index.php");
		die();
	}
} else {
	$_SESSION['message'] = "Enter Username & Password !";
	$_SESSION['msg-type'] = "fail";
	header("Location: index.php");
	die();
}
break;
case "logout":
unset($_SESSION['username']);
unset($_SESSION['uid']);
$_SESSION['message'] = "You have been successfully logged out!";
$_SESSION['msg-type'] = "success";
header("Location: index.php");
die();
break;
default:
die("Access Denied");
}
?>