<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

include '../configuration/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === 'krijan@gmail.com' && $password === 'admin123') {
        
        $_SESSION['user'] = $email;

        header("Location: ../template/adminside.php");
        exit();
    } else {
        echo "Invalid Username or Password!";
    }
}
?>