<?php
require_once '../config/conn.php';

if (isset($_GET['id'])) {
    $query = mysqli_query($conn, "SELECT * FROM buku WHERE id = " . $_GET['id']);
    $data = mysqli_fetch_assoc($query);

    $id = $_GET['id'];
    $query = "DELETE FROM buku WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        if ($data) {
            $fotoPath = '../uploads/' . $data['foto'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
            echo "Book deleted successfully";
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    } else {
        echo "No user ID provided";
    }
}


?>