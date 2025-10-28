<?php
require_once '../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_buku = intval($_POST['book_id']);
    $id_user = intval($_POST['id_user']);
    $tanggal_pinjam = date('Y-m-d');
    $tanggal_kembali = $_POST['kembali_tanggal'];
    $result = mysqli_query($conn, "SELECT stok FROM buku WHERE id = $id_buku");
    $book = mysqli_fetch_assoc($result);

    if ($book['stok'] <= 0) {
        echo "Book is out of stock";
        exit();
    } else {
        $queryy = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_user = $id_user AND status = 'Dipinjam'");
        if (mysqli_num_rows($queryy) >= 2) {
            echo "You have reached the maximum limit of 2 borrowed books.";
            exit();
        }
        $query = "INSERT INTO peminjaman (id_buku, id_user, tgl_pinjam, tgl_kembali, status) VALUES ($id_buku, $id_user, '$tanggal_pinjam', '$tanggal_kembali', 'Dipinjam')";
        if (mysqli_query($conn, $query)) {
            mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id = $id_buku");
            header("Location: ../anggota/dashboard.php");
            exit();
        } else {
            echo "Failed to borrow book: " . mysqli_error($conn);
        }
    }
}
?>