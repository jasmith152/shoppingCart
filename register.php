<?php 
    $page_title = 'Make an Impression!';
    include ('includes/header.php');
    include ('includes/helperFunctions.php');
?>
<div class="container" width="20%">
    <form class="form_login" name="login" action="includes/helperFunctions.php" method="post" border="0">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="name"class="form-control" id="first_name" placeholder="First Name" required="required">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="name" class="form-control" id="last_name" placeholder="Last Name" required="required">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Email address" required="required">
        </div>
        <div class="form-group">
            <label for="confirm_email">Confirm Email address</label>
            <input type="email" class="form-control" id="confirm_email" placeholder="Confirm Email address" required="required">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required="required">
        </div>
        <button type="submit" class="submit btn btn-default" value="1">Submit</button>
    </form>
</div>
<?php include ('includes/footer.php');