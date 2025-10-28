<?php
require_once '../config/conn.php';
session_start();

if (isset($_GET['id'])) {
    $todayy = date('Y-m-d');
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT tgl_kembali FROM peminjaman WHERE id = $id");

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        if ($data['tgl_kembali'] < $todayy) {
            $denda = (strtotime($todayy) - strtotime($data['tgl_kembali'])) / (60 * 60 * 24) * 2000;
            mysqli_query($conn, "UPDATE peminjaman SET status = 'Terlambat', tgl_kembali = '$todayy', denda = $denda WHERE id = $id");
            mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id = (SELECT id_buku FROM peminjaman WHERE id = $id)");
        } else {
            mysqli_query($conn, "UPDATE peminjaman SET status = 'Dikembalikan', tgl_kembali  = '$todayy', denda = 0 WHERE id = $id");
            mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id = (SELECT id_buku FROM peminjaman WHERE id = $id)");
        }
    } else {
        echo "Data tidak ditemukan untuk ID: $id";
    }
}
?>