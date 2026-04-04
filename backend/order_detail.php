<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../configuration/database_connection.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
   
    $sql="INSERT INTO orders (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";
    $result=mysqli_query($conn,$sql);
    if($result){
        header("Location: ../index.php?message=Order placed successfully!");
        exit;
    }
    else{
        die("DB Error: " . mysqli_error($conn));
    }
}
?>
