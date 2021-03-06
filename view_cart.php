<?php
$page_title = 'View Your Shopping Cart';
include ('includes/header.php');
include ('includes/helperFunctions.php');
if(isset($_POST['submitted'])){
	foreach($_POST['qty'] as $k => $v){
		$pid = (int)$k;
		$qty = (int)$v;		
		if($qty == 0){
            unset($_SESSION['cart'][$pid]);
		}elseif($qty > 0){
            $_SESSION['cart'][$pid]['quantity'] = $qty;
		}		
	} 
}
if(!empty($_SESSION['cart'])){
    $print_ids = '';
    foreach ($_SESSION['cart'] as $pid => $value) {
		$print_ids .= $pid . ',';
	}
    $print_ids = trim(substr($print_ids, 0, -1));
    $sql = "SELECT prints.*,artists.artists_id,CONCAT_WS(' ', first_name, middle_name, last_name) AS artist FROM prints AS prints
    JOIN artists ON prints.artist_id = artists.artists_id 
    WHERE prints.print_id IN (".$print_ids.") ORDER BY artists.last_name ASC";
    $sql_params = array();	
    $conn = connection();
    $results = returnResults($conn,$sql,$sql_params);
    $order_total = 0;
    if(is_array($results)){
        echo '<form action="view_cart.php" method="post">
                <table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
                    <tr>
                        <td align="left" width="30%"><b>Artist</b></td>
                        <td align="left" width="30%"><b>Print Name</b></td>
                        <td align="right" width="10%"><b>Price</b></td>
                        <td align="center" width="10%"><b>Qty</b></td>
                        <td align="right" width="10%"><b>Total Price</b></td>
                    </tr>';
        foreach($results as $row){
            $subtotal = $_SESSION['cart'][$row['print_id']]['quantity'] * $_SESSION['cart'][$row['print_id']]['price'];
            $order_total += $subtotal;
            $_SESSION['order_total'] = $order_total;
            echo '<tr>
            <td align="left">'.$row['artist'].'</td>
            <td align="left">'.$row['print_name'].'</td>
            <td align="right">'.$_SESSION['cart'][$row['print_id']]['price'].'</td>
            <td align="center"><input type="text size="3" name="qty['.$row['print_id'].']" value="'.$_SESSION['cart'][$row['print_id']]['quantity'].'" /></td>
            <td align="right">'.number_format ($subtotal, 2).'</td>
            </tr>';
        }
        echo '<tr>
                <td colspan="4" align="right"><b>Sub Total:</b></td>
                <td align="right">$'.number_format ($order_total, 2).'</td>
            </tr>';
        $tax = $order_total * .065;
        $order_total += $tax;
        echo '<tr>
                <td colspan="4" align="right"><b>Tax:</b></td>
                <td align="right">$'.number_format ($tax, 2).'</td>
            </tr>
            <tr>
                <td colspan="4" align="right"><b>Total:</b></td>
                <td align="right">$'.number_format ($order_total, 2).'</td>
            </tr>
        </table>
        <div align="center"><input class="btn btn-default" type="submit" name="submit" value="Update My Cart" /></div>
        <input type="hidden" name="submitted" value="TRUE" />
        </form>
        <p align="center">Enter a quantity of 0 to remove an item.
        <br /><br /><a class="btn btn-default" href="checkout.php">Checkout</a>
        <a class="btn btn-default" href="browse_prints.php">Continue Shopping</a></p>';
    }else{
        echo 'div align="center">'.$results.'</div>';
    }    
}else{
	echo '<p>Your cart is currently empty.</p>';
}
include ('includes/footer.php');