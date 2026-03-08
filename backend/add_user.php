<?php
include '../configuration/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    

    $sql = "INSERT INTO user_authentication (fullname, email, password)
            VALUES ('$fullname', '$email', '$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../index.php?message=Account created!");
        exit;
    } else {
        header("Location: ../index.php?error=" . mysqli_error($conn));
        exit;
    }
}
?>