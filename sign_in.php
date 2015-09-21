<?php 
    $page_title = 'Make an Impression!';
    include ('includes/header.php');
    if(isset($_SESSION['error']['login_fail'])){
        echo '<div align="center">'.$_SESSION['error']['login_fail'].'</div>';
        unset($_SESSION['error']['login_fail']);
    }
?>
<div class="container">
    <form style="width:50%;margin-left:25%" class="form-horizontal" action="includes/helperFunctions.php" method="post" border="0">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
<!--  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>-->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="sign_in_submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>
</div>
<?php include ('includes/footer.php');