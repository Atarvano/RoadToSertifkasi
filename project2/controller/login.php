<?php
require_once '../config/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtolower(trim(htmlspecialchars($_POST['username'])));
    $password = strtolower(htmlspecialchars($_POST['password']));
    $query = mysqli_query($conn, "SELECT * FROM admin where username = '$username' ");
    $result = mysqli_fetch_assoc($query);

    if ($result && password_verify($password, $result['password'])) {
        echo "berhasil";
    } else {
        echo "gagal" . mysqli_error($conn);
    }
}



?>