<?php 
$page_title = 'Order Confirmation';
include ('includes/header.php');
include ('includes/helperFunctions.php');
echo '<pre>';print_r($_SESSION);exit;
//$customer = ; 
//$total = ;
$conn = connection();
$sql = "INSERT INTO orders (customer_id, total) VALUES (:customer, :total)";
$results = insertOrders($conn,$sql,$customer,$total);
echo '<pre>';print_r($results);exit;
if (mysqli_affected_rows($dbc) == 1) {

	// Need the order ID:
	$oid = mysqli_insert_id($dbc);
	
	// Insert the specific order contents into the database...
	
	// Prepare the query:
	$q = "INSERT INTO order_contents (order_id, print_id, quantity, price) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($dbc, $q);
	mysqli_stmt_bind_param($stmt, 'iiid', $oid, $pid, $qty, $price);
	
	// Execute each query, count the total affected:
	$affected = 0;
	foreach ($_SESSION['cart'] as $pid => $item) {
		$qty = $item['quantity'];
		$price = $item['price'];
		mysqli_stmt_execute($stmt);
		$affected += mysqli_stmt_affected_rows($stmt);
	}

	// Close this prepared statement:
	mysqli_stmt_close($stmt);

	// Report on the success....
	if ($affected == count($_SESSION['cart'])) { // Whohoo!
	
		// Commit the transaction:
		mysqli_commit($dbc);
		
		// Clear the cart.
		unset($_SESSION['cart']);
		
		// Message to the customer:
		echo '<p>Thank you for your order. You will be notified when the items ship.</p>';
		
		// Send emails and do whatever else.
	
	} else { // Rollback and report the problem.
	
		mysqli_rollback($dbc);
		
		echo '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
		// Send the order information to the administrator.
		
	}

} else { // Rollback and report the problem.

	mysqli_rollback($dbc);

	echo '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
	
	// Send the order information to the administrator.
	
}

mysqli_close($dbc);

include ('includes/footer.php');