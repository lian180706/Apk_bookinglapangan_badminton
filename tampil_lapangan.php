<?php
require_once __DIR__ . '/../koneksi.php';

$data = mysqli_query(
    $conn,
    "SELECT * FROM lapangan"
);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Daftar Lapangan</title>

    <style>
        /* BACKGROUND */
        body {
            font-family: Arial;
            margin: 0;

            background: url('bg3.jpg');
            background-size: 100%;
        }

        /* JUDUL */
        h2 {
            text-align: center;
            color: white;
            margin-top: 120px;
        }

        /* CONTAINER */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        /* CARD */
        .card {
            background: white;
            width: 220px;
            padding: 20px;

            border-radius: 15px;

            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            transition: 0.3s;
        }

        /* HOVER */
        .card:hover {
            transform: translateY(-8px);
        }

        /* BUTTON */
        .btn {
            background: #2ecc71;
            color: white;

            padding: 10px 18px;

            text-decoration: none;

            border-radius: 8px;

            display: inline-block;

            margin-top: 10px;
        }

        /* BUTTON HOVER */
        .btn:hover {
            background: #27ae60;
        }
    </style>

</head>

<body>

    <h2>
        Daftar Lapangan Badminton
    </h2>

    <div class="container">

        <?php
        while ($row =
            mysqli_fetch_assoc($data)
        ) {
        ?>

            <div class="card">

                <h3>
                    <?= $row['nama_lapangan'] ?>
                </h3>

                <p>
                    Jenis:
                    <?= $row['jenis'] ?>
                </p>

                <p>
                    Harga:
                    Rp <?= number_format($row['harga_per_jam']) ?>/jam
                </p>

                <p>
                    Status:
                    <?= $row['status'] ?>
                </p>

                <a class="btn"
                    href="booking/booking.php?id=<?= $row['id_lapangan'] ?>">

                    Booking

                </a>

            </div>

        <?php } ?>

    </div>

</body>

</html>