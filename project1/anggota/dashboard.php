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
    <style>
        @media print {
            .title {
                font-size: 24px;
                display: none;
            }

            .tablee {
                width: 100%;
                border-collapse: collapse;
            }

            .tablee th,
            .tablee td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }

            .tablee th {
                background-color: #f2f2f2;

            }
        }
    </style>
</head>

<body>
    <h1 class="title">Welcome to the Admin Dashboard</h1>



    <table class="title">
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
    <table class="tablee">
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

        <button onclick="window.print()">Print</button>

</body>

</html>