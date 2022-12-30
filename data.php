<?php

    require_once('connection.php');
    $query=mysqli_query($connection,"SELECT * FROM product");

    $result = array();
    while($row = mysqli_fetch_array($query)){
        array_push($result, array(
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'price' => $row['price'],
            'review' => $row['review']
        ));
    }

    
    function add_product(){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $review = $_POST['review'];
            
        // include database connection file
        include_once("connection.php");
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO product(product_id,product_name,price,review) VALUES('$product_id','$product_name','$price','$review')");
        
        // Show message when user added
        return $result;
    };

    function update_product(){	
        $product_id = $_POST['product_id'];
        $product_name=$_POST['product_name'];
        $price=$_POST['price'];
        $review=$_POST['review'];
        include_once("connection.php");
        // update user data
        $result= mysqli_query($mysqli, "UPDATE users SET product_name='$product_name',price='$price',review='$review' WHERE product_id=$product_id");
        
        return $result;
    }

    function delete_product(){
        include_once("connection.php");
        $product_id=$_GET['product_id'];
        $result = mysqli_query($mysqli, "DELETE FROM users WHERE product_id=$product_id");

        return $result;
    }
    
    echo json_encode(
        array('result'=> $result)
    );






?>