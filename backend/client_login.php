<?php
session_start();
include '../configuration/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: ../index.php?error=Please fill in all fields");
        exit;
    }

    $sql    = "SELECT * FROM user_authentication WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Store user in session
        $_SESSION['user']     = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['email']    = $user['email'];

        header("Location: ../index.php?login=success");
        exit;
    } else {
        header("Location: ../index.php?error=Invalid+credentials");
        exit;
    }
}
?>