<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo (isset($page_title)) ? $page_title : 'Welcome!'; ?></title>
    <link rel="stylesheet" type="text/css" media="screen" href="includes/style.css" />    
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
    <script src="includes/jquery-2.1.4.js"></script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
<body>
<div class="table-responsive">
    <table class="table" cellspacing="0" cellpadding="0" border="0" align="center" width="90%">
        <tr>
            <td align="center" colspan="5"><img src="images/titles.jpg" width="600" height="61" border="0" alt="title or logo" /></td>
        </tr>
        <tr align="center">
            <td><a class="btn btn-default" href="index.php"><img src="images/homes.jpg" width="200" height="39" border="0" alt="home page" /></a></td>
            <td><a class="btn btn-default" href="browse_prints.php"><img src="images/print.jpg" width="200" height="39" border="0" alt="view the prints" /></a></td>
            <td><a class="btn btn-default" href="view_cart.php"><img src="images/carts.jpg" width="200" height="39" border="0" alt="view your cart" /></a></td>
            <?php
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                echo'<td>';
            ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-default"><?php echo'Welcome, '.htmlentities($_SESSION['user']['first_name'], ENT_QUOTES, 'UTF-8').' '.htmlentities($_SESSION['user']['last_name'], ENT_QUOTES, 'UTF-8').'';?></button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Edit Profile</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="sign_out" href="includes/helperFunctions.php?sign_out_submit=1">Sign Out</a></li>
                    </ul>
                </div>
            <?php }else{
                echo'<td><a class="btn btn-default" href="sign_in.php"><img src="" width="200" height="39" border="0" alt="Sign In" /></a></td>';
                echo'<td><a class="btn btn-default" href="register.php"><img src="" width="200" height="39" border="0" alt="Create Account" /></a></td>';
            }
            ?>
        </tr>
        <tr class="background_color">
            <td align="left" colspan="5" ><br />