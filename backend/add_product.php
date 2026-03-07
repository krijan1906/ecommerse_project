<?php
include '../configuration/database_connection.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $product_name=$_POST['product_name'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $description=$_POST['description'];
    $sql="INSERT INTO product_detail(product_name,price,category,description) VALUES('$product_name','$price','$category','$description')";
    $result=mysqli_query($conn,$sql);
    if($result){
        header("Location: ../adminside.php?message=Product added successfully!");
        exit;
    }else{
        header("Location: ../adminside.php?error=".mysqli_error($conn));
        exit;
    }
}
?>