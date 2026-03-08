<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../configuration/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $product_name = $_POST['product_name'];
    $price        = $_POST['price'];
    $category     = $_POST['category'];
    $description  = $_POST['description'];

    $sql = "INSERT INTO product_detail (product_name, price, category, description)
            VALUES ('$product_name', '$price', '$category', '$description')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../template/adminside.php?message=Product added!");
        exit;
    } else {
        die("DB Error: " . mysqli_error($conn));
    }
}
?>