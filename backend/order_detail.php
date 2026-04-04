<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../configuration/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name  = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name   = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email       = mysqli_real_escape_string($conn, $_POST['email']);
    $cart_items  = mysqli_real_escape_string($conn, $_POST['cart_items'] ?? '');
    $cart_amount = mysqli_real_escape_string($conn, $_POST['cart_amount'] ?? 0);

    $sql = "INSERT INTO orders (first_name, last_name, email, order_name, amount) 
        VALUES ('$first_name', '$last_name', '$email', '$cart_items', '$cart_amount')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../index.php?message=Order placed successfully!");
        exit;
    } else {
        die("DB Error: " . mysqli_error($conn));
    }
}
?>