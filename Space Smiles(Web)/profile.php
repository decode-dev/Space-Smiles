<?php
session_start();
include "config.php";
include "functions.php";

$id = $_GET['id'];

if(empty($id)) {
	$_SESSION['message'] = 'You have selected an invalid post.';
	$_SESSION['msg-type'] = 'fail';
	header("Location: home.php");
	die();
} else {
	if(!isset($_SESSION['username']) && !isset($_SESSION['uid'])) {
		$_SESSION['message'] = 'Please login before u can access this page.';
		$_SESSION['msg-type'] = 'fail';
		header("Location: home.php");
		die();
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Spacetales</title>

<!-- CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!-- JS -->
<script src="js/javascript.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- FONTS -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
</head>
<body class="profile-index">
<header class="navbar-fixed-top"><div class="container">
    <div id="logo"><a href="#"><img src="img/logo.png" class="img-responsive" style="max-width: 64px; max-height: 64px;"/></a></div>
    <div class="menu feed">
      <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Info</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
  </div>
</header>
<?php
$sql = "SELECT * FROM users WHERE id='$id'";
$query = mysql_query($sql);
$count = mysql_num_rows($query);
if($count == 0) {
	$_SESSION['message'] = "Invalid User ID";
	$_SESSION['msg-type'] = "fail";
	header("Location: home.php");
	die();
} else {
	$data = mysql_fetch_array($query);
	$count_posts = mysql_num_rows(mysql_query("SELECT * FROM post WHERE uid='$id' ORDER by id DESC"));
?>
<section id="profile">
	<div id="cover">
    	<div id="profile-picture" class="clearfix">
        	<img src="img/franklin_big_avatar.jpg" class="img-thumbnail"/>
        </div>
        <div id="bio">
        	<h3><?php echo $data['name']; ?></h3>
        	<p><?php echo $data['about']; ?></p>
        </div>
    </div>
    <div id="short-info">
    	<div class="container">
        	<div id="posts">
            	<img src="img/posts.png" width="24" height="24" class="fllr"/>
                <p><?php echo $count_posts; ?></p>
            </div>
            <div id="followers">
            	<img src="img/follows.png" width="24" height="24" class="fllr" />
                <p>10k+</p>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="row">
    <?php
    	$i = 0;
    	$q = mysql_query("SELECT id,url FROM post WHERE uid='$id'");
    	while($data = mysql_fetch_array($q)) {
    		echo "<div class=\"col-xs-6 col-sm-4 boxs\" style=\"cursor:pointer; background-image:url(uploads/".$data['url'].");\" onclick=\"location.href='post.php?id=".$data['id']."'\"></div>";
     	}
    ?>
	</div>
    </div>

</section>
<?php
}
?>
</body>
</html>
