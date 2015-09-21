<?php
$page_title = 'Add to Cart';
include ('includes/header.php');
include ('includes/helperFunctions.php');
if(isset($_GET['pid']) && is_numeric($_GET['pid'])){
    $pid = (int)$_GET['pid'];
    if(isset($_SESSION['cart'][$pid])){	
        $_SESSION['cart'][$pid]['quantity']++;
        echo '<p>Another copy of the print has been added to your shopping cart.
            <a href="browse_prints.php"><input type="button" name="continue" value="Continue Shopping"></a>
            <a href="view_cart.php"><input type="button" name="view_cart" value="View Cart" /></a>
        </p>';
    }else{
        $sql = "SELECT price FROM prints WHERE prints.print_id = :print_id";
        $sql_params = array(
            ':print_id' => $pid
        );
        $conn = connection();
        $results = returnResults($conn,$sql,$sql_params);
        if(is_array($results)){
            $_SESSION['cart'][$pid] = array(
                'quantity' => 1, 
                'price' => $results[0]['price']
            );
            echo '<p>The print has been added to your shopping cart.
            <a href="browse_prints.php"><input type="button" name="continue" value="Continue Shopping"></a>
            <a href="view_cart.php"><input type="button" name="view_cart" value="View Cart" /></a>
            </p>';
        }else{
            echo '<div align="center">'.$results.'</div>';
        }
    }
}else{
    echo '<div align="center">This page has been accessed in error!</div>';
}
include ('includes/footer.php');