<?php
function connection(){
    try{
        $results = new PDO("mysql:host=localhost;dbname=shopping_cart","johnny","Question1521");
        $results->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    }catch(PDOException $e){
        $results =  'ERROR: ' . $e->getMessage();
    }
    return $results;
}

function returnResults($conn,$sql){
    try{
        $statement = $conn->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();    
    }catch(PDOException $e){
        $results = 'ERROR: ' . $e->getMessage();
    }
    return $results;
}

function insertOrders($conn,$sql,$customer,$total){
    try{
        $statement = $conn->prepare($sql);
        $statement->bindParam(':customer', $customer);
        $statement->bindParam(':total', $total);
        $statement->execute(); 
        $results = $statement->lastInsertId();
    }catch(PDOException $e){
        $results = 'ERROR: ' . $e->getMessage();
    }
    return $results;
}

function insertOrderContent($conn,$sql){
    try{
        $statement = $conn->prepare($sql);
        $statement->execute();  
        $results;
    }catch(PDOException $e){
        $results = 'ERROR: ' . $e->getMessage();
    }
    return $results;
}

function getImage($name){
    $image_flag = FALSE;
    $upload_path = 'images/uploads/';
    $image = $upload_path.$name;
    if (!file_exists($image) || !is_file($image)){
        $image_flag = FALSE;
        $image = 'images/unavailable.png';
        $name = 'unavailable.png';
    }
    return $image;
}

if(isset($_POST['submit']) && $_POST['submit'] == 1){
   echo "inside if statement";exit;
}