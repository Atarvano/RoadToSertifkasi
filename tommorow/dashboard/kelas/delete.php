<?php
require "../../config/conn.php";
$id = $_GET['id'];
if (mysqli_query($conn, "DELETE FROM KELAS WHERE id = $id")) {
    echo "<script>alert('berhasil');    window.location.href = '../kelas.php';</script>";
}
?>