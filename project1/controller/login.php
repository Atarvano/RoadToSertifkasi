<?php
require_once '../config/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = htmlspecialchars($_POST['password']);
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($query);
    if ($result && password_verify($password, $result['password'])) {
        if ($result['role'] === 'admin') {

            $_SESSION['username'] = $result['username'];
            $_SESSION['admin'] = $result['role'];
            header("Location: ../admin/dashboard.php");
        } else {
            $_SESSION['id_user'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['user'] = $result['role'];
            header("Location: ../anggota/dashboard.php");
        }
    } else {
        echo "Invalid username or password";
    }
}

?>