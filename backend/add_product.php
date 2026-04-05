<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
include '../configuration/database_connection.php';

// INSERT PRODUCT
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Get form data
    $product_name = $_POST['product_name'];
    $price        = $_POST['price'];
    $category     = $_POST['category'];
    $description  = $_POST['description'];
    $old_price    = $_POST['old_price'];

    // Get image
    $image_name = $_FILES['image']['name'];
    $tmp_name   = $_FILES['image']['tmp_name'];

    // Create path
    $image_path = "uploads/" . $image_name;

    // Move image   
    if (move_uploaded_file($tmp_name, $image_path)) {
       echo "Image uploaded successfully";
    } else {
       die("Image upload failed!");
    }

    // Insert into DB
    $sql = "INSERT INTO product_detail 
            (product_name, price, category, description, old_price, image)
            VALUES 
            ('$product_name', '$price', '$category', '$description', '$old_price', '$image_path')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../template/adminside.php?message=Product added!");
        exit;
    } else {
        die("DB Error: " . mysqli_error($conn));
    }
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM product_detail WHERE id='$id'");
    header("Location: ../template/adminside.php");
    exit; 
}
?>