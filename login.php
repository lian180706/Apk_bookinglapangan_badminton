<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$data = mysqli_query($conn,
"SELECT * FROM users
WHERE email='$email'");

$user = mysqli_fetch_assoc($data);

if($user &&
password_verify(
$password,
$user['password']
)){

$_SESSION['id_user']
= $user['id_user'];

$_SESSION['nama']
= $user['nama'];

header("Location: ../dashboard.php");

}else{

echo "<script>
alert('Login gagal!');
</script>";

}

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Login Booking Badminton</title>

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<style>

/* Background Gambar */

body {
    margin: 0;
    height: 100vh;
    background: url('bg1.jpg') no-repeat center;
    background-size: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Login Box */

.login-box{

background:rgba(255, 255, 255, 0.4);

padding:40px;

width:320px;

border-radius:15px;

box-shadow:
0 10px 25px rgba(0,0,0,0.4);

text-align:center;

animation: fadeIn 0.8s;

}

/* Logo */

.logo{

font-size:45px;

margin-bottom:10px;

}

/* Judul */

.login-box h2{

margin-bottom:20px;

color:#27ae60;

}

/* Input */

.input-group{

text-align:left;

margin-bottom:15px;

}

.input-group label{

font-size:14px;

font-weight:bold;

}

.input-group input{

width:100%;

padding:10px;

margin-top:5px;

border-radius:8px;

border:1px solid #ccc;

}

/* Button */

button{

width:100%;

padding:12px;

background:#27ae60;

border:none;

color:white;

font-size:16px;

border-radius:8px;

cursor:pointer;

transition:0.3s;

}

button:hover{

background:#1e8449;

transform:scale(1.03);

}

/* Link */

a{

color:#27ae60;

text-decoration:none;

}

/* Animasi */

@keyframes fadeIn{

from{
opacity:0;
transform:translateY(-20px);
}

to{
opacity:1;
transform:translateY(0);
}

}

</style>

</head>

<body>

<div class="login-box">

<div class="logo">

</div>

<h2>
Login Booking Lapangan
</h2>

<form method="POST">

<div class="input-group">

<label>Email</label>

<input
type="email"
name="email"
placeholder="Masukkan email"
required>

</div>

<div class="input-group">

<label>Password</label>

<input
type="password"
name="password"
placeholder="Masukkan password"
required>

</div>

<button name="login">

Login

</button>

</form>

<br>

<p style="font-size:14px;">

Belum punya akun?

<a href="register.php">

Daftar disini

</a>

</p>

</div>

</body>

</html>
