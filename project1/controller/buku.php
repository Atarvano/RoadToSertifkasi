<?php
require_once '../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = trim(htmlspecialchars($_POST['book_title']));
    $tahun = trim(htmlspecialchars($_POST['tahun']));
    $stok = trim(htmlspecialchars($_POST['stok']));
    $foto = $_FILES['foto']['name'];
    $temp = $_FILES['foto']['tmp_name'];
    $folder = '../uploads/' . $foto;

    if ($stok < 0) {
        echo "Stok cannot be negative";
        exit();
    } else {
        if (move_uploaded_file($temp, $folder)) {
            $query = "INSERT INTO buku (judul, tahun, stok, foto) VALUES ('$judul', '$tahun', '$stok', '$foto')";
            $result = mysqli_query($conn, $query);
            if ($result) {
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                echo "Failed to add book: " . mysqli_error($conn);
            }
        }
    }
}



?>