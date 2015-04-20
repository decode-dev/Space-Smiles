<?php
define("API", TRUE);
include "config.php";
$key = "testkey";
$getKey = stripslashes($_GET['key']);
if($key == $getKey) {
	$getFunc = stripslashes($_GET['function']);
	$functions = array("checkLogin", "sendReg", "getPost", "getCustomPost", "checkStar", "addStar", "removeStar", "getProfile", "addPost");
	$dir = "./api/".$getFunc.".api.php";
	if(in_array($getFunc, $functions)) {
		if(file_exists($dir)) {
			include $dir;
		} else {
			$throw = json_encode(array("error" => array("message" => "The selected function, does not reffeer to any file, please contact the server administrator.")));
			die($throw);
		}
	} else {
		$throw = json_encode(array("error" => array("message" => "Invalid function selected!")));
		die($throw);
	}

} else {
	$throw = json_encode(array("error" => array("message" => "You don't have access to this file.")));
	die($throw);
}

?>