
<?php
	include "config.php";
	include "functions.php";
	$action = $_GET['action'];

	switch($action) {
		case "addStar":
		$uid = $_GET['uid'];
		$pid = $_GET['pid'];

		if(empty($uid) || empty($pid)) {
			header("Location: home.php");
			die();
		}
		if(checkStars($pid, $uid) == 0) {
			$query = mysql_query("INSERT INTO stars (uid, pid) VALUES ('$uid', '$pid')");
			if($query) {
				$sql = mysql_query("SELECT stars FROM post WHERE id='$pid'");
				$data = mysql_fetch_array($sql);
				$tmp_stars = $data['stars'] + 1;
				$sql = "UPDATE post SET stars='$tmp_stars' WHERE id='$pid'";
				$queryy = mysql_query($sql);
				header("Location: post.php?id=".$pid);
				die();
			} else {
				header("Location: home.php");
				die();
			}
		} else {
			header("Location: home.php");
			die();
		}
		break;
		case "removeStar":
			$uid = $_GET['uid'];
			$pid = $_GET['pid'];
			$sql = "SELECT * FROM stars WHERE uid='$uid' AND pid='$pid'";
			$query = mysql_query($sql);
			$count = mysql_num_rows($query);

			if($count == 1) {
				$sql2 = "DELETE FROM stars WHERE uid='$uid' AND pid='$pid'";
				$query2 = mysql_query($sql2);
				if($query2) {
					$data = mysql_fetch_array(mysql_query("SELECT stars FROM post WHERE id='$pid'"));
					$tmp_stars = $data['stars'] - 1;
					$query = mysql_query("UPDATE post SET stars='$tmp_stars' WHERE id='$pid'");
					if($query) {
						header("Location: post.php?id=".$pid);
						die();
					} else {
						header("Location: post.php?id=".$pid);
						die();
					}
				} else {
					header("Location: post.php?id=".$pid);
					die();
				}
			} else {
				header("Location: home.php");
				die();
			}	
		break;
		default:
			header("Location: home.php");
			die();
		}

?>