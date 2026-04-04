<?php
$servername ="localhost";
$username="root";
$password="";
$database="ecommerse_side";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("connection failed:".mysqli_connect_error());
}
else{
    echo "connection successfull  krijan's database server";
}
?>