<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

<body>
    <?php
    require '../../config/conn.php';
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM kelas WHERE id = $id");
    $nama = mysqli_fetch_assoc($query);
    ?>
    <form action="update.php?id=<?= $id ?>" method="post">
        <label for="kelas"></label>
        <input type="text" name="kelas" id="" value="<?= $nama['kelas'] ?>">
        <button type="submit" name="submit">submit</button>
    </form>
</body>

<?php


if (isset($_POST['submit'])) {
    $kelas = trim(htmlspecialchars($_POST['kelas']));
    $id = $_GET['id'];
    $query = mysqli_query($conn, "UPDATE kelas SET kelas = '$kelas' WHERE id = $id ");
    if ($query) {
        echo "<script>alert('berhasil');    window.location.href = '../kelas.php';</script>";
    }
}

?>

</html>