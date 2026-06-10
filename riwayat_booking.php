<?php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$data = mysqli_query($conn, "
    SELECT booking.*, lapangan.nama_lapangan
    FROM booking
    JOIN lapangan ON booking.id_lapangan = lapangan.id_lapangan
    WHERE booking.id_user = '$id_user'
") or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Booking</title>
    <link rel="stylesheet" href="jquery.dataTables.min.css">
    </link>
    <script src="jquery-3.7.0.min.js"></script>
    <script src="jquery.dataTables.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f5f5f5;
            /* polos */
        }

        .container {
            width: 90%;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #2e8b57;
            color: white;
            padding: 10px;
        }

        td {
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #e0f7ea;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Riwayat Booking</h2>

        <table border="1" cellpadding="10" id="table1">

            <thead>
                <tr>
                    <th>Lapangan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= $row['nama_lapangan'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['jam_mulai'] ?> - <?= $row['jam_selesai'] ?></td>
                        <td>Rp <?= number_format($row['total_harga']) ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
    </div>

    <script>
        $(document).ready(function() {
            $('#table1').DataTable();
        });
    </script>

</body>

</html>