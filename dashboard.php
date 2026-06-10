<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

/* TAMBAHKAN DI SINI */
include "koneksi.php";

$id_user = $_SESSION['id_user'];

$cek = mysqli_query(
    $conn,
    "SELECT * FROM booking
WHERE id_user='$id_user'
AND status='pending'
ORDER BY id_booking DESC
LIMIT 1"
);

$booking = mysqli_fetch_assoc($cek);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard Booking Badminton</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f5f6fa;
        }

        /* Navbar */

        .navbar {
            background: #2ecc71;
            color: white;
            padding: 15px;
            font-size: 20px;
        }

        /* Sidebar */

        .sidebar {
            width: 200px;
            height: 100vh;
            background: #34495e;
            position: fixed;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #2ecc71;
        }

        /* Content */

        .content {
            margin-left: 210px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
    </style>

</head>

<body>

    <div class="navbar">
        Booking Lapangan Badminton
    </div>

    <div class="sidebar">

        <a href="booking/tampil_lapangan.php">
            Booking
        </a>

        <?php if ($booking) { ?>

            <a href="pembayaran/pembayaran.php?id=<?= $booking['id_booking'] ?>">
                Pembayaran
            </a>

        <?php } else { ?>

            <a href="#" onclick="alert('Tidak ada booking yang belum dibayar')">
                Pembayaran
            </a>

        <?php } ?>

        <a href="booking/riwayat_booking.php">
            Riwayat
        </a>

        <a href="admin/logout.php">
            Logout
        </a>

    </div>

    <div class="content">

        <div class="card">

            <h2>
                Selamat Datang,
                <?php echo $_SESSION['nama']; ?>
            </h2>

            <p>
                Silakan pilih menu di samping.
            </p>

        </div>

    </div>

</body>

</html>