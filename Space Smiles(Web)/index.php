<?php
session_start();
include "config.php";
include "include.php";
if(isset($_SESSION['username']) && isset($_SESSION['uid'])) {
    header("Location: home.php");
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
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!-- JS -->
<script src="js/javascript.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.shake.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".container").hide(100);
        $(".message").hide();
        $(".message").fadeIn("slow").delay(5000);
        $(".message").fadeOut().delay(5000);
        $('.container').fadeIn("slow");
    });
</script>
<!-- FONTS -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

</head>
<body class="index">
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
<div class="container">
	<header>
    	<div id="logo" ><a href="#"><img src="img/logo.png" /></a></div>
        <div class="menu">
        	<ul>
            	<li><a href="#" class="active">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Info</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </header>
    <div id="content">
    	<div clas="row">
        	<div class="col-md-6 welcome">
        		<h1>Welcome</h1>
				<p>Space Smiles is an application where you can share your images with your friends and loved ones.
                And also make a postcards and send them the mto see the amazing pictures.
                Can also add description about the picture and the people can also satrt the image.</p>
        	</div>
            <div class="col-md-6 signup">
            	<h1>Sign Up</h1>
            	<div class="form-group">
                    <form action="process.php?action=register" method="POST">
  					<input type="text" class="form-control" id="name" placeholder="Name" name="name" />
                    <input type="text" class="form-control" id="email" placeholder="E-Mail" name="email" />
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" />
  					<input type="password" class="form-control" id="password" placeholder="Password" name="password" />
                    	<div class="bttns">
                    <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#login">Log In</button>
                    <input type="submit" id="signup" class="btn btn-primary" value="Sign Up" />
                    </form>
                    	</div>
				</div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>

<?php
unset($_SESSION['message']);
unset($_SESSION['msg-type']);
?>
<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="width:500px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Sign In</h4>
      </div>
      <div class="modal-body">
        <form action="process.php?action=login" method="post" name="login">
            <input type="text" name="username" class="form-control" id="usr" placeholder="Username">
            <input type="password" name="password" class="form-control" id="pwd" placeholder="Password"
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" name="Sign in" value="Sign In" />
      </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>