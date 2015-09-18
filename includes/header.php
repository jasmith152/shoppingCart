<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo (isset($page_title)) ? $page_title : 'Welcome!'; ?></title>
    <link rel="stylesheet" type="text/css" media="screen" href="includes/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="includes/bootstrap/css/bootstrap.css" />
    <script type="text/javascript">    class="login"
        $(".submit").on('click', function(){
            alert('this is a test');
            $('.form_login').submit();
        });
    </script>
</head>
<body>
<table cellspacing="0" cellpadding="0" border="0" align="center" width="90%">
	<tr>
		<td align="center" colspan="5"><img src="images/titles.jpg" width="600" height="61" border="0" alt="title or logo" /></td>
	</tr>
	<tr align="center">
		<td><a href="index.php"><img src="images/homes.jpg" width="200" height="39" border="0" alt="home page" /></a></td>
		<td><a href="browse_prints.php"><img src="images/print.jpg" width="200" height="39" border="0" alt="view the prints" /></a></td>
		<td><a href="view_cart.php"><img src="images/carts.jpg" width="200" height="39" border="0" alt="view your cart" /></a></td>
        <td><a href="view_cart.php"><img src="" width="200" height="39" border="0" alt="Sign In" /></a></td>
        <td><a href="register.php"><img src="" width="200" height="39" border="0" alt="Create Account" /></a></td>
	</tr>
	<tr class="background_color">
		<td align="left" colspan="5" ><br />
