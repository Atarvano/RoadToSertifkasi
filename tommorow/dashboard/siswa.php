<?php
require '../config/conn.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kelas</title>
</head>

<body>
    <ul>
        <li><a href="../dashboard/index.php">halaman utama</a></li>
        <li><a href="../dashboard/kelas.php">kelas</a></li>
        <li><a href="">siswa</a></li>
        <li><a href="">logout</a></li>
    </ul>
    <br>
    <hr>
    <h1>Menu</h1>
    <a href="kelas/create.php">Create Kelas</a>
    <hr>
    <table>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>nisn</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($conn, "SELECT s.id_siswa AS id, s.foto, s.nisn, s.nama_siswa, k.kelas from siswa as s JOIN kelas AS k ON s.id_kelas = k.id");
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>

                <td><?= $no++ ?></td>
                <td><img src="../uploads/<?= $row['foto'] ?>" alt="<?= $row['nama_siswa'] ?>"></td>
                <td><?= $row['nisn'] ?></td>
                <td><?= $row['nama_siswa'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><a href="kelas/delete.php?id=<?= $row['id'] ?>">delete</a> || <a
                        href="kelas/update.php?id=<?= $row['id'] ?>">update</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>

</html>