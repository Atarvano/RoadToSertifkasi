<?php
include 'config/conn.php';
?>

<h2>Tambah Booking Dokter</h2>

<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Nama Pasien</td>
            <td><input type="text" name="nama_pasien" required></td>
        </tr>
        <tr>
            <td>Nama Dokter</td>
            <td>
                <select name="id_dokter" required>
                    <option value="">-- Pilih Dokter --</option>
                    <?php
                    $dokter = mysqli_query($conn, "SELECT * FROM dokter ORDER BY nama_dokter ASC");
                    while ($d = mysqli_fetch_assoc($dokter)) {
                        echo "<option value='{$d['id_dokter']}'>{$d['nama_dokter']} ({$d['spesialis']})</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td><input type="date" name="tanggal" required></td>
        </tr>
        <tr>
            <td>Jam</td>
            <td><input type="time" name="jam" required></td>
        </tr>
        <tr>
            <td>Foto BPJS</td>
            <td><input type="file" name="foto_bpjs" accept=".jpg,.jpeg,.png" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="simpan">Simpan Booking</button></td>
        </tr>
    </table>
</form>

<?php

if (isset($_POST['simpan'])) {
    $nama_pasien = $_POST['nama_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $fototemp = $_FILES['foto_bpjs']['tmp_name'];
    $foto_name = $_FILES['foto_bpjs']['name'];
    $uploads = 'uploads/' . $foto_name;

    $query = mysqli_query($conn, "SELECT * FROM booking WHERE id_dokter = '$id_dokter' AND tanggal = '$tanggal' AND jam = '$jam'");

    if (mysqli_num_rows($query) > 0) {
        echo "Jam tersebut ada booking juga";
    } else {
        move_uploaded_file($fototemp, $uploads);

        mysqli_query($conn, "INSERT INTO booking (nama_pasien, id_dokter, tanggal, jam, foto_bpjs, status)
        VALUES ('$nama_pasien', '$id_dokter', '$tanggal', '$jam', '$foto_name', 'Menunggu')");

        echo "Data berhasil disimpan";
    }
}

?>