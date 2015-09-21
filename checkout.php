<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
$page_title = 'Order Confirmation';
include ('includes/header.php');
include ('includes/helperFunctions.php');
$customer = $_SESSION['user']['customer_id']; 
$total = $_SESSION['order_total'];    
$print_ids = '';
$quantity = '';
foreach ($_SESSION['cart'] as $pid => $value) {
    $print_ids .= $pid . ',';
    $quantity .= $value['quantity']  . ',';
}
$print_ids = trim(substr($print_ids, 0, -1));
$quantity = trim(substr($quantity, 0, -1));
$conn = connection();
$sql = "INSERT INTO orders (customer_id, total) VALUES (:customer, :total)";
$sql_params = array(
    ':customer' => $customer,
    ':total' => $total
); 
$results = insertContent($conn,$sql,$sql_params);
if(is_numeric($results)){	
    $conn->beginTransaction();
	$sql = "INSERT INTO order_content (order_id, print_id, quantity, price, customer_id)
         VALUES (:order_id, :print_id, :quantity, :price, :customer_id)";
	$sql_params = array(
        ':order_id' => rand(0, 1000000),
        ':print_id' => json_encode($print_ids),
        ':quantity' => json_encode($quantity),
        ':price' => $total,
        ':customer_id' => $_SESSION['user']['customer_id']
    );
    $results = insertContent($conn,$sql,$sql_params);
	if(is_numeric($results)){
		$conn->commit();
		unset($_SESSION['cart']);
		$message = '<p>Thank you for your order. You will be notified when the items ship.</p>';
        echo $message;
		// Send emails and do whatever else.	
	}else{
		$conn->rollBack();		
		$message = '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
		// Send the order information to the administrator.	
	}
}else{
	$conn->rollBack();
	$message = '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
	// Send the order information to the administrator.
}
include ('includes/footer.php');