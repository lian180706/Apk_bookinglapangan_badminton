<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

/* CEK LOGIN */

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

/* CEK ID BOOKING */

if (!isset($_GET['id'])) {

    echo "<script>
alert('ID Booking tidak ditemukan');
window.location='booking/riwayat_booking.php';
</script>";

    exit;
}

$id_booking = $_GET['id'];

/* AMBIL DATA BOOKING */

$data = mysqli_query(
    $conn,

    "SELECT * FROM booking
WHERE id_booking='$id_booking'"
)

    or die(mysqli_error($conn));

$booking = mysqli_fetch_assoc($data);

if (!$booking) {

    echo "Data booking tidak ditemukan";
    exit;
}

/* PROSES PEMBAYARAN */

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bayar'])) {
    if ($booking['status'] == 'Selesai') {
        echo "Sudah dibayar";
        exit;
    }

    $metode = $_POST['metode'];

    $jumlah = $booking['total_harga'];

    mysqli_query($conn, "INSERT INTO pembayaran (id_booking, metode, jumlah, status) 
VALUES ('$id_booking', '$metode', '$jumlah', 'Lunas')");

    mysqli_query(
        $conn,

        "UPDATE booking
SET status='Selesai'
WHERE id_booking='$id_booking'"
    );

    echo "<script>
    alert('Pembayaran berhasil');
    window.location='../dashboard.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Pembayaran Lapangan</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;

            background:
                url('bg5.jpg') no-repeat center;

            background-size: cover;

            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {

            background: white;

            padding: 30px;

            width: 360px;

            border-radius: 15px;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.3);

        }

        .card h2 {

            text-align: center;

            color: #27ae60;

            margin-bottom: 20px;

        }

        label {

            font-weight: bold;

            display: block;

            margin-top: 10px;

        }

        select,
        input {

            width: 100%;

            padding: 10px;

            margin-top: 5px;

            border-radius: 8px;

            border: 1px solid #ccc;

        }

        button {

            width: 100%;

            margin-top: 20px;

            padding: 12px;

            background: #27ae60;

            border: none;

            color: white;

            font-size: 16px;

            border-radius: 10px;

            cursor: pointer;

        }

        button:hover {

            background: #1e8449;

        }

        .info {

            background: #e8f5e9;

            padding: 10px;

            margin-top: 10px;

            border-radius: 8px;

            font-size: 14px;

        }
    </style>

</head>

<body>

    <div class="card">

        <h2>
            Pembayaran Booking
        </h2>

        Total Bayar: Rp <?= number_format($booking['total_harga']) ?>
        Status: <?= $booking['status'] ?>

        <form method="POST">
            <div class="info">

                Total Bayar:
                <b>
                    Rp <?= number_format($booking['total_harga']) ?>
                </b>
            </div>

            <label>
                Metode Pembayaran
            </label>

            <select name="metode" required>

                <option value="">
                    -- Pilih Metode --
                </option>

                <option value="Transfer">
                    Transfer Bank
                </option>

                <option value="E-wallet">
                    E-Wallet
                </option>

                <option value="DANA">
                    DANA
                </option>

            </select>

            <button type="submit" name="bayar"
                onclick="return confirm('Yakin mau bayar?')">
                Bayar Sekarang
            </button>
        </form>

    </div>

</body>

</html>