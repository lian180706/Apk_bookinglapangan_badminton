<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "apk_bokinglapangan_badminton"
);

if(!$conn){
    die("Koneksi gagal : " . mysqli_connect_error());
}

?>