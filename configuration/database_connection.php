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
    echo "<h2 style='
        color:#4CAF50;
        font-family:Arial, sans-serif;
        text-align:center;
        margin-top:20px;
        text-shadow:1px 1px 5px rgba(0,0,0,0.2);
    '>🚀 Powered by Krijan Server</h2>";
}
?>