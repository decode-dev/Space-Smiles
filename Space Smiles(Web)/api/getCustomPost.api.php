<?php
if(!defined("API")) {
	die("Direct access is permitted.");
}

$num = $_GET['num'];
if(empty($num)) {
	$throw = json_encode(array("error" => array("message" => "You must enter number of requested posts!")));
	die($throw);
} else {
	$sql = "SELECT * FROM post ORDER by id DESC";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);

	if($count < $num) {
		$num = $count;
	}
	$query = mysql_query("SELECT * FROM post ORDER by id DESC LIMIT $num");
	while($data = mysql_fetch_array($query)) {
		$tmp .= $data['id'].";";
	}
	$ar = array("ids" => $tmp);
	$throw = json_encode($ar);
	die($throw);

}
?>