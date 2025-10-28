<?php
require_once '../config/conn.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id = $id");
$data = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam <?= $id ?></title>
</head>

<body>
    <h1>Pinjam Buku: <?= htmlspecialchars($data['judul']) ?></h1>
    <form action="../controller/pinjam.php" method="post">
        <input type="hidden" name="book_id" value="<?= htmlspecialchars($data['id']) ?>">
        <label for="pinjam_tanggal">Tanggal Pinjam:</label>
        <input type="date" id="pinjam_tanggal" name="pinjam_tanggal" required>
        <br>
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
        <label for="kembali_tanggal">Tanggal Kembali:</label>
        <input type="date" id="kembali_tanggal" name="kembali_tanggal" required>
        <br>
        <input type="submit" value="Pinjam Buku">
    </form>
</body>

</html>