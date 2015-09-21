<?php
include ('includes/helperFunctions.php');
if(isset($_GET['pid']) && is_numeric($_GET['pid'])){ 
    $pid = (int)$_GET['pid']; 
    $sql = "SELECT prints.*,artists.artists_id,CONCAT_WS(' ', first_name, middle_name, last_name) AS artist FROM prints AS prints
    JOIN artists ON prints.artist_id = artists.artists_id WHERE prints.print_id = :print_id";
    $sql_params = array(
        ':print_id' => $pid
    );
    $conn = connection();
    $results = returnResults($conn,$sql,$sql_params);
    if(is_array($results)){
        foreach($results as $row){
            $page_title = $row['print_name'];
            include ('includes/header.php');
            echo '<div align="center"><b>'.$row['print_name'].'</b> by '.$row['artist'].'<br />';
            echo (is_null($row['size'])) ? '(No size information available)' : $row['size'];
            echo '<br />'.$row['price'];
            echo '</div><br />';
            $image = getImage($row['file_path']);
            if(!empty($image)){
                echo '<div align="center"><img src="'.$image.'" /></div><br />';	
            }else{
                echo '<div align="center">No image available.</div><br />'; 
            }
            echo '<p align="center">'.((is_null($row['description'])) ? '(No description available)' : $row['description']).'</p>';            
            echo '<p align="center"><a class="btn btn-default" href="add_cart.php?pid='.$pid.'">Add to Cart</a></p>';
        }
    }else{
        echo '<div align="center">{$results}</div>';
    }
}else{
    echo '<div align="center">No ID Passed</div>';
}
include ('includes/footer.php');