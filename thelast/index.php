<?php
require_once "config/conn.php";
$id = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="tambah.php">Tambah booking</a>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Nama Dokter</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Foto BPJS</th>
            <th>Status</th>
        </tr>

        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT b.*, d.nama_dokter AS nama_dokter 
                                  FROM booking AS b 
                                  JOIN dokter d ON b.id_dokter = d.id_dokter 
                                  ORDER BY tanggal, jam");

        while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama_pasien']; ?></td>
                <td><?= $data['nama_dokter']; ?></td>
                <td><?= $data['tanggal']; ?></td>
                <td><?= $data['jam']; ?></td>
                <td>
                    <img src="uploads/<?= $data['foto_bpjs']; ?>" width="60" height="60"
                        style="object-fit:cover; border-radius:6px;">
                </td>
                <td><?= $data['status']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <?php
    $chart = mysqli_query($conn, "    SELECT d.nama_dokter AS nama_dokter, COUNT(*) AS total
    FROM booking AS b
    JOIN dokter AS d ON b.id_dokter = d.id_dokter
    WHERE b.status = 'Selesai'
    GROUP BY d.nama_dokter");
    $labels = [];
    $data = [];
    while ($row = mysqli_fetch_assoc($chart)) {
        $labels[] = $row['nama_dokter'];
        $data[] = $row['total'];
    }

    // ubah array jadi string untuk Chart.js
    $labelss = "'" . implode("','", $labels) . "'";
    $datas = implode(",", $data);

    ?>

    <!-- tempatkan di bawah hasil query -->
    <canvas id="myChart" width="400" height="200"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?= $labelss; ?>],
                datasets: [{
                    label: 'Total Pasien Selesai',
                    data: [<?= $datas; ?>],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: '#333',
                    borderRadius: 8
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Pasien per Dokter (Status: Selesai)',
                        font: {
                            size: 18
                        }
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>