<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku</title>
</head>

<body>
    <h1>Welcome to the Admin Dashboard</h1>



    <table>
        <tr>
            <th>Book Title</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <?php
        require_once '../config/conn.php';
        $query = mysqli_query($conn, "SELECT * FROM buku");
        while ($book = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($book['judul']); ?></td>
                <td><?php echo htmlspecialchars(date('Y F ', strtotime($book['tahun']))); ?></td>
                <td><?php echo htmlspecialchars($book['stok']); ?></td>
                <td><img src="../uploads/<?php echo htmlspecialchars($book['foto']); ?>"
                        alt="<?php echo htmlspecialchars($book['judul']); ?>" width="100"></td>
                <td><a href="pinjam.php?id=<?php echo $book['id']; ?>">Pinjam</a>
                    <a href="kembalikan.php?id=<?php echo $book['id']; ?>">kembalikan</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>


    <h1>Buku Yang dipinjam</h1>
    <table>
        <tr>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
        </tr>
        <?php
        $id_user = $_SESSION['id_user'];
        $peminjaman_query = mysqli_query($conn, "SELECT p.id as id_peminjaman, p.tgl_pinjam, p.tgl_kembali, p.status, b.judul, b.foto FROM peminjaman p JOIN buku b ON p.id_buku = b.id WHERE p.id_user = $id_user");
        while ($pinjam = mysqli_fetch_assoc($peminjaman_query)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($pinjam['judul']); ?></td>
                <td><img style="width: 100px;" src="../uploads/<?php echo htmlspecialchars($pinjam['foto']); ?>" alt="">
                </td>
                <td><?php echo htmlspecialchars($pinjam['tgl_pinjam']); ?></td>
                <td><?php echo htmlspecialchars($pinjam['tgl_kembali']); ?></td>
                <td><?php echo htmlspecialchars($pinjam['status']); ?></td>

                <?php if ($pinjam['status'] == 'Dipinjam') { ?>
                    <td><a href="kembalikan.php?id=<?php echo $pinjam['id_peminjaman']; ?>">Kembalikan</a></td>
                <?php } ?>

            </tr>
            <?php
        }
        ?>


</body>

</html>