<?php

function checkStars($pid, $uid) {
	$sql = "SELECT * FROM stars WHERE pid='$pid' AND uid='$uid'";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	if($count == 0)
		return 0;
	else
		return 1;
}
?>