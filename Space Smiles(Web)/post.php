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
		$_SESSION['message'] = 'Please Login before you can access this page.';
		$_SESSION['msg-type'] = 'fail';
		header("Location: home.php");
		die();
	}
	
}
unset($_SESSION['message']);
unset($_SESSION['msg-type']);
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
<body class="single-post-index">
<header class="navbar-fixed-top"><div class="container">
    <div id="logo"><a href="index.php"><img src="img/logo.png" class="img-responsive" style="max-width: 64px; max-height: 64px;"/></a></div>
    <div class="menu feed">
      <ul>
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Info</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
  </div>
</header>
<?php
$sql = "SELECT * FROM post WHERE id='$id'";
$query = mysql_query($sql);
$data = mysql_fetch_array($query);
$uid = $data['uid'];
$data2 = mysql_fetch_array(mysql_query("SELECT name FROM users WHERE id='$uid'"));
?>
<section id="single-post">
	<div class="container">
    	<div class="big-image img-responsive clearfix" style="background-image: url(uploads/<?php echo $data['url']; ?>);"></div>
        <div class="info-bar">
        	<div class="photo-title">
        	<div class="avatar-post">
            	<img src="img/collins_avatar.png"  />
            </div>
            <span class="a-name"><?php echo $data2['name']; ?></span>
            <?php
            if(checkStars($data['id'], $_SESSION['uid']) == 0) {
                echo '<a href="star.php?action=addStar&uid='.$_SESSION['uid'].'&pid='.$data['id'].'" style="float:right;margin-right:20px;"><img src="img/star.png" /></a>';
            } else {
                echo '<a href="star.php?action=removeStar&uid='.$_SESSION['uid'].'&pid='.$data['id'].'" style="float:right;margin-right:20px;"><img src="img/star_gold.png" /></a>';
            }
            ?>
            <!--<img src="img/star.png"  class="star"/>-->
            </div>
            <div class="photo-description">
                <p>
                	<?php echo $data['description']; ?>
                </p>
            </div>
        </div>
    </div>
</section>

</body>
</html>
