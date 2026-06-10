<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

// CEK LOGIN //
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}
// CEK ID //
if (!isset($_GET['id']) || $_GET['id'] == 0) {
    echo "<script>
    alert('ID Lapangan tidak ditemukan!');
    window.location='../tampil_lapangan.php';
    </script>";
    exit;
}

$id_lapangan = $_GET['id'];

if ($id_lapangan == 0) {
    echo "ID Lapangan tidak ditemukan";
    exit;
}

// AMBIL DATA LAPANGAN //
$data = mysqli_query(
    $conn,
    "SELECT * FROM lapangan
WHERE id_lapangan='$id_lapangan'"
);

$lapangan =
    mysqli_fetch_assoc($data);
if (!$lapangan) {
    echo "<script>
    alert('Data lapangan tidak ditemukan!');
    window.location='../tampil_lapangan.php';
    </script>";
    exit;
}

// PROSES BOOKING //
if (isset($_POST['booking'])) {

    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $total = $_POST['total'];

    if (empty($_POST['total'])) {
        echo "<script>alert('Pilih jam dulu!');</script>";
        exit;
    }

    $id_user = $_SESSION['id_user'];

    mysqli_query(
        $conn,

        "INSERT INTO booking
(id_user,
id_lapangan,
tanggal,
jam_mulai,
jam_selesai,
total_harga,
status)

VALUES
('$id_user',
'$id_lapangan',
'$tanggal',
'$jam_mulai',
'$jam_selesai',
'$total',
'pending')"
    );

    $id_booking_baru = mysqli_insert_id($conn);

    echo "<script>
    alert('Booking berhasil');
    window.location='/BOOKING_BADMINTON/dashboard.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Booking Lapangan</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial;

            background: url('../bg6.jpg') no-repeat center;
            ;
            background-size: 90%;
            background-position: center;

        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .form {
            width: 380px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.55);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            position: relative;
            z-index: 2;
        }

        h2 {
            text-align: center;
            color: #27ae60;
            margin-bottom: 15px;
        }

        input {
            background: white;
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background: #27ae60;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1e8449;
            transform: scale(1.03);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</head>

<body>

    <div class="form">

        <h2>
            Booking
            <?= $lapangan['nama_lapangan'] ?>
        </h2>

        <form method="POST">

            Tanggal
            <input type="date" name="tanggal" required>

            Jam Mulai
            <input type="time" id="jam_mulai" name="jam_mulai" onchange="hitung()" required>

            Jam Selesai
            <input type="time" id="jam_selesai" name="jam_selesai" onchange="hitung()" required>

            Harga per jam
            <input type="text" id="harga" value="<?= $lapangan['harga_per_jam'] ?>" readonly>

            Total Harga
            <input type="text" id="total" name="total" readonly>

            <button type="submit" name="booking">
                Booking Sekarang
            </button>

        </form>

    </div>

    <script>
        function hitung() {

            let mulai = document.getElementById("jam_mulai").value;
            let selesai = document.getElementById("jam_selesai").value;
            let harga = document.getElementById("harga").value;

            if (mulai && selesai) {

                let jam1 = parseInt(mulai.split(":")[0]);
                let jam2 = parseInt(selesai.split(":")[0]);

                if (jam2 > jam1) {

                    let totalJam = jam2 - jam1;
                    let total = totalJam * harga;

                    document.getElementById("total").value = total;

                } else {
                    alert("Jam selesai harus lebih besar!");
                }

            }

        }
    </script>

</body>

</html>