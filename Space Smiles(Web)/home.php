<?php
session_start();
include "config.php";
include "functions.php";

if(!isset($_SESSION['username']) && !isset($_SESSION['uid'])) {
	$_SESSION['message'] = "Please login before u can access this page.";
	$_SESSION['msg-type'] = "fail";
	header("Location: index.php");
	die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="icon" href="img/favcon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favcon.ico" type="image/x-icon"/>
<title>Space Smiles</title>

<!-- CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="css/style.css?<?php echo time();?>" rel="stylesheet" type="text/css" />
<style type="text/css">
.row {
	margin-bottom:20px !important;
}
</style>
<!-- JS -->
<script src="js/javascript.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".message").hide();
        $(".message").fadeIn("slow").delay(5000);
        $(".message").fadeOut().delay(5000);
    });
</script>
<!-- FONTS -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
</head>
<body class="feed-index">
<?php
        if(isset($_SESSION['message'])) {
    ?>
    <div class="message <?php echo $_SESSION['msg-type']; ?>">
        <?php
            echo $_SESSION['message'];
        ?>
    </div>
    <?php
        }
    ?>
<header class="navbar-fixed-top"><div class="container">
    <div id="logo"><a href="#"><img src="img/logo.png" class="img-responsive" style="max-width: 64px; max-height: 64px;"/></a></div>
    <div class="menu feed">
      <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Info</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</header>
<section id="feed" class="container">
	<?php
		
		$sql = "SELECT * FROM post ORDER by id DESC";
		$query = mysql_query($sql);
		$count = mysql_num_rows($query);
		echo "<div class='row'>";
		for($i = 1; $i <= $count; $i++) {
			$data = mysql_fetch_array($query);
			$uid = $data['uid'];
            $id = $data['id'];
			$data2 = mysql_fetch_array(mysql_query("SELECT name FROM users WHERE id='$uid'"));
			echo "<div class=\"col-xs-6 col-sm-4 card\" onclick=\"location.href='post.php?id=".$id."'\">";
        	echo '<div class="title">
            	<div class="avatar"><img src="img/avatar.png" class="img-responsive" /></div>
                <div class="name"><p>'.$data2['name'].'</p></div>
                <div class="time"><time><a href="post.php?id='.$id.'">'.$data['postdate'].'</a></time></div>
            </div>
            <div class="image" style="background-image:url(\'uploads/'.$data['url'].'\');background-position: 50% 50%;
	background-size: cover;
	background-repeat: no-repeat;
	width: 345px;height: 230px;"></div>
            <div class="description">
            	<p>'.$data['description'].'</p>
                <div class="star">';
                	if(checkStars($data
                		['id'], $_SESSION['uid']) == 0) {
                		echo '<a href="star.php?action=addStar&uid='.$_SESSION['uid'].'&pid='.$data['id'].'"><img src="img/star.png" /></a>';
                	} else {
                		echo '<a href="star.php?action=removeStar&uid='.$_SESSION['uid'].'&pid='.$data['id'].'"><img src="img/star_gold.png" /></a>';
                	}
                    echo '<br />
                    <span class="counter">'.$data['stars'].'</span>
                </div>
            </div>
        </div>';
        if($i % 3 == 0)
        	echo "<!-- Row end --></div><div class='row'>";
        }

	?>
</div>
</section>

</body>
</html>
<?php
unset($_SESSION['message']);
unset($_SESSION['msg-type']);
?>