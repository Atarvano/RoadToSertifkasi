<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

<body>
    <form action="create.php" method="post">
        <label for="kelas"></label>
        <input type="text" name="kelas" id="">
        <button type="submit" name="submit">submit</button>
    </form>
</body>

<?php
require '../../config/conn.php';

if (isset($_POST['submit'])) {
    $kelas = trim(htmlspecialchars($_POST['kelas']));
    $query = mysqli_query($conn, "INSERT INTO kelas (kelas) VALUES ('$kelas') ");
    if ($query) {
        echo "<script>alert('berhasil')</script>";
    }
}

?>

</html>