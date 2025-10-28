<?php
session_start();

if (!isset($_SESSION['admin'])) {
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

    <form action="../controller/buku.php" method="post" enctype="multipart/form-data">
        <label for="book_title">Book Title:</label>
        <input type="text" id="book_title" name="book_title" required>
        <br>
        <label for="tahun">Tahun:</label>
        <input type="date" id="tahun" name="tahun" required>
        <br>
        <label for="stok">Stok</label>
        <input type="number" id="stok" name="stok" required>
        <br>
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>
        <br>
        <input type="submit" value="Add Book">
    </form>

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
            echo "<tr>";
            echo "<td>" . htmlspecialchars($book['judul']) . "</td>";
            echo "<td>" . htmlspecialchars(date('Y F ', strtotime($book['tahun']))) . "</td>";
            echo "<td>" . htmlspecialchars($book['stok']) . "</td>";
            echo "<td><img src='../uploads/" . htmlspecialchars($book['foto']) . "' alt='" . htmlspecialchars($book['judul']) . "' width='100'></td>";
            echo "<td><a href='../controller/delete.php?id=" . $book['id'] . "' onclick=\"return confirm('Are you sure you want to delete this book?');\">Delete</a></td>";
            echo "</tr>";

        }
        ?>
    </table>


</body>

</html>