<?php
require_once '../config/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim(strtolower(htmlspecialchars($_POST['username'])));
    $password = trim(htmlspecialchars($_POST['password']));
    $query = mysqli_query($conn, "SELECT * FROM user where username = '$username'");
    $result = mysqli_fetch_assoc($query);
    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['admin'] = $result['nama'];
        header('location:../dashboard/index.php');
    }
}