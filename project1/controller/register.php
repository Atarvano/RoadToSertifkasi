<?php
require_once '../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $username = trim(strtolower(htmlspecialchars($_POST['username'])));
    $password = htmlspecialchars($_POST['password']);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "Username already exists";
    } else {
        $query = "INSERT INTO user (nama, username, password, role) VALUES ('$nama', '$username', '$hash', 'admin')";
        if (mysqli_query($conn, $query)) {
            echo "Registration successful";
        } else {
            echo "Registration failed: " . mysqli_error($conn);
        }
    }

}



?>