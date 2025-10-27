<?php
require_once '../config/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = htmlspecialchars($_POST['password']);
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($query);
    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['username'] = $result['username'];
        $_SESSION['role'] = $result['role'];
        echo "Login successful";
    } else {
        echo "Invalid username or password";
    }
}

?>